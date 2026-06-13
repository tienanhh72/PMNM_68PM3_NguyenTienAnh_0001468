<?php
$currentPage = floor($offset / $limit) + 1;
?>
<style>
    .card-premium {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05);
        padding: 30px;
        margin-bottom: 30px;
    }
    
    .page-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
    }

    .search-input {
        border-radius: 10px 0 0 10px !important;
        border: 1px solid #cbd5e1;
        padding: 10px 16px;
        font-weight: 500;
    }

    .search-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
    }

    .search-btn {
        border-radius: 0 10px 10px 0 !important;
        background: #4f46e5;
        border-color: #4f46e5;
        color: white;
        padding: 10px 20px;
        font-weight: 600;
    }

    .search-btn:hover {
        background: #4338ca;
    }

    .btn-create-premium {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        transition: all 0.25s ease;
    }

    .btn-create-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .table-premium {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-top: 20px;
    }

    .table-premium th {
        background-color: #f8fafc;
        color: #64748b;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        padding: 16px 20px;
        border-bottom: 2px solid #e2e8f0;
    }

    .table-premium td {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
        font-size: 0.925rem;
        vertical-align: middle;
    }

    .table-premium tr:last-child td {
        border-bottom: none;
    }

    .table-premium tr:hover td {
        background-color: #f8fafc;
    }

    .badge-class-code {
        background-color: rgba(99, 102, 241, 0.1);
        color: #4f46e5;
        font-weight: 700;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        border: 1px solid rgba(99, 102, 241, 0.15);
    }

    .btn-action-edit {
        color: #3b82f6;
        background-color: rgba(59, 130, 246, 0.08);
        border: 1px solid rgba(59, 130, 246, 0.15);
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-action-edit:hover {
        background-color: #3b82f6;
        color: white;
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.2);
    }

    .btn-action-delete {
        color: #ef4444;
        background-color: rgba(239, 68, 68, 0.08);
        border: 1px solid rgba(239, 68, 68, 0.15);
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-action-delete:hover {
        background-color: #ef4444;
        color: white;
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2);
    }

    .pagination-premium .page-link {
        color: #4f46e5;
        border-color: #e2e8f0;
        padding: 8px 16px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .pagination-premium .page-link:hover {
        background-color: #f1f5f9;
        color: #4338ca;
        border-color: #cbd5e1;
    }

    .pagination-premium .page-item.active .page-link {
        background-color: #4f46e5;
        border-color: #4f46e5;
        color: white;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.25);
    }

    .pagination-premium .page-item.disabled .page-link {
        color: #94a3b8;
        background-color: #f8fafc;
        border-color: #e2e8f0;
    }
</style>

