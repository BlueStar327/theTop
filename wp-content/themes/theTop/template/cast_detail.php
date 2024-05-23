<?php
/*
Template Name: cast detail
*/
 get_header(); 
?>

<section class="xl_container cast_mv">
    <picture>
        <source media="(max-width: 768px)" srcset="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg_sp.png">
        <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg.png" alt="mv">
    </picture>
    <div class="absolute">
        <p>キャスト詳細</p> 
    </div>
</section>

<div class="flex justify-between navigation">
        <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a><a href="<?php echo esc_url( home_url( '/cast_page' ) ); ?>">キャスト</a> キャスト詳細</p>
    <p></p>
</div>

<section class="xl_container cast_detail">
    <div>
        <div class="detail_card">
            <div class="slider_group">
                <div class="cast_detail_slider">
                    <picture>
                        <img class="slider_img" src="" alt="img">
                    </picture>
                    <picture>
                        <img class="slider_img" src="" alt="img">
                    </picture>
                    <picture>
                        <img class="slider_img" src="" alt="img">
                    </picture>
                    <picture>
                        <img class="slider_img" src="" alt="img">
                    </picture>
                    <picture>
                        <img class="slider_img" src="" alt="img">
                    </picture>
                </div>
                <div class="flex justify-end">
                <blockquote class="twitter-tweet">
                <a href="https://twitter.com/username/status/1234567890123456789"><img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_detail_b_twitter_ico.png" alt="twitter"></a>
            </blockquote>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
            <h3 class="small_topic">PROFILE<span>プロフィール</span></h3>
            <div class="block md:flex">
                <div class="detail"></div>     
                <pre class="txt etc_txt">
                </pre>
                </div>            
            <div class="detail_cast">
                <h3 class="text-center">MENU</h3>
                <div class="row flex justify-between">
                    <p><span>デートコース</span></p>
                    <p class="td"><span id="date_cost"></span>円</p>
                </div>
                <div class="row flex justify-between">
                    <p><span>ホテルコース</span></p>
                    <p class="td"><span id="hotel_cost"></span>円</p>
                </div>
                <div class="row flex justify-between">
                    <p><span>通話コース</span></p>
                    <p class="td"><span id="call_cost"></span>円</p>
                </div>
                <div class="row flex justify-between">
                    <p><span>交通費</span></p>
                    <p class="td"><span id="traffic_cost"></span>円</p>
                </div>
                <div class="row flex justify-between">
                    <p><span>ステイパック</span></p>
                    <p class="td"><span id="middle_cost"></span>円</p>
                </div>
                <div class="row flex justify-between">
                    <p><span>ロングタイム</span></p>
                    <p class="td"><span id="long_cost"></span>円 / 24時間</p>
                </div>
                <div class="bottom_deco"></div>
            </div>
            
            <h3 class="small_topic">SCHEDULE<span>出勤情報</span></h3>
            <div class="flex justify-between self_schedule"></div>

            <script>
                var week_name = ['日', '月', '火', '水', '木', '金', '土'];
                var date = new Date();
                var now_week = date.getDay();
                var html = "";
                for (let i = 0; i < week_name.length; i++) {
                    html +=  "<div>"
                            +' <p class="th">' + (date.getMonth() + 1) + '/' + (date.getDate() + i) + ' (' + week_name[(date.getDay() + i) % 7] + ')</p>'
                            +' <p class="td"><span id="from' + ((date.getDay() + i) % 7) + '"></span><br> ~ <br><span id="to' + ((date.getDay() + i) % 7) + '"></span> </p>'
                            +' </div>'
                }
                $(".self_schedule").html(html);
            </script>
            
        </div>
        <a class="good reservation">予約</a>
    </div>
    
    <div class="cast_commit">
        <p>レビュー</p>
        <div class="input_box">
            <form action="" method="get" class="">
                <textarea name="commit" id="commit_input" cols="30" rows="10"></textarea>
                <div class="flex justify-between">
                    <ul class="flex justify-between">
                        <li><a>
                            <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_detail_b_ico.png" alt="img">
                        </a></li>
                        <li><a>
                            <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_detail_b_i_ico.png" alt="img">
                        </a></li>
                        <li><a>
                            <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_detail_b_link_ico.png" alt="img">
                        </a></li>
                    </ul>
                    <button type="button"  onclick="sendReview()">送信</button>
                </div>
            </form>
            <div class="cast_reviews"></div>
        </div>
    </div>
</section>

