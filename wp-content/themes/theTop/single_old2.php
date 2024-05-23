<?php get_header(); ?>
<main id="content">
	<?php if ( have_posts() ) : ?>
	<?php while( have_posts() ) : the_post(); ?>
	
	<!--<div class="low_header">
		<div class="low_header_cont">
			<div class="low_subheader_cont">
				<h1 class="low_header_cont_entittle"><?php the_title(); ?></h1>
			</div>
		</div>
		<div class="low_header_img" style="background: url(<?php the_post_thumbnail_url( 'full' ); ?>);background-size: 100% auto; background-repeat: no-repeat; background-position-y: center; background-position-x: center;"></div>
	</div>-->
	
	<div class="low_main">
		<?php the_content(); ?>
		<div class="breadcrumbs_low_blog" typeof="BreadcrumbList" vocab="http://schema.org/">
			<?php if(function_exists('bcn_display')){bcn_display();}?>
		</div>
	</div>
	
	<!--<div class="low_content_page3">
		<ul class="low_content_page3_menu">
			<?php if (get_previous_post()):?>
				<li><?php previous_post_link('%link',"前の記事へ",TRUE); ?></li>
			<?php endif; ?>
			<li><a href="<?= get_home_url(); ?>/topics/" style="background: #e0901d; color: #ffffff;">一覧へ</a></li>
			<?php if (get_next_post()):?>
				<li><?php next_post_link('%link',"次の記事へ",TRUE); ?></li>
			<?php endif; ?>
		</ul>
	</div>
	<br/><br/><br/>-->
	
	<?php endwhile;?>
	<?php endif; ?>
</main>
<?php get_footer(); ?>