<div class="container">
    <!-- Hiển thị Flash Messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px;">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-circle-check fs-5 me-2" style="color: #10b981;"></i>
                <div><strong>Thành công!</strong> <?php echo $_SESSION['success']; ?></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 12px;">
            <div class="d-flex align-items-center">
                <i class="fa-solid fa-circle-exclamation fs-5 me-2" style="color: #ef4444;"></i>
                <div><strong>Lỗi!</strong> <?php echo $_SESSION['error']; ?></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="card-premium">
        <!-- Header -->
        <div class="row align-items-center mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <h1 class="page-title"><i class="fa-solid fa-school text-primary me-2"></i> Danh sách lớp học</h1>
                <p class="text-muted mb-0 mt-1">Tổng cộng có <strong><?php echo $totalRecord; ?></strong> lớp học</p>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="/lop/create" class="btn-create-premium">
                    <i class="fa-solid fa-plus"></i> Thêm lớp học mới
                </a>
            </div>
        </div>

        <!-- Thanh Tìm kiếm -->
        <form action="/lop/index/<?php echo $limit; ?>/0" method="GET" class="mb-4">
            <div class="input-group" style="max-width: 500px;">
                <input type="text" name="search" class="form-control search-input" placeholder="Tìm kiếm theo mã lớp, tên lớp..." value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn search-btn" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm
                </button>
                <?php if (!empty($search)): ?>
                    <a href="/lop/index/<?php echo $limit; ?>/0" class="btn btn-outline-secondary d-flex align-items-center justify-content-center" style="border-radius: 0; border-color: #cbd5e1; border-left: none;">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                <?php endif; ?>
            </div>
        </form>

        <!-- Bảng lớp học -->
        <div class="table-responsive">
            <table class="table-premium">
                <thead>
                    <tr>
                        <th style="width: 80px;">STT</th>
                        <th style="width: 150px;">Mã Lớp</th>
                        <th>Tên Lớp Học</th>
                        <th>Ghi Chú</th>
                        <th style="width: 220px;" class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($lop) > 0): ?>
                        <?php 
                        $stt = $offset + 1;
                        foreach($lop as $l): 
                        ?>
                            <tr>
                                <td><strong>#<?php echo $stt++; ?></strong></td>
                                <td><span class="badge-class-code"><?php echo htmlspecialchars($l['MaLop']); ?></span></td>
                                <td class="fw-semibold text-slate-800"><?php echo htmlspecialchars($l['TenLop']); ?></td>
                                <td class="text-muted"><?php echo htmlspecialchars($l['GhiChu'] ?: 'Không có ghi chú'); ?></td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-2">
                                        <a href="/lop/edit/<?php echo $l['STT']; ?>" class="btn-action-edit">
                                            <i class="fa-solid fa-pen-to-square"></i> Sửa
                                        </a>
                                        <a href="/lop/delete/<?php echo $l['STT']; ?>" class="btn-action-delete" onclick="return confirm('Bạn có thực sự muốn xóa lớp học <?php echo htmlspecialchars($l['TenLop']); ?>?')">
                                            <i class="fa-solid fa-trash-can"></i> Xóa
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-circle-info fs-3 d-block mb-2"></i>
                                Không tìm thấy lớp học nào phù hợp!
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Phân trang -->
        <?php if ($totalPage > 1): ?>
            <div class="mt-4">
                <nav aria-label="Class pagination">
                    <ul class="pagination pagination-premium justify-content-center">
                        <!-- First -->
                        <li class="page-item <?php echo ($currentPage <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="/lop/index/<?php echo $limit; ?>/0?search=<?php echo urlencode($search); ?>" aria-label="First">
                                <i class="fa-solid fa-angles-left"></i>
                            </a>
                        </li>
                        <!-- Prev -->
                        <li class="page-item <?php echo ($currentPage <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="/lop/index/<?php echo $limit; ?>/<?php echo max(0, $offset - $limit); ?>?search=<?php echo urlencode($search); ?>" aria-label="Previous">
                                <i class="fa-solid fa-angle-left"></i>
                            </a>
                        </li>
                        
                        <!-- Pages -->
                        <?php 
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($totalPage, $currentPage + 2);
                        
                        for ($i = $startPage; $i <= $endPage; $i++): 
                            $pageOffset = ($i - 1) * $limit;
                        ?>
                            <li class="page-item <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                                <a class="page-link" href="/lop/index/<?php echo $limit; ?>/<?php echo $pageOffset; ?>?search=<?php echo urlencode($search); ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>

                        <!-- Next -->
                        <li class="page-item <?php echo ($currentPage >= $totalPage) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="/lop/index/<?php echo $limit; ?>/<?php echo min(($totalPage - 1) * $limit, $offset + $limit); ?>?search=<?php echo urlencode($search); ?>" aria-label="Next">
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </li>
                        <!-- Last -->
                        <li class="page-item <?php echo ($currentPage >= $totalPage) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="/lop/index/<?php echo $limit; ?>/<?php echo ($totalPage - 1) * $limit; ?>?search=<?php echo urlencode($search); ?>" aria-label="Last">
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>
</div>
