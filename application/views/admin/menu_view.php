<div style="margin:0px 50px 0px 50px;">
<?php if($data['menus']):?>
<table class="table">
    <thead>
    <tr>
        <th>№ п/п</th>
        <th>Имя</th>
        <th>Путь</th>
        <th>Удалить</th>
    </tr>
    </thead>
    <?php foreach($data['menus'] as $menu):?>
    <tr>
        <td><?= $menu['id']?></td>
        <td><a href="/admin/menu/edit/id/<?= $menu['id']?>"><?= $menu['title']?></a></td>
        <td><?= $menu['path']?></td>
        <td>
            <form action="/admin/menu/delete" method="post">
                <input name="id" type="hidden" value="<?= $menu['id']?>">
                <button type="submit" class="btn btn-primary">Удалить</button>
            </form>
        </td>
    </tr>
    <?php endforeach;endif;?>

</table>
    <a href="/admin/menu/add">Добавить пункт меню</a>
</div>