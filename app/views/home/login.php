<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống</title>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            padding: 40px;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            box-shadow:
                0 10px 25px rgba(0, 0, 0, 0.06),
                0 20px 48px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-3px);
            box-shadow:
                0 15px 35px rgba(0, 0, 0, 0.08),
                0 25px 60px rgba(37, 99, 235, 0.12);
        }

        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo i {
            font-size: 52px;
            color: #2563eb;
            margin-bottom: 15px;
            display: block;
        }

        .logo h2 {
            color: #1e293b;
            font-size: 24px;
            font-weight: 600;
        }

        .input-group {
            position: relative;
            margin-bottom: 18px;
        }

        .input-group i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .input-group input {
            width: 100%;
            height: 48px;
            padding: 0 14px 0 42px;
            border: 1px solid #dbe2ea;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.2s ease;
        }

        .input-group input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .btn-login {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 10px;
            background: #2563eb;
            color: white;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-login:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo">
            <i class="fas fa-user-shield"></i>
            <h2>Đăng nhập hệ thống quản lý</h2>
        </div>
        <form action="/auth/login" method="post">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input
                    type="text"
                    id="username"
                    name="username"
                    placeholder="Tên đăng nhập"
                    required>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Mật khẩu"
                    required>
            </div>
            <button type="submit" class="btn-login">
                Đăng nhập
            </button>
        </form>
    </div>
</body>
</html>

