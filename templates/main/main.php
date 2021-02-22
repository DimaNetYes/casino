<?php include __DIR__ . '/../header.php'; ?>
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
        <div class="casino__part">
            <div class="casino__part_1"><img src="/templates/Images/playzee-logo.png" alt=""></div>
            <div class="casino__part_2">
                <span>100% Up to</span>
                <span>$1500</span>
                <span>+150 zee spins</span>
                <span>+500 Zee Points</span>
            </div>
            <div class="casino__part_3 movie_choice">
                <span style="font-size:10px">Rating</span>
                <div id="r1" class="rate_widget">
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
                <button>Play</button>
            </div>
        </div>
    </section>

</article>


<?php foreach ($casinos as $casino): ?>
<!--    <h2>--><?//= $casino['name'] ?><!--</h2>-->
<!--    <p>--><?//= $casino['text'] ?><!--</p>-->
<!--    <hr>-->
<?php print_r($casino->casino); ?>

<?php endforeach; ?>
<?php include __DIR__ . '/../footer.php'; ?>
