<li class="pc-item <?php echo e(request()->is('admin/berita*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('admin.berita.index')); ?>" class="pc-link">
        <span class="pc-micon"><i class="ti ti-news"></i></span>
        <span class="pc-mtext">Kelola Berita</span>
    </a>
</li>
<li class="pc-item <?php echo e(request()->is('admin/penduduk*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('admin.penduduk.index')); ?>" class="pc-link">
        <span class="pc-micon"><i class="ti ti-users"></i></span>
        <span class="pc-mtext">Data Penduduk</span>
    </a>
</li>
<li class="pc-item <?php echo e(request()->is('admin/pengajuan-surat*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('admin.pengajuan-surat.index')); ?>" class="pc-link">
        <span class="pc-micon"><i class="ti ti-file-text"></i></span>
        <span class="pc-mtext">Pengajuan Surat</span>
    </a>
</li>
<li class="pc-item <?php echo e(request()->is('admin/pengaduan*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('admin.pengaduan.index')); ?>" class="pc-link">
        <span class="pc-micon"><i class="ti ti-message-report"></i></span>
        <span class="pc-mtext">Kelola Pengaduan</span>
    </a>
</li>
<li class="pc-item <?php echo e(request()->is('admin/messages*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('admin.messages.index')); ?>" class="pc-link">
        <span class="pc-micon"><i class="ti ti-mail"></i></span>
        <span class="pc-mtext">Balas Pesan</span>
    </a>
</li>
<li class="pc-item <?php echo e(request()->is('admin/activities*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('admin.activities.index')); ?>" class="pc-link">
        <span class="pc-micon"><i class="ti ti-history"></i></span>
        <span class="pc-mtext">Riwayat Aktivitas User</span>
    </a>
</li>
<?php /**PATH C:\Users\PC_\Documents\New folder\project-sekolah\resources\views/admin/sidebar.blade.php ENDPATH**/ ?>