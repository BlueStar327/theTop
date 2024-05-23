<?php
/*
Template Name: course page
*/
 get_header(); 
?>
<section class="xl_container cast_mv">
    <picture>
        <source media="(max-width: 768px)" srcset="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg_sp.png">
        <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg.png" alt="mv">
    </picture>
    <div class="absolute">
        <p>コース</p>
    </div>
</section>

<div class="flex justify-between navigation">
    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a> コース</p>
    <p></p>
</div>

<section class="xl_container top_realnews course_realnews">
    <ul class="">
        <li class="flex justify-center">
            <div class="human_left_card">
                <picture>
                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/top_store_news2.png" alt="person">
                    <source media="(max-width: 768px)" srcset="top_store_news2.png">
                </picture>
                <div class="txt">
                    <h5>デートコース</h5>
                    <p>キャストとあなたのお好きな場所でデートができるプラン。洗練された人気キャストと理想のデートを楽しんでみませんか？カフェやレストランでのお食事はもちろん、観光地への旅行などもあなたのご希望のプランで楽しめます。
                    </p>
                </div>
            </div>
        </li>
        <li class="flex justify-center">
            <div class="human_left_card flex-row-reverse">
                <picture>
                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/top_history1.png" alt="person">
                    <source media="(max-width: 768px)" srcset="top_history1.png">
                </picture>
                <div class="txt">
                    <h5>ホテルコース</h5>
                    <p>まずはキャストプロフィールのページをご覧になり、お会いになりたいキャストをお選びください。様々なキャストがおりますので、キャラクターをお知りに知りになりたい場合は、キャストの日記やTwitterをご覧になるのがおすすめです。
                        <br>なかなかお相手を選べないという場合は、遠慮なくLINE メール TwitterDMでお店までご相談ください。お客様の好みをお伺いして、ぴったりのキャストをご提案致します。ご質問ご相談だけでも構いません。問い合わせをしたら予約しないといけないということはありませんのでお気軽にご連絡ください。</p>
                </div>
            </div>
        </li>
        <li class="flex justify-center">
            <div class="human_left_card">
                <picture>
                    <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/top_history2.png" alt="person">
                    <source media="(max-width: 768px)" srcset="top_history2.png">
                </picture>
                <div class="txt">
                    <h5>通話コース</h5>
                    <p>私たちのキャストが必要な場合は、いつでも通知書を送ってください。</p>
                </div>
            </div>
        </li>
    </ul>
</section>

<section class="xl_container top_review review_box course_review">
    
    <div class="review">
        <div class="grid grid-cols-3 tabs">
            <button class="btntab">デートコース</button>
            <button class="btntab active">ホテルコース</button>
            <button class="btntab">通話コース</button>
        </div>

        <div class="history_card">
            <div class="flex card_header">
                <p class="text-center index">STEP. 1</p>
                <p class="name">お好みのキャストをお選びください</p>
            </div>
            <div class="card_body">
                <p>まずはキャストプロフィールのページをご覧になり、お会いになりたいキャストをお選びください。様々なキャストがおりますので、キャラクターをお知りに知りになりたい場合は、キャストの日記やTwitterをご覧になるのがおすすめです。
                    <br>なかなかお相手を選べないという場合は、遠慮なくLINE メール TwitterDMでお店までご相談ください。お客様の好みをお伺いして、ぴったりのキャストをご提案致します。ご質問ご相談だけでも構いません。問い合わせをしたら予約しないといけないということはありませんのでお気軽にご連絡ください。</p>
                                        
                <div class="flex justify-center items-center">
                    <a href="" class="red_btn">続きを読む</a>
                </div>
            </div>
        </div>
        <div class="history_card">
            <div class="flex card_header">
                <p class="text-center index">STEP. 2</p>
                <p class="name">ご予約</p>
            </div>
            <div class="card_body">
                <p>お会いになりたいキャストが決まりましたら、キャストに直接ご連絡いただきます。キャストプロフィールページより、LINE メール TwitterDMでキャストと直接メッセージのやりとりが可能です。
                    <br>なかなかお相手を選べないという場合は、遠慮なくLINE メール TwitterDMでお店までご相談ください。お客様の好みをお伺いして、ぴったりのキャストをご提案致します。ご質問ご相談だけでも構いません。問い合わせをしたら予約しないといけないということはありませんのでお気軽にご連絡ください。
                    <br>その際に下記の予約メッセージテンプレートを使用してキャストにお送りいただきますとスムーズにご予約が進みます。内容が決まりましたら、この段階でキャストより当日のお支払い金額をお知らせいたしますのでご安心ください。</p>
            </div>
        </div>
        <div class="history_card">
            <div class="flex card_header">
                <p class="text-center index">STEP. 3</p>
                <p class="name">お好みのキャストをお選びください</p>
            </div>
            <div class="card_body">
                <p>まずはキャストプロフィールのページをご覧になり、お会いになりたいキャストをお選びください。様々なキャストがおりますので、キャラクターをお知りに知りになりたい場合は、キャストの日記やTwitterをご覧になるのがおすすめです。
                    <br>なかなかお相手を選べないという場合は、遠慮なくLINE メール TwitterDMでお店までご相談ください。お客様の好みをお伺いして、ぴったりのキャストをご提案致します。ご質問ご相談だけでも構いません。問い合わせをしたら予約しないといけないということはありませんのでお気軽にご連絡ください。</p>
            </div>
        </div>                
        <div class="history_card">
            <div class="flex card_header">
                <p class="text-center index">STEP. 4</p>
                <p class="name">お好みのキャストをお選びください</p>
            </div>
            <div class="card_body">
                <p>まずはキャストプロフィールのページをご覧になり、お会いになりたいキャストをお選びください。様々なキャストがおりますので、キャラクターをお知りに知りになりたい場合は、キャストの日記やTwitterをご覧になるのがおすすめです。
                    <br>なかなかお相手を選べないという場合は、遠慮なくLINE メール TwitterDMでお店までご相談ください。お客様の好みをお伺いして、ぴったりのキャストをご提案致します。ご質問ご相談だけでも構いません。問い合わせをしたら予約しないといけないということはありませんのでお気軽にご連絡ください。</p>
            </div>
        </div>
        <div class="history_card">
            <div class="flex card_header">
                <p class="text-center index">STEP. 5</p>
                <p class="name">お好みのキャストをお選びください</p>
            </div>
            <div class="card_body">
                <p>まずはキャストプロフィールのページをご覧になり、お会いになりたいキャストをお選びください。様々なキャストがおりますので、キャラクターをお知りに知りになりたい場合は、キャストの日記やTwitterをご覧になるのがおすすめです。
                    <br>なかなかお相手を選べないという場合は、遠慮なくLINE メール TwitterDMでお店までご相談ください。お客様の好みをお伺いして、ぴったりのキャストをご提案致します。ご質問ご相談だけでも構いません。問い合わせをしたら予約しないといけないということはありませんのでお気軽にご連絡ください。</p>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
<script>
    $( ".btntab" ).each(function( index, value ) {
        $(this).click(()=>{
            $('.btntab').removeClass("active");
            $(this).addClass('active');
            console.log(index);
        });
    });
    
</script>