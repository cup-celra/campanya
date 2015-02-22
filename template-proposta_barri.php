<?php
/**
 * Template Name: Proposta Barri
 * Generated with Aina. Version 0.4.0
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
      
      <?php while ( have_posts() ) : the_post(); ?>
      
          <?php get_template_part( 'content', 'page' ); ?>
      
        <?php endwhile; // end of the loop. ?>

      <?php campanya_form_validations(); ?>

      <?php
        aina_accept_form_for('proposta', array(
          'tax' => array(
            'name' => 'propostacategories',
            'parent_id' => 8
          ),
        ));
      ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_footer(); ?>

