<?php get_header(); ?>
<main id="content">
	<?php if ( have_posts() ) : ?>
	<?php while( have_posts() ) : the_post(); ?>
	
	<div class="low_header">
		<div class="low_header_cont">
<!--ページ用メインビジュアルのタイトル
			<div class="low_subheader_cont">
				<h1 class="low_header_cont_entittle"><?php the_field('entittle'); ?></h1>
				<h1 class="low_header_cont_jptittle"><?php the_title(); ?></h1>
			</div>
-->
		</div>
		<div class="low_header_img" style="background-image: url(<?php the_field('tittleimg'); ?>);background-size: 100% auto; background-repeat: no-repeat; background-position-y: center; background-position-x: center;"></div>
	</div>
	<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
		<?php if(function_exists('bcn_display')){bcn_display();}?>
	</div>
	
	<div class="low_main">
		<div class="low_main_content">
			<p><?php the_content(); ?></p>
		</div>
	</div>
	
	<?php endwhile;?>
	<?php endif; ?>
</main>
<?php get_footer(); ?>