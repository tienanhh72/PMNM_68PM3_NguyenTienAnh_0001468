<?php
$username = $_SESSION['username'] ?? 'Người dùng';
?>
<style>
    .welcome-section {
        text-align: center;
        margin-bottom: 50px;
    }
    .welcome-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 10px;
    }
    .welcome-subtitle {
        color: #64748b;
        font-size: 1.1rem;
    }
    .dashboard-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }
    .dashboard-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: #6366f1;
    }
    .card-icon-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px auto;
        font-size: 2.2rem;
        transition: all 0.3s ease;
    }
    .icon-student {
        background: rgba(99, 102, 241, 0.1);
        color: #4f46e5;
    }
    .dashboard-card:hover .icon-student {
        background: #4f46e5;
        color: #ffffff;
    }
    .icon-class {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }
    .dashboard-card:hover .icon-class {
        background: #10b981;
        color: #ffffff;
    }
    .card-title-premium {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 15px;
    }
    .card-desc {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 30px;
    }
    .btn-dashboard {
        padding: 12px 28px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }
    .btn-student {
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }
    .btn-student:hover {
        box-shadow: 0 6px 20px rgba(79, 70, 229, 0.35);
        color: white;
    }
    .btn-class {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }
    .btn-class:hover {
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.35);
        color: white;
    }
</style>

<div class="container my-auto">
    <!-- Welcome section -->
    <div class="welcome-section">
        <h1 class="welcome-title">Chào mừng, <?php echo htmlspecialchars($username); ?>!</h1>
        <p class="welcome-subtitle">Hệ thống Quản lý Đào tạo Lớp 68PM3. Vui lòng lựa chọn phân hệ quản lý bên dưới.</p>
    </div>

    <!-- Cards Row -->
    <div class="row justify-content-center g-4" style="max-width: 900px; margin: 0 auto;">
        <!-- Student Card -->
        <div class="col-md-6">
            <div class="dashboard-card">
                <div>
                    <div class="card-icon-wrapper icon-student">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h2 class="card-title-premium">Quản lý Sinh viên</h2>
                    <p class="card-desc">
                        Xem danh sách sinh viên toàn khóa, tìm kiếm theo tên hoặc MSSV, thực hiện phân lớp, thêm mới, sửa đổi thông tin cá nhân và quản lý hồ sơ sinh viên.
                    </p>
                </div>
                <div>
                    <a href="/sinhvien/index" class="btn-dashboard btn-student w-100">
                        <span>Truy cập </span> <i class="fa-solid fa-circle-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Class Card -->
        <div class="col-md-6">
            <div class="dashboard-card">
                <div>
                    <div class="card-icon-wrapper icon-class">
                        <i class="fa-solid fa-school"></i>
                    </div>
                    <h2 class="card-title-premium">Quản lý Lớp học</h2>
                    <p class="card-desc">
                        Xem danh sách các lớp đào tạo hiện có, thêm lớp mới, sửa đổi thông tin lớp, phân loại theo ngành học, và theo dõi số lượng sinh viên tham gia từng lớp.
                    </p>
                </div>
                <div>
                    <a href="/lop/index" class="btn-dashboard btn-class w-100">
                        <span>Truy cập </span> <i class="fa-solid fa-circle-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>