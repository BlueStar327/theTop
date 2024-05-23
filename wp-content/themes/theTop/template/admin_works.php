<?php
/*
Template Name: admin work page
*/

session_start();

if(!isset($_SESSION["admin_id"])) {
    header('Location: ' .   esc_url( home_url('/')), true, (preg_match('~^30[1237]$~', $code) > 0) ? $code : 302);
}

get_header(); 

$page = 1;
if(!empty($_GET["cpage"])) {
   $page = $_GET["cpage"];
} else {
   $page = 1;
}

$total = 15;
if(isset($_SESSION["total"])) {
    $total = $_SESSION["total"];
} else {
   $total = 15;
}

$items_per_page = 10;
?>

<div class="flex">
    <?php require_once 'a_nav.php' ?>
    <div class="diary_box">
        <div class="work_status">
            <div class="flex justify-between work_search">
                <div class="flex date_input">
                    <label for="from">日付</label>
                    <input type="date" name="from" id="from">
                    <input type="date" name="to" id="to">
                </div>
                <div class="flex course_input">
                    <label for="course">コース</label>
                    <select name="course" id="course">
                        <option value="0"></option>
                        <option value="1">デートコース</option>
                        <option value="2">ホテルコース</option>
                        <option value="3">通話コース</option>
                        <option value="4">長期的な関係</option>
                    </select>
                </div>
                <div class="flex hosts_input">
                    <label for="hosts">ホスト</label>
                    <select name="hosts" id="hosts">
                        <option value=""></option>
                    </select>
                </div>
                <button type="button" class="clean" onclick="clean()">クリーン</button>
                <button type="button" class="search" onclick="search()">検索</button>
            </div>
            <div class="flex justify-center work_state">
                <div>
                    <div class="flex">
                        <p>予約合計数</p>
                        <p class="total_works">0</p>
                    </div>
                    <div class="flex">
                        <p>合計売上</p>
                        <p class="total_incoming">0</p>
                    </div>
                </div>
                <div>
                <div class="flex">
                        <p>デートコース</p>
                        <p class="date_course">0</p>
                    </div>
                    <div class="flex">
                        <p>金額</p>
                        <p class="purchase">0</p>
                    </div>
                </div>
                <div>
                <div class="flex">
                        <p>ホテルコース</p>
                        <p class="hotel_course">0</p>
                    </div>
                    <div class="flex">
                        <p>店落ち</p>
                        <p class="store_closure">0</p>
                    </div>
                </div>
                <div>
                <div class="flex">
                        <p>通話コース</p>
                        <p class="calling_course">0</p>
                    </div>
                    <div class="flex">
                        <p>入金完了</p>
                        <p class="deposit_completed">0</p>
                    </div>
                </div>
            </div>
        </div>
        
        <ul id="diary_table" class="schedule_table">
            <li>
                <div class="th num"><span>No</span></div>
                <div class="th hostname"><span>ホスト</span></div>
                <div class="th from"><span>始める</span></div>
                <div class="th to"><span>終わり</span></div>
                <div class="th customer"><span>お客様</span></div>
                <div class="th course awork"><span>コース</span></div>
                <div class="th address"><span>住所</span></div>
                <div class="th price"><span>価格</span></div>
                <div class="th purchase"><span>購入</span></div>
                <div class="th w_state"><span>購入</span></div>
                <div class="th actions"><span>支払い状態</span></div>
            </li>
        </ul>
        <div class="page_nav">
            <?php 
                echo paginate_links( array(
                    'base' => add_query_arg( 'cpage', '%#%' ),
                    'format' => '',
                    'prev_text' => __('&laquo;'),
                    'next_text' => __('&raquo;'),
                    'total' => ceil($total / $items_per_page),
                    'current' => $page
                ));
            ?>
        </div>
    </div>
</div>
<?php require_once 'tem_footer.php' ?>
<?php require_once 'user_footer.php' ?>

<script>
$selctState = 0;
$startDate = "";
$endDate = "";
$selectCourse = "";
$selectHost = "";

