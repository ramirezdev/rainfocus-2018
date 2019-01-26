<footer class="footer wrap cf" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

				<div id="inner-footer" class="">

					<?php

					$bottom_page_query = new WP_Query( 'page_id=57' );
					while ( $bottom_page_query->have_posts() ) : $bottom_page_query->the_post();
				    	the_content();
					endwhile;
					wp_reset_postdata();

					?>

				</div>

			</footer>

		</div>
		<?php // all js scripts are loaded in library/bones.php ?>
		
		<?php wp_footer(); ?>
		
	</body>

</html> <!-- end of site. what a ride! -->

