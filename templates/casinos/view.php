<?php include __DIR__ . '/../header.php'; ?>
<h1><?= $casino->getName() ?></h1>
<p><?= $casino->getParsedText() ?></p>
<p>Автор: <?= $casino->getAuthor()->getNickname() ?></p>
<?php include __DIR__ . '/../footer.php'; ?>



