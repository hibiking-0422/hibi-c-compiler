<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
</head>
<body>
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
</body>
</html>
