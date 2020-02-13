<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" />
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <script src="/js/jquery-3.3.1.js"></script>
    <script src="/js/main.js" defer></script>
</head>

<body>
<div class="container">

    <h1 class="text-center"><?php if(isset($data['title']))echo $data['title'];?></h1>

</div>
</br>
<?php if(isset($_SESSION['error'])){?>
    <div class="alert alert-danger">
        <?=$_SESSION['error']?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php } ?>
<?php if(isset($_SESSION['success'])){?>
    <div class="alert alert-success">
        <?=$_SESSION['success']?>
        <?php unset($_SESSION['success']); ?>
    </div>
<?php } ?>
<nav class="nav nav-pills nav-fill border">
    <a class="nav-item nav-link border" href="/admin">Домой</a>
    <a class="nav-item nav-link border" href="/admin/menu/index">Меню</a>
    <a class="nav-item nav-link border" href="/admin/goods/index">Товары</a>
    <a class="nav-item nav-link disabled border" href="#">Disabled</a>
</nav>

<?php include 'application/views/admin/'.$content_view; ?>
</body>
</html>