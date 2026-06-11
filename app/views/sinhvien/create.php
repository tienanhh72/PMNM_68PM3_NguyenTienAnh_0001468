<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            max-width: 1000px; 
            width: 90%;        
            margin: 40px auto; 
        }
        h1 {
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
   <h1>Thêm sinh viên</h1>
   <form action="/sinhvien/store" method="POST">
        <label for="HoTen">Họ tên:</label>
        <input type="text" id="HoTen" name="HoTen" required><br><br>
        <label for="MSSV">MSSV:</label>
        <input type="text" id="MSSV" name="MSSV" required><br><br>
        <label for="GioiTinh">Giới tính:</label>
        <select id="GioiTinh" name="GioiTinh" required>
            <option value="">Chọn giới tính</option>
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
            <option value="Khác">Khác</option>
        </select><br><br>

        <input type="submit" value="Thêm sinh viên">
    </form>
</body>
</html>