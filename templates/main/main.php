<?php include __DIR__ . '/../header.php'; ?>
<?php foreach ($casinos as $casino): ?>
<!--    <h2>--><?//= $casino['name'] ?><!--</h2>-->
<!--    <p>--><?//= $casino['text'] ?><!--</p>-->
<!--    <hr>-->
<?php print_r($casino->casino); ?>

<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php'; ?>
