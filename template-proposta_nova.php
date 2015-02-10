<?php
/**
 * Template Name: Proposta Nova
 * Generated with Aina. Version 0.4.0
 */

get_header(); ?>

  <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

      <?php $validations = array( 'full_name', 'email' ); ?>
      <?php foreach( $validations as $validation ): ?>
        <?php if ( is_flash( $validation . '-error' ) ): ?>
          <div class="form-error">
            <?php the_flash( $validation . '-error' ); ?>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>

      <?php if ( is_flash( 'yeah' ) ): ?>
        <div class="form-yeah">
          <?php the_flash( 'yeah' ); ?>
        </div>
      <?php else: ?>

        <?php
          aina_accept_form_for('proposta', array(
            'tax' => array(
              'name' => 'propostacategories',
              'parent_id' => 7
            ),
          ));
        ?>

      <?php endif; ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_footer(); ?>

