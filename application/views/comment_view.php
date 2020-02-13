<form action="/comment/index/num/<?= $data['params']?>" method="post" enctype="multipart/form-data">

    <input name="id" type="hidden" value="<?= $data['params']?>">

    <div class="form-group">
        <label for="body">Сообщение</label>
        <textarea name="body" class="form-control" id="body" rows="3"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">запостить</button>
</form>

<div class="row">
    <div class="col-md-12">
        <ul class="list-group">
            <?php if(!empty($data['comments'])):?>
            <?php foreach ($data['comments'] as $comment): ?>

    <li class="list-group-item">
        <div><?= nl2br($comment['comment']) ?></div>
    </li>
<?php endforeach; else: echo'Коментариев нет.'; endif; ?>
</ul>
</div>
</div>