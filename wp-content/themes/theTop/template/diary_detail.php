<?php
/*
Template Name: diary detail
*/
 get_header(); 
?>
<section class="xl_container cast_mv">
    <picture>
        <source media="(max-width: 768px)" srcset="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg_sp.png">
        <img src="<?=get_home_url();?>/wp-content/themes/theTop/image/cast_mv_bg.png" alt="mv">
    </picture>
    <div class="absolute">
        <p>写メ日記</p>
    </div>
</section>

<div class="flex justify-between navigation">
    <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">トップ</a> 写メ日記</p>
    <p></p>
</div>

<section class="xl_container terms_services"></section>

<?php get_footer(); ?>

<script>
var diary_id = <?php
if(empty($_GET["id"])) {
    echo 1;
}
else {
    echo $_GET["id"];
}
?>; 

$.ajax({
    url: "<?php echo esc_url( home_url( '/diarys_get_api' ) ); ?>", 
    type: "POST",
    data: {
        diary_id: diary_id
    },
    success: function(res){
        var data = JSON.parse(res);
        if(data['data'])  {
            var news = data['data'];
            var htmltext = "";
            htmltext += '<h3  class="text-center">' + news["d_title"] + '</h3>'
            + '<picture>'
            + '    <img src="' + (news["d_image"] ? news["d_image"] : "<?=get_home_url();?>/wp-content/themes/theTop/image/IMG_5166.JPG") + '" alt="img">'
            + '</picture>'
            + '<ul>'
            + '  <li>'
            + ' <p>' + news["d_content"] + '</p>'
            + ' </li>'
            + '</ul>';
            $("section.terms_services").html(htmltext);
        }
    }
});
</script>