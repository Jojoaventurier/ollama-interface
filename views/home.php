<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Installed Models</title>
    <link rel="stylesheet" href="styles.css"> <!-- Include your CSS file -->
</head>
<body>
    <header>
        <h1>Installed Models</h1>
    </header>

    <main>
        <!-- Display Errors -->
        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <?php foreach ($errors as $error): ?>
                    <div class="error"><?= $error ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- List Models -->
        <?php if (!empty($models)): ?>
            <ul>
                <?php foreach ($models as $model): ?>
                    <li><?= $model ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No models are installed locally.</p>
        <?php endif; ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y'); ?> AI Interface</p>
    </footer>
</body>
</html>