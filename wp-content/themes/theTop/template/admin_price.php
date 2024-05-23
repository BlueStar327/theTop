<?php
/*
Template Name: admin price page
*/

session_start();

if(!isset($_SESSION["admin_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}
get_header(); 
?>

<div class="flex">
    <?php require_once 'a_nav.php' ?>
    <div>
        <div class="diary_box">
            <button type="button" onclick="change_save()" class="add_diary">保存</button>
            <section class="xl_container price_info price_set">
                <div class="price_info">
                    <div class="price_detail">
                        <h3>料金表</h3>
    
                        <div class="table admin_table">
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
                                <p class="td"><span><input type="number" name="rookie_date" id="rookie_date" value="2000">円</span>
                                    /1時間
                                </p>
                                <p class="td"><span><input type="number" name="bronze_date" id="bronze_date" value="6000">円</span>
                                    /1時間
                                </p>
                                <p class="td"><span><input type="number" name="silver_date" id="silver_date" value="8000">円</span>
                                    /1時間
                                </p>
                                <p class="td"><span><input type="number" name="gold_date" id="gold_date" value="10000">円</span>
                                    /1時間
                                </p>
                                <p class="td"><span><input type="number" name="legend_date" id="legend_date" value="20000">円</span>
                                    /1時間
                                </p>
                            </div>
                            <div class="row">
                                <p class="td">ホテルコース</p>
                                <p class="td"><span><input type="number" name="rookie_hotel" id="rookie_hotel" value="5000">円</span>
                                    /1時間
                                </p>
                                <p class="td"><span><input type="number" name="bronze_hotel" id="bronze_hotel" value="8000">円</span>
                                    /1時間
                                </p>
                                <p class="td"><span><input type="number" name="silver_hotel" id="silver_hotel" value="10000">円</span>
                                    /1時間
                                </p>
                                <p class="td"><span><input type="number" name="gold_hotel" id="gold_hotel" value="12000">円</span>
                                    /1時間
                                </p>
                                <p class="td"><span><input type="number" name="legend_hotel" id="legend_hotel" value="20000">円</span>
                                    /1時間
                                </p>
                            </div>
                            <div class="row">
                                <p class="td">通話コース</p>
                                <p class="td"><span><input type="number" name="rookie_call" id="rookie_call" value="1000">円</span>
                                    /30分
                                </p>
                                <p class="td"><span><input type="number" name="normal_call" id="normal_call" value="6000">円</span>
                                    /1時間
                                </p>
                            </div>
                            <div class="row">
                                <p class="td">ステイパック</p>
                                <p class="td"><span><input type="number" name="rookie_10h" id="rookie_10h" value="50000">円</span>
                                    /10時間
                                </p>
                                <p class="td"><span><input type="number" name="normal_10h" id="normal_10h" value="80000">円</span>
                                    /10時間
                                </p>
                            </div>
                            <div class="row">
                                <p class="td">ロングタイム</p>
                                <p class="td"><span><input type="number" name="rookie_24h" id="rookie_24h" value="120000">円</span>
                                    /24時間
                                </p>
                                <p class="td"><span><input type="number" name="normal_24h" id="normal_24h" value="180000">円</span>
                                    /24時間
                                </p>
                            </div>
                            <div class="row">
                                <p class="td">指名料</p>
                                <p  class="td"><span><input type="number" name="region_price" id="region_price" value="1000">円</span></p>
                            </div>
                            <div class="row">
                                <p class="td">交通費</p>
                                <p class="td"><span><input type="number" name="traffic_price" id="traffic_price" value="1000">円(23区内) 遠方実費</span>
                                    <span>※大宮 横浜 千葉などは基本 <input type="number" name="traffic_price_etc" id="traffic_price_etc" value="2000">円</span>
                                </p>
                            </div>
                            <div class="row">
                                <p class="td">出張費</p>
                                <p class="td"><span><input type="number" name="travel_price" id="travel_price" value="5000">円</span>
                                    ※関東外の場合のみ
                                </p>
                            </div>
                            <div class="row">
                                <p class="td">深夜タクシー代</p>
                                <p class="td w-5\/6">キャスト自宅まで実費
                                    <br>※電車のない時間帯の移動がある場合のみ
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="diary_box">
            <button type="button" onclick="method_change_save()" class="add_diary">保存</button>
            <section class="xl_container price_info price_set">
                <div class="price_info">
                    <div class="price_detail">
                        <h3>出会い方</h3>
    
                        <div class="table admin_table">
                            <div class="row">
                                <textarea name="get_method" id="get_method" class="get_method"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>  
    </div>
</div>
<?php require_once 'tem_footer.php' ?>
<?php require_once 'user_footer.php' ?>
<script>

function change_save(value) {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/price_get_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: '<?=$_SESSION["user_id"];?>',
            type: '2',
            p_rookie_date: $("input#rookie_date").val(),
            p_bronze_date: $("input#bronze_date").val(),
            p_silver_date: $("input#silver_date").val(),
            p_gold_date: $("input#gold_date").val(),
            p_legend_date: $("input#legend_date").val(),
            p_rookie_hotel: $("input#rookie_hotel").val(),
            p_bronze_hotel: $("input#bronze_hotel").val(),
            p_silver_hotel: $("input#silver_hotel").val(),
            p_gold_hotel: $("input#gold_hotel").val(),
            p_legend_hotel: $("input#legend_hotel").val(),
            p_rookie_call: $("input#rookie_call").val(),
            p_normal_call: $("input#normal_call").val(),
            p_rookie_10h: $("input#rookie_10h").val(),
            p_normal_10h: $("input#normal_10h").val(),
            p_rookie_24h: $("input#rookie_24h").val(),
            p_normal_24h: $("input#normal_24h").val(),
            p_region_price: $("input#region_price").val(),
            p_traffic_price: $("input#traffic_price").val(),
            p_traffic_price_etc: $("input#traffic_price_etc").val(),
            p_travel_price: $("input#travel_price").val(),
        },
        success: function(res){
            var data = JSON.parse(res);
            if(data['data'])  {
                alert("Changing saved successfully.");
            } else {
                alert("Try again.");
            }
        }
    });
}

