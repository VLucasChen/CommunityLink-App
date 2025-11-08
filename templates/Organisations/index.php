<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Organisation> $organisations
 * @var \App\Model\Entity\Organisation $organisation
 */
use Cake\Utility\Text;

$modalId = 'orgModal';
?>

<style>
    :root {
        --m3-primary: #6750A4;
        --m3-primary-container: #EADDFF;
        --m3-surface: #FFFBFE;
        --m3-surface-variant: #E7E0EC;
        --m3-on-surface: #1C1B1F;
        --m3-outline: #79747E;
    }

    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2.5rem 0;
        color: white;
        margin-bottom: 2rem;
        border-radius: 0 0 24px 24px;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-title i {
        font-size: 2.25rem;
    }

    .page-subtitle {
        font-size: 1rem;
        opacity: 0.95;
    }

    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .btn-add {
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        cursor: pointer;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .table-modern {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .table-modern thead {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    }

    .table-modern th {
        padding: 1.25rem 1rem;
        text-align: left;
        font-weight: 600;
        color: var(--m3-on-surface);
        border-bottom: 2px solid var(--m3-surface-variant);
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-modern td {
        padding: 1.25rem 1rem;
        border-bottom: 1px solid var(--m3-surface-variant);
        color: var(--m3-on-surface);
        vertical-align: middle;
    }

    .table-modern tbody tr {
        transition: background 0.2s ease;
    }

    .table-modern tbody tr:hover {
        background: var(--m3-primary-container);
    }

    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }

    .org-info-cell {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .org-name {
        font-weight: 600;
        color: var(--m3-on-surface);
        font-size: 1rem;
    }

    .org-address {
        font-size: 0.875rem;
        color: var(--m3-outline);
    }

    .org-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
        color: var(--m3-on-surface);
    }

    .org-info i {
        color: var(--m3-primary);
    }

    .industry-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 500;
        font-size: 0.875rem;
        background: #D1FAE5;
        color: #065F46;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
        justify-content: center;
    }

    .btn-action {
        padding: 0.5rem;
        border-radius: 10px;
        border: none;
        background: transparent;
        color: var(--m3-outline);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        width: 36px;
        height: 36px;
        cursor: pointer;
    }

    .btn-action:hover {
        background: var(--m3-primary-container);
        color: var(--m3-primary);
        transform: scale(1.1);
    }

    .btn-action.danger:hover {
        background: #FEE2E2;
        color: #DC2626;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .empty-state i {
        font-size: 3rem;
        color: var(--m3-outline);
        opacity: 0.5;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        color: var(--m3-on-surface);
        margin-bottom: 0.5rem;
        font-size: 1.5rem;
    }

    .empty-state p {
        color: var(--m3-outline);
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .pagination-wrapper {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .pagination {
        display: flex;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination li {
        margin: 0;
    }

    .pagination a,
    .pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0.5rem 0.75rem;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .pagination a {
        background: white;
        color: var(--m3-on-surface);
        border: 1px solid var(--m3-surface-variant);
    }

    .pagination a:hover {
        background: var(--m3-primary-container);
        color: var(--m3-primary);
        border-color: var(--m3-primary);
    }

    .pagination .current {
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        color: white;
        border: none;
    }

    .pagination-info {
        color: var(--m3-outline);
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .table-modern {
            font-size: 0.85rem;
        }

        .table-modern th,
        .table-modern td {
            padding: 0.75rem 0.5rem;
        }

        .action-buttons {
            flex-direction: column;
        }
    }

    /* Modal Styling */
    .modal-content {
        border-radius: 24px;
        border: none;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        padding: 1.5rem 2rem;
        border-bottom: none;
        border-radius: 24px 24px 0 0;
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: white !important;
    }

    .btn-close-white {
        filter: brightness(0) invert(1);
        opacity: 0.9;
    }

    .btn-close-white:hover {
        opacity: 1;
    }

    .modal-body {
        padding: 2rem;
        background: var(--m3-surface);
    }

    .modal-body .form-control,
    .modal-body .form-select {
        border-radius: 16px;
        border: 2px solid var(--m3-surface-variant);
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
        background: var(--m3-surface);
    }

    .modal-body .form-control:focus,
    .modal-body .form-select:focus {
        border-color: var(--m3-primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }

    .modal-body textarea.form-control {
        min-height: 120px;
        padding: 1rem;
    }

    .modal-body .form-label {
        font-weight: 600;
        color: var(--m3-on-surface);
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .modal-body .mb-3 {
        margin-bottom: 1.25rem !important;
    }

    .modal-body .btn-primary {
        background: linear-gradient(135deg, var(--m3-primary) 0%, #764ba2 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .modal-body .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .modal-body .btn-secondary {
        background: white;
        color: var(--m3-on-surface);
        border: 2px solid var(--m3-surface-variant);
        padding: 0.75rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .modal-body .btn-secondary:hover {
        background: var(--m3-surface-variant);
        border-color: var(--m3-outline);
        color: var(--m3-on-surface);
    }

    .modal-view-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .modal-view-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .modal-view-label {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--m3-outline);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .modal-view-value {
        font-size: 1rem;
        color: var(--m3-on-surface);
        font-weight: 500;
    }

    .modal-view-section {
        margin-bottom: 1.5rem;
    }

    .modal-view-section-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--m3-on-surface);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .modal-view-section-title i {
        color: var(--m3-primary);
        font-size: 1.25rem;
    }

    .modal-view-section-content {
        background: var(--m3-surface-variant);
        padding: 1.25rem;
        border-radius: 16px;
        color: var(--m3-on-surface);
        line-height: 1.6;
        white-space: pre-wrap;
    }

    .modal-view-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        font-weight: 500;
        font-size: 0.875rem;
        background: #D1FAE5;
        color: #065F46;
    }

    @media (max-width: 768px) {
        .modal-dialog {
            width: 95%;
            margin: 1rem auto;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-header {
            padding: 1.25rem 1.5rem;
        }

        .modal-view-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <h1 class="page-title">
            <i class="bi bi-building-fill"></i>
            Organisations Management
        </h1>
        <p class="page-subtitle">Manage partner organisations</p>
    </div>
</div>

<div class="container">
    <!-- Action Bar -->
    <div class="action-bar">
        <div></div>
        <div class="search-actions">
            <button class="btn-add" data-bs-toggle="modal" data-bs-target="#<?= $modalId ?>" onclick="setModal('add')">
                <i class="bi bi-plus-circle"></i> New Organisation
            </button>
        </div>
    </div>

    <!-- Table -->
    <?php if (count($organisations) > 0): ?>
    <div class="table-responsive">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Organisation</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Industry</th>
                    <th>Created</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($organisations as $org): ?>
                    <tr>
                        <td>
                            <div class="org-info-cell">
                                <div class="org-name"><?= h($org->org_name) ?></div>
                                <div class="org-address"><?= Text::truncate($org->business_address, 40) ?></div>
                            </div>
                        </td>
                        <td>
                            <div class="org-info">
                                <i class="bi bi-envelope"></i>
                                <span><?= h($org->email) ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="org-info">
                                <i class="bi bi-telephone"></i>
                                <span><?= h($org->phone) ?></span>
                            </div>
                        </td>
                        <td>
                            <span class="industry-badge">
                                <i class="bi bi-briefcase"></i>
                                <?= h($org->industry) ?>
                            </span>
                        </td>
                        <td>
                            <div class="org-info">
                                <i class="bi bi-calendar3"></i>
                                <span><?= $org->created ? $org->created->format('M d, Y') : '-' ?></span>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="action-buttons">
                                <button class="btn-action" onclick="setModal('view', '<?= $org->id ?>')" title="View">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button class="btn-action" onclick="setModal('edit', '<?= $org->id ?>')" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <?= $this->Form->postLink(
                                    '<i class="bi bi-trash"></i>',
                                    ['action' => 'delete', $org->id],
                                    [
                                        'class' => 'btn-action danger',
                                        'title' => 'Delete',
                                        'confirm' => __('Are you sure you want to delete "{0}"?', $org->org_name),
                                        'escape' => false
                                    ]
                                ) ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination-wrapper">
        <ul class="pagination">
            <?= $this->Paginator->first('<i class="bi bi-chevron-double-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->prev('<i class="bi bi-chevron-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('<i class="bi bi-chevron-right"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->last('<i class="bi bi-chevron-double-right"></i>', ['escape' => false]) ?>
        </ul>
        <div class="pagination-info">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </div>
    </div>
    <?php else: ?>
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <h3>No Organisations Found</h3>
            <p>There are no organisations at the moment. Click "New Organisation" to create one.</p>
        </div>
    <?php endif; ?>
</div>

<!-- ==================== MODAL ==================== -->
<div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add Organisation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
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

    // Helper: nl2br
    function nl2br(str) {
        return (str + '').replace(/\n/g, '<br>');
    }

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
            <div class="modal-view-grid">
                <div class="modal-view-item">
                    <div class="modal-view-label">
                        <i class="bi bi-building"></i>
                        Organisation Name
                    </div>
                    <div class="modal-view-value">
                        ${org.org_name || '-'}
                    </div>
                </div>
                <div class="modal-view-item">
                    <div class="modal-view-label">
                        <i class="bi bi-envelope"></i>
                        Email
                    </div>
                    <div class="modal-view-value">
                        ${org.email || '-'}
                    </div>
                </div>
                <div class="modal-view-item">
                    <div class="modal-view-label">
                        <i class="bi bi-telephone"></i>
                        Phone
                    </div>
                    <div class="modal-view-value">
                        ${org.phone || '-'}
                    </div>
                </div>
                <div class="modal-view-item">
                    <div class="modal-view-label">
                        <i class="bi bi-briefcase"></i>
                        Industry
                    </div>
                    <div class="modal-view-value">
                        <span class="modal-view-badge">
                            ${org.industry || '-'}
                        </span>
                    </div>
                </div>
                <div class="modal-view-item">
                    <div class="modal-view-label">
                        <i class="bi bi-person-lines-fill"></i>
                        Contact Person
                    </div>
                    <div class="modal-view-value">
                        ${org.contact_person_full_name || '-'}
                    </div>
                </div>
            </div>
            <div class="modal-view-section">
                <div class="modal-view-section-title">
                    <i class="bi bi-geo-alt"></i>
                    Business Address
                </div>
                <div class="modal-view-section-content">
                    ${nl2br(org.business_address || 'No address provided')}
                </div>
            </div>
            <div class="modal-view-section">
                <div class="modal-view-section-title">
                    <i class="bi bi-info-circle"></i>
                    Help Description
                </div>
                <div class="modal-view-section-content">
                    ${nl2br(org.help_description || 'No description provided')}
                </div>
            </div>
            <div class="d-flex gap-2 mt-4" style="justify-content: flex-end; padding-top: 1.5rem; border-top: 2px solid var(--m3-surface-variant);">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i> Close
                </button>
            </div>`;
        } else {
            // === ADD / EDIT MODE ===
            const isEdit = mode === 'edit';
            title.textContent = isEdit ? 'Edit Organisation' : 'Add Organisation';

            // Lấy HTML từ form ẩn và wrap trong col
            const getFieldHTML = (name, colClass = 'col-md-6') => {
                const el = document.querySelector(`#hiddenFormFields [name="${name}"]`);
                if (!el) return '';
                
                // Tìm form group chứa label và input (CakePHP tạo div.mb-3)
                let formGroup = el.closest('.mb-3');
                
                // Nếu không tìm thấy, thử tìm parent div
                if (!formGroup) {
                    formGroup = el.parentElement;
                }
                
                const wrapper = document.createElement('div');
                wrapper.className = colClass + ' mb-3';
                
                if (formGroup && formGroup.innerHTML) {
                    // Lấy toàn bộ HTML của form group (bao gồm label)
                    wrapper.innerHTML = formGroup.innerHTML;
                } else {
                    // Fallback: tìm label trong cùng parent
                    const parent = el.parentElement;
                    let html = '';
                    if (parent) {
                        const label = parent.querySelector('label');
                        if (label) {
                            html = label.outerHTML;
                        }
                    }
                    // Nếu vẫn không có label, tìm bằng for attribute
                    if (!html) {
                        const label = document.querySelector(`#hiddenFormFields label[for="${el.id}"]`);
                        if (label) {
                            html = label.outerHTML;
                        }
                    }
                    // Nếu vẫn không có, tạo label từ name
                    if (!html) {
                        const labelText = name.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                        html = `<label for="${el.id || name}" class="form-label">${labelText}</label>`;
                    }
                    html += el.outerHTML;
                    wrapper.innerHTML = html;
                }
                return wrapper.outerHTML;
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
                ${getFieldHTML('org_name', 'col-12')}
                ${getFieldHTML('email', 'col-md-6')}
                ${getFieldHTML('phone', 'col-md-6')}
                ${getFieldHTML('industry', 'col-md-6')}
                ${getFieldHTML('contact_person_full_name', 'col-md-6')}
                ${getFieldHTML('business_address', 'col-12')}
                ${getFieldHTML('help_description', 'col-12')}
            </div>
            <div class="d-flex gap-2 mt-4" style="justify-content: flex-end; padding-top: 1.5rem; border-top: 2px solid var(--m3-surface-variant);">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> ${isEdit ? 'Update Organisation' : 'Save Organisation'}
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-lg"></i> Cancel
                </button>
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
});
</script>
<?php $this->end(); ?>

<?= $this->element('success_modal', [
    'modalId' => 'orgSuccessModal',
    'title' => 'Success!',
    'message' => 'The operation was completed successfully.',
    'actionLink' => null,
    'actionText' => null
]) ?>
