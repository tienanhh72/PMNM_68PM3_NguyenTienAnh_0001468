<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin sinh viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            max-width: 1000px; 
            width: 90%;        
            margin: 40px auto; 
        }
        h2 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h2>Chỉnh sửa thông tin sinh viên</h2>
    <form action="/sinhvien/update/<?php echo $sinhvien['id']; ?>" method="POST">
        <label for="HoTen">Họ tên:</label><br>
        <input type="text" id="HoTen" name="HoTen" value="<?php echo $sinhvien['HoTen']; ?>"><br><br>

        <label for="GioiTinh">Giới tính:</label><br>
        <select id="GioiTinh" name="GioiTinh">
            <option value="Nam" <?php if($sinhvien['GioiTinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
            <option value="Nữ" <?php if($sinhvien['GioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
            <option value="Khác" <?php if($sinhvien['GioiTinh'] == 'Khác') echo 'selected'; ?>>Khác</option>
        </select><br><br>

        <label for="MSSV">MSSV:</label><br>
        <input type="text" id="MSSV" name="MSSV" value="<?php echo $sinhvien['MSSV']; ?>"><br><br>
        <input type="submit" value="Cập nhật">
    </form>
</body>
</html>