<section class="xl_container cast_filter input_modal_box">
    <div class="input_modal">
        <form action="" method="post" id="scheduleAdd">
            <div class="flex justify-between box_condition">
                <div class="flex calender_box">
                    <label for="select_date1">日付</label>
                    <input type="datetime-local" name="select_date" id="select_date1" required>
                    <span> ~ </span>
                    <input type="datetime-local" name="select_date" id="select_date2" required>
                </div>
                <div class="flex select_box">
                    <label for="cast_select">タイプ</label>
                    <select name="select" id="cast_select"  onchange="numsChange_type()">
                        <option value="1">デートコース</option>
                        <option value="2">ホテルコース</option>
                        <option value="3">通話コース</option>
                        <option value="4">ステイパック</option>
                        <option value="5">長期的な関係</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-between row_gap">
                <div>
                    <label for="nickname">ニックネーム</label>
                    <input name="nickname" id="nickname" type="text" placeholder="スーパー忍者"  required>
                </div>
                <div class="">
                    <label for="address">住所</label>
                    <input name="address" id="address" type="text" placeholder="関東ホテル">
                </div>
            </div>
            <div class="row_gap">
            	<label for="contact_number">必ず予約者様の電話番号をご記入ください。</label>
            	<input name="contact_number" id="contact_number" type="number" placeholder="000000000" required>
            </div>
            <p class="row_gap">あなたのキャストのリアルタイムランキングにコインをあげませんか？</p>
            <div class="row_gap date_text_in">
                <div>
                    <label for="purchase">コース時間</label>
                    <input type="number" name="purchase" id="purchase" id="" value="5">
                </div>
                <p class="pt-3 nums_price">ご請求金額は、コース単価×コース時間の合計をご請求いたします。</p>
            </div>
            <div class="row_gap">
                <label for="commit" class="block">説明</label>
                <textarea name="commit" id="commit" cols="30" rows="10"></textarea>
            </div>
            <div class="flex justify-end row_gap">
                <button type="submit">予約</button>
                <button type="button" class="cancel">キャンセル</button>
            </div>
        </form>
    </div>
</section>

<script>

var host_id = '<?php
if(empty($_GET["host_id"])) {
    echo 1;
}
else {
    echo $_GET["host_id"];
}
?>';

$.ajax({
    url: "<?php echo esc_url( home_url( '/profile_get_api' ) ); ?>", 
    type: "POST",
    data: {
        type: 'gone',
        user_id: host_id,
        host_id: host_id,
    },
    success: function(res){
        console.log(res);
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            $("#from0").html(data['data']['g_from0']);
            $("#to0").html(data['data']['g_to0']);
            $("#from1").html(data['data']['g_from1']);
            $("#to1").html(data['data']['g_to1']);
            $("#from2").html(data['data']['g_from2']);
            $("#to2").html(data['data']['g_to2']);
            $("#from3").html(data['data']['g_from3']);
            $("#to3").html(data['data']['g_to3']);
            $("#from4").html(data['data']['g_from4']);
            $("#to4").html(data['data']['g_to4']);
            $("#from5").html(data['data']['g_from5']);
            $("#to5").html(data['data']['g_to5']);
            $("#from6").html(data['data']['g_from6']);
            $("#to6").html(data['data']['g_to6']);
        }
    }
});

var host_level = '1';
var date_cost;
var hotel_cost;
var call_cost;
var traffic_cost;
var middle_cost;
var long_cost;
var calc_price;

$("#scheduleAdd").submit(function( event ) {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/orders_put_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: host_id,
            host_id: host_id,
            price: calc_price,
            nickname: $("input#nickname").val(),
            start: $("input#select_date1").val(),
            end: $("input#select_date2").val(),
            course: $("input#cast_select").val(),
            address: $("input#address").val(),
            contact: $("input#contact_number").val(),
            coursetype: $("select#cast_select").val(),
            purchase: $("input#purchase").val()
        },
        success: function(res){
            alert("New Schedule saved successfully.");
            $(".input_modal_box").removeClass("active");
        }
    });

    event.preventDefault();
});

