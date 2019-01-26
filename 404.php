<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="m-all t-3of3 d-7of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<section class="entry-content cf" itemprop="articleBody">
									<?php
										$page404 = new WP_Query( 'page_id=3757' );
										while ( $page404->have_posts() ) : $page404->the_post();
											the_content();
										endwhile;
										wp_reset_postdata();
									?>
								</section> <?php // end article section ?>

							</article>

						</main>

						

				</div>

			</div>

<?php get_footer(); ?>
