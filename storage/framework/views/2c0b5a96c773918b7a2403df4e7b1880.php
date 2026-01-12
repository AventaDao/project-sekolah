<li class="pc-item <?php echo e(request()->is('pengajuan-surat*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('pengajuan-surat.index')); ?>" class="pc-link">
        <span class="pc-micon"><i class="ti ti-file-text"></i></span>
        <span class="pc-mtext">Pengajuan Surat</span>
    </a>
</li>
<li class="pc-item">
    <a href="javascript:void(0)" class="pc-link toggle-submenu" data-submenu="pengaduanSubmenu" onclick="toggleSubmenu(this, event)">
        <span class="pc-micon"><i class="ti ti-help"></i></span>
        <span class="pc-mtext">Layanan Pengaduan</span>
        <span class="pc-arrow"><i class="ti ti-chevron-right"></i></span>
    </a>
    <ul class="pc-submenu" id="pengaduanSubmenu" style="display: none; list-style: none; padding-left: 0;">
        <li class="pc-item">
            <a href="<?php echo e(route('pengaduan.create')); ?>?kategori=<?php echo e(urlencode('Kendala Sistem Informasi Desa')); ?>" class="pc-link">
                <span class="pc-micon"><i class="ti ti-alert-circle"></i></span>
                <span class="pc-mtext">Kendala Sistem</span>
            </a>
        </li>
        <li class="pc-item">
            <a href="<?php echo e(route('pengaduan.create')); ?>?kategori=<?php echo e(urlencode('Bantuan Sistem Informasi Desa')); ?>" class="pc-link">
                <span class="pc-micon"><i class="ti ti-question-mark"></i></span>
                <span class="pc-mtext">Bantuan Sistem</span>
            </a>
        </li>
        <li class="pc-item">
            <a href="<?php echo e(route('pengaduan.create')); ?>?kategori=<?php echo e(urlencode('Laporan Kejadian Lapangan')); ?>" class="pc-link">
                <span class="pc-micon"><i class="ti ti-clipboard-check"></i></span>
                <span class="pc-mtext">Laporan Kejadian di Lapangan</span>
            </a>
        </li>
    </ul>
</li>
<li class="pc-item <?php echo e(request()->is('activities*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('activities.index')); ?>" class="pc-link">
        <span class="pc-micon"><i class="ti ti-history"></i></span>
        <span class="pc-mtext">Riwayat Aktivitas</span>
    </a>
</li>

<style>
.pc-submenu .pc-item {
    padding: 0;
}

.pc-submenu .pc-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 16px;
}

.pc-submenu .pc-micon {
    flex-shrink: 0;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.pc-submenu .pc-micon i {
    font-size: 18px;
}

.pc-submenu .pc-mtext {
    white-space: normal;
    word-wrap: break-word;
    overflow-wrap: break-word;
    flex: 1;
    line-height: 1.4;
}
</style>

<script>
function toggleSubmenu(element, event) {
    event.preventDefault();
    event.stopPropagation();
    
    const submenuId = element.getAttribute('data-submenu');
    const submenu = document.getElementById(submenuId);
    const arrow = element.querySelector('.pc-arrow i');
    
    if (submenu) {
        if (submenu.style.display === 'none' || submenu.style.display === '') {
            submenu.style.display = 'block';
            if (arrow) {
                arrow.style.transform = 'rotate(90deg)';
                arrow.style.transition = 'transform 0.3s ease';
            }
        } else {
            submenu.style.display = 'none';
            if (arrow) {
                arrow.style.transform = 'rotate(0deg)';
                arrow.style.transition = 'transform 0.3s ease';
            }
        }
    }
}
</script>
<?php /**PATH C:\Users\User\Documents\UKK\project-sekolah\resources\views/user/sidebar.blade.php ENDPATH**/ ?>