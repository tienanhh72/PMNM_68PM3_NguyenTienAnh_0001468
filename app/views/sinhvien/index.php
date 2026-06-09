<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Trang Sinh Viên</title>
    <style>
        .container {
            max-width: 1000px; 
            width: 90%;        
            margin: 40px auto; 
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #bbbbbb;
        }
        .container h1 {
            text-align: left;     
            margin-bottom: 15px;  
        }
        .btn {
            display: inline-block;
            padding: 8px 16px;
            margin: 4px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 4px;
        }
        .btn-warning {
            background-color: #222aff;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .pagination-container {
            display: flex;
            /* justify-content: space-between; */
            align-items: center;
            padding: 40px 0;
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            border-radius: 0 0 8px 8px; /* Bo góc khớp với đáy của bảng */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Danh sách sinh viên</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>MSSV</th>
                    <th>Họ tên</th>
                    <th>Giới tính</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($sinhvien as $sv): ?>
                    <tr>
                        <!-- <td><?php echo $index + 1; ?></td> -->
                        <td><?php echo $sv['id']; ?></td>
                        <td><?php echo $sv['MSSV']; ?></td>
                        <td><?php echo $sv['HoTen']; ?></td>
                        <td><?php echo $sv['GioiTinh']; ?></td>
                        <td>
                            <a class="btn btn-warning" href="/sinhvien/edit/<?php echo $sv['id']; ?>">Sửa</a>
                            <a class="btn btn-danger" href="/sinhvien/delete/<?php echo $sv['id']; ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination-container">
            <?php
                $pageSize = 5; // Số sinh viên hiển thị trên mỗi trang
                for ($i = 1; $i <= $totalPage; $i++) {
                    $offset = ($i - 1) * $pageSize;
                    echo '<a class="btn btn-primary" href="/sinhvien/index/' . $pageSize . '/' . $offset . '">' . $i . '</a> ';
                }
            ?>
        </div>
    </div>
</body>
</html>