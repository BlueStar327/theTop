<?php
/*
Template Name: admin hosts page
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
        <button type="button" onclick="add_host()" class="add_diary">追加</button>
        <ul id="diary_table" class="hosts_table">
            <li>
                <div class="th num"><span>No</span></div>
                <div class="th avatar"><span>アバター</span></div>
                <div class="th name"><span>名前</span></div>
                <div class="th ranking"><span>ランキング</span></div>
                <div class="th level"><span>レベル</span></div>
                <div class="th age"><span>年齢</span></div>
                <div class="th tall"><span>高い</span></div>
                <div class="th weight"><span>重さ</span></div>
                <div class="th call"><span>着信</span></div>
                <div class="th point"><span>ポイント</span></div>
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
function delete_host(value) {
    $.ajax({
        url: "<?php echo esc_url( home_url( '/host_delete_api' ) ); ?>", 
        type: "POST",
        data: {
            host_id: value
        },
        success: function(res){
            $(window).attr('location','');
        }
    });
}

function edit_host(value) {
    $(window).attr('location','<?php echo esc_url( home_url( '/admin_host_edit_diary' ) ); ?>?host_id=' + value);
}

function add_host(value) {
    $(window).attr('location','<?php echo esc_url( home_url( '/admin_host_edit_diary' ) ); ?>');
}

$.ajax({
    url: "<?php echo esc_url( home_url( '/hosts_get_api' ) ); ?>", 
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
                var hosts = data['data'];
                var htmltext = $("ul.hosts_table").html();
                var end = hosts.length;
                var levels = ["Rookie", "Bronze" , "Silver", "Gold", "Legend"];
                for (let i = 0 + <?=$items_per_page * ($page - 1);?>; i < <?=$page * $items_per_page;?>; i++) {
                     if(i == end) break;
                     htmltext += '<li>'
                                     + '<div class="num"><span>' + (i + 1) + '</span></div>'
                                     + '<div class="flex items-center justify-center avatar"><img src="' + ( hosts[i]['uf_image'] ? hosts[i]['uf_image'] : ('<?=get_home_url();?>' + '/wp-content/themes/theTop/image/top_human_g_ico.png') ) + '" alt="img"></div>'
                                     + '<div class="name"><span>' + hosts[i]['uf_firstname'] + hosts[i]['uf_lastname'] + '</span></div>'
                                     + '<div class="ranking"><span>' + hosts[i]['h_ranking'] + '</span></div>'
                                     + '<div class="level"><span>' + levels[hosts[i]['h_level'] - 1] + '</span></div>'
                                     + '<div class="age"><span>' + hosts[i]['uf_age'] + '</span></div>'
                                     + '<div class="tall"><span>' + hosts[i]['uf_tall'] + '</span></div>'
                                     + '<div class="weight"><span>' + hosts[i]['uf_weight'] + '</span></div>'
                                     + '<div class="call"><span>' + hosts[i]['uf_contact_number'] + '</span></div>'
                                     + '<div class="point"><span>' + hosts[i]['h_point'] + '</span></div>'
                                     + '<div class="actions">'
                                     + '<button type="button" class="edit" onclick="edit_host(' + hosts[i]['h_uid'] + ')"></button>'
                                     + '<button type="button" class="delete" onclick="delete_host(' + hosts[i]['h_id'] + ')"></button></div>'
                                     + '</li>';
                }
                $("ul.hosts_table").html(htmltext);
            }
        }
    }
});
</script>