$.ajax({
    url: "<?php echo esc_url( home_url( '/hosts_get_api' ) ); ?>", 
    type: "POST",
    data: {
        host_id: host_id
    },
    success: function(res){
        // alert(res);
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            var host = data['data'][0];
            var htmltext = "";
            host_level = host["h_level"];
            var levels = ["Rookie", "Bronze" , "Silver", "Gold", "Legend"];
            if(host["uf_image"]) $(".slider_img").attr('src', host["uf_image"]);
            else $(".slider_img").attr('src', "<?=get_home_url();?>/wp-content/themes/theTop/image/cast_detail_img.png");
            htmltext += '<h2 class="text-center">プロフィール<span>(PROFILE)</span></h2>'
            			+'<p><span>名前: </span>' + host["uf_firstname"] + "" + host["uf_lastname"] + '</p>'
                        + '<p><span>年齢: </span>' + host["uf_age"] + '歳<br></p>'
                        + '    <p><span>身長： </span>' + host["uf_tall"] + 'cm<br></p>'
                        + '    <p><span>重量: </span>' + host["uf_weight"] + 'kg<br></p>'
                        + '    <p><span>スタイル: </span>' + host["uf_bodytype"] + '<br></p>'
                        + '    <p><span>レベル： </span>' + levels[host["h_level"] - 1] + '<br></p>'
                        + '    <p><span>ランク: </span>' + host["h_ranking"] + '<br></p>'
                        + '</p>';
            $(".detail").html(htmltext);
            $(".etc_txt").html(host["uf_content"]);
        }
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
                    switch (host_level) {
                        case '1':
                            date_cost = hosts['p_rookie_date'];
                            hotel_cost = hosts['p_rookie_hotel'];
                            call_cost = hosts['p_rookie_call'];
                            traffic_cost = hosts['p_traffic_price'];
                            middle_cost = hosts['p_rookie_10h'];
                            long_cost = hosts['p_rookie_24h'];
                            break;
                    
                        case '2':
                            date_cost = hosts['p_bronze_date'];
                            hotel_cost = hosts['p_bronze_hotel'];
                            call_cost = hosts['p_normal_call'];
                            traffic_cost = hosts['p_traffic_price'];
                            middle_cost = hosts['p_normal_10h'];
                            long_cost = hosts['p_normal_24h'];
                            break;
                    
                        case '3':                    
                            date_cost = hosts['p_silver_date'];
                            hotel_cost = hosts['p_silver_hotel'];
                            call_cost = hosts['p_normal_call'];
                            traffic_cost = hosts['p_traffic_price'];
                            middle_cost = hosts['p_normal_10h'];
                            long_cost = hosts['p_normal_24h'];
                            break;
                    
                        case '4':
                            date_cost = hosts['p_gold_date'];
                            hotel_cost = hosts['p_gold_hotel'];
                            call_cost = hosts['p_normal_call'];
                            traffic_cost = hosts['p_traffic_price'];
                            middle_cost = hosts['p_normal_10h'];
                            long_cost = hosts['p_normal_24h'];                    
                            break;
                    
                        case '5':
                            date_cost = hosts['p_legend_date'];
                            hotel_cost = hosts['p_legend_hotel'];
                            call_cost = hosts['p_normal_call'];
                            traffic_cost = hosts['p_traffic_price'];
                            middle_cost = hosts['p_normal_10h'];
                            long_cost = hosts['p_normal_24h'];                    
                            break;
                    
                        default:
                            break;
                    }
                    $("span#date_cost").html(date_cost);
                    $("span#hotel_cost").html(hotel_cost);
                    $("span#call_cost").html(call_cost);
                    $("span#traffic_cost").html(traffic_cost);
                    $("span#middle_cost").html(middle_cost);
                    $("span#long_cost").html(long_cost);
                    
                    calc_price = date_cost;
                }
            }
        });
    }
});


$.ajax({
    url: "<?php echo esc_url( home_url( '/review_get_api' ) ); ?>", 
    type: "POST",
    data: {
        host_id: host_id
    },
    success: function(res){
        // alert(res);
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            var hosts = data['data'];
            var htmltext = "";
            var len = hosts.length;
            var end = 0;
            if(len > 5) end = 5;
            else end = len;
            for (let i= 0; i < end; i++) {
                htmltext += '<div class="cast_review">'
                            + '   <p class="th">' + hosts[i]["create_at"] + '</p>'
                            + ' <p class="td">' + hosts[i]["r_content"] + '</p>'
                            + '</div>';
                $(".cast_reviews").html(htmltext);
            }
            $.each(data['data'], function (index, value) {
            })
        }
    }
});

function sendReview() {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/review_put_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id:  host_id,
            content: $("textarea#commit_input").val(),
        },
        success: function(res){
            var htmltext = "";
            var date = new Date();
            htmltext += '<div class="cast_review">'
                        + '   <p class="th">' + date.getFullYear() + "-" + date.getMonth() + "-" + date.getDate() + " " + date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds() + '</p>'
                        + ' <p class="td">ビュー。 良いレビュー。<br />' + $("textarea#commit_input").val() + '</p>'
                        + '</div>';
            htmltext += $(".cast_reviews").html();
            $(".cast_reviews").html(htmltext);
            $("textarea#commit_input").val("");
        }
    });
}

function numsChange_type() {
    switch ($("#cast_select").val()) {
        case "1":
            calc_price = date_cost;
            break;
            
        case "2":
            calc_price = hotel_cost;
            break;
    
        case "3":
            calc_price = call_cost;
            break;
    
        case "4":
            calc_price = middle_cost;
            break;

        case "5":
            calc_price = long_cost;
            break;
    
        default:
            break;
    }
}

</script>

<?php get_footer(); ?>