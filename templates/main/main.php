<?php include __DIR__ . '/../header.php'; ?>
<div class="background-image"></div>
<article>
    <header>PlayJosh</header>
    <div class="description">
        <p>TOP 5 REAL MONEY ONLINE CASINO BONUS LIST</p>
        <p>Play online slots for real money at trusted online casinos in Europe. Claim your exclusive welcome bonus and  start playing slots today!</p>
        <p>10,302 Claimed Bonuses And Counting</p>
    </div>
    <section class="casino">
        <div class="casino__title">
            <div>CASINO</div>
            <div>WELCOME BONUS</div>
            <div>USER RATING</div>
            <div>RATING</div>
            <div>PLAY NOW</div>
        </div>
<?php foreach ($casinos as $key => $casino): ?>
<!--        <p style="font-size:30px;"> --><?php //print_r($casino); break;?><!--</p>-->

        <div class="casino__part">
            <div class="casino__part_1"><img src="<?=$casino->casino ?>" alt=""></div>
            <div class="casino__part_2">
                <span id="cas_name"><?= $casino->name; ?></span>
                <span><?= $casino->upTo; ?></span>
                <span><?= $casino->bonus; ?></span>
                <span><?= $casino->freespeen; ?></span>
            </div>
            <div class="casino__part_3 movie_choice">
                <span style="font-size:10px" id="t1">Rating</span>
                <div id="r<?=$key+1 ?>" class="rate_widget">
                    <div class="star_1 ratings_stars"></div>
                    <div class="star_2 ratings_stars"></div>
                    <div class="star_3 ratings_stars"></div>
                    <div class="star_4 ratings_stars"></div>
                    <div class="star_5 ratings_stars"></div>
                    <div class="total_votes">vote data</div>
                </div>
            </div>
            <div class="casino__part_4">
                <div class="total_rating">vote data</div>
            </div>
            <div class="casino__part_5">
                <button data-index="1" class="btn">Play</button>
            </div>
        </div>



<?php //break;?>
<?php endforeach; ?>
    </section>
</article>
<?php include __DIR__ . '/../footer.php'; ?>