$("#from").change(function(){
    $startDate = $('#from').val();
});

$("#to").change(function(){
    $endDate = $('#to').val();
});

$("#course").change(function(){
    $selectCourse = $('#course').val();
});

$("#hosts").change(function(){
    $selectHost = $('#hosts').val();
});

function clean() {
    $(window).attr('location','');
}

function search() {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/orders_get_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: <?=$_SESSION["user_id"];?>,
            admin_id: <?=$_SESSION["user_id"];?>,
            search_work: '1',
            startDate: $startDate,
            endDate: $endDate,
            selectCourse: $selectCourse,
            selectHost: $selectHost,
            admin_work: '1'
        },
        success: function(res){
            var data = JSON.parse(res); 
            if(data['total'] != <?= $total; ?>) {
                $(window).attr('location','');
            } else {
                if(data['data'] != [])  {
                    var diarys = data['data'];
                    var htmltext = '<li>'
                                        + '<div class="th num"><span>No</span></div>'
                                        + '<div class="th hostname"><span>ホスト</span></div>'
                                        + '<div class="th from"><span>始める</span></div>'
                                        + '<div class="th to"><span>終わり</span></div>'
                                        + '<div class="th customer"><span>お客様</span></div>'
                                        + '<div class="th course awork"><span>コース</span></div>'
                                        + '<div class="th address"><span>住所</span></div>'
                                        + '<div class="th price"><span>価格</span></div>'
                                        + '<div class="th purchase"><span>購入</span></div>'
                                        + '<div class="th w_state"><span>購入</span></div>'
                                        + '    <div class="th actions"><span>支払い状態</span></div>'
                                    + '</li>'
                    var end = diarys.length;
                    <?php $page = 1; ?>
                    for (let i = 0 + <?=$items_per_page * ($page - 1);?>; i < <?=$page * $items_per_page;?>; i++) {
                        if(i == end) break;
                        htmltext += '<li>'
                                + '<div class="num"><span>' + (i + 1) + '</span></div>'
                                + '<div class="hostname"><span>' + diarys[i]['uf_firstname'] + diarys[i]['uf_lastname'] + '</span></div>'
                                + '<div class="from"><span>' + diarys[i]['o_start'] + '</span></div>'
                                + '<div class="to"><span>' + diarys[i]['o_end'] + '</span></div>'
                                + '<div class="customer"><span>' + diarys[i]['o_name'] + '</span></div>'
                                + '<div class="course awork"><span>' + diarys[i]['o_course'] + '</span></div>'
                                + '<div class="address"><span>' + diarys[i]['o_address'] + '</span></div>'
                                + '<div class="price"><span>' + diarys[i]['o_price'] + '</span></div>'
                                + '<div class="purchase"><span>' + diarys[i]['o_purchase'] + '</span></div>'
                                + '<div class="w_state"><span class="cell ' + ( diarys[i]['o_state'] == 0 ? 'state1' : '') + ( diarys[i]['o_state'] == 1 ? 'state2' : '') + ( diarys[i]['o_state'] == 2 ? 'state3' : '') + '">' + ( diarys[i]['o_state'] == 0 ? '未確' : '') + ( diarys[i]['o_state'] == 1 ? '仮確' : '') + ( diarys[i]['o_state'] == 2 ? '確定' : '') + '</span></div>'
                                + '<div class="actions"><span class="cancel"><button type="button" class="cancel '  + ( diarys[i]['o_pay'] == 1? 'green' : '' ) + (diarys[i]['o_pay'] == 0? ('" onclick="paid(' + diarys[i]['o_id'] +')') : '') + '">' + ( diarys[i]['o_pay'] == 1? '未確' : '確定' ) + '</button></span></div>'
                                + '</li>';
                    }
                    $("ul#diary_table").html(htmltext);
                }
            }
        }
    });
}

function paid(value) {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/orders_put_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: '<?=$_SESSION["user_id"];?>',
            schedule_id: value,
            pay: '1'
        },
        success: function(res){
            $(window).attr('location','');
        }
    });
}

