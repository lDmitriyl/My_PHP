<div id="tableBox">
<table id="userTable">
    <tr>
        <td>Логин(еmail)</td>
        <td><?=$_SESSION['user']['email']?></td>
    </tr>
    <tr>
        <td>Имя</td>
        <td><input type="text" id="newName" name="newName" value="<?=$_SESSION['user']['name']?>"></td>
    </tr>
    <tr>
        <td>Телефон</td>
        <td><input type="text" id="newPhone" name="newPhone" value="<?=$_SESSION['user']['phone']?>"></td>
    </tr>
    <tr>
        <td>Адресс</td>
        <td><textarea type="text" id="newAddress"  name="newAddress" ><?=$_SESSION['user']['address']?></textarea></td>
    </tr>
    <tr>
        <td>Новый пароль</td>
        <td><input type="password" id="newPwd1" name="newPwd1"></td>
    </tr>
    <tr>
        <td>Повтор пароля</td>
        <td><input type="password" id="newPwd2" name="newPwd2"></td>
    </tr>
    <tr>
        <td>Для того чтоб сохранить новые данные введите текущий пароль</td>
        <td><input type="password" id="curPwd" name="curPwd"></td>
    </tr>
    <tr>
        <td></td>
        <td><button onclick="updateUser();">Сохранить изменения</button></td>
    </tr>

</table>
</div>