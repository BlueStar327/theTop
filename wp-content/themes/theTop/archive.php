<?php if ( get_post_type( $post ) !== 'post'): ?>
<?php get_header(); ?>
<main id="content">
<header class="header">
<h1 class="entry-title"><?php single_term_title(); ?></h1>
<div class="archive-meta"><?php if ( '' != the_archive_description() ) { echo esc_html( the_archive_description() ); } ?></div>
</header>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php endwhile; endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php else : ?>
<style type="text/css">
.low_header_img{
/*�X�g�[���[�y�[�W�@�g�b�v�摜�@�摜�T�C�Y�@2500�~900*/
/**/
background:url(<?php the_field('main-image', 7203); ?> );
background-size:cover!important;
}

.low_main {
    padding-top: 60px;
/*�X�g�[���[�y�[�W�@�w�i�摜�@�摜�T�C�Y�@2500�~3000*/
    background: url(<?php echo get_template_directory_uri() ; ?>/image/story-background_<?php echo the_time("Y"); ?>.jpg);
    background-size: 100%;
 /*   background-attachment: fixed;;*/
    margin-bottom: 0;
}


#tabs-nav li:nth-last-child(1),#tabs-nav li:nth-last-child(2),#tabs-nav li:nth-last-child(3),#tabs-nav li:nth-last-child(4),#tabs-nav li:nth-last-child(5),#tabs-nav li:nth-last-child(6),#tabs-nav li:nth-last-child(7),#tabs-nav li:nth-last-child(8),#tabs-nav li:nth-last-child(9),#tabs-nav li:nth-last-child(10){
background:#fff;
}
 


#tabs-content {
	padding: 40px 40px 0px!important;
}
.low_header_cont {
	z-index: -1;
}

.sekou_flex {
    margin: 0 auto!important;
}

#tabs-content{
background: #fff;
    border-radius: 15px;
    margin-top: 27px;
margin-bottom:35px;
    padding: 27px 3px 0;
}


@media only screen and (max-width: 1024px) {
#tabs-content {
    padding: 27px 3px 0!important;
}
}
.breadcrumbs{
display:none;
}



.tabs_main{
margin-top:0;
}


.tabs_scroll_main {
    width: 100%;
    background: #fff;
    padding: 10px 20px;
    border-radius: 15px;
}

.low_content_page4{
margin-bottom:0;
}

.sekou_flex_cont:nth-child(2n){
margin-right:0;
}

.sekou_flex_cont{
position:relative;
border-radius:8px;
width: 49%!important;
margin-right:2%;
margin-bottom:25px!important;
}
@media only screen and (max-width: 1024px) {
.sekou_flex_cont {
    width: 100%!important;
}
.sekou_flex_img {
    height: 55vw !important;
}

}

.story-post-cont{
    display: flex;
    align-items: center;
height:184px;
}

.sekou_flex_img{
width: 40%!important;
    /*width: 40%;*/
margin-right:15px;
}

.sekou_flex_cont_tittle {
    height: auto;
    overflow: hidden;
}

.story-post-right{
/*max-width:100%;*/
width: 60%!important;
}

.sekou_flex_cont_tittle a {
    font-size: 14px;
}

..sekou_flex_cont_flex_cate {
    padding: 4px 17px;
    font-size: 10px;
}
.sekou_flex_cont_more {
    text-align: right;
    font-size: 15px;
    margin-top: -20px;
    margin-bottom: 0;
}








@media only screen and (max-width: 1024px) {

.low_header {
    padding-top: 1em;
}

.low_header_img {
    height: 66vw!important;
background-size:cover!important;
    background-position: center;
}
.low_header_img {
    background-size: auto 118% !important;
}
.story-post-right{
/*max-width:100%;*/
width: 100%!important;
}

.sekou_flex_cont {
    width:100%;
}

.story-post-cont {
    display: block;
height:auto;
}

.sekou_flex_img {
    min-width: 150px;
    width: 100%!important;
    margin-right: 0;
}



}
.tabs_main {
    margin-top: 0!important;}
.low_main {
    padding-top: 60px!important;}
/*fadein*/
.fadeIn{
animation-name:fadeInAnime;
animation-duration:1s;
animation-fill-mode:forwards;
opacity:0;
}

@keyframes fadeInAnime{
  from {
    opacity: 0;
  }

  to {
    opacity: 1;
  }
}

/*delay-time*/
.delay-time10{
animation-delay: 1s;
}
.delay-time15{
animation-delay: 1.5s;
}
.sekou_flex_cont_flex_cate {
	background: rgba(254, 0, 0, 1);
width: 144px;
    padding: 4px;
}
.sekou_flex_cont_flex_cate.cate_important {
	background: rgba(254, 0, 0, 1);
width: 144px;
    padding: 4px;
}
.sekou_flex_cont.important {
    background: rgba(254, 0, 0, 0.3);
}
.sekou_flex_cont.important .sekou_flex_cont_overlay {
   background: rgba(254, 0, 0, 0.8) none repeat scroll 0% 0%;
}
.sekou_flex_cont_tittle {
    height: auto;
    overflow: hidden;
}
.sekou_flex_cont_tittle a {
    font-size: 14px!important;
}
.sekou_flex_cont_tittle {
    height: auto!important;
}

</style>

<?php get_template_part('template/date'); ?>
<?php endif; ?>
<script>
    $(function() {
  // 現在のURLを取得
  var currentUrl = location.href;

  // 各要素のhref属性を取得
  $('#tabs-nav li a').each(function() {
    var href = $(this).attr('href');

    // 現在のURLと前方一致する場合
    if (currentUrl.indexOf(href) === 0) {
      // class "active" を付与
      $(this).addClass('active');
    }
  });
});
</script>
<style>
    @media only screen and (max-width: 1024px) {

.low_header_img {
background-position: -73vw 7vw !important;
    background-size: 240% !important;
}
}
</style> 