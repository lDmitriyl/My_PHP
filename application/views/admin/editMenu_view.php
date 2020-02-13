<form action="/admin/menu/edit" method="post">

    <input name="id" type="hidden" value="<?= $data['menu']['id']?>">
    <div class="form-group">
        <label for="title">Название</label>
        <input type="text" id="title" name="title" value="<?= $data['menu']['title']?>">
    </div>

    <div class="form-group">
        <label for="path">Путь</label>
        <input type="text" id="path" name="path" value="<?= $data['menu']['path']?>">
    </div>

    <button type="submit" class="btn btn-primary">Редактировать</button>
</form>