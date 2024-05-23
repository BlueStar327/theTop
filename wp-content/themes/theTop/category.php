<?php get_header(); ?>
<main id="content">

	<div class="low_header">
		<div class="low_header_cont">
			<div class="low_subheader_cont">
				<h1 class="low_header_cont_entittle">TOPICS</h1>
				<h1 class="low_header_cont_jptittle">トピック</h1>
			</div>
		</div>
		<div class="low_header_img" style="background-image: url(<?= get_template_directory_uri(); ?>/image/01.jpg);background-size: 100% auto; background-repeat: no-repeat; background-position-y: center; background-position-x: center;"></div>
	</div>
	<div class="breadcrumbs" typeof="BreadcrumbList" vocab="http://schema.org/">
		<?php if(function_exists('bcn_display')){bcn_display();}?>
	</div>

	<div class="low_main">
		<div class="low_main_content">

			<div class="low_content_page4">

				<div class="sekou_flex">
					<!-- 繰り返し -->
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<div class="sekou_flex_cont">
						<div class="sekou_flex_img">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('full'); ?>
							</a>
						</div>
						<div class="sekou_flex_cont_flex">
							<div class="sekou_flex_cont_flex_cate">
								<?php $cat = get_the_category(); ?>
								<?php $cat = $cat[0]; ?>
								<?php echo get_cat_name($cat->term_id); ?>
							</div>
							<div class="sekou_flex_cont_flex_day">
								<?php the_time('Y.m.d'); ?>
							</div>
						</div>
						<div class="sekou_flex_cont_tittle">
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</div>
						<div class="sekou_flex_cont_text">
							<?php echo mb_substr(strip_tags($post-> post_content),0,80) . '……'; ?>
						</div>
						<div class="sekou_flex_cont_more">
							<a href="<?php the_permalink(); ?>">詳しく見る <img src="<?= get_home_url(); ?>/wp-content/uploads/2019/10/yazirusi.png"></a>
						</div>
					</div>

					<?php endwhile; endif; ?>
					<!-- 繰り返し -->
				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>