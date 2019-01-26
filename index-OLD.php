<?php 
  get_header(); 
  $args = array( 'post_type' => 'post', 'order' => 'DESC' );
  $cat1Args = array( 'order' => 'DESC', 'category__and' => 190 );
  $cat2Args = array( 'order' => 'DESC', 'category__and' => 193 );
  $primaryID = '';
  $secondaryID = '';
  $currentMixedIndex = 0;
  $maxMixedPosts = 5;
  $mixedPostsCounter = 1;
?>
			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

              <div id="posts-loop-wrapper">

                <div class="featured-container m-all t-3of3 d-all"><!-- START PRIMARY -->
                  <?php
                    $post_query = new WP_Query($args);
                      if($post_query->have_posts() ) {
                        while($post_query->have_posts() ) {
                          $post_query->the_post();
                          $id = get_the_ID();
                          $link = get_permalink($id);
                          $categoryString = get_the_category();
                          $post_thumbnail_id = get_post_thumbnail_id();
                          $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                          $field = get_field_object('featured_post_type');
                          $value = $field['value'];
                          if($value == 'Primary (Top of Blog page)' && $primaryID == '') {
                            $primaryID = $id;
                  ?>
                        <div class="primary-featured-img">
                          <img title="image title" alt="thumb image" class="wp-post-image" src="<?php echo $post_thumbnail_url; ?>" style="width:100%; height:auto;">
                        </div>
                        <div class="post-meta">
                          <h3><?php the_category(); ?></h3>
                          <h1><?php the_title(); ?></h1>
                          <div class="reading-time">
                            <?php 
                              global $readingTimeWP;
                              $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') ); 
                            ?>
                            <span><?php echo $reading_time; ?> Minutes</span>
                          </div>
                          <a href="<?php echo $link; ?>" class="read-link">Read</a>
                        </div>
                    <?php
                      }
                    }
                  }
                  ?>
                </div><!-- END PRIMARY -->


                <div class="mixed-container m-all t-3of3 d-3of4"><!-- START MIXED -->
                    <?php
                      $post_query = new WP_Query($args);
                        if($post_query->have_posts() ) {
                          while($post_query->have_posts() ) {
                            $post_query->the_post();
                            $id = get_the_ID();
                            $link = get_permalink($id);
                            $rowClass = '';
                            $containerClass = '';
                            $categoryArray = get_the_category();
                            $firstCategory = $categoryArray[0]->cat_name;
                            $catNameString = '';
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                            switch ($firstCategory) {
                              case 'Technology & News':
                                  $catNameString = 'tech-news';
                                  break;
                              case 'Product':
                                  $catNameString = 'product';
                                  break;
                              case 'Marketing':
                                  $catNameString = 'marketing';
                                  break;
                              case 'Event Management':
                                  $catNameString = 'event-management';
                                  break;
                              case 'Event ROI':
                                  $catNameString = 'event-roi';
                                  break;
                              default:
                                  $catNameString = 'tech-news';
                            }
                            if($primaryID !== $id) {
                              if($currentMixedIndex < 5 ) {
                              // if($secondaryID !== $id) {

                                if($currentMixedIndex == 0 || $currentMixedIndex == 1) {
                                  $containerClass = 'm-all t-3of3 d-1of2';
                                  $rowClass = 'first-row';
                                } else {
                                  $containerClass = 'm-all t-3of3 d-1of3';
                                  $rowClass = 'second-row';
                                }

                      ?>
                            <div class="mixed-post <?php echo $containerClass; ?>"> <!-- START COMPONENT -->
                              <div class="content-wrapper <?php echo $rowClass; ?> <?php echo $catNameString; ?>"> <!-- START WRAPPER -->
                                <div class="primary-featured-img">
                                  <img title="image title" alt="thumb image" class="wp-post-image" src="<?php echo $post_thumbnail_url; ?>" style="width:100%; height:auto;">
                                </div>
                                <div class="post-meta">
                                  <div class="shadow-wrapper">
                                    <div class="shadow"></div>
                                  </div>
                                  <h3><?php the_category(); ?></h3>
                                  <a href="<?php echo $link; ?>"><?php the_title(); ?></a>
                                  <hr/>
                                  <div class="info-wrapper">
                                    <div class="reading-time">
                                      <?php 
                                        global $readingTimeWP;
                                        $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') ); 
                                      ?>
                                      <span><?php echo $reading_time; ?> Minutes</span>
                                    </div>
                                    <span class="bullet">•</span>
                                    <div class="time-since">
                                      <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
                                    </div> 
                                    
                                    <span class="sm-cat-label"><?php echo $firstCategory ?></span>
                                  </div>
                                  
                                </div>
                              </div><!-- END WRAPPER -->
                            </div><!-- END COMPONENT -->

                        <?php
                          $currentMixedIndex++;
                              // }
                              }
                            }
                          }
                        }   
                    ?>
               </div><!-- END MIXED -->

               <div class="mixed-sidbar d-1of4"><!-- START SIDEBAR -->
                  <?php get_sidebar(); ?>
               </div><!-- END SIDEBAR -->
              
              

                <div class="featured-container m-all t-3of3 d-all"><!-- START SECONDARY -->
                    <?php
                      $post_query = new WP_Query($args);
                        if($post_query->have_posts() ) {
                          while($post_query->have_posts() ) {
                            $post_query->the_post();
                            $id = get_the_ID();
                            $categoryString = get_the_category();
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                            $categoryArray = get_the_category();
                            $firstCategory = $categoryArray[0]->cat_name;
                            $catNameString = '';
                            $field = get_field_object('featured_post_type');
                            $value = $field['value'];
                            if($value == 'Secondary (After initial post feed)' && $secondaryID == '') {
                              $secondaryID = $id;
                    ?>

                            <div class="primary-featured-img">
                              <img title="image title" alt="thumb image" class="wp-post-image" src="<?php echo $post_thumbnail_url; ?>" style="width:100%; height:auto;">
                            </div>
                            <div class="post-meta">
                              <h3><?php the_category(); ?></h3>
                              <h1><?php the_title(); ?></h1>
                              <hr/>
                              <div class="reading-time">
                                <?php 
                                  global $readingTimeWP;
                                  $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') ); 
                                ?>
                                <span><?php echo $reading_time; ?> Minutes</span>
                              </div>
                            </div>


                      <?php
                              }
                            }
                          }   
                      ?>

                  
               </div><!-- END SECONDARY -->


               <div class="single-cat-container m-all t-3of3 d-all"><!-- START CATEGORY 1 -->
               <div class="category-name-bar m-all t-all d-all event-management">Event Management</div>
                <?php
                      $post_query = new WP_Query($cat1Args);
                        if($post_query->have_posts() ) {
                          while($post_query->have_posts() ) {
                            $post_query->the_post();
                            $id = get_the_ID();
                            $containerClass = '';
                            $categoryString = get_the_category();
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                            switch ($firstCategory) {
                              case 'Technology & News':
                                  $catNameString = 'tech-news';
                                  break;
                              case 'Product':
                                  $catNameString = 'product';
                                  break;
                              case 'Marketing':
                                  $catNameString = 'marketing';
                                  break;
                              case 'Event Management':
                                  $catNameString = 'event-management';
                                  break;
                              case 'Event ROI':
                                  $catNameString = 'event-roi';
                                  break;
                              default:
                                  $catNameString = 'tech-news';
                            }

                      ?>
                            
                            <div class="single-cat-post m-all t-all d-1of4">
                              <div class="wrapper">
                                <div class="single-post-featured-img" style="background-image: url('<?php echo $post_thumbnail_url; ?>');"></div>
                                <div class="post-meta">
                                  <h3><?php the_category(); ?></h3>
                                  <h1><?php the_title(); ?></h1>
                                  <div class="reading-time">
                                    <?php 
                                      global $readingTimeWP;
                                      $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') ); 
                                    ?>
                                    <span><?php echo $reading_time; ?> Minutes</span>
                                  </div>
                                </div>
                              </div>
                            </div>

                        <?php

                          }
                        }   
                    ?>
               </div><!-- END CATEGORY 1 -->

               



            </div><!-- END WRAPPER -->


						</main>

				</div>

			</div>


<?php get_footer(); ?>
