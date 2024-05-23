<?php
/*
Template Name: price
*/
 get_header(); 
?>
<section class="xl_container cast_mv">
    <picture>
        <source media="(max-width: 768px)" srcset="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg_sp.png">
        <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg.png" alt="mv">
    </picture>
    <div class="absolute">
        <p>価格</p>
    </div>
</section>

<div class="flex justify-between navigation">
    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a> 価格</p>
    <p></p>
</div>

<section class="xl_container price_info">
    <div class="price_info">
        <div class="price_detail">
            <h3>料金表</h3>

            <div class="table">
                <div class="row">
                    <p class="th"></p>
                    <p class="th">Rookie</p>
                    <p class="th">Bronze</p>
                    <p class="th">Silver</p>
                    <p class="th">Gold</p>
                    <p class="th">Legend</p>
                </div>
                <div class="row">
                    <p class="td">デートコース</p>
                    <p class="td"><span id="rookie_date">2,000</span>円<br>
                        /1時間
                    </p>
                    <p class="td"><span id="bronze_date">6,000</span>円<br>
                        /1時間
                    </p>
                    <p class="td"><span id="silver_date">8,000</span>円<br>
                        /1時間
                    </p>
                    <p class="td"><span id="gold_date">10,000</span>円<br>
                        /1時間
                    </p>
                    <p class="td"><span id="legend_date">20,000</span>円<br>
                        /1時間
                    </p>
                </div>
                <div class="row">
                    <p class="td">ホテルコース</p>
                    <p class="td"><span id="rookie_hotel">5,000</span>円<br>
                        /1時間
                    </p>
                    <p class="td"><span id="bronze_hotel">8,000</span>円<br>
                        /1時間
                    </p>
                    <p class="td"><span id="silver_hotel">10,000</span>円<br>
                        /1時間
                    </p>
                    <p class="td"><span id="gold_hotel">12,000</span>円<br>
                        /1時間
                    </p>
                    <p class="td"><span id="legend_hotel">20,000</span>円<br>
                        /1時間
                    </p>
                </div>
                <div class="row">
                    <p class="td">通話コース</p>
                    <p class="td"><span id="rookie_call">1,000</span>円<br>
                        /30分
                    </p>
                    <p class="td"><span id="normal_call">6,000</span>円<br>
                        /1時間
                    </p>
                </div>
                <div class="row">
                    <p class="td">ステイパック</p>
                    <p class="td"><span id="rookie_10h">50,000</span>円<br>
                        /10時間
                    </p>
                    <p class="td"><span id="normal_10h">80,000</span>円<br>
                        /10時間
                    </p>
                </div>
                <div class="row">
                    <p class="td">ロングタイム</p>
                    <p class="td"><span id="rookie_24h">120,000</span>円<br>
                        /24時間
                    </p>
                    <p class="td"><span id="normal_24h">180,000</span>円<br>
                        /24時間
                    </p>
                </div>
                <div class="row">
                    <p class="td">指名料</p>
                    <p  class="td"><span id="region_price">1,000</span>円</p>
                </div>
                <div class="row">
                    <p class="td">交通費</p>
                    <p class="td"><span id="traffic_price">1,000</span>円(23区内) 遠方実費
                        <br>※大宮 横浜 千葉などは基本<span id="traffic_price_etc">2,000</span>円
                    </p>
                </div>
                <div class="row">
                    <p class="td">出張費</p>
                    <p class="td"><span id="travel_price">5,000</span>円
                        <br>※関東外の場合のみ
                    </p>
                </div>
                <div class="row">
                    <p class="td">深夜タクシー代</p>
                    <p class="td w-5\/6">キャスト自宅まで実費
                        <br>※電車のない時間帯の移動がある場合のみ
                    </p>
                </div>
            </div>

            <ul>
                <li><span>詳しくは、キャストページをご確認下さい。</span></li>
                <li><span>2時間からご予約を承ります。2時間以降は30分毎にご予約・延長が可能です。30分毎の料金は1時間料金の半額となります。</span></li>
                <li><span>ステイパック、ロングタイムは、通常のデートコースやホテルコースと組み合わせてのご利用も可能です。</span></li>
                <li><span>ステイパックは、キャストの睡眠時間確保にご協力ください。</span></li>
            </ul>
        </div>

        <div class="price_detail">
            <h3>お支払い方法</h3>

            <ul>
                <li><span>ご利用料金はご対面の際に直接現金でキャストへお渡しください。当日、できるだけお二人の雰囲気をこわさないような場所とタイミングでキャストからお声がけさせていただきます。</span></li>
                <li><span>途中からご延長の際は、その時点でキャストへ延長分の料金をお渡しください。</span></li>
            </ul>
        </div>

        <div class="price_detail">
            <h3>注意事項</h3>

            <ul>
                <li><span>ご予約時間中の飲食代施設料移動費等はお客様負担となります。</span></li>
                <li><span>ご予約は2時間から承っており、以降30分刻みでご予約及びご延長いただけます。</span></li>
                <li><span>30分の料金は各1時間の料金の半額といたします。</span></li>
                <li><span>ご予約者以外の方が同席の場合はご予約時にキャストの承諾を得て、またお店までその旨ご連絡くださいませ。</span></li>
            </ul>
        </div>

        <div class="price_detail">
            <h3>ご利用時間について</h3>

            <ul>
                <li><span>デートコースはお待ち合わせ時間〜お見送り解散までを時間内とします。</span></li>
                <li><span>ホテルコースはホテル入室〜退出までが時間内となるようお願いいたします。<br>（お待ち合わせ〜ホテルまでと、ホテル〜お見送り改札までの、ホテル滞在前後徒歩10分程度はサービスとさせていただきます。）</span></li>
            </ul>
        </div>

        <div class="price_detail">
            <h3>キャンセルについて</h3>

            <ul>
                <li><span>ご予約の事前キャンセルは可能でございます。キャンセルの場合はキャストにをその旨ご連絡の上、お店までお知らせください。</span></li>
                <li><span>キャストとお約束の時間の24時間前までキャンセル料無料といたします。</span></li>
                <li><span>それ以降のキャンセルですとご予定の金額の100%をキャンセル料としてお支払いいただきますので、ご注意いただきますようお願いいたします。</span></li>
            </ul>
        </div>

        <div class="price_detail">
            <h3>ご対面までの流れ</h3>

            <ul>
                <li><span>キャストLINEまたはTwitterDMまでご希望の 日時/コース/エリア をお送りください。</span></li>
                <li><span>キャストよりご予約の可否のお返事と併せてご利用料金をご案内させていただきます。</span></li>
                <li><span>それ以降のキャンセルですとご予定の金額の100%キャストからお客様にお送りした「ご予約詳細」のコピーまたはスクリーンショットを店連絡先までお送りいただき、ご予約完了となります。</span></li>
                <li><span>合流場所(目印になる建物 お店名 ホテル室内 ご自宅など)をお伝えください。</span></li>
                <li><span>ご対面</span></li>
            </ul>
        </div>

        <div class="price_detail">
            <h3>ご対面までの流れ</h3>

            <ul>
                <li><span>デートコース>手繋ぎ ハグまで可能<br>（屋外 飲食店 アミューズメント施設 カラオケ等）</span></li>
                <li><span>ホテルコース>手繋ぎ ハグ キス 性感施術まで可能<br>（ホテル ご自宅）</span></li>
                <li><span>ステイパック>手繋ぎ ハグ キス 性感施術まで可能</span></li>
                <li><span>ロングタイム>手繋ぎ ハグ キス 性感施術まで可能<br>※ネットカフェ・ハプニングバーは全コース同行不可</span></li>
            </ul>
        </div>
    </div>

    <div class="flex justify-center items-center">
        <a href="<?php echo esc_url( home_url( '/terms_services' ) ); ?>" class="red_btn">利用規約</a>
    </div>