function method_change_save() {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/price_get_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: '<?=$_SESSION["user_id"];?>',
            type: '4',
            get_method: $("#get_method").val(),
        },
        success: function(res){
            var data = JSON.parse(res);
            if(data['data'])  {
                alert("Changing saved successfully.");
            } else {
                alert("Try again.");
            }
        }
    });
}

$.ajax({
    url: "<?php echo esc_url( home_url( '/price_get_api' ) ); ?>", 
    type: "POST",
    data: {
        user_id: '<?=$_SESSION["user_id"];?>',
        type: '1'
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [] && data['success'] == 1)  {
            var hosts = data['data'];
            $("input#rookie_date").val(hosts['p_rookie_date']);
            $("input#bronze_date").val(hosts['p_bronze_date']);
            $("input#silver_date").val(hosts['p_silver_date']);
            $("input#gold_date").val(hosts['p_gold_date']);
            $("input#legend_date").val(hosts['p_legend_date']);
            $("input#rookie_hotel").val(hosts['p_rookie_hotel']);
            $("input#bronze_hotel").val(hosts['p_bronze_hotel']);
            $("input#silver_hotel").val(hosts['p_silver_hotel']);
            $("input#gold_hotel").val(hosts['p_gold_hotel']);
            $("input#legend_hotel").val(hosts['p_legend_hotel']);
            $("input#rookie_call").val(hosts['p_rookie_call']);
            $("input#normal_call").val(hosts['p_normal_call']);
            $("input#rookie_10h").val(hosts['p_rookie_10h']);
            $("input#normal_10h").val(hosts['p_normal_10h']);
            $("input#rookie_24h").val(hosts['p_rookie_24h']);
            $("input#normal_24h").val(hosts['p_normal_24h']);
            $("input#region_price").val(hosts['p_region_price']);
            $("input#traffic_price").val(hosts['p_traffic_price']);
            $("input#traffic_price_etc").val(hosts['p_traffic_price_etc']);
            $("input#travel_price").val(hosts['p_travel_price']);
        }
    }
});

$.ajax({
    url: "<?php echo esc_url( home_url( '/price_get_api' ) ); ?>", 
    type: "POST",
    data: {
        user_id: '<?=$_SESSION["user_id"];?>',
        type: '3'
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [] && data['success'] == 1)  {
            var hosts = data['data'];
            $("#get_method").val(hosts['m_method']);
            const $this = $("#get_method"); // 'this' refers to the current textarea in the loop
            $this.css('height', 'auto');
            $this.css('height', $this.prop('scrollHeight') + 'px');
        }
    }
});

function adjustTextareaHeight() {
    const $this = $(this); // 'this' refers to the current textarea in the loop
    $this.css('height', 'auto');
    $this.css('height', $this.prop('scrollHeight') + 'px');
}

// Add event listeners to all textareas with the 'auto-expand' class
$('.get_method').each(function() {
    $(this).on('input', adjustTextareaHeight);
    // Initial adjustment in case any textarea has pre-filled content
    adjustTextareaHeight.call(this);
});
</script>