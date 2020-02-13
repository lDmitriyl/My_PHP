<div style="margin:0px 50px 0px 50px;">
    <input type="button"  onclick="saveInXML();" value="Сохранить в XML">
    <?php if($data['goods']):?>
    <table class="table">
        <thead>
        <tr>
            <th>№ п/п</th>
            <th>Имя</th>
            <th>Цена</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <?php foreach($data['goods'] as $good):?>
            <tr>
                <td><?= $good['id']?></td>
                <td><a href="/admin/goods/edit/id/<?= $good['id']?>"><?= $good['title']?></a></td>
                <td><?= $good['price']?></td>
                <td>
                    <form action="/admin/goods/delete" method="post">
                        <input name="id" type="hidden" value="<?= $good['id']?>">
                        <button type="submit" class="btn btn-primary">Удалить</button>
                    </form>
                </td>
            </tr>
        <?php endforeach;endif;?>

    </table>
    <a href="/admin/goods/add">Добавить товар</a>
</div>