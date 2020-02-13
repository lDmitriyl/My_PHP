<div>
    <div id="cart" style=”text-align:left;”>
        <a href="/cart/index" style="margin-left: 455px">В корзине <span id="cartCntItems"><?php if(count($_SESSION['cart'])>0){echo count($_SESSION['cart']);}else{echo "пусто";}?></span></a>
    </div>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">№</th>
      <th scope="col">Имя</th>
      <th scope="col">Цена</th>
        <th scope="col">Корзина</th>
    </tr>
  </thead>
  <tbody>
  <?php
  if(!empty($data['goods'])):
  $i=0;
  foreach ($data['goods'] as $good):?>
    <tr>
      <th scope="row"><?=$i?></th>
      <td><?=$good['title']?></td>
      <td><?=$good['price']?></td>
      <td><a id="addCart_<?=$good['id']?>" href="#" onclick="addToCart(<?=$good['id']?>);return false;" <?if(in_array($good['id'],$_SESSION['cart'])){?>style="display: none" <?}?>alt="Добавить в корзину">Добавить в корзину</a>
          <a id="removeCart_<?=$good['id']?>" href="#" onclick="removeToCart(<?=$good['id']?>);return false;" <?if(!in_array($good['id'],$_SESSION['cart'])){?>style="display: none" <?}?>alt="Удалить из корзины">Удалить из корзины</a>
      </td>
    </tr>
  <?php $i++; endforeach;
  else: 'Товаров нет';
  endif;?>
  </tbody>
</table>
    </div>