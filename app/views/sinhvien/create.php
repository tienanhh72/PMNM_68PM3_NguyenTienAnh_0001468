<style>
    .card-form-premium {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        padding: 40px;
        max-width: 650px;
        margin: 0 auto;
    }

    .form-label-premium {
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
    }

    .form-control-premium {
        border-radius: 10px;
        border: 1px solid #cbd5e1;
        padding: 12px 16px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .form-control-premium:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }

    .btn-submit-premium {
        background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .btn-submit-premium:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(79, 70, 229, 0.3);
    }

    .btn-back-premium {
        background-color: #f1f5f9;
        border: 1px solid #e2e8f0;
        color: #475569;
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back-premium:hover {
        background-color: #e2e8f0;
        color: #1e293b;
    }
</style>

<div class="container">
    <!-- Hiển thị lỗi nếu có -->
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mx-auto mb-4" role="alert" style="max-width: 650px; border-radius: 12px;">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-circle-exclamation fs-5 me-2" style="color: #ef4444;"></i>
                <div><strong>Lỗi!</strong> <?php echo $_SESSION['error']; ?></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="card-form-premium">
        <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
            <h2 class="h4 fw-bold mb-0 text-slate-800"><i class="fa-solid fa-user-plus text-primary me-2"></i> Thêm sinh viên mới</h2>
            <a href="/sinhvien/index" class="text-decoration-none text-primary fw-semibold"><i class="fa-solid fa-arrow-left"></i> Quay lại danh sách</a>
        </div>

        <form action="/sinhvien/store" method="POST">
            <!-- Họ tên -->
            <div class="mb-3">
                <label for="hoten" class="form-label form-label-premium">Họ và tên sinh viên</label>
                <input type="text" id="hoten" name="hoten" class="form-control form-control-premium" placeholder="Nhập họ và tên đầy đủ (Ví dụ: Nguyễn Văn A)" required>
            </div>

            <!-- MSSV -->
            <div class="mb-3">
                <label for="mssv" class="form-label form-label-premium">Mã số sinh viên (MSSV)</label>
                <input type="text" id="mssv" name="mssv" class="form-control form-control-premium" placeholder="Nhập đúng 6 chữ số (Ví dụ: 000123)" maxlength="6" required>
                <small class="form-text text-muted">MSSV bắt buộc gồm 6 chữ số và không được trùng lặp.</small>
            </div>

            <!-- Giới tính -->
            <div class="mb-3">
                <label for="gioi_tinh" class="form-label form-label-premium">Giới tính</label>
                <select id="gioi_tinh" name="gioi_tinh" class="form-select form-control-premium" required>
                    <option value="">Chọn giới tính</option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>

            <!-- Lớp học -->
            <div class="mb-4">
                <label for="MaLop" class="form-label form-label-premium">Lớp học</label>
                <select id="MaLop" name="MaLop" class="form-select form-control-premium" required>
                    <option value="">-- Chọn lớp học --</option>
                    <?php if (count($classes) > 0): ?>
                        <?php foreach ($classes as $class): ?>
                            <option value="<?php echo htmlspecialchars($class['MaLop']); ?>">
                                <?php echo htmlspecialchars($class['MaLop']) . ' - ' . htmlspecialchars($class['TenLop']); ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="" disabled>Chưa có lớp học nào trong hệ thống</option>
                    <?php endif; ?>
                </select>
                <?php if (count($classes) === 0): ?>
                    <small class="text-danger mt-1 d-block"><i class="fa-solid fa-circle-exclamation"></i> Hãy tạo lớp học trước khi thêm sinh viên!</small>
                <?php endif; ?>
            </div>

            <!-- Nút bấm -->
            <div class="d-flex gap-3 justify-content-end border-top pt-3">
                <a href="/sinhvien/index" class="btn-back-premium">Hủy</a>
                <button type="submit" class="btn btn-submit-premium" <?php echo (count($classes) === 0) ? 'disabled' : ''; ?>>
                    <i class="fa-solid fa-circle-check"></i> Lưu sinh viên
                </button>
            </div>
        </form>
    </div>
</div>