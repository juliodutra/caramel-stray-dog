<!DOCTYPE html>
<html>
<head>
    <title>Sidewalk Donations</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <nav>
        <?php if ($this->Identity->isLoggedIn()): ?>
            <a href="/donations">Donations</a>
            <a href="/donations/add">Add Donation</a>
            <a href="/logout">Logout</a>
        <?php else: ?>
            <a href="/login">Login</a>
            <a href="/register">Register</a>
        <?php endif; ?>
    </nav>

    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>

    <script src="/js/app.js"></script>
</body>
</html>