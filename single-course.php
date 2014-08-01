<?php get_header(); ?>

<!-- start content container -->
<div id="content">
    <div class="row">
    <?php //get_template_part('template-part', 'search'); ?>



        <div class="main-content">

        <?php // theloop
                if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <div <?php post_class(); ?>>
                          <?php if ($_SERVER['HTTP_REFERER']) {
                            echo "<p class='search-return'><a href='javascript:history.go(-1)'><< Return to Search Results</a></p>";
                          } ?>

                            <h2 class="page-header course-title"><?php the_title() ;?></h2>
                            <div class="sidebar col-lg-4">
                            <div class="course-credential center-block">
                              <?php
                              if(in_category('fmp')){
                                echo '<img src="http://cdn.ifma.org/sfcdn/education/fmp-logo_color_med836DBD92634D.jpg?sfvrsn=2" alt="FMP Logo">';
                              }
                              if(in_category('sfp')){
                                echo '<img src="http://cdn.ifma.org/sfcdn/education/sfp-logo_color_medF85909A67844.jpg?sfvrsn=2" alt="SFP Logo">';
                              }
                              if(in_category('cfm')){
                                echo '<img src="http://cdn.ifma.org/sfcdn/education/cfm-logo_color_med182CC468D797.jpg?sfvrsn=2" alt="CFM Logo">';
                              }
                               ?>
                            </div>
                            <div class="course-location">
                              <?php
                              //map stuff
                              $location = get_field('map_location');
                              if ($location) {
                                $place = get_field('map_location', $location[0]);
                                echo "<p> Address: {$place['address']} </p>";
                                echo "<img src='http://maps.googleapis.com/maps/api/staticmap?markers=".$place['lat'].",".$place['lng']."&zoom=13&size=375x375&sensor=false' alt='map location'>";
                              }
                              ?>
                            </div>
                          </div>

                            <div class="course-details">
                            <?php if (get_field('start_date')){ ?>
                            <p><i class="fa fa-calendar"></i> <?php echo date('M d, Y',strtotime(get_field('start_date'))); ?></p>
                            <?php } else { ?>
                              <p><i class="fa fa-calendar"></i> Anytime</p>
                            <?php } ?>

                            <p><i class="fa fa-road"></i> <?php if (is_array(get_field('delivery_method'))) {
                              array_walk(get_field('delivery_method'),'walk_delivery_method');
                               } else {
                                   echo get_field('delivery_method');
                               }
                               ?></p>

                            <?php if (get_field("accredited")=="Yes") { ?>
                            <p><i class="fa fa-check"></i> Accredited</p>
                            <?php } else { ?>
                            <p><i class="fa fa-ban"></i> Accredited</p>
                            <?php } ?>


                            <p><i class="fa fa-globe"></i> <a href="<?php get_field("website_url"); ?>">Website</a></p>
                                       </div>

                            <div class="col-lg-8 course-info">


                                <p>Provided By: <?php echo get_field("provided_by"); ?></p>
                                <?php $instructor = get_field('instructor');
                                    if ($instructor) {
                                        $name = get_field('first_name',$instructor[0])." ".get_field('last_name',$instructor[0]);
                                    }
                                ?>
                                <p>Instructor: <?php echo $name; ?></p>
                                <p>CEU Level: <?php echo get_field("level"); ?></p>


                            </div>

                            <div class=" col-lg-8 course-content">

                            <h3>Course Description/Syllabus</h3>

                            <?php the_content(); ?></div>

                            <?php wp_link_pages(); ?>
                            <?php get_template_part('template-part', 'postmeta'); ?>


                        </div>
                       <?php endwhile; ?>
                <?php posts_nav_link(); ?>
                <?php else: ?>

                    <?php get_404_template(); ?>

            <?php endif; ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
