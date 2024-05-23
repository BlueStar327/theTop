		<section class="xl_container yellow_bg top_meeting">
            <h2 class="text-center">出会い方</h2>
            <p class="method">どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？ どうやって会うの？</p>
            <ul class="flex justify-between">
                <li>
                    <a href="<?php echo esc_url( home_url( '/price_page' ) ); ?>">手数料</a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/terms_services' ) ); ?>">利用規約</a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/cast_page' ) ); ?>">予約</a>
                </li>
            </ul>
        </section>
        <script>
            $.ajax({
                url: "<?php echo esc_url( home_url( '/price_get_api' ) ); ?>", 
                type: "POST",
                data: {
                    type: '3'
                },
                success: function(res){
                    var data = JSON.parse(res);
                    if(data['data'] != [] && data['success'] == 1)  {
                        var hosts = data['data'];
                        $(".method").html(hosts['m_method']);
                    }
                }
            });
        </script>
    </main>
    <footer class="xl_container">
        <div class="flex justify-between">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <h2 class="text-center">
                <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/header_logo.png" alt="logo">
                </h2>
            </a>
            <blockquote class="twitter-tweet">
                <a href="https://twitter.com/username/status/1234567890123456789"><img src="<?=get_home_url();?>/wp-content/themes/theTop/image/switter_ico.png" alt="ico"></a>
            </blockquote>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
        <div class="flex list">
            <p>※18歳未満の方による当サイトの閲覧は関係法規により禁止いたします。<br /> 無店舗型性風俗特殊営業届出番号　第22572号<br /> TEL：お電話でのご予約は受け付けておりません。お問い合わせやご相談等はキャストに直接LINE・Twitter等でご連絡ください。<br /> 営業時間：12:00〜29:00（受付：11:00〜）出勤情報に記載のないキャストでも出勤可能のことがあります。直接キャストへご連絡ください。</p>
            <ul>
                <li>
                    <a href="<?php echo esc_url( home_url( '/cast_page' ) ); ?>">キャスト</a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/review_page' ) ); ?>">レビュー</a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/terms_services' ) ); ?>">スケジュール</a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/price_page' ) ); ?>">価格</a>
                </li>
                <li>
                    <a href="<?php echo esc_url( home_url( '/course_page' ) ); ?>">コース</a>
                </li>
            </ul>
        </div>
    </footer>
    <script src="<?=get_home_url();?>/wp-content/themes/theTop/js/slick.min.js"></script>
    <script src="<?=get_home_url();?>/wp-content/themes/theTop/js/main.js"></script>
    <script src="<?=get_home_url();?>/wp-content/themes/theTop/js/style.js"></script>
    <?php require_once 'script.php' ?>
</body>
</html>