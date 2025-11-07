<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Organisation> $organisations
 * @var \App\Model\Entity\Organisation $organisation
 */
use Cake\Utility\Text;

// Load CSS (trong layout đã có, nhưng an toàn thì giữ lại)
$this->Html->css([
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
    'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css'
], ['block' => true]);

$modalId = 'orgModal';
?>

<div class="container-fluid py-4">

    <!-- Flash Messages -->
    <?= $this->Flash->render() ?>

    <!-- Nút mở Modal Add -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>" onclick="setModal('add')">
            Add Organisation
        </button>
    </div>

    <!-- Bảng danh sách -->
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient bg-primary text-white py-3">
            <h4 class="mb-0">All Organisations</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Organisation</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Industry</th>
                            <th>Created</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($organisations)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                No organisations found. Click "Add Organisation" to create one.
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($organisations as $org): ?>
                        <tr class="border-start border-primary border-3">
                            <td class="ps-4">
                                <div class="fw-semibold"><?= h($org->org_name) ?></div>
                                <small class="text-muted"><?= Text::truncate($org->business_address, 40) ?></small>
                            </td>
                            <td>
                                <a href="mailto:<?= h($org->email) ?>" class="text-decoration-none">
                                    <?= h($org->email) ?>
                                </a>
                            </td>
                            <td><?= h($org->phone) ?></td>
                            <td>
                                <span class="badge bg-success"><?= h($org->industry) ?></span>
                            </td>
                            <td><?= $org->created?->format('d/m/Y') ?></td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <button class="btn btn-outline-info btn-sm" onclick="setModal('view', '<?= $org->id ?>')">
                                        View
                                    </button>
                                    <button class="btn btn-outline-warning btn-sm" onclick="setModal('edit', '<?= $org->id ?>')">
                                        Edit
                                    </button>
                                    <?= $this->Form->postLink(
                                        'Delete',
                                        ['action' => 'delete', $org->id],
                                        [
                                            'class' => 'btn btn-outline-danger btn-sm',
                                            'title' => 'Delete',
                                            'confirm' => 'Are you sure you want to delete "' . h($org->org_name) . '"?',
                                            'escape' => false
                                        ]
                                    ) ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        <div class="text-muted me-3">
            <?= $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} of {{count}}') ?>
        </div>
        <nav>
            <ul class="pagination shadow-sm">
                <?= $this->Paginator->prev('Previous', ['class' => 'page-link']) ?>
                <?= $this->Paginator->numbers(['class' => 'page-link']) ?>
                <?= $this->Paginator->next('Next', ['class' => 'page-link']) ?>
            </ul>
        </nav>
    </div>
</div>

<!-- ==================== MODAL ==================== -->
<div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content rounded-4 shadow-lg">
            <div class="modal-header bg-gradient bg-primary text-white">
                <h5 class="modal-title fw-bold" id="modalTitle">Add Organisation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="modalBody">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ==================== ẨN FORM ĐỂ JS LẤY HTML ==================== -->
<div style="display: none;" id="hiddenFormFields">
    <?= $this->Form->control('org_name', [
        'label' => 'Organisation Name',
        'class' => 'form-control',
        'required' => true
    ]) ?>
    <?= $this->Form->control('email', [
        'label' => 'Email',
        'type' => 'email',
        'class' => 'form-control'
    ]) ?>
    <?= $this->Form->control('phone', [
        'label' => 'Phone',
        'class' => 'form-control'
    ]) ?>
    <?= $this->Form->control('industry', [
        'label' => 'Industry',
        'class' => 'form-control'
    ]) ?>
    <?= $this->Form->control('business_address', [
        'label' => 'Business Address',
        'type' => 'textarea',
        'rows' => 2,
        'class' => 'form-control'
    ]) ?>
    <?= $this->Form->control('contact_person_full_name', [
        'label' => 'Contact Person',
        'class' => 'form-control'
    ]) ?>
    <?= $this->Form->control('help_description', [
        'label' => 'Help Description',
        'type' => 'textarea',
        'rows' => 3,
        'class' => 'form-control'
    ]) ?>
