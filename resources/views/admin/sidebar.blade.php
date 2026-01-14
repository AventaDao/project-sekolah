<!-- Kelola Berita Menu Item -->
<li class="pc-item sidebar-menu-item {{ request()->is('admin/berita*') ? 'active' : '' }}">
    <a href="{{ route('admin.berita.index') }}" class="pc-link sidebar-link">
        <span class="pc-micon sidebar-icon">
            <i class="ti ti-news"></i>
        </span>
        <span class="pc-mtext sidebar-text">Kelola Berita</span>
        <span class="sidebar-badge badge bg-success" style="display: none;">5</span>
    </a>
</li>

<!-- Data Penduduk Menu Item -->
<li class="pc-item sidebar-menu-item {{ request()->is('admin/penduduk*') ? 'active' : '' }}">
    <a href="{{ route('admin.penduduk.index') }}" class="pc-link sidebar-link">
        <span class="pc-micon sidebar-icon">
            <i class="ti ti-users"></i>
        </span>
        <span class="pc-mtext sidebar-text">Data Penduduk</span>
    </a>
</li>

<!-- Pengajuan Surat Menu Item -->
<li class="pc-item sidebar-menu-item {{ request()->is('admin/pengajuan-surat*') ? 'active' : '' }}">
    <a href="{{ route('admin.pengajuan-surat.index') }}" class="pc-link sidebar-link">
        <span class="pc-micon sidebar-icon">
            <i class="ti ti-file-text"></i>
        </span>
        <span class="pc-mtext sidebar-text">Pengajuan Surat</span>
        <span class="sidebar-badge badge bg-warning" style="display: none;">Pending</span>
    </a>
</li>

<!-- Kelola Pengaduan Menu Item -->
<li class="pc-item sidebar-menu-item {{ request()->is('admin/pengaduan*') ? 'active' : '' }}">
    <a href="{{ route('admin.pengaduan.index') }}" class="pc-link sidebar-link">
        <span class="pc-micon sidebar-icon">
            <i class="ti ti-message-report"></i>
        </span>
        <span class="pc-mtext sidebar-text">Kelola Pengaduan</span>
    </a>
</li>

<!-- Balas Pesan Menu Item -->
<li class="pc-item sidebar-menu-item {{ request()->is('admin/messages*') ? 'active' : '' }}">
    <a href="{{ route('admin.messages.index') }}" class="pc-link sidebar-link">
        <span class="pc-micon sidebar-icon">
            <i class="ti ti-mail"></i>
        </span>
        <span class="pc-mtext sidebar-text">Balas Pesan</span>
        <span class="sidebar-badge badge bg-danger" style="display: none;">2</span>
    </a>
</li>

<!-- Riwayat Aktivitas Menu Item -->
<li class="pc-item sidebar-menu-item {{ request()->is('admin/activities*') ? 'active' : '' }}">
    <a href="{{ route('admin.activities.index') }}" class="pc-link sidebar-link">
        <span class="pc-micon sidebar-icon">
            <i class="ti ti-history"></i>
        </span>
        <span class="pc-mtext sidebar-text">Riwayat Aktivitas User</span>
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
}
</style>
