<?php
// Xác định menu active dựa trên URL hiện tại
$request_uri = $_SERVER['REQUEST_URI'] ?? '';
$is_sinhvien = (strpos($request_uri, '/sinhvien') !== false || $request_uri === '/' || strpos($request_uri, '/home/index') !== false);
$is_lop = (strpos($request_uri, '/lop') !== false);
$username = $_SESSION['username'] ?? 'Guest';
?>
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        --dark-bg: #0f172a;
        --nav-text: #94a3b8;
        --nav-active: #ffffff;
        --glass-bg: rgba(15, 23, 42, 0.9);
        --glass-border: rgba(255, 255, 255, 0.08);
    }
    
    .navbar-premium {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-bottom: 1px solid var(--glass-border);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.15);
        padding: 15px 0;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .navbar-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .navbar-brand-premium {
        font-size: 1.4rem;
        font-weight: 800;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        letter-spacing: 0.5px;
    }

    .navbar-menu-premium {
        display: flex;
        gap: 30px;
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .navbar-item-premium a {
        color: var(--nav-text);
        text-decoration: none;
        font-size: 0.95rem;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .navbar-item-premium a:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.05);
    }

    .navbar-item-premium.active a {
        color: var(--nav-active);
        background: rgba(79, 70, 229, 0.15);
        border: 1px solid rgba(79, 70, 229, 0.3);
        box-shadow: 0 0 15px rgba(79, 70, 229, 0.1);
    }

    .navbar-user-premium {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-info-badge {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--glass-border);
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        color: #e2e8f0;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .user-info-badge i {
        color: #10b981;
    }

    .btn-logout-premium {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #ef4444;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .btn-logout-premium:hover {
        background: #ef4444;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }
</style>

<nav class="navbar-premium">
    <div class="navbar-container">
        <a href="/sinhvien/index" class="navbar-brand-premium">
            <i class="fa-solid fa-graduation-cap"></i> QLSV
        </a>
        <ul class="navbar-menu-premium">
            <li class="navbar-item-premium <?php echo $is_sinhvien ? 'active' : ''; ?>">
                <a href="/sinhvien/index">
                    <i class="fa-solid fa-users"></i> Quản lý sinh viên
                </a>
            </li>
            <li class="navbar-item-premium <?php echo $is_lop ? 'active' : ''; ?>">
                <a href="/lop/index">
                    <i class="fa-solid fa-school"></i> Quản lý lớp
                </a>
            </li>
        </ul>
        <div class="navbar-user-premium">
            <div class="user-info-badge">
                <i class="fa-solid fa-circle-user"></i>
                <span>Hi, <strong><?php echo htmlspecialchars($username); ?></strong></span>
            </div>
            <!-- Giả sử có route logout ở home/login hoặc tương tự, ta sẽ cho về home/login -->
            <a href="/home/login" class="btn-logout-premium" onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?')">
                <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
            </a>
        </div>
    </div>
</nav>