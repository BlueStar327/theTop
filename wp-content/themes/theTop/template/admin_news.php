<?php
/*
Template Name: admin news page
*/

session_start();

$_SESSION["news_id"] = "";

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
        <button type="button" onclick="add_diary()" class="add_diary">追加</button>
        <ul id="diary_table">
            <li>
                <div class="th num"><span>No</span></div>
                <div class="th title"><span>タイトル</span></div>
                <div class="th content"><span>コンテンツ</span></div>
                <div class="th created"><span>作成時間</span></div>
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
function delete_diary(value) {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/news_delete_api' ) ); ?>", 
        type: "POST",
        data: {
            news_id: value
        },
        success: function(res){
            $(window).attr('location','');
        }
    });
}

function edit_diary(value) {
    $(window).attr('location','<?php echo esc_url( home_url( '/admin_news_edit_diary' ) ); ?>?news_id=' + value);
}

function add_diary(value) {
    $(window).attr('location','<?php echo esc_url( home_url( '/admin_news_edit_diary' ) ); ?>');
}

$.ajax({
    url: "<?php echo esc_url( home_url( '/news_get_api' ) ); ?>", 
    type: "POST",
    data: {
        user_id: '<?=$_SESSION["user_id"];?>'
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
                     htmltext += '<li><div class="num"><span>' + (i + 1)
                         + '</span></div><div class="title"><span>' 
                         + diarys[i]['n_title'] + '</span></div><div class="content"><span>' 
                         + diarys[i]['n_content'] + '</span></div><div class="created"><span>' 
                         + diarys[i]['create_at'] 
                         + '</span></div><div class="actions"><button type="button" class="edit" onclick="edit_diary(' 
                         + diarys[i]['n_id'] +')"></button><button type="button" class="delete" onclick="delete_diary(' 
                         + diarys[i]['n_id'] +')"></button></div></li>';
                }
                $("ul#diary_table").html(htmltext);
            }
        }
    }
});
</script>