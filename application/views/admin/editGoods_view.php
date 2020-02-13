<form action="/admin/goods/edit" method="post">

    <input name="id" type="hidden" value="<?= $data['goods']['id']?>">
    <div class="form-group">
        <label for="title">Название</label>
        <input type="text" id="title" name="title" value="<?= $data['goods']['title']?>">
    </div>

    <div class="form-group">
        <label for="price">Цена</label>
        <input type="text" id="price" name="price" value="<?= $data['goods']['price']?>">
    </div>

    <button type="submit" class="btn btn-primary">Редактировать</button>
</form>