<?php 
  get_header(); 
  $args = array( 'post_type' => 'post', 'order' => 'DESC' );
  $cat1Args = array( 'order' => 'DESC', 'posts_per_page' => '5', 'category__and' => 190 );
  $cat2Args = array( 'order' => 'DESC', 'posts_per_page' => '5', 'category__and' => 191 );
  $cat3Args = array( 'order' => 'DESC', 'posts_per_page' => '5', 'category__and' => 192 );
  $cat4Args = array( 'order' => 'DESC', 'posts_per_page' => '5', 'category__and' => 193 );
  $cat5Args = array( 'order' => 'DESC', 'posts_per_page' => '5', 'category__and' => 194 );
  $primaryID = '';
  $secondaryID = '';
  $currentMixedIndex = 0;
  $maxCategoryPosts = 4;
  $mixedPostsCounter = 1;
?>
			<div id="content">

				<div id="inner-content" class="wrap cf">

						<main id="main" class="cf blog" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

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
                          $categoryArray = get_the_category();
                          $firstCategory = $categoryArray[0]->cat_name;
                          $catNameString = '';
                          $post_thumbnail_id = get_post_thumbnail_id();
                          $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                          $field = get_field_object('featured_post_type');
                          $value = $field['value'];
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
                          if($value == 'Primary (Top of Blog page)' && $primaryID == '') {
                            $primaryID = $id;
                  ?>
                        <div class="primary-featured-img <?php echo $catNameString; ?>">
                          <img title="image title" alt="thumb image" class="wp-post-image" src="<?php echo $post_thumbnail_url; ?>" style="width:100%; height:auto;">
                        </div>
                        <div class="post-meta">
                          <div class="category"><?php echo $catNameString; ?></div>
                          <h2><?php the_title(); ?></h2>
                          <div class="reading-time">
                            <?php 
                              global $readingTimeWP;
                              $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') ); 
                            ?>
                            <span class="clock"></span> <span><?php echo $reading_time; ?> Mins</span>
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
                            $post_date = get_the_date( 'l F j, Y' );
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
                              if($currentMixedIndex < 4 ) {
                              // if($secondaryID !== $id) {

                                if($currentMixedIndex == 0 || $currentMixedIndex == 1) {
                                  $containerClass = 'm-all t-3of3 d-1of2';
                                  $rowClass = 'first-row';
                                } else {
                                  $containerClass = 'm-all t-3of3 d-1of2';
                                  $rowClass = 'second-row';
                                }

                      ?>
                            <div class="mixed-post <?php echo $containerClass; ?>" data-link="<?php echo $link; ?>"> <!-- START COMPONENT -->
                              <div class="content-wrapper <?php echo $rowClass; ?> <?php echo $catNameString; ?>"> <!-- START WRAPPER -->
                                <div class="primary-featured-img">
                                  <img title="image title" alt="thumb image" class="wp-post-image" src="<?php echo $post_thumbnail_url; ?>" style="width:100%; height:auto;">
                                </div>

                                <div class="title-date">
                                  <div class="title"><a href="<?php echo $link; ?>"><?php the_title(); ?></a></div>
                                  <div class="date"><?php echo $post_date; ?></div>
                                </div>
                                <div class="time-category">
                                  <div class="reading-time">
                                      <?php 
                                        global $readingTimeWP;
                                        $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') ); 
                                      ?>
                                      <span class="clock"></span> <span class="minutes"><?php echo $reading_time; ?> MINS</span>
                                    </div>
                                  <div class="category"><?php the_category(); ?></div>
                                </div>
                                <div class="cover-all"></div>
                                <div class="post-meta"></div>

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
                  <?php // get_sidebar(); ?>
                  <h2>STAY ON TOP OF EVENT NEWS, TECHNOLOGY & LEARN HOW TO GET THE MOST OUT OF YOUR EVENTS.</h2>
                  <?php echo do_shortcode("[wpforms id='4240']"); ?>
               </div><!-- END SIDEBAR -->
              
              

                <div class="featured-container m-all t-3of3 d-all"><!-- START SECONDARY -->
                    <?php
                      $post_query = new WP_Query($args);
                        if($post_query->have_posts()) {
                          while($post_query->have_posts() ) {
                            $post_query->the_post();
                            $id = get_the_ID();
                            $link = get_permalink($id);
                            $categoryString = get_the_category();
                            $categoryArray = get_the_category();
                            $firstCategory = $categoryArray[0]->cat_name;
                            $catNameString = '';
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                            $field = get_field_object('featured_post_type');
                            $value = $field['value'];
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
                            if($value == 'Secondary (After initial post feed)' && $secondaryID == '') {
                              $secondaryID = $id;
                    ?>

                            <div class="primary-featured-img <?php echo $catNameString; ?>">
                          <img title="image title" alt="thumb image" class="wp-post-image" src="<?php echo $post_thumbnail_url; ?>" style="width:100%; height:auto;">
                        </div>
                        <div class="post-meta">
                          <div class="category"><?php echo $catNameString; ?></div>
                          <h2><?php the_title(); ?></h2>
                          <div class="reading-time">
                            <?php 
                              global $readingTimeWP;
                              $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') ); 
                            ?>
                            <span class="clock"></span> <span><?php echo $reading_time; ?> Mins</span>
                          </div>
                          <a href="<?php echo $link; ?>" class="read-link">Read</a>
                        </div>


                      <?php
                              }
                            }
                          }   
                      ?>

                  
               </div><!-- END SECONDARY -->


               <div id="event-management" class="single-cat-container m-all t-3of3 d-all"><!-- START CATEGORY 1 -->
               <div class="category-name-bar m-all t-all d-all event-management">Event Management</div>
                <?php
                      $post_query = new WP_Query($cat1Args);
                        if($post_query->have_posts() || $counter < $maxCategoryPosts ) {
                          while($post_query->have_posts() ) {
                            $post_query->the_post();
                            $id = get_the_ID();
                            $link = get_permalink($id);
                            $containerClass = '';
                            $categoryString = get_the_category();
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                            $categoryArray = get_the_category();
                            $firstCategory = $categoryArray[0]->cat_name;
                            $catNameString = '';
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
                            
                            <div class="single-cat-post m-all t-all d-1of4" data-link="<?php echo $link; ?>">
                              <div class="wrapper">
                                <div class="cover-all <?php echo $catNameString; ?>"></div>
                                <div class="single-post-featured-img" style="background-image: url('<?php echo $post_thumbnail_url; ?>');"></div>
                                <div class="time">
                                    <?php 
                                      global $readingTimeWP;
                                      $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') ); 
                                    ?>
                                    <span class="clock"></span> <span><?php echo $reading_time; ?> MINS</span>
                                </div>
                                <div class="post-meta">
                                  <h1><?php the_title(); ?></h1>
                                  <hr/>
                                  <div class="time-since">
                                    <span class="clock"></span> <span><?php echo $reading_time; ?> MINS</span> • <span><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></span>
                                  </div> 
                                </div>
                              </div>
                            </div>

                        <?php

                          }
                        }   
                    ?>
               </div><!-- END CATEGORY 1 -->

               <div id="marketing" class="single-cat-container m-all t-3of3 d-all"><!-- START CATEGORY 2 -->
               <div class="category-name-bar m-all t-all d-all marketing">Marketing</div>
                <?php
                      $post_query = new WP_Query($cat2Args);
                        if($post_query->have_posts() ) {
                          while($post_query->have_posts() ) {
                            $post_query->the_post();
                            $id = get_the_ID();
                            $link = get_permalink($id);
                            $containerClass = '';
                            $categoryString = get_the_category();
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                            $categoryArray = get_the_category();
                            $firstCategory = $categoryArray[0]->cat_name;
                            $catNameString = '';
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
                            
                            <div class="single-cat-post m-all t-all d-1of4" data-link="<?php echo $link; ?>">
                              <div class="wrapper">
                                <div class="cover-all <?php echo $catNameString; ?>"></div>
                                <div class="single-post-featured-img" style="background-image: url('<?php echo $post_thumbnail_url; ?>');"></div>
                                <div class="time">
                                    <?php 
                                      global $readingTimeWP;
                                      $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') ); 
                                    ?>
                                    <span class="clock"></span> <span><?php echo $reading_time; ?> Minutes</span>
                                </div>
                                <div class="post-meta">
                                  <h1><?php the_title(); ?></h1>
                                  <hr/>
                                  <div class="time-since">
                                    <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
                                  </div> 
                                </div>
                              </div>
                            </div>

                        <?php

                          }
                        }   
                    ?>
               </div><!-- END CATEGORY 2 -->

               <div id="event-roi" class="single-cat-container m-all t-3of3 d-all"><!-- START CATEGORY 3 -->
               <div class="category-name-bar m-all t-all d-all event-roi">Event ROI</div>
                <?php
                      $post_query = new WP_Query($cat3Args);
                        if($post_query->have_posts() ) {
                          while($post_query->have_posts() ) {
                            $post_query->the_post();
                            $id = get_the_ID();
                            $link = get_permalink($id);
                            $containerClass = '';
                            $categoryString = get_the_category();
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                            $categoryArray = get_the_category();
                            $firstCategory = $categoryArray[0]->cat_name;
                            $catNameString = '';
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
                            
                            <div class="single-cat-post m-all t-all d-1of4" data-link="<?php echo $link; ?>">
                              <div class="wrapper">
                                <div class="cover-all <?php echo $catNameString; ?>"></div>
                                <div class="single-post-featured-img" style="background-image: url('<?php echo $post_thumbnail_url; ?>');"></div>
                                <div class="time">
                                    <?php 
                                      global $readingTimeWP;
                                      $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') ); 
                                    ?>
                                    <span class="clock"></span> <span><?php echo $reading_time; ?> Minutes</span>
                                </div>
                                <div class="post-meta">
                                  <h1><?php the_title(); ?></h1>
                                  <hr/>
                                  <div class="time-since">
                                    <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
                                  </div> 
                                </div>
                              </div>
                            </div>

                        <?php

                          }
                        }   
                    ?>
               </div><!-- END CATEGORY 3 -->

               

               <div id="tech-news" class="single-cat-container m-all t-3of3 d-all"><!-- START CATEGORY 4 -->
               <div class="category-name-bar m-all t-all d-all tech-news">News & Technology</div>
                <?php
                      $post_query = new WP_Query($cat4Args);
                        if($post_query->have_posts() ) {
                          while($post_query->have_posts() ) {
                            $post_query->the_post();
                            $id = get_the_ID();
                            $link = get_permalink($id);
                            $containerClass = '';
                            $categoryString = get_the_category();
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                            $categoryArray = get_the_category();
                            $firstCategory = $categoryArray[0]->cat_name;
                            $catNameString = '';
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
                            
                            <div class="single-cat-post m-all t-all d-1of4" data-link="<?php echo $link; ?>">
                              <div class="wrapper">
                                <div class="cover-all <?php echo $catNameString; ?>"></div>
                                <div class="single-post-featured-img" style="background-image: url('<?php echo $post_thumbnail_url; ?>');"></div>
                                <div class="time">
                                    <?php 
                                      global $readingTimeWP;
                                      $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') ); 
                                    ?>
                                    <span class="clock"></span> <span><?php echo $reading_time; ?> Minutes</span>
                                </div>
                                <div class="post-meta">
                                  <h1><?php the_title(); ?></h1>
                                  <hr/>
                                  <div class="time-since">
                                    <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
                                  </div> 
                                </div>
                              </div>
                            </div>

                        <?php

                          }
                        }   
                    ?>
               </div><!-- END CATEGORY 4 -->

               <div id="product" class="single-cat-container m-all t-3of3 d-all"><!-- START CATEGORY 5 -->
               <div class="category-name-bar m-all t-all d-all product">Product</div>
                <?php
                      $post_query = new WP_Query($cat5Args);
                        if($post_query->have_posts() ) {
                          while($post_query->have_posts() ) {
                            $post_query->the_post();
                            $id = get_the_ID();
                            $link = get_permalink($id);
                            $containerClass = '';
                            $categoryString = get_the_category();
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                            $categoryArray = get_the_category();
                            $firstCategory = $categoryArray[0]->cat_name;
                            $catNameString = '';
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
                            
                            <div class="single-cat-post m-all t-all d-1of4" data-link="<?php echo $link; ?>">
                              <div class="wrapper">
                                <div class="cover-all <?php echo $catNameString; ?>"></div>
                                <div class="single-post-featured-img" style="background-image: url('<?php echo $post_thumbnail_url; ?>');"></div>
                                <div class="time">
                                    <?php 
                                      global $readingTimeWP;
                                      $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') ); 
                                    ?>
                                    <span class="clock"></span> <span><?php echo $reading_time; ?> Minutes</span>
                                </div>
                                <div class="post-meta">
                                  <h1><?php the_title(); ?></h1>
                                  <hr/>
                                  <div class="time-since">
                                    <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?>
                                  </div> 
                                </div>
                              </div>
                            </div>

                        <?php

                          }
                        }   
                    ?>
               </div><!-- END CATEGORY 5 -->


            </div><!-- END WRAPPER -->


						</main>

				</div>

			</div>


<?php get_footer(); ?>
