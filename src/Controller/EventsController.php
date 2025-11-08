<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 */
class EventsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->requireLogin();
        $this->requireAdmin();
        
        // Disable layout for admin pages (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);
        
        // Auto-update event status when date passes
        // Ready to go → Archive, Preparing → Failed
        $today = date('Y-m-d');
        $pastEvents = $this->Events->find()
            ->where([
                'Events.event_date <' => $today,
                'OR' => [
                    ['Events.status' => 'Ready to go'],
                    ['Events.status' => 'Preparing']
                ]
            ])
            ->toArray();
        
        foreach ($pastEvents as $event) {
            if ($event->status === 'Ready to go') {
                $event->status = 'Archive';
            } elseif ($event->status === 'Preparing') {
                $event->status = 'Failed';
            }
            $this->Events->save($event);
        }
        
        $query = $this->Events->find()
            ->contain(['Organisations', 'Volunteers']);

        // A5 Requirement: Main search filters Title only
        $search = $this->request->getQuery('search');
        if ($search) {
            $query->where(['Events.title LIKE' => '%' . $search . '%']);
        }

        // A5 Requirement: Dedicated skills filter (can be combined with other criteria)
        $skills = $this->request->getQuery('skills');
        if ($skills) {
            $query->where(['Events.required_skills LIKE' => '%' . $skills . '%']);
        }

        // Filter by status (A3 logic preserved)
        $status = $this->request->getQuery('status');
        if ($status) {
            $query->where(['Events.status' => $status]);
        }

        // A5 Requirement: Filter by specific event date (can be combined with skills)
        // Support both date range and specific date
        $event_date = $this->request->getQuery('event_date');
        $date_from = $this->request->getQuery('date_from');
        $date_to = $this->request->getQuery('date_to');
        
        if ($event_date) {
            // Specific date search (A5 requirement: "10 October 2025" as event date)
            $query->where(['Events.event_date' => $event_date]);
        } else {
            // Date range (A3 logic preserved)
            if ($date_from) {
                $query->where(['Events.event_date >=' => $date_from]);
            }
            if ($date_to) {
                $query->where(['Events.event_date <=' => $date_to]);
            }
        }

        // Default ordering (can be overridden by paginator sort links)
        $query = $query->order(['Events.event_date' => 'DESC']);

        // Server-side pagination
        $events = $this->paginate($query, [
            'limit' => 10,
            'sortableFields' => ['Events.title', 'Events.event_date', 'Events.location', 'Organisations.org_name']
        ]);

        $this->set(compact('events', 'search', 'skills', 'status', 'event_date', 'date_from', 'date_to'));
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();
        
        // Disable layout for admin pages (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);
        
        $event = $this->Events->get($id, contain: ['Organisations', 'Volunteers']);
        
        // Get assigned volunteer IDs for display (A3 logic)
        $assignedVolunteerIds = [];
        foreach ($event->volunteers ?? [] as $volunteer) {
            $assignedVolunteerIds[] = $volunteer->id;
        }
        
        // Get all volunteers with their details for display (A3 logic)
        $volunteersTable = $this->fetchTable('Volunteers');
        $volunteers = $volunteersTable->find('all', [
            'order' => ['first_name' => 'ASC']
        ])->toArray();
        
        $this->set(compact('event', 'assignedVolunteerIds', 'volunteers'));
    }

    /**
     * Add method - A3 logic preserved: volunteer assignments
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->requireLogin();
        $this->requireAdmin();
        
        // Disable layout for admin pages (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);
        
        $event = $this->Events->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            
            // Handle volunteer assignments (A3 logic preserved)
            $volunteerIds = $data['volunteer_ids'] ?? [];
            unset($data['volunteer_ids']);
            
            $event = $this->Events->patchEntity($event, $data);
            
            if ($this->Events->save($event)) {
                // Handle volunteer assignments (A3 logic)
                if (!empty($volunteerIds)) {
                    $volunteerEventsTable = $this->fetchTable('VolunteerEvents');
                    foreach ($volunteerIds as $volunteerId) {
                        $volunteerEvent = $volunteerEventsTable->newEmptyEntity();
                        $volunteerEvent->event_id = $event->id;
                        $volunteerEvent->volunteer_id = $volunteerId;
                        $volunteerEventsTable->save($volunteerEvent);
                    }
                }
                
                $this->Flash->success(__('Event added successfully!'));

                return $this->redirect(['action' => 'index']);
            }
            // Display validation errors if save fails
            $errors = $event->getErrors();
            if (!empty($errors)) {
                foreach ($errors as $field => $fieldErrors) {
                    foreach ($fieldErrors as $error) {
                        $this->Flash->error(__('{0}: {1}', [ucfirst($field), $error]));
                    }
                }
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        // A5 Requirement: Use virtual fields for unambiguous dropdowns
        $organisations = $this->Events->Organisations->find('list', [
            'keyField' => 'id',
            'valueField' => function ($org) {
                return $org->org_name . ' - ' . $org->contact_person_full_name . ' (' . $org->industry . ')';
            }
        ])->order(['org_name' => 'ASC'])->all();
        
        $volunteersTable = $this->fetchTable('Volunteers');
        $volunteers = $volunteersTable->find('all', [
            'order' => ['first_name' => 'ASC']
        ])->toArray();
        
        $this->set(compact('event', 'organisations', 'volunteers'));
    }

    /**
     * Edit method - A3 logic preserved: volunteer assignments
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();
        
        // Disable layout for admin pages (has full HTML with sidebar like A3)
        $this->viewBuilder()->setLayout(null);
        
        $event = $this->Events->get($id, contain: ['Volunteers']);
        
        // Get currently assigned volunteer IDs (A3 logic)
        $assignedVolunteerIds = [];
        foreach ($event->volunteers ?? [] as $volunteer) {
            $assignedVolunteerIds[] = $volunteer->id;
        }
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            
            // Handle volunteer assignments (A3 logic preserved)
            $volunteerIds = $data['volunteer_ids'] ?? [];
            unset($data['volunteer_ids']);
            
            $event = $this->Events->patchEntity($event, $data);
            
            if ($this->Events->save($event)) {
                // Remove existing assignments and add new ones (A3 logic)
                $volunteerEventsTable = $this->fetchTable('VolunteerEvents');
                $volunteerEventsTable->deleteAll(['event_id' => $event->id]);
                
                if (!empty($volunteerIds)) {
                    foreach ($volunteerIds as $volunteerId) {
                        $volunteerEvent = $volunteerEventsTable->newEmptyEntity();
                        $volunteerEvent->event_id = $event->id;
                        $volunteerEvent->volunteer_id = $volunteerId;
                        $volunteerEventsTable->save($volunteerEvent);
                    }
                }
                
                $this->Flash->success(__('Event updated successfully!'));

                return $this->redirect(['action' => 'index']);
            }
            // Display validation errors if save fails
            $errors = $event->getErrors();
            if (!empty($errors)) {
                foreach ($errors as $field => $fieldErrors) {
                    foreach ($fieldErrors as $error) {
                        $this->Flash->error(__('{0}: {1}', [ucfirst($field), $error]));
                    }
                }
            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }
        // A5 Requirement: Use virtual fields for unambiguous dropdowns
        $organisations = $this->Events->Organisations->find('list', [
            'keyField' => 'id',
            'valueField' => function ($org) {
                return $org->org_name . ' - ' . $org->contact_person_full_name . ' (' . $org->industry . ')';
            }
        ])->order(['org_name' => 'ASC'])->all();
        
        $volunteersTable = $this->fetchTable('Volunteers');
        $volunteers = $volunteersTable->find('all', [
            'order' => ['first_name' => 'ASC']
        ])->toArray();
        
        $this->set(compact('event', 'organisations', 'volunteers', 'assignedVolunteerIds'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->requireLogin();
        $this->requireAdmin();
        $this->request->allowMethod(['post', 'delete']);

        // Remove volunteer assignments first (A3 logic)
        $volunteerEventsTable = $this->fetchTable('VolunteerEvents');
        $volunteerEventsTable->deleteAll(['event_id' => $id]);

        // Then delete the event
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('Event deleted successfully!'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
