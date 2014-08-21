<?php get_header(); ?>

<!-- start content container -->
<div id="content">
    <div class="row">
    <?php //get_template_part('template-part', 'search'); ?>
        <div class="main-content">
            <!-- the loop -->
            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div <?php post_class(); ?>>
                    <?php if ($_SERVER['HTTP_REFERER']) { ?>
                        <p class='search-return'><a href='javascript:history.go(-1)'><< Return to Search Results</a></p>
                    <?php } ?>
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
                        <div class="course-contact">
                            <h3>Contact:</h3>
                            <?php $contact = get_field('contact'); ?>
                            <p><?php echo get_field('contact_fname',$contact[0]->ID)." ".get_field('contact_lname',$contact[0]->ID); ?></p>
                            <p><?php echo get_field('email',$contact[0]->ID); ?></p>
                            <p><?php echo get_field('phone_number',$contact[0]->ID); ?></p>
                        </div>
                        <div class="course-location">
                            <?php
                            //map stuff
                            $location = get_field('map_location');
                            if ($location) {
                                $place = get_field('map_location', $location[0]->ID);
                                ?>
                                <h3> Location: </h3>
                                <?php
                                echo "<p>".$place['address']."</p>";
                                echo "<p><img src='http://maps.googleapis.com/maps/api/staticmap?markers=".$place['lat'].",".$place['lng']."&zoom=13&size=375x375&sensor=false' alt='map location'></p>";
                            } ?>
                        </div>
                    </div>
                    <div class="course-details">
                        <?php if (get_field('start_date')){ ?>
                            <?php if (get_field('end_date') > get_field('start_date')){ ?>
                            <p><i class="fa fa-calendar"></i> <?php echo date('M d, y',strtotime(get_field('start_date')))." - ".date('M d, y',strtotime(get_field('end_date'))); ?></p>
                            <?php } else { ?>
                                <p><i class="fa fa-calendar"></i> <?php echo date('M d, Y',strtotime(get_field('start_date'))); ?></p>
                            <?php } ?>
                        <?php } else { ?>
                            <p><i class="fa fa-calendar"></i> Anytime</p>
                        <?php } ?>
                            <p><i class="fa fa-road"></i>
                            <?php if (is_array(get_field('delivery_method'))) {
                                array_walk(get_field('delivery_method'),'walk_delivery_method');
                            } else {
                                echo get_field('delivery_method');
                            }
                            ?></p>
                            <?php if (get_field("accredited")=="Yes") { ?>
                                <p><i class="fa fa-check"></i> IFMA Accredited</p>
                            <?php } else { ?>
                                <p><i class="fa fa-ban"></i> IFMA Accredited</p>
                            <?php }

                                  if (get_field("college_accredited")=="Yes") { ?>
                                <p><i class="fa fa-check"></i> College Accredited</p>
                            <?php } else { ?>
                                <p><i class="fa fa-ban"></i> College Accredited</p>
                            <?php } ?>

                            <p><i class="fa fa-globe"></i> <a href="<?php echo get_field("website_url"); ?>">Website</a></p>
                                       </div>

                            <div class="col-lg-8 course-info">

                            <?php    if (get_field("provided_by") { ?>
                                <p>Provided By: <?php echo get_field("provided_by"); ?></p>
                                <?php } ?>

                                <?php $instructor = get_field('instructor');
                                    if ($instructor) {
                                        $name = get_field('first_name',$instructor[0])." ".get_field('last_name',$instructor[0]);?>
                                    <p>Instructor: <?php echo $name; ?></p>
                                    <?php } ?>

                                <?php if (get_field('level')) { ?>

                                    <p>Course Level: <?php echo get_field("level"); ?></p>

                                <?php }?>

                                <?php if (get_field('college_credits')) { ?>
                                    <p>College Credit Hours: <?php echo get_field('college_credits') ?></p>
                                <?php } ?>
                                <?php if (get_field('number_of_ceu')) { ?>
                                    <p>Number of CEU: <?php echo get_field('number_of_ceu'); ?>  </p>
                                <?php } ?>
                                <?php if (get_field("registration_url") != ""){ ?>
                                <p><a class="btn btn-action pull-right" href="<?php echo get_field('registration_url'); ?>">Register Now</a></p>
                                <?php } ?>

                            </div>

                            <div class=" col-lg-8 course-content">

                            <h3>Course Description/Syllabus</h3>

                            <?php the_content();
                            if(get_field("registration_url") != ""){
                                ?>
                            <a class="btn btn-action pull-right" href="<?php echo get_field('registration_url'); ?>">Register Now</a>
                        <?php }?>
                            </div>


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