$.ajax({
    url: "<?php echo esc_url( home_url( '/orders_get_api' ) ); ?>", 
    type: "POST",
    data: {
        user_id: <?=$_SESSION["user_id"];?>,
        admin_id: <?=$_SESSION["user_id"];?>,
        admin_work: '1'
    },
    success: function(res){
        var data = JSON.parse(res); 
        if(data['total'] != <?= $total; ?>) {
            $(window).attr('location','');
        } else {
            if(data['data'] != [])  {
                var diarys = data['data'];
                var htmltext = $("ul#diary_table").html();
                var end = diarys.length;
                for (let i = 0 + <?=$items_per_page * ($page - 1);?>; i < <?=$page * $items_per_page;?>; i++) {
                    if(i == end) break;
                    htmltext += '<li>'
                            + '<div class="num"><span>' + (i + 1) + '</span></div>'
                            + '<div class="hostname"><span>' + diarys[i]['uf_firstname'] + diarys[i]['uf_lastname'] + '</span></div>'
                            + '<div class="from"><span>' + diarys[i]['o_start'] + '</span></div>'
                            + '<div class="to"><span>' + diarys[i]['o_end'] + '</span></div>'
                            + '<div class="customer"><span>' + diarys[i]['o_name'] + '</span></div>'
                            + '<div class="course awork"><span>' + diarys[i]['o_course'] + '</span></div>'
                            + '<div class="address"><span>' + diarys[i]['o_address'] + '</span></div>'
                            + '<div class="price"><span>' + diarys[i]['o_price'] + '</span></div>'
                            + '<div class="purchase"><span>' + diarys[i]['o_purchase'] + '</span></div>'
                            + '<div class="w_state"><span class="cell ' + ( diarys[i]['o_state'] == 0 ? 'state1' : '') + ( diarys[i]['o_state'] == 1 ? 'state2' : '') + ( diarys[i]['o_state'] == 2 ? 'state3' : '') + '">' + ( diarys[i]['o_state'] == 0 ? '未確' : '') + ( diarys[i]['o_state'] == 1 ? '仮確' : '') + ( diarys[i]['o_state'] == 2 ? '確定' : '') + '</span></div>'
                            + '<div class="actions"><span class="cancel"><button type="button" class="cancel '  + ( diarys[i]['o_pay'] == 1? 'green' : '' ) + (diarys[i]['o_pay'] == 0? ('" onclick="paid(' + diarys[i]['o_id'] +')') : '') + '">' + ( diarys[i]['o_pay'] == 1? '未確' : '確定' ) + '</button></span></div>'
                            + '</li>';
                }
                $("ul#diary_table").html(htmltext);
    
                $(".total_works").html(diarys.length);
                $(".date_course").html(diarys.filter(en => en["o_coursetype"] == "0").length);
                $(".hotel_course").html(diarys.filter(en => en["o_coursetype"] == "1").length);
                $(".calling_course").html(diarys.filter(en => en["o_coursetype"] == "2").length);
            }
        }
    }
});

$.ajax({
    url: "<?php echo esc_url( home_url( '/hosts_get_api' ) ); ?>", 
    type: "POST",
    data: {
        user_id: '<?=$_SESSION["user_id"];?>'
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            var hosts = data['data'];
            var htmltext = '<option value="0"></option>';
            $.each(hosts, function(index, value ) {
                htmltext += '<option value="' + value["h_id"] + '">' + value['uf_firstname'] + value['uf_lastname'] + '</option>';
            });
            $("#hosts").html(htmltext);
        }
    }
});

function get_current() {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/get_current_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: '<?=$_SESSION["user_id"];?>'
        },
        success: function(res){
            var data = JSON.parse(res);
            if(data['data'] != [])  {
                $(".total_incoming").html(data['total']);
                $(".purchase").html(data['purchase']);
                $(".store_closure").html(data['closure']);
                $(".deposit_completed").html(data['deposit_com']);
            }
        }
    });
}

get_current();

</script>