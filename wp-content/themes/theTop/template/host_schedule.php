<?php
/*
Template Name: host schedule page
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
            <input type="text" name="contact_number" id="contact_number" required>
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
        <div class="flex justify-end">
            <button type="button" class="close" onclick="formclose()">キャンセル</button>
            <button type="submit" class="submit">追加</button>
        </div>
    </form>
</div>
<div class="flex">
    <?php require_once 'c_nav.php' ?>
    <div class="diary_box">
        <button type="button" onclick="change_gone()" class="add_diary">出勤情報追加</button>
        <div class="con_schedule"></div>
        <script>
            var week_name = ['日', '月', '火', '水', '木', '金', '土'];
            var date = new Date();
            var now_week = date.getDay();
            var html = "";
            for (let i = 0; i < week_name.length; i++) {
                html +=  '<div class="flex justify-between">'
                        +'   <p class="th">' + (date.getMonth() + 1) + '/' + (date.getDate() + i) + ' (' + week_name[(date.getDay() + i) % 7] + ')</p>'
                        +'   <p class="flex justify-between td">'
                        + '    <input type="time" name="from" id="from' + ((date.getDay() + i) % 7) + '">'
                        +'     <span>~</span>'
                        + '    <input type="time" name="to" id="to' + ((date.getDay() + i) % 7) + '">'
                        +'   </p>'
                        +' </div>'
            }
            $(".con_schedule").html(html);
        </script>
        <button type="button" onclick="add_schedule()" class="add_diary">追加</button>
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
                <div class="th actions"><span>行動</span></div>
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
            host_id: '<?=$_SESSION["user_id"];?>',
            price: '1000',
            nickname: $("input#nick_name").val(),
            start: $("input#select_date1").val(),
            end: $("input#select_date2").val(),
            course: $("input#course").val(),
            address: $("input#address").val(),
            contact: $("input#contact_number").val(),
            coursetype: $("select#cast_select").val(),
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

$.ajax({
    url: "<?php echo esc_url( home_url( '/orders_get_api' ) ); ?>", 
    type: "POST",
    data: {
        user_id: <?=$_SESSION["user_id"];?>,
        host_id: <?=$_SESSION["user_id"];?>
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
                     htmltext += (diarys[i]['o_allow'] == '0'? '<li class="gray">' : '<li>')
                             + '<div class="num"><span>' + (i + 1) + '</span></div>'
                             + '<div class="from"><span>' + diarys[i]['o_start'] + '</span></div>'
                             + '<div class="to"><span>' + diarys[i]['o_end'] + '</span></div>'
                             + '<div class="customer"><span>' + diarys[i]['o_name'] + '</span></div>'
                             + '<div class="course"><span>' + diarys[i]['o_course'] + '</span></div>'
                             + '<div class="address"><span>' + diarys[i]['o_address'] + '( ' + diarys[i]['o_contact'] + ')' + '</span></div>'
                             + '<div class="price"><span>' + diarys[i]['o_price'] + '</span></div>'
                             + '<div class="purchase"><span>' + diarys[i]['o_purchase'] + '</span></div>'
                             + '<div class="actions"><span class="cancel"><button type="button" class="cancel" onclick="cancel(' + diarys[i]['o_id'] +')">キャンセル</button></span></div>'
                             + '</li>';
                }
                $("ul#diary_table").html(htmltext);
            }
        }
    }
});

$.ajax({
    url: "<?php echo esc_url( home_url( '/profile_get_api' ) ); ?>", 
    type: "POST",
    data: {
        type: 'gone',
        user_id: '<?=$_SESSION["user_id"];?>'
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'] != [])  {
            $("input#from0").val(data['data']['g_from0']);
            $("input#to0").val(data['data']['g_to0']);
            $("input#from1").val(data['data']['g_from1']);
            $("input#to1").val(data['data']['g_to1']);
            $("input#from2").val(data['data']['g_from2']);
            $("input#to2").val(data['data']['g_to2']);
            $("input#from3").val(data['data']['g_from3']);
            $("input#to3").val(data['data']['g_to3']);
            $("input#from4").val(data['data']['g_from4']);
            $("input#to4").val(data['data']['g_to4']);
            $("input#from5").val(data['data']['g_from5']);
            $("input#to5").val(data['data']['g_to5']);
            $("input#from6").val(data['data']['g_from6']);
            $("input#to6").val(data['data']['g_to6']);
        }
    }
});

function change_gone() {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/profile_put_api' ) ); ?>", 
        type: "POST",
        data: {
            type: 'gone',
            user_id: <?=$_SESSION["user_id"];?>,
            from0: $("input#from0").val(),
            to0: $("input#to0").val(),
            from1: $("input#from1").val(),
            to1: $("input#to1").val(),
            from2: $("input#from2").val(),
            to2: $("input#to2").val(),
            from3: $("input#from3").val(),
            to3: $("input#to3").val(),
            from4: $("input#from4").val(),
            to4: $("input#to4").val(),
            from5: $("input#from5").val(),
            to5: $("input#to5").val(),
            from6: $("input#from6").val(),
            to6: $("input#to6").val(),
        },
        success: function(res){
            alert("Profile saved successfully.");
        },
    });
}
</script>