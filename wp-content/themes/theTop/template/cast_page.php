<?php
/*
Template Name: cast page
*/
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

$items_per_page = 12;
?>
<section class="xl_container cast_mv">
    <picture>
        <source media="(max-width: 768px)" srcset="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg_sp.png">
        <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg.png" alt="mv">
    </picture>
    <div class="absolute">
        <p>キャスト</p>
    </div>
</section>

<div class="flex justify-between navigation">
    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a> キャスト</p>
    <p>並べ替え</p>
</div>

<section class="xl_container cast_filter">
    <h2>キャストフィルター</h2>
    <div class="flex justify-between box_condition">
        <div class="flex calender_box">
            <label for="select_date">日付</label>
            <input type="datetime-local" name="select_date" id="select_date">
            <span> ~ </span>
            <input type="datetime-local" name="select_date" id="select_date">
        </div>
        <div class="flex select_box">
            <label for="cast_select">タイプ</label>
            <select name="select" id="cast_select">
                <option value="デートコース">デートコース</option>
                <option value="ホテルコース">ホテルコース</option>
                <option value="通話コース">通話コース</option>
                <option value="長期的な関係">長期的な関係</option>
            </select>
        </div>
    </div>
    <ul class="hosts"></ul>
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
</section>

<?php get_footer(); ?>
 
<script>
$.ajax({
    url: "<?php echo esc_url( home_url( '/hosts_get_api' ) ); ?>", 
    type: "POST",
    data: {},
    success: function(res){
        var data = JSON.parse(res);
        if(data['total'] != <?= $total; ?>) {
            $(window).attr('location','');
        } else {
            if(data['data'] != [])  {
                hosts = data['data'];
                var end = hosts.length;
                var htmltext = "";
                for (let i = 0 + <?=$items_per_page * ($page - 1);?>; i < <?=$page * $items_per_page;?>; i++) {
                     if(i == end) break;
    
    				var now_date = new Date();
                var date = new Date(hosts[i]['create_at']);
                console.log(now_date);
                console.log(date);
                console.log(now_date - date);
                
                if((now_date - date) < 552334500) htmltext += '<li class="new_member">';
                else htmltext += '<li class="">';
                
                     htmltext += '    <a href="<?php echo esc_url( home_url( '/cast_detail' ) ); ?>?host_id=' + hosts[i]['h_id'] + '">'
                                 + '        <div class="human_card first_rank">'
                                 + '            <picture>'
                                 + '                <img src="' + ( hosts[i]['uf_image'] ? hosts[i]['uf_image'] : "<?=get_home_url();?>/wp-content/themes/theTop/image/cast_detail_img.png") + '" alt="order">'
                                 + '                <source media="(max-width: :768)" srcset="' + ( hosts[i]['uf_image'] ? hosts[i]['uf_image'] : ('<?=get_home_url();?>' + '/wp-content/themes/theTop/image/top_human_g_ico.png') ) + '">'
                                 + '            </picture>'
                                 + '           <h5>' + hosts[i]['uf_firstname'] + hosts[i]['uf_lastname'] + '</h5>'
                                 + '            <p class="infor">' + hosts[i]['uf_tall'] + 'cm / ' + hosts[i]['uf_weight'] + 'Kg / ' + hosts[i]['uf_age'] + ' age / muscular</p>'
                                 + '            <p class="detail">' + hosts[i]['uf_state'] + '</p>'
                                 + '         </div>'
                                 + '    </a>'
                                 + '</li>';
                }
                $("ul.hosts").html(htmltext);
            }
        }
    }
});
</script>