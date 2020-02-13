

    <form action="/table/tbumn" method="post">
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="Ряды" name="rows">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Колонки" name="cols">
            </div>
            <div class="col">
                <input type="color" class="form-control" name="color">
            </div>
            <div class="col">
                <input type="submit" class="form-control" value="Нарисовать">
            </div>
        </div>
    </form>
    <hr>

<?php
echo $data['table'];



