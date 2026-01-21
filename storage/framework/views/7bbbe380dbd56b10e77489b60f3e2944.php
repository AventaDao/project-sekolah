<!-- Pengajuan Surat Menu Item -->
<li class="pc-item sidebar-menu-item <?php echo e(request()->is('pengajuan-surat*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('pengajuan-surat.index')); ?>" class="pc-link sidebar-link">
        <span class="pc-micon sidebar-icon">
            <i class="ti ti-file-text"></i>
        </span>
        <span class="pc-mtext sidebar-text">Pengajuan Surat</span>
    </a>
</li>

<!-- Layanan Pengaduan Menu dengan Submenu -->
<li class="pc-item sidebar-menu-item sidebar-collapsible <?php echo e(request()->is('pengaduan*') ? 'active' : ''); ?>">
    <a href="javascript:void(0)" class="pc-link sidebar-link toggle-submenu" data-submenu="pengaduanSubmenu" onclick="toggleSubmenu(this, event)">
        <span class="pc-micon sidebar-icon">
            <i class="ti ti-help"></i>
        </span>
        <span class="pc-mtext sidebar-text">Layanan Pengaduan</span>
        <span class="pc-arrow sidebar-arrow">
            <i class="ti ti-chevron-right"></i>
        </span>
    </a>
    <ul class="pc-submenu sidebar-submenu" id="pengaduanSubmenu" style="display: none; list-style: none; padding-left: 0;">
        <!-- Kendala Sistem -->
        <li class="pc-item sidebar-submenu-item <?php echo e(request()->is('pengaduan/create*') && request()->query('kategori') == 'Kendala Sistem Informasi Desa' ? 'active' : ''); ?>">
            <a href="<?php echo e(route('pengaduan.create')); ?>?kategori=<?php echo e(urlencode('Kendala Sistem Informasi Desa')); ?>" class="pc-link sidebar-submenu-link">
                <span class="pc-micon sidebar-submenu-icon">
                    <i class="ti ti-alert-circle"></i>
                </span>
                <span class="pc-mtext sidebar-submenu-text">Kendala Sistem</span>
            </a>
        </li>
        <!-- Bantuan Sistem -->
        <li class="pc-item sidebar-submenu-item <?php echo e(request()->is('pengaduan/create*') && request()->query('kategori') == 'Bantuan Sistem Informasi Desa' ? 'active' : ''); ?>">
            <a href="<?php echo e(route('pengaduan.create')); ?>?kategori=<?php echo e(urlencode('Bantuan Sistem Informasi Desa')); ?>" class="pc-link sidebar-submenu-link">
                <span class="pc-micon sidebar-submenu-icon">
                    <i class="ti ti-question-mark"></i>
                </span>
                <span class="pc-mtext sidebar-submenu-text">Bantuan Sistem</span>
            </a>
        </li>
        <!-- Laporan Kejadian -->
        <li class="pc-item sidebar-submenu-item <?php echo e(request()->is('pengaduan/create*') && request()->query('kategori') == 'Laporan Kejadian Lapangan' ? 'active' : ''); ?>">
            <a href="<?php echo e(route('pengaduan.create')); ?>?kategori=<?php echo e(urlencode('Laporan Kejadian Lapangan')); ?>" class="pc-link sidebar-submenu-link">
                <span class="pc-micon sidebar-submenu-icon">
                    <i class="ti ti-clipboard-check"></i>
                </span>
                <span class="pc-mtext sidebar-submenu-text">Laporan Kejadian</span>
            </a>
        </li>
        <!-- Pengaduan Saya -->
        <li class="pc-item sidebar-submenu-item <?php echo e(request()->is('pengaduan/index*') || request()->is('pengaduan') ? 'active' : ''); ?>">
            <a href="<?php echo e(route('pengaduan.index')); ?>" class="pc-link sidebar-submenu-link">
                <span class="pc-micon sidebar-submenu-icon">
                    <i class="ti ti-list-check"></i>
                </span>
                <span class="pc-mtext sidebar-submenu-text">Pengaduan Saya</span>
            </a>
        </li>
    </ul>
</li>

<!-- Riwayat Aktivitas Menu Item -->
<li class="pc-item sidebar-menu-item <?php echo e(request()->is('activities*') ? 'active' : ''); ?>">
    <a href="<?php echo e(route('activities.index')); ?>" class="pc-link sidebar-link">
        <span class="pc-micon sidebar-icon">
            <i class="ti ti-history"></i>
        </span>
        <span class="pc-mtext sidebar-text">Riwayat Aktivitas</span>
    </a>
