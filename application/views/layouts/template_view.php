<?php include 'application/views/menu_view.php'?>
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
    <div class="box">
        <div class="loginBox login">
            <button type="button" class="close" onclick="closeLogin();" aria-label="Close" >
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="formBox">
                <h2 style="text-align: center">Авторизация</h2>
                <div class="form-group">
                    <label for="loginEmail">Email address</label>
                    <input type="email" class="form-control" id="loginEmail" name="loginEmail" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="loginPwd">Пароль</label>
                    <input type="password" class="form-control" id="loginPwd" name="loginPwd" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary" onclick="login();">Войти</button>
            </div>
        </div>

        <div class="registerBox register">
            <button type="button" class="close" onclick="closeRegister();" aria-label="Close" >
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="formBox">
                <h2 style="text-align: center">Регистрация</h2>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="pwd1">Пароль</label>
                        <input type="password" class="form-control" id="pwd1" name="pwd1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="pwd2">Повторить пароль</label>
                        <input type="password" class="form-control" id="pwd2" name="pwd2" placeholder="Password">
                    </div>
                    <button type="submit" onclick="registerUser();" class="btn btn-primary">Регистрация</button>
            </div>
        </div>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <?php echo drawMenu($menu); if(count($_SESSION['user'])>0){?>
                <div id="userName" style="display: inline">
            <a id="userLink" href="/user/"><?=$_SESSION['user']['displayName']?></a>
            <a href="/user/logout/">выход</a>
        </div>
            <? }else{?>
            <div id="buttonAuth" style="display: <?php if(isset($data[0]['cnt'])){echo 'none';}else{echo "block";}?>">
                <button type="submit" onclick="authorization();">Войти</button>
                <button type="submit" onclick="register();">Регистрация</button>
            </div>
            <div id="userName">
        <a id="userLink" href="/user/"></a>
        <a href="/user/logout/">выход</a>
            </div>
        <? }?>
            </div>
        </div>
    </nav>





<!-- Main jumbotron for a primary marketing message or call to action -->
<?if(isset($data['slider'])):?>
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-3" style="color: yellowgreen">Главная страница</h1>
            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>
        </div>
    </div>
<?php endif;?>
<div class="container">
    <h1 class="display-4 text-center" style='margin-bottom: 20px'><?php if(isset($data['title']))echo $data['title'];?></h1>
    <div class="row">
        <div class="col-md-3">
            <?= drawMenu($menu, true) ?>
        </div>
        <div class="col-md-9">
            <?php if (isset($data['error'])) : ?>
                <div class="alert alert-danger">
                    <?= $data['error']?>
                </div>
            <?php endif; ?>
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

            <?php include 'application/views/'.$content_view; ?>
        </div>
    </div>
    <hr>
    <footer>
        <p>&copy; Company <?= date('Y'); ?></p>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
    <script src="/js/bootstrap.bundle.js" defer></script>
</div> <!-- /container -->
</div>
</body>
</html>