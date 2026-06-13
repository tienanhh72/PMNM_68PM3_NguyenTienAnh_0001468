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
            <h2 class="h4 fw-bold mb-0 text-slate-800"><i class="fa-solid fa-plus text-primary me-2"></i> Thêm lớp học mới</h2>
            <a href="/lop/index" class="text-decoration-none text-primary fw-semibold"><i class="fa-solid fa-arrow-left"></i> Quay lại danh sách</a>
        </div>

        <form action="/lop/store" method="POST">
            <!-- Mã lớp -->
            <div class="mb-3">
                <label for="MaLop" class="form-label form-label-premium">Mã lớp học</label>
                <input type="text" id="MaLop" name="MaLop" class="form-control form-control-premium" placeholder="Ví dụ: CNTT02, KTPM01" required>
                <small class="form-text text-muted">Mã lớp dùng để liên kết với sinh viên và không được phép trùng lặp.</small>
            </div>

            <!-- Tên lớp -->
            <div class="mb-3">
                <label for="TenLop" class="form-label form-label-premium">Tên lớp học</label>
                <input type="text" id="TenLop" name="TenLop" class="form-control form-control-premium" placeholder="Ví dụ: Công nghệ Thông tin 2" required>
            </div>

            <!-- Ghi chú -->
            <div class="mb-4">
                <label for="GhiChu" class="form-label form-label-premium">Ghi chú</label>
                <textarea id="GhiChu" name="GhiChu" class="form-control form-control-premium" rows="3" placeholder="Nhập ghi chú hoặc thông tin bổ sung (nếu có)"></textarea>
            </div>

            <!-- Nút bấm -->
            <div class="d-flex gap-3 justify-content-end border-top pt-3">
                <a href="/lop/index" class="btn-back-premium">Hủy</a>
                <button type="submit" class="btn btn-submit-premium">
                    <i class="fa-solid fa-circle-check"></i> Lưu lớp học
                </button>
            </div>
        </form>
    </div>
</div>