</li>

<style>
/* ============================================
   SIDEBAR ADMIN - MODERN UI STYLING
   ============================================ */

/* Main Menu Items */
.sidebar-menu-item {
    position: relative;
    margin-bottom: 8px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.sidebar-link {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    gap: 12px;
    padding: 12px 14px;
    color: #6c757d;
    text-decoration: none;
    border-radius: 10px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    font-weight: 500;
}

/* Icon Styling - Centered */
.sidebar-icon {
    flex-shrink: 0;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background-color: rgba(70, 128, 255, 0.12);
    color: #4680ff;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 18px;
}

/* Text Styling */
.sidebar-text {
    flex: 1;
    font-size: 14px;
    font-weight: 500;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    transition: all 0.3s ease;
    letter-spacing: 0.3px;
}

/* Sidebar Badge */
.sidebar-badge {
    font-size: 10px;
    padding: 3px 8px;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
}

/* Hover State */
.sidebar-link:hover {
    background-color: rgba(70, 128, 255, 0.1);
    color: #4680ff;
    padding-left: 16px;
}

.sidebar-link:hover .sidebar-icon {
    background-color: rgba(70, 128, 255, 0.2);
    color: #4680ff;
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(70, 128, 255, 0.15);
}

/* Active State */
.sidebar-menu-item.active .sidebar-link {
    background: linear-gradient(135deg, rgba(70, 128, 255, 0.95) 0%, rgba(44, 128, 200, 0.95) 100%);
    color: #ffffff;
    box-shadow: 0 6px 20px rgba(70, 128, 255, 0.35);
    font-weight: 600;
}

.sidebar-menu-item.active .sidebar-icon {
    background-color: rgba(255, 255, 255, 0.25);
    color: #ffffff;
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.sidebar-menu-item.active .sidebar-text {
    color: #ffffff;
}

.sidebar-menu-item.active .sidebar-badge {
    background-color: rgba(255, 255, 255, 0.3) !important;
    color: #ffffff;
}

.sidebar-menu-item.active .sidebar-arrow {
    color: #ffffff;
}

/* ============================================
   SUBMENU STYLING - DIPERBAIKI TOTAL
   ============================================ */

.sidebar-collapsible {
    position: relative;
}

.sidebar-arrow {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 24px;
    height: 24px;
    color: #6c757d;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 16px;
}

.sidebar-submenu {
    margin: 6px 0 0 0;
    padding-left: 20px;
    background-color: transparent !important;
    border-left: none !important;
    border-radius: 0 10px 10px 0;
    overflow: hidden;
    animation: slideDown 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    list-style: none !important;
}

@keyframes slideDown {
    from {
        opacity: 0;
        max-height: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        max-height: 500px;
        transform: translateY(0);
    }
}

.sidebar-submenu-item {
    padding: 0 !important;
    transition: all 0.3s ease;
    margin-bottom: 2px;
    background-color: transparent !important;
}

.sidebar-submenu-item:last-child {
    margin-bottom: 0;
}

/* SEMUA SUBMENU LINK HARUS ABU-ABU DENGAN TRANSPARENT BACKGROUND */
.sidebar-submenu-link {
    display: flex !important;
    align-items: center !important;
    gap: 10px !important;
    padding: 10px 14px !important;
    margin: 0 8px !important;
    color: #6c757d !important;
    text-decoration: none !important;
    font-size: 13px !important;
    font-weight: 500 !important;
    transition: all 0.3s ease !important;
    position: relative !important;
    border-radius: 8px !important;
    background-color: transparent !important;
    background: transparent !important;
    box-shadow: none !important;
}

.sidebar-submenu-link::before {
    content: '';
    position: absolute;
    left: 0;
    width: 3px;
    height: 0;
    background: transparent;
    border-radius: 0 2px 2px 0;
    transition: all 0.3s ease;
}

/* SEMUA SUBMENU ICON HARUS ABU-ABU DENGAN TRANSPARENT BACKGROUND */
.sidebar-submenu-icon {
    flex-shrink: 0 !important;
    width: 24px !important;
    height: 24px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    background-color: transparent !important;
    background: transparent !important;
    color: #6c757d !important;
    border-radius: 6px !important;
    font-size: 16px !important;
    transition: all 0.3s ease !important;
    box-shadow: none !important;
}

.sidebar-submenu-text {
    flex: 1;
    white-space: normal;
    word-wrap: break-word;
    overflow-wrap: break-word;
    line-height: 1.4;
    transition: all 0.3s ease;
    color: #6c757d !important;
}

/* Submenu Item Hover - background light saja */
.sidebar-submenu-link:hover {
    background-color: rgba(100, 100, 100, 0.08) !important;
    color: #6c757d !important;
}

.sidebar-submenu-link:hover .sidebar-submenu-icon {
    background-color: transparent !important;
    color: #6c757d !important;
}

/* PENTING: ACTIVE SUBMENU HARUS MEMILIKI HIGHLIGHT YANG TERLIHAT */
.sidebar-submenu-item.active .sidebar-submenu-link {
    background-color: rgba(70, 128, 255, 0.12) !important;
    background: rgba(70, 128, 255, 0.12) !important;
    color: #4680ff !important;
    font-weight: 600 !important;
    border-radius: 8px !important;
    box-shadow: 0 2px 8px rgba(70, 128, 255, 0.15) !important;
}

.sidebar-submenu-item.active .sidebar-submenu-link::before {
    height: 16px !important;
    background: linear-gradient(180deg, #4680ff 0%, #357abd 100%) !important;
}

.sidebar-submenu-item.active .sidebar-submenu-icon {
    background-color: rgba(70, 128, 255, 0.2) !important;
    background: rgba(70, 128, 255, 0.2) !important;
    color: #4680ff !important;
    box-shadow: 0 2px 6px rgba(70, 128, 255, 0.12) !important;
}

/* Navbar Dashboard Link Styling */
.pc-navbar .pc-item .pc-link {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
    color: #6c757d;
    text-decoration: none;
    border-radius: 10px;
    transition: all 0.3s ease;
    position: relative;
}

.pc-navbar .pc-item .pc-link .pc-micon {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    background-color: rgba(70, 128, 255, 0.12);
    color: #4680ff;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 18px;
}

.pc-navbar .pc-item .pc-link .pc-mtext {
    flex: 1;
    font-size: 14px;
    font-weight: 500;
    letter-spacing: 0.3px;
}

/* Navbar Dashboard Link Hover */
.pc-navbar .pc-item .pc-link:hover {
    background-color: rgba(70, 128, 255, 0.1);
    color: #4680ff;
    padding-left: 16px;
}

.pc-navbar .pc-item .pc-link:hover .pc-micon {
    background-color: rgba(70, 128, 255, 0.2);
    color: #4680ff;
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(70, 128, 255, 0.15);
}

/* Navbar Dashboard Link Active */
.pc-navbar .pc-item.active .pc-link {
    background: linear-gradient(135deg, rgba(70, 128, 255, 0.95) 0%, rgba(44, 128, 200, 0.95) 100%);
    color: #ffffff;
    box-shadow: 0 6px 20px rgba(70, 128, 255, 0.35);
    font-weight: 600;
}

.pc-navbar .pc-item.active .pc-link .pc-micon {
    background-color: rgba(255, 255, 255, 0.25);
    color: #ffffff;
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.pc-navbar .pc-item.active .pc-link .pc-mtext {
    color: #ffffff;
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar-link {
        padding: 11px 12px;
        gap: 10px;
    }
    
    .sidebar-icon {
        width: 28px;
        height: 28px;
        font-size: 16px;
    }
    
    .sidebar-text {
        font-size: 13px;
    }
    
    .sidebar-badge {
        font-size: 9px;
        padding: 2px 6px;
    }
    
    .pc-navbar .pc-item .pc-link {
        padding: 11px 12px;
        gap: 10px;
    }
    
    .pc-navbar .pc-item .pc-link .pc-micon {
        width: 28px;
        height: 28px;
        font-size: 16px;
    }
    
    .pc-navbar .pc-item .pc-link .pc-mtext {
        font-size: 13px;
    }
    
    /* Responsive Submenu */
    .sidebar-submenu {
        padding-left: 15px;
    }
    
    .sidebar-submenu-link {
        padding: 8px 12px;
        font-size: 12px;
    }
    
    .sidebar-submenu-icon {
        width: 20px;
        height: 20px;
        font-size: 14px;
    }
}

/* Animasi untuk arrow ketika submenu dibuka */
.sidebar-collapsible .sidebar-arrow i {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* ============================================
   HIGHLIGHT HANYA PARENT MENU SAJA
   ============================================ */

/* Highlight untuk parent menu ketika submenu aktif */
.sidebar-collapsible:has(.sidebar-submenu-item.active) .sidebar-link {
    background: linear-gradient(135deg, rgba(70, 128, 255, 0.95) 0%, rgba(44, 128, 200, 0.95) 100%) !important;
    color: #ffffff !important;
    box-shadow: 0 6px 20px rgba(70, 128, 255, 0.35) !important;
    font-weight: 600 !important;
}

.sidebar-collapsible:has(.sidebar-submenu-item.active) .sidebar-icon {
    background-color: rgba(255, 255, 255, 0.25) !important;
    color: #ffffff !important;
    transform: scale(1.1) !important;
}

.sidebar-collapsible:has(.sidebar-submenu-item.active) .sidebar-text {
    color: #ffffff !important;
}

.sidebar-collapsible:has(.sidebar-submenu-item.active) .sidebar-arrow {
    color: #ffffff !important;
}

</style>

<script>
function toggleSubmenu(element, event) {
    event.preventDefault();
    event.stopPropagation();
    
    const submenuId = element.getAttribute('data-submenu');
    const submenu = document.getElementById(submenuId);
    const arrow = element.querySelector('.sidebar-arrow i');
    const parentLi = element.closest('.sidebar-collapsible');
    
    if (submenu) {
        const isVisible = submenu.style.display !== 'none' && submenu.style.display !== '';
        
        if (isVisible) {
            // Tutup submenu
            submenu.style.display = 'none';
            if (arrow) {
                arrow.style.transform = 'rotate(0deg)';
            }
            if (parentLi) {
                parentLi.classList.remove('active-open');
            }
        } else {
            // Buka submenu
            submenu.style.display = 'block';
            if (arrow) {
                arrow.style.transform = 'rotate(90deg)';
            }
            if (parentLi) {
                parentLi.classList.add('active-open');
            }
            
            // Tutup submenu lain yang terbuka
            const allSubmenus = document.querySelectorAll('.sidebar-submenu');
            const allArrows = document.querySelectorAll('.sidebar-arrow i');
            const allParents = document.querySelectorAll('.sidebar-collapsible');
            
            allSubmenus.forEach(sm => {
                if (sm !== submenu && sm.style.display !== 'none') {
                    sm.style.display = 'none';
                }
            });
            
            allArrows.forEach(arr => {
                const arrParent = arr.closest('.sidebar-collapsible');
                if (arrParent !== parentLi && arr.style.transform === 'rotate(90deg)') {
                    arr.style.transform = 'rotate(0deg)';
                }
            });
            
            allParents.forEach(p => {
                if (p !== parentLi && p.classList.contains('active-open')) {
                    p.classList.remove('active-open');
                }
            });
        }
    }
}

// Fungsi untuk auto-expand submenu jika ada item yang aktif
document.addEventListener('DOMContentLoaded', function() {
    // Cek apakah ada submenu item yang aktif
    const activeSubmenuItem = document.querySelector('.sidebar-submenu-item.active');
    
    if (activeSubmenuItem) {
        // Temukan parent submenu
        const submenu = activeSubmenuItem.closest('.sidebar-submenu');
        const parentMenu = activeSubmenuItem.closest('.sidebar-collapsible');
        
        if (submenu && parentMenu) {
            // Buka submenu
            submenu.style.display = 'block';
            
            // Rotate arrow
            const arrow = parentMenu.querySelector('.sidebar-arrow i');
            if (arrow) {
                arrow.style.transform = 'rotate(90deg)';
            }
            
            // Tambah class active-open
            parentMenu.classList.add('active-open');
        }
    }
    
    // Tambah event listener untuk semua menu yang bisa diklik
    const menuLinks = document.querySelectorAll('.sidebar-link');
    menuLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Jika bukan toggle submenu, close semua submenu
            if (!this.classList.contains('toggle-submenu')) {
                const allSubmenus = document.querySelectorAll('.sidebar-submenu');
                const allArrows = document.querySelectorAll('.sidebar-arrow i');
                const allParents = document.querySelectorAll('.sidebar-collapsible');
                
                allSubmenus.forEach(sm => {
                    sm.style.display = 'none';
                });
                
                allArrows.forEach(arr => {
                    arr.style.transform = 'rotate(0deg)';
                });
                
                allParents.forEach(p => {
                    p.classList.remove('active-open');
                });
            }
        });
    });
});
</script><?php /**PATH C:\project-sekolah\resources\views/user/sidebar.blade.php ENDPATH**/ ?>