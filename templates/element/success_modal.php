<?php
/**
 * Success Modal Component
 * 
 * @var \App\View\AppView $this
 * @var string $modalId Unique ID for the modal (default: 'successModal')
 * @var string $title Modal title (default: 'Success!')
 * @var string $message Modal message (default: 'The operation was completed successfully.')
 * @var array|null $actionLink Action link array ['controller' => '...', 'action' => '...', 'text' => '...'] (optional)
 * @var string $actionText Text for action button (default: 'View List')
 */

$modalId = $modalId ?? 'successModal';
$title = $title ?? 'Success!';
$message = $message ?? 'The operation was completed successfully.';
$actionLink = $actionLink ?? null;
$actionText = $actionText ?? 'View List';
?>

<!-- Success Modal -->
<div class="modal fade" id="<?= h($modalId) ?>" tabindex="-1" aria-labelledby="<?= h($modalId) ?>Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);">
            <div class="modal-body text-center py-4 px-5">
                <div class="mb-3">
                    <i class="bi bi-check-circle-fill" style="font-size: 4rem; color: #28a745;"></i>
                </div>
                <h4 class="modal-title mb-3" id="<?= h($modalId) ?>Label" style="color: var(--m3-on-surface); font-weight: 700;">
                    <?= h($title) ?>
                </h4>
                <p class="text-muted mb-4" style="font-size: 1rem;">
                    <?= h($message) ?>
                </p>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 12px; padding: 0.5rem 1.5rem;">
                        Close
                    </button>
                    <?php if ($actionLink): ?>
                        <?= $this->Html->link(
                            $actionText,
                            $actionLink,
                            ['class' => 'btn btn-primary', 'style' => 'border-radius: 12px; padding: 0.5rem 1.5rem;']
                        ) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if there's a success flash message
    const flashMessages = document.querySelectorAll('.message.success');
    const successModalElement = document.getElementById('<?= h($modalId) ?>');
    
    if (flashMessages.length > 0 && successModalElement) {
        // Wait a bit to ensure Bootstrap is loaded
        setTimeout(function() {
            // Check if Bootstrap is available
            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                const successModal = new bootstrap.Modal(successModalElement);
                successModal.show();
                
                // Hide flash messages
                flashMessages.forEach(msg => {
                    msg.style.display = 'none';
                });
            }
        }, 100);
    }
});
</script>