</div>

<!-- ==================== JAVASCRIPT ==================== -->
<?php $this->start('script'); ?>
<script>
// Đảm bảo DOM và Bootstrap đã load
document.addEventListener('DOMContentLoaded', function () {
    if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap JS not loaded!');
        return;
    }

    // Dữ liệu organisations
    const orgData = <?= json_encode(array_map(fn($org) => $org->toArray(), iterator_to_array($organisations))) ?>;

    // Hàm mở modal
    window.setModal = function(mode, id = null) {
        const modalEl = document.getElementById('<?= $modalId ?>');
        const title = document.getElementById('modalTitle');
        const body = document.getElementById('modalBody');
        const modal = new bootstrap.Modal(modalEl);

        const org = id ? orgData.find(o => o.id === id) : null;
        let html = '';

        if (mode === 'view' && org) {
            // === VIEW MODE ===
            title.textContent = `View: ${org.org_name}`;
            html = `
            <div class="row g-3">
                <div class="col-md-6"><strong>Name:</strong> ${org.org_name}</div>
                <div class="col-md-6"><strong>Email:</strong> <a href="mailto:${org.email}">${org.email}</a></div>
                <div class="col-md-6"><strong>Phone:</strong> ${org.phone}</div>
                <div class="col-md-6"><strong>Industry:</strong> <span class="badge bg-success">${org.industry}</span></div>
                <div class="col-12">
                    <strong>Address:</strong>
                    <div class="bg-light p-3 rounded small">${nl2br(org.business_address)}</div>
                </div>
                <div class="col-12"><strong>Contact:</strong> ${org.contact_person_full_name}</div>
                <div class="col-12">
                    <strong>Help Needed:</strong>
                    <div class="bg-light p-3 rounded">${nl2br(org.help_description)}</div>
                </div>
            </div>
            <div class="text-end mt-4">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>`;
        } else {
            // === ADD / EDIT MODE ===
            const isEdit = mode === 'edit';
            title.textContent = isEdit ? 'Edit Organisation' : 'Add Organisation';

            // Lấy HTML từ form ẩn
            const getFieldHTML = (name) => {
                const el = document.querySelector(`[name="${name}"]`);
                return el ? el.closest('.col-md-6, .col-12').outerHTML : '';
            };

            html = `
            <?= $this->Form->create(null, [
                'url' => ['action' => 'index'],
                'id' => 'orgForm',
                'class' => 'needs-validation',
                'novalidate' => true
            ]) ?>
            <?= $this->Form->hidden('id') ?>
            <div class="row g-3">
                ${getFieldHTML('org_name')}
                ${getFieldHTML('email')}
                ${getFieldHTML('phone')}
                ${getFieldHTML('industry')}
                ${getFieldHTML('business_address')}
                ${getFieldHTML('contact_person_full_name')}
                ${getFieldHTML('help_description')}
            </div>
            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary px-4">
                    ${isEdit ? 'Update' : 'Save'}
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
            <?= $this->Form->end() ?>`;

            // Điền dữ liệu khi Edit
            if (isEdit && org) {
                setTimeout(() => {
                    const form = document.getElementById('orgForm');
                    if (form) {
                        form.elements['id'].value = org.id;
                        form.elements['org_name'].value = org.org_name || '';
                        form.elements['email'].value = org.email || '';
                        form.elements['phone'].value = org.phone || '';
                        form.elements['industry'].value = org.industry || '';
                        form.elements['business_address'].value = org.business_address || '';
                        form.elements['contact_person_full_name'].value = org.contact_person_full_name || '';
                        form.elements['help_description'].value = org.help_description || '';
                    }
                }, 50);
            }
        }

        body.innerHTML = html;
        modal.show();
    };

    // Helper: nl2br
    function nl2br(str) {
        return (str + '').replace(/\n/g, '<br>');
    }
});
</script>
<?php $this->end(); ?>