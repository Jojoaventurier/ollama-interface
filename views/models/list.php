<?php $title = 'Available Models'; ?>
<?php ob_start(); ?>
<h1>Local Models</h1>
<ul>
    <?php foreach ($models as $model): ?>
        <li><?= $model ?></li>
    <?php endforeach; ?>
</ul>

<h1>Remote Models</h1>
<ul>
<?php foreach ($remoteModels as $model): ?>
    <li>
        <?= $model['name'] ?> (Size: <?= round($model['diskSize'] / (1024 ** 3), 2) ?> GB)
        <?php if ($model['diskSize'] >= ModelController::VERY_LARGE_SIZE): ?>
            <span class="alert alert-danger">Very Large Model (Over 20GB)</span>
        <?php elseif ($model['diskSize'] >= ModelController::WARNING_SIZE): ?>
            <span class="alert alert-warning">Large Model (10GB to 20GB)</span>
        <?php endif; ?>
        <button onclick="window.location.href='/models/download?name=<?= urlencode($model['name']) ?>&size=base'">Download Base</button>
        <button onclick="window.location.href='/models/download?name=<?= urlencode($model['name']) ?>&size=large'">Download Large</button>
    </li>
<?php endforeach; ?>
</ul>
<?php $content = ob_get_clean(); ?>
<?php require 'views/layouts/main.php'; ?>