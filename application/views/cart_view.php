<?php if(count($data['goods'])<1):?>
<h2>В корзине товаров нет</h2>
<?php else:?>
    <form action="/cart/order/" method="POST">
<table class="table">
    <thead class="thead-light">
    <tr>
        <th scope="col">№</th>
        <th scope="col">Наименование</th>
        <th scope="col">Количество</th>
        <th scope="col">Цена за еденицу</th>
        <th scope="col">Цена</th>
        <th scope="col">Действие</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=0;
    foreach ($data['goods'] as $good):?>
        <tr>
            <th scope="row"><?=$i?></th>
            <td><?=$good['title']?></td>
            <td>
                <input name="item_<?=$good['id']?>" type="text" id="item_<?=$good['id']?>" value="1" onchange="conversion(<?=$good['id']?>);">
            </td>
            <td>
                <span id="itemprice_<?=$good['id']?>" value="<?=$good['price']?>"><?=$good['price']?></span>
            </td>
            <td>
                <span id="itemrealprice_<?=$good['id']?>"><?=$good['price']?></span>
            </td>
            <td>
                <a id="addCart_<?=$good['id']?>" href="#" onclick="addToCart(<?=$good['id']?>);return false;" style="display: none" alt="Добавить в корзину">Восстановить</a>
                <a id="removeCart_<?=$good['id']?>" href="#" onclick="removeToCart(<?=$good['id']?>);return false;"  alt="Удалить из корзины">Удалить из корзины</a>
            </td>
        </tr>
        <?php $i++; endforeach;?>
    </tbody>
</table>
        <input type="submit" value="Оформить заказ">
    </form>
<?php endif;?>