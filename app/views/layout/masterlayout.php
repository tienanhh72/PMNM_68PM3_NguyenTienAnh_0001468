<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title><?php echo isset($title) ? htmlspecialchars($title) : 'Hệ thống Quản lý'; ?></title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding-top: 80px; /* Bù trừ khoảng trống cho fixed navbar */
            margin: 0;
        }
        .main-content {
            flex: 1;
            padding: 40px 0;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <?php require_once '../app/views/layout/partial/header.php'; ?>

    <main class="main-content">
        <?php
            if (isset($viewname) && !empty($viewname)) {
                require_once '../app/views/' . $viewname . '.php';
            }
        ?>
    </main>

    <?php require_once '../app/views/layout/partial/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>