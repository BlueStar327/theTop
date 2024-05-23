<?php
/*
Template Name: admin schedule page
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
<div class="add_schedule">
    <form action="<?php echo esc_url( home_url( '/orders_put_api' ) ); ?>" method="post" id="scheduleAdd">
        <div class="flex items-center calender_box">
            <label for="select_date1">日付</label>
            <input type="datetime-local" name="select_date1" id="select_date1" required>
            <span> ~ </span>
            <input type="datetime-local" name="select_date2" id="select_date2" required>
        </div>
        <div class="flex select_box">
            <label for="cast_select">タイプ</label>
            <select name="select" id="cast_select">
                <option value="0">デートコース</option>
                <option value="1">ホテルコース</option>
                <option value="2">通話コース</option>
                <option value="3">長期的な関係</option>
            </select>
        </div>
        <div class="flex items-center">
            <label for="nick_name">ニックネーム</label>
            <input type="text" name="nick_name" id="nick_name" required>
        </div>
        <div class="flex items-center">
            <label for="address">住所</label>
            <input type="text" name="address" id="address">
        </div>
        <div class="flex items-center">
            <label for="contact_number">連絡先番号</label>
            <input type="text" name="contact_number" id="contact_number">
        </div>
        <div class="flex items-center">
            <label for="course">コース</label>
            <input type="text" name="course" id="course">
        </div>
        <p>あなたのキャストのリアルタイムランキングにコインをあげませんか？</p>
        <div class="items-center">
            <label for="purchase">ニックネーム</label>
            <input type="number" name="purchase" id="purchase" value="5">
            <p class="nums_price">ご請求金額は、コース単価×コース時間の合計をご請求いたします。</p>
        </div>
        <div class="items-center">
            <label for="host_id">ニックネーム</label>
            <select name="host_id" id="host_id">
            </select>
        </div>
        <div class="flex justify-end">
            <button type="button" class="close" onclick="formclose()">キャンセル</button>
            <button type="submit" class="submit">追加</button>
        </div>
    </form>
</div>
<div class="flex">
    <?php require_once 'a_nav.php' ?>
    <div class="diary_box">
        <button type="button" onclick="add_schedule()" class="add_diary">追加</button>
        <ul id="diary_table" class="schedule_table">
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

<!-- ////// script ////////// -->
<script>
function cancel(value) {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/orders_put_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: '<?=$_SESSION["user_id"];?>',
            schedule_id: value,
            delete: '1'
        },
        success: function(res){
            $(window).attr('location','');
        }
    });
}

function add_schedule(value) {
    $(".add_schedule").addClass("action");
}

function formclose() {
    $(".add_schedule").removeClass("action");
}

$("#scheduleAdd").submit(function( event ) {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/orders_put_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: '<?=$_SESSION["user_id"];?>',
            host_id:  $("#host_id").val(),
            price: '1000',
            nickname: $("input#nick_name").val(),
            start: $("input#select_date1").val(),
            end: $("input#select_date2").val(),
            course: $("input#course").val(),
            coursetype: $("select#cast_select").val(),
            address: $("input#address").val(),
            contact: $("input#contact_number").val(),
            purchase: $("input#purchase").val()
        },
        success: function(res){
            alert("New Schedule saved successfully.");
            formclose() ;
            $(window).attr('location','');
        }
    });

    event.preventDefault();
});

function display() {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/orders_get_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: <?=$_SESSION["user_id"];?>,
            admin_id: <?=$_SESSION["user_id"];?>
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
                                        + '<div class="th from"><span>始める</span></div>'
                                        + '<div class="th to"><span>終わり</span></div>'
                                        + '<div class="th customer"><span>お客様</span></div>'
                                        + '<div class="th course"><span>コース</span></div>'
                                        + '<div class="th address aschedul"><span>住所</span></div>'
                                        + '<div class="th host"><span>ホスト</span></div>'
                                        + '<div class="th price"><span>価格</span></div>'
                                        + '<div class="th purchase"><span>購入</span></div>'
                                        + '<div class="th actions"><span>行動</span></div>'
                                        + '</li>';
                    var end = diarys.length;
                    for (let i = 0 + <?=$items_per_page * ($page - 1);?>; i < <?=$page * $items_per_page;?>; i++) {
                        if(i == end) break;
                        htmltext += (diarys[i]['o_allow'] == '0'? '<li class="gray">' : '<li>')
                                + '<div class="num"><span>' + (i + 1) + '</span></div>'
                                + '<div class="from"><span>' + diarys[i]['o_start'] + '</span></div>'
                                + '<div class="to"><span>' + diarys[i]['o_end'] + '</span></div>'
                                + '<div class="customer"><span>' + diarys[i]['o_name'] + '</span></div>'
                                + '<div class="course"><span>' + diarys[i]['o_course'] + '</span></div>'
                                + '<div class="address aschedul"><span>' + diarys[i]['o_address'] + ' ( ' + diarys[i]['o_contact'] + ' )' + '</span></div>'
                                + '<div class="host"><span>' + diarys[i]['o_hostid'] + '</span></div>'
                                + '<div class="price"><span>' + diarys[i]['o_price'] + '</span></div>'
                                + '<div class="purchase"><span>' + diarys[i]['o_purchase'] + '</span></div>'
                                + '<div class="actions schedule_allow">'
                                + '<button class="' + ( diarys[i]["o_allow"] == 0 ? 'not' : 'read' ) + '" type="button"' + ( diarys[i]["o_allow"] == 0 ? ('onclick="sendAllow(' + diarys[i]["o_id"] + ', 2)') : ('onclick="sendAllow(' + diarys[i]["o_id"] + ', 1)') ) + '">' + ( diarys[i]["o_allow"] == 0 ? '許可する' : '許可しません' ) + '</button>'
                                + '<button type="button" class="cancel" onclick="cancel(' + diarys[i]['o_id'] +')">キャンセル</button></div>'
                                + '</li>';
                    }
                    $("ul#diary_table").html(htmltext);
                }
            }
        }
    });
}

function sendAllow(num, value) {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/orders_put_api' ) ); ?>", 
        type: "POST",
        data: {
            user_id: '<?=$_SESSION["user_id"];?>',
            schedule_id: num,
            order_allow: value
        },
        success: function(res){
            display();
        }
    });
}

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
            var htmltext = "";
            $.each(hosts, function(index, value ) {
                htmltext += '<option value="' + value["h_uid"] + '">' + value['uf_firstname'] + value['uf_lastname'] + '</option>';
            });
            $("#host_id").html(htmltext);
        }
    }
});

display();

</script>