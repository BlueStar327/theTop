<?php get_header(); ?>
<main id="content">
	<?php if ( have_posts() ) : ?>
	<?php while( have_posts() ) : the_post(); ?>
	<!--
	<div class="low_header">
		<div class="low_header_cont">
			<div class="low_subheader_cont">
				<h1 class="low_header_cont_entittle"><?php the_title(); ?></h1>
			</div>
		</div>
		<div class="low_header_img" style="background: url(<?php the_field('tittleimg'); ?>);background-size: 100% auto; background-repeat: no-repeat; background-position-y: center; background-position-x: center;"></div>
	</div>
	-->
	<br/><br/><br/><br/>
	<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
		<?php if(function_exists('bcn_display')){bcn_display();}?>
	</div>
	
	<div class="low_main">
		<div class="low_main_content">
			<!-- <div class="low_main_content_bukkennzyouhouno_flex">
				<div class="low_main_content_bukkennzyouhouno_flex_cont">
					<p><?php the_field('yakusyoku'); ?></p>
					<h2><?php the_field('name'); ?></h2>
				</div>
				<div class="low_main_content_bukkennzyouhouno_flex_img">
					<?php the_post_thumbnail('large'); ?>
				</div>
			</div> -->
			<div class="low_content_page4">
				<h4><?php the_field('name'); ?></h4>
			</div>
				<p><?php the_content(); ?></p>
		</div>
	</div>
	
	<?php endwhile;?>
	<?php endif; ?>
</main>
<?php get_footer(); ?>