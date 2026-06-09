<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title><?php echo $title; ?></title>
    <style>
        .content {
            margin-top: 80px; 
            margin-bottom: 80px; 
        }
    </style>
</head>
<body>
    <div> <?php require_once '../app/views/layout/partial/header.php'; ?> </div>
    <div class="content"></div>
        <?php
            require_once '../app/views/' . $viewname . '.php';
        ?>
    </div>
    <div><?php require_once '../app/views/layout/partial/footer.php'; ?></div>
</body>
</html>