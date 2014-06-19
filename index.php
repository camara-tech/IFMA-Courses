<?php get_header(); ?>
<div id="content">
    <div class="row">
      <?php get_template_part('templates/template-part', 'search'); ?>
      <div class="main-content col-lg-8 col-md-8 col-sm-8">
      <?php get_template_part('templates/template','sort'); ?>
      <?php // theloop
      if ( have_posts() ) : while ( have_posts() ) : the_post();
        ?>
        <div <?php post_class(); ?>>

            <article class="container course-list">
                            <h2 class="course-title">
                                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'IFMA-Courses' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                            </h2>
                            <div class="course-details">
                            <?php if (get_field('start_date') != null) { ?>
                            <p><i class="fa fa-calendar"></i> <?php echo date('M d, Y',strtotime(get_field('start_date'))); ?></p>
                            <?php } else { ?>
                            <p><i class="fa fa-calendar"></i> Anytime </p>
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


                            <p><i class="fa fa-globe"></i> <a href="<?php get_field("website"); ?>">Website</a></p>
                            </div>
                            <?php the_excerpt(); ?>

                            <a href="<?php echo get_permalink(); ?>" class="btn btn-default pull-right"> Read More...</a>
                            </article>
                            <?php wp_link_pages(); ?>
                            <?php get_template_part('template-part', 'postmeta'); ?>
                            <?php  if ( comments_open() ) : ?>
                                   <div class="clear"></div>
                                  <p class="text-right">
                                      <a class="btn btn-success" href="<?php the_permalink(); ?>#comments"><?php comments_number(__('Leave a Comment','devdmbootstrap3'), __('One Comment','devdmbootstrap3'), '%' . __(' Comments','devdmbootstrap3') );?> <span class="glyphicon glyphicon-comment"></span></a>
                                  </p>
                            <?php endif; ?>
                       </div>

                <?php endwhile; ?>
                <?php posts_nav_link(); ?>
                <?php else: ?>

                    <?php get_404_template(); ?>

            <?php endif; ?>
</div>

    </div>
</div>
</div>
</div>
<?php get_footer(); ?>
