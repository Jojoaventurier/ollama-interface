<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'AI Model App' ?></title>
    <link rel="stylesheet" href="/public/css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="/home">Home</a>
            <a href="/models">Models</a>
            <a href="/chat">Chat</a>
        </nav>
    </header>

    <?php if (!empty($errors)): ?>
    <div class="error-messages">
        <?php foreach ($errors as $error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

    <main>
        <?= $content ?>
    </main>
</body>
</html>