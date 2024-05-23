<?php
/*
Template Name: news detail
*/
 get_header(); 
?>
<section class="xl_container cast_mv">
    <picture>
        <source media="(max-width: 768px)" srcset="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg_sp.png">
        <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg.png" alt="mv">
    </picture>
    <div class="absolute">
        <p>ニュース</p>
    </div>
</section>

<div class="flex justify-between navigation">
    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a> ニュース</p>
    <p></p>
</div>

<section class="xl_container terms_services"></section>

<?php get_footer(); ?>

<script>
var news_id = <?php
if(empty($_GET["news_id"])) {
    echo 1;
}
else {
    echo $_GET["news_id"];
}
?>; 

$.ajax({
    url: "<?php echo esc_url( home_url( '/news_get_api' ) ); ?>", 
    type: "POST",
    data: {
        news_id: news_id
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'])  {
            var news = data['data'];
            var htmltext = "";
            htmltext += '<picture>'
            + '    <img src="' + (news["n_image"] ? news["n_image"] : "<?=get_home_url();?>/wp-content/themes/theTop/image/IMG_5166.JPG") + '" alt="img">'
            + '</picture>'
            + '<ul>'
            + '  <li>'
            + ' <p>' + news["n_content"] + '</p>'
            + ' </li>'
            + '</ul>';
            $("section.terms_services").html(htmltext);
        }
    }
});
</script>