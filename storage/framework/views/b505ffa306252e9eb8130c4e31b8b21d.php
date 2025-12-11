<li class="pc-item <?php echo e(request()->is('pengajuan-surat*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('pengajuan-surat.index')); ?>" class="pc-link">
        <span class="pc-micon"><i class="ti ti-file-text"></i></span>
        <span class="pc-mtext">Pengajuan Surat</span>
    </a>
</li>
<li class="pc-item <?php echo e(request()->is('activities*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('activities.index')); ?>" class="pc-link">
        <span class="pc-micon"><i class="ti ti-history"></i></span>
        <span class="pc-mtext">Riwayat Aktivitas</span>
    </a>
</li>
<?php /**PATH C:\Users\User\Documents\Laravel\UKK\desapp\resources\views/user/sidebar.blade.php ENDPATH**/ ?>