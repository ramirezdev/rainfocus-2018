

              <article id="post-<?php the_ID(); ?>" <?php post_class('cf'); ?> role="article" itemscope itemprop="blogPost" itemtype="http://schema.org/BlogPosting">

                <header class="article-header entry-header">
                  <?php if ( has_post_thumbnail() ):?>
                    <div class="featured-image-wrap"><?php the_post_thumbnail('full'); ?></div>
                  <?php endif; ?>
                  <?php 
                    $categoryArray = get_the_category($id);
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
                  <div class="category"><?php the_category(); ?></div>
                  <h1 class="entry-title single-title" itemprop="headline" rel="bookmark"><?php the_title(); ?></h1>
                  <div class="reading-time">
                    <?php 
                      global $readingTimeWP;
                      $id = get_the_ID();
                      $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') ); 
                    ?>
                    <span class="clock"></span> <span class="minutes"><?php echo $reading_time; ?> MINS</span>
                  </div>
                </header>
                <div class="divider-bar <?php echo $catNameString; ?>"></div>
                <section class="entry-content cf" itemprop="articleBody">
                  
                  <div class="content-wrapper m-all t-3of3 d-3of4">
                    <?php the_content(); ?>
                  </div>
                  <div class="sidebar-wrapper d-1of4">
                    <?php get_sidebar(); ?>
                  </div>
                </section> <?php // end article section ?>

                <footer class="article-footer m-all t-3of3 d-3of4">
                  
                  <div class="post-meta">
                    <?php $post_date = get_the_date( 'l F j, Y' ); ?>
                    <div class="post-date"><?php echo $post_date; ?></div> <span>|</span> 
                    <div><span>Categories:</span> <?php echo get_the_category_list(', '); ?></div> <span>|</span> 
                    <?php the_tags( '<div class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</div>' ); ?>
                  </div>
                  
                  <div class="share-wrapper"><?php echo do_shortcode("[addtoany]"); ?></div>

                  <hr/>

                </footer> <?php // end article footer ?>

              </article> <?php // end article ?>

              <?php
                global $readingTimeWP;
              ?>

              <div id="related-posts-container" class="m-all t-3of3 d-3of4">
                <h2>Related posts</h2>
                <div class="related-posts-wrapper">

                  <?php
                      $post_objects = get_field('related_post_object');
                      if( $post_objects ): ?>
                          <ul>
                          <?php foreach( $post_objects as $post): // variable must be called $post (IMPORTANT) ?>
                              <?php setup_postdata($post); ?>
                              <li>
                                  <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                  <span>Post Object Custom Field: <?php the_field('field_name'); ?></span>
                              </li>
                          <?php endforeach; ?>
                          </ul>
                          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                      <?php endif;
                    ?>

                    <?php 
                      $field = get_field_object('related_post_id_1');
                      $id = $field['value'];
                      $title = get_the_title($id);
                      $categoryArray = get_the_category($id);
                      $firstCategory = $categoryArray[0]->cat_name;
                      $catNameString = '';
                      $date = get_the_date( 'l F j, Y', $id );
                      $link = get_permalink($id);
                      $post_thumbnail_id = get_post_thumbnail_id($id);
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
                      $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') );
                      if ($id !== '') {
                    ?>
                  <div class="related-post m-all t-1of3 d-1of3"><!-- START RELATED 1 -->
                    <div class="rel-post-img-time <?php echo $catNameString; ?>" data-link="<?php echo $link; ?>">
                      <div class="cover-all"></div>
                      <div class="related-post-featured-img" style="background-image: url('<?php echo $post_thumbnail_url; ?>');"></div>
                      <div class="info">
                        <span class="clock"></span>
                        <div class="cat-time">
                          <span><?php echo $firstCategory; ?></span>
                          <span><?php echo $reading_time; ?> MINS</span>
                        </div>
                      </div>
                    </div>
                    <div class="title">
                      <h3><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h3>
                    </div>
                    <div class="date" style="color: black;">
                      <?php echo $date; ?>
                    </div>
                    
                  </div><!-- END RELATED 1 -->
                      <?php } ?>


                    <?php 
                      $field = get_field_object('related_post_id_2');
                      $id = $field['value'];
                      $title = get_the_title($id);
                      $categoryArray = get_the_category($id);
                      $firstCategory = $categoryArray[0]->cat_name;
                      $catNameString = '';
                      $date = get_the_date( 'l F j, Y', $id );
                      $link = get_permalink($id);
                      $post_thumbnail_id = get_post_thumbnail_id($id);
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
                      $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') );
                      if ($id !== '') {
                    ?>

                  <div class="related-post m-all t-1of3 d-1of3"><!-- START RELATED 2 -->
                    <div class="rel-post-img-time <?php echo $catNameString; ?>" data-link="<?php echo $link; ?>">
                      <div class="cover-all"></div>
                      <div class="related-post-featured-img" style="background-image: url('<?php echo $post_thumbnail_url; ?>');"></div>
                      <div class="info">
                        <span class="clock"></span>
                        <div class="cat-time">
                          <span><?php echo $firstCategory; ?></span>
                          <span><?php echo $reading_time; ?> MINS</span>
                        </div>
                      </div>
                    </div>
                    <div class="title">
                      <h3><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h3>
                    </div>
                    <div class="date" style="color: black;">
                      <?php echo $date; ?>
                    </div>
                    
                  </div><!-- END RELATED 2 -->
                  <?php } ?>

                  <?php 
                    $field = get_field_object('related_post_id_3');
                    $id = $field['value'];
                    $title = get_the_title($id);
                    $categoryArray = get_the_category($id);
                    $firstCategory = $categoryArray[0]->cat_name;
                    $catNameString = '';
                    $date = get_the_date( 'l F j, Y', $id );
                    $link = get_permalink($id);
                    $post_thumbnail_id = get_post_thumbnail_id($id);
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
                    $reading_time = $readingTimeWP->rt_calculate_reading_time($id, get_option('rt_reading_time_options') );
                    if ($id !== '') {
                    ?>
                  <div class="related-post m-all t-1of3 d-1of3"><!-- START RELATED 3 -->
                    <div class="rel-post-img-time <?php echo $catNameString; ?>" data-link="<?php echo $link; ?>">
                      <div class="cover-all"></div>
                      <div class="related-post-featured-img" style="background-image: url('<?php echo $post_thumbnail_url; ?>');"></div>
                      <div class="info">
                        <span class="clock"></span>
                        <div class="cat-time">
                          <span><?php echo $firstCategory; ?></span>
                          <span><?php echo $reading_time; ?> MINS</span>
                        </div>
                      </div>
                    </div>
                    <div class="title">
                      <h3><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h3>
                    </div>
                    <div class="date" style="color: black;">
                      <?php echo $date; ?>
                    </div>
                    
                  </div><!-- END RELATED 3 -->
                  <?php } ?>

                </div>
              </div>
