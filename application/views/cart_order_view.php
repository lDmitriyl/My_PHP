<?php $classname="inline"; if(count($data)<1){?>
    <h2>В корзине товаров нет</h2>
<?php }else{?>
    <div id="ordersBox">
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">№</th>
                <th scope="col">Наименование</th>
                <th scope="col">Количество</th>
                <th scope="col">Цена за еденицу</th>
                <th scope="col">Цена</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i=0;
            foreach ($data as $item){?>
                <tr>
                    <th scope="row"><?=$i?></th>
                    <td><?=$item['title']?></td>
                    <td>
                        <span id="itemCnt_<?=$item['id']?>"><input type="hidden" name="itemCnt_<?=$item['id']?>" value="<?=$item['cnt']?>"><?=$item['cnt']?></span>

                    </td>
                    <td>
                        <span id="itemPrice_<?=$item['id']?>"><input type="hidden" name="itemPrice_<?=$item['id']?>" value="<?=$item['price']?>"><?=$item['price']?></span>

                    </td>
                    <td>
                        <span id="itemRealPrice_<?=$item['id']?>"><input type="hidden" name="itemRealPrice_<?=$item['id']?>" value="<?=$item['realPrice']?>"><?=$item['realPrice']?></span>
                    </td>
                </tr>
                <?php $i++; }?>
            </tbody>
        </table>

<?php } if(count($_SESSION['user'])>0){?>
<table class="table">
    <tr>
        <td>Имя:</td>
        <?php if($_SESSION['user']['name']){?>
        <td><input type="text" name="name" value="<?=$_SESSION['user']['name']?>"></td>
        <?php }else{?>
        <td><a href="/user/">заполните поле</a></td>
        <?php }?>
    </tr>
    <tr>
        <td>Телефон:</td>
        <?php if($_SESSION['user']['phone']){?>
            <td><input type="text" name="phone" value="<?=$_SESSION['user']['phone']?>"></td>
        <?php }else{?>
            <td><a href="/user/">заполните поле</a></td>
        <?php }?>
    </tr>
    <tr>
        <td>Адрес:</td>
        <?php if($_SESSION['user']['address']){?>
            <td><textarea type="text" name="address" ><?=$_SESSION['user']['address']?></textarea></td>
        <?php }else{?>
            <td><a href="/user/">заполните поле</a></td>
        <?php }?>
    </tr>

</table>

<?php }else{ ?>

    <div class="login">
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

    <div class="register">
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
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="password" class="form-control" id="name" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="password" class="form-control" id="phone" name="phone" placeholder="Phone">
            </div>
            <div class="form-group">
                <label for="address">Адресс</label>
                <input type="password" class="form-control" id="address" name="address" placeholder="Address">
            </div>
            <button type="submit" onclick="registerUser();" class="btn btn-primary">Регистрация</button>
        </div>
    </div>
<?php  $classname="none";}?>
<button  style="display: <?=$classname?>" type="submit" onclick="saveOrder();">Оформить заказ</button>
    </div>


