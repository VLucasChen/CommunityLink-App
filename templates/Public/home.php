<div class="text-center mb-5">
    <h1 class="fw-bold text-primary">Welcome to CommunityLink</h1>
    <p class="text-muted lead">Connecting volunteers, organisations, and communities together.</p>
</div>

<h3 class="fw-bold mb-3">🌟 Upcoming Events</h3>
<div class="row">
<?php foreach ($events as $event): ?>
  <div class="col-md-4 mb-4">
    <div class="card shadow-sm h-100 border-0 rounded-4">
      <div class="card-body">
        <h5 class="card-title text-primary fw-bold"><?= h($event->title) ?></h5>
        <p><strong>Date:</strong> <?= $event->event_date->format('d M Y') ?></p>
        <p><strong>Organisation:</strong> <?= h($event->organisation->org_name ?? 'N/A') ?></p>
        <p><?= $this->Text->truncate($event->event_description, 100) ?></p>
      </div>
    </div>
  </div>
<?php endforeach; ?>
</div>
