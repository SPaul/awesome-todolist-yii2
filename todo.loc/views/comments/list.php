<?php foreach ($model as $comment => $data) : ?>
    <div class="alert alert-info">
        <h4><span class="glyphicon glyphicon-user"></span> <?= $data->name; ?></h4>
        <p><span class="glyphicon glyphicon-pencil"></span><?= $data->content; ?></p>
    </div>
<?php endforeach;?>