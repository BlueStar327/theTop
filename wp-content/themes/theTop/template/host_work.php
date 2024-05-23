<?php
/*
Template Name: host work page
*/

session_start();

if(!isset($_SESSION["host_id"])) {
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
    <?php require_once 'c_nav.php' ?>
    <div class="diary_box">
        <div class="work_state">
            <p class="text-center work_topic">仕事の状態</p>
            <div class="grid state_lines">
                <div class="state_line step3">
                    <span>未確</span>
                </div>
                <div class="state_line step2" onclick="changeState(1)">
                    <span>仮確</span>
                </div>
                <div class="state_line step1" onclick="changeState(2)">
                    <span>確定</span>
                </div>
            </div>
        </div>
        
        <ul id="diary_table" class="schedule_table">
            <li>
                <div class="th num"><span>No</span></div>
                <div class="th from"><span>始める</span></div>
                <div class="th to"><span>終わり</span></div>
                <div class="th customer"><span>お客様</span></div>
                <div class="th course"><span>コース</span></div>
                <div class="th address"><span>住所</span></div>
                <div class="th price"><span>価格</span></div>
                <div class="th purchase"><span>購入</span></div>
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

function stateshow(value, law_id) {
    $selctState = law_id;
    for (let i = 1; i < 4; i++) {
        $selct = $(".state_line:nth-child(" + i + ")");
        $selct.removeClass();
        $selct.addClass("state_line");
        if(i < value + 2) $selct.addClass("step3");
        if(i == value + 2) $selct.addClass("step2");
        if(i > value + 2) $selct.addClass("step1");  
    }
}

function changeState(value) {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/orders_put_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: '<?=$_SESSION["user_id"];?>',
            schedule_id: $selctState,
            changeState: value
        },
        success: function(res){
            stateshow(value, $selctState);
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
        host_id: <?=$_SESSION["user_id"];?>,
        host_work: '1'
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
                     htmltext += (diarys[i]['o_allow'] == '0'? '<li class="gray" ' : '<li ') + '" onclick="stateshow(' + diarys[i]['o_state'] + ', ' + diarys[i]['o_id'] + ')">'
                             + '<div class="num"><span>' + (i + 1) + '</span></div>'
                             + '<div class="from"><span>' + diarys[i]['o_start'] + '</span></div>'
                             + '<div class="to"><span>' + diarys[i]['o_end'] + '</span></div>'
                             + '<div class="customer"><span>' + diarys[i]['o_name'] + '</span></div>'
                             + '<div class="course"><span>' + diarys[i]['o_course'] + '</span></div>'
                             + '<div class="address"><span>' + diarys[i]['o_address'] + '</span></div>'
                             + '<div class="price"><span>' + diarys[i]['o_price'] + '</span></div>'
                             + '<div class="purchase"><span>' + diarys[i]['o_purchase'] + '</span></div>'
                             + '<div class="actions"><span class="cancel"><button type="button" class="cancel '  + ( diarys[i]['o_pay'] == 1? 'green' : '' ) + (diarys[i]['o_pay'] == 0? ('" onclick="paid(' + diarys[i]['o_id'] +')') : '') + '">' + ( diarys[i]['o_pay'] == 1? '未確' : '確定' ) + '</button></span></div>'
                             + '</li>';
                }
                $("ul#diary_table").html(htmltext);
            }
        }
    }
});
</script>