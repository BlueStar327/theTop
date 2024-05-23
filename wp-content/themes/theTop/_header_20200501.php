<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width" />
		<meta name="theme-color" content="#f39800">
		<!--<link rel="stylesheet" href="<?=get_home_url();?>/wp-content/themes/yasuda/template/animation.css"> -->
		<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/template/animation.css">
		<script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
		<?php wp_head(); ?>
		<script> 
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){ 
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), 
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m) 
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga'); 

		  ga('create', 'UA-73700821-2', 'auto'); 
		  ga('send', 'pageview'); 

		</script>
	</head>
	
	<?php if ( is_home() || is_front_page() ) : ?>
	<!--<body  id="topbody" <?php body_class(); ?>>-->
	<body <?php body_class(); ?>>
	<!---10.20---->
		<div id='overlay' style='position:fixed;display:block;width:100%;height:100%;top:0;left:0;background-color:rgb(0,0,0);z-index: 99999;cursor: pointer;'></div>
	<!---end--->
	<?php else: ?>
	<body <?php body_class(); ?>>
	<?php endif; ?>
	
		<?php if ( is_home() || is_front_page() ) : ?>
		<!--<div class="pctopmovie">
			<video src="<?=get_home_url();?>/wp-content/themes/yasuda/video/yasuda_intro_movie_PC.mp4" preload="none" autoplay loop muted playsinline></video>
		</div>
		<div class="sptopmovie">
			<video src="<?=get_home_url();?>/wp-content/themes/yasuda/video/yasuda_intro_movie_SP.mp4" preload="none" autoplay loop muted playsinline></video>
		</div>-->
		<?php else: ?>
		<?php endif; ?>
		
		<?php if ( is_home() || is_front_page() ) : ?>
			<div id="wrapper" class="hfeed">
		<?php else: ?>
			<div id="wrapper" class="hfeed2">
		<?php endif; ?>
		
			<header id="header">
				<div id="branding">
					<div id="site-title">
						<?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '<h1>'; } ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" rel="home"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
						<?php if ( is_front_page() || is_home() || is_front_page() && is_home() ) { echo '</h1>'; } ?>
					</div>
					<div id="site-description"><?php bloginfo( 'description' ); ?></div>
				</div>
				<?php if ( is_home() || is_front_page() ) : ?>
				<div class="tpsite_movie">
					<!--<div class="tp_header_mainimg_backblackfade"></div>
					<div class="tp_header_mainimg">
						<div class="tp_header_imgcenter">
							<div class="tp_header_img">
								<img src="<?=get_home_url();?>/wp-content/themes/yasuda/img/02.png">
								<h2>未来へ駆ける<span></span><br/>YASUDAYA</h2>  
								<p>サンプルテキスサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストサンプルテキストト</p>
								<!--<p class="tp_header_img_more"><a href="/">MORE</a></p>-->
							<!--</div>
						</div>
					</div>-->
					<div class="tp_header_video">
						<!-- <video src="<?=get_home_url();?>/wp-content/themes/yasuda/video/yasuda_main.mp4" preload="none" autoplay loop muted playsinline></video> -->
						<video src="<?=get_home_url();?>/wp-content/themes/yasuda/video/yasuda_main.mp4" preload="none" autoplay loop muted playsinline></video>
					</div>
					<div class="bg_loop1" id="loop_animation_css"></div>
				</div>
				<?php else: ?>
				<?php endif; ?>
				<div class="site_header">
				
					<?php if ( is_home() || is_front_page() ) : ?>
					<div class="site_headertoppage">
					<?php else: ?>
					<div class="site_headerlowpage">
					<?php endif; ?>
					
						<div class="site_header_flex">
							<div class="site_header_flex_content">
								<div class="site_header_tittle">
									<!-- <a href="<?=get_home_url();?>"><img src="<?=get_home_url();?>/wp-content/themes/yasuda/img/01.png"></a> -->
									<a href="<?=get_home_url();?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg"></a>
								</div>
								<div class="site_header_menu">
									<!--PCMENU-->
									<nav id="menu" role="navigation" class="menu">
										<div class="main-menu">
											<ul id="menu_id" class="menu_class">
												<li><a href="<?=get_home_url();?>/">ホーム</a></li>
												<li>
													<a href="<?=get_home_url();?>/topics/">お知らせ</a>
												</li>
												<li>
													<a href="<?=get_home_url();?>/company/">会社情報</a>
													<ul class="site_header_submenu_flex">
														<li>
															<a href="<?=get_home_url();?>/company/greeting/">代表挨拶</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/company/profile/">企業情報</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/company/history/">安田屋の歴史</a>
														</li>
													</ul>
												</li>
												<li>
													<a href="<?=get_home_url();?>/store/">店舗情報</a>
													<ul class="site_header_submenu_flex">
														<li>
															<a href="<?=get_home_url();?>/store/tokyo/">東京都</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/store/saitama/">埼玉県</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/store/chiba/">千葉県</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/store/kanagawa/">神奈川県</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/store/gunma/">群馬県</a>
														</li>
													</ul>
												</li>
												<li>
													<a href="<?=get_home_url();?>/csr/">CSR情報</a>
													<ul class="site_header_submenu_flex">
														<li>
															<a href="<?=get_home_url();?>/csr/eco/">環境対策活動</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/csr/social/">社会貢献活動</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/csr/csr_activity">具体的事例</a>
														</li>
													</ul>
												</li>
												<li><a href="<?=get_home_url();?>/article/">物件情報募集</a></li>
												<li>
													<a target="_blank" href="/saiyo/">採用情報</a>
												</li>
												<li>
													<a href="<?=get_home_url();?>/contact/">お問い合わせ</a>
												</li>
											</ul>
										</div>
									</nav>
									<!--PCMENUEND-->
									<!-- sp menu-->
									
									<nav class="mobile-menu">
										<input type="checkbox" id="checkbox" class="mobile-menu__checkbox">
										<label for="checkbox" class="mobile-menu__btn"><div class="mobile-menu__icon"><p>MENU</p></div></label>
										<div class="mobile-menu__container">
											<ul class="mobile-menu__list">
												<li><a href="<?=get_home_url();?>/">ホーム</a></li>
												<li>
													<a href="<?=get_home_url();?>/topics/">お知らせ</a>
												</li>
												<li>
													<a href="<?=get_home_url();?>/company/">会社情報</a>
													<ul class="sp_site_header_submenu_flex">
														<li>
															<a href="<?=get_home_url();?>/company/greeting/">代表挨拶</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/company/profile/">企業情報</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/company/history/">安田屋の歴史</a>
														</li>
													</ul>
												</li>
												<li>
													<a href="<?=get_home_url();?>/store/">店舗情報</a>
													<ul class="sp_site_header_submenu_flex">
														<li>
															<a href="<?=get_home_url();?>/store/tokyo/">東京</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/store/saitama/">埼玉</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/store/chiba/">千葉</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/store/kanagawa/">神奈川</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/store/gunma/">群馬</a>
														</li>
													</ul>
												</li>
												<li>
													<a href="<?=get_home_url();?>/csr/">CSR情報</a>
													<ul class="sp_site_header_submenu_flex">
														<li>
															<a href="<?=get_home_url();?>/csr/eco/">環境対策</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/csr/social/">社会貢献</a>
														</li>
														<li>
															<a href="<?=get_home_url();?>/csr/csr_activity">具体的事例</a>
														</li>

													</ul>
												</li>
												<li>
													<a target="_blank" href="/saiyo/">採用情報</a>
												</li>
												<li>
													<a href="<?=get_home_url();?>/contact/">お問い合わせ</a>
												</li>
												<!--
												<ul class="sp_site_header_submenu_flex_bottan">
													<li><a target="_blank" href="/saiyo/rec_wp/">採用情報</a></li>
													<li><a href="<?=get_home_url();?>/contact/">お問い合わせ</a></li>
												</ul>
												-->
											</ul>
										</div>
									</nav>
									<!-- sp menu end -->
									<!--<div class="site_header_menu_pcorange">
										<div class="site_header_menu_pcorange_con">
											<a href="/saiyo/rec_wp" target="_blank">採用情報</a>
										</div>
										<div class="site_header_menu_pcorange_con">
											<a href="<?=get_home_url();?>/contact">お問い合わせ</a>
										</div>
									</div>-->
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<div id="container">