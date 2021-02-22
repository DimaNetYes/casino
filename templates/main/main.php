<?php include __DIR__ . '/../header.php'; ?>

<div class="container">
    <header><p>PlayJosh</p></header>
    <div class="description">
        <p>TOP 5 Real Money Online Casino Bonus List!</p>
        <p>Play online slots for real money at trusted online casinos in Europe. Claim your exclusive welcome bonus and start playing slots today!</p>
        <p>10,302 Claimed Bonuses And Counting</p>
    </div>
    <div class="casinos">
        <div class="casinos__title">
            <div><span>CASINO</span></div>
            <div><span>WELCOME BONUS</span></div>
            <div><span>USER RATING</span></div>
            <div><span>RATING</span></div>
            <div><span>PLAY NOW</span></div>
        </div>
        <div class="casino"></div>
    </div>
</div>
<?php foreach ($casinos as $casino): ?>
<!--    <h2>--><?//= $casino['name'] ?><!--</h2>-->
<!--    <p>--><?//= $casino['text'] ?><!--</p>-->
<!--    <hr>-->
<?php print_r($casino); ?>

<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php'; ?>
