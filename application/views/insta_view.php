<div class="row">
    <div class="col-md-12">
<form action="/insta/index" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="body">Сообщение</label>
        <textarea name="body" class="form-control" id="body" rows="3"></textarea>
    </div>

    <div class="form-group">
        <label for="img">Ваша Картинка</label>
        <input name="img" type="file" class="form-control-file" id="img" aria-describedby="fileHelp">
    </div>

    <button type="submit" class="btn btn-primary">запостить</button>
</form>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <ul class="list-group">

            <?php if(!empty($data['content'])):?>
            <?php foreach ($data['content'] as $image): ?>
                <li class="list-group-item">
                    <img width="200px" height="200px" src="/<?= $image['path'] ?>" alt="">
                    <div><?= nl2br($image['body']) ?></div>

                    <a target="_blank" href="/comment/index/num/<?= $image['id'] ?>">комментарии(<?php foreach($data['comment'] as $ar){if ($ar['id']==$image['id'])echo $ar['comment'];}?>)</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </br>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php if($data['page']!=1):?>
                <li class="page-item">
                    <a class="page-link" href="/insta/index/page/<?=$data['page']-1?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php endif;?>
                <?php for($i=1; $i<=$data['pagesCount']; $i++):
                  if($data['page']==$i) : ?>
                    <li class="page-item active"><a class="page-link" href="/insta/index/page/<?=$i?>"><?=$i?></a></li>
                  <?php else:?>
                      <li class="page-item"><a class="page-link" href="/insta/index/page/<?=$i?>"><?=$i?></a></li>
                <?php endif;endfor;?>
                <?php if($data['page']!=$data['pagesCount']):?>
                <li class="page-item">
                    <a class="page-link" href="/insta/index/page/<?=$data['page']+1?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
                <?php endif;?>
            </ul>
        </nav>
        <?php else:?>
        <h2>Постов нет!</h2>
        <?php endif;?>
    </div>
</div>