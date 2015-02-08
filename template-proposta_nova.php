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
       <div style="min-height: 500px">&nbsp;</div>
      <?php else: ?>

        <form action="" method="post" id="proposta-form">

          <?php wp_nonce_field( 'proposta-submission', 'proposta-nonce' ); ?>

          <?php echo aina_add_custom_fields('proposta');  ?>

          <?php echo wp_referer_field(); ?>

          <p>
            <?php echo campanya_text('fields_are_required'); ?>
          </p>

          <input type="submit" value="<?php echo campanya_text('submit'); ?>">

        </form>

      <?php endif; ?>

    </main><!-- #main -->
  </div><!-- #primary -->

<?php get_footer(); ?>