</section>

<?php get_footer(); ?>

<script>
$.ajax({
    url: "<?php echo esc_url( home_url( '/price_get_api' ) ); ?>", 
    type: "POST",
    data: {
        user_id: ' ',
        type: '1'
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            var hosts = data['data'];
            $("span#rookie_date").html(hosts['p_rookie_date']);
            $("span#bronze_date").html(hosts['p_bronze_date']);
            $("span#silver_date").html(hosts['p_silver_date']);
            $("span#gold_date").html(hosts['p_gold_date']);
            $("span#legend_date").html(hosts['p_legend_date']);
            $("span#rookie_hotel").html(hosts['p_rookie_hotel']);
            $("span#bronze_hotel").html(hosts['p_bronze_hotel']);
            $("span#silver_hotel").html(hosts['p_silver_hotel']);
            $("span#gold_hotel").html(hosts['p_gold_hotel']);
            $("span#legend_hotel").html(hosts['p_legend_hotel']);
            $("span#rookie_call").html(hosts['p_rookie_call']);
            $("span#normal_call").html(hosts['p_normal_call']);
            $("span#rookie_10h").html(hosts['p_rookie_10h']);
            $("span#normal_10h").html(hosts['p_normal_10h']);
            $("span#rookie_24h").html(hosts['p_rookie_24h']);
            $("span#normal_24h").html(hosts['p_normal_24h']);
            $("span#region_price").html(hosts['p_region_price']);
            $("span#traffic_price").html(hosts['p_traffic_price']);
            $("span#traffic_price_etc").html(hosts['p_traffic_price_etc']);
            $("span#travel_price").html(hosts['p_travel_price']);
        }
    }
});
</script>