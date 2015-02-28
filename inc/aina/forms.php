<?php
/**
 * Forms
 */

function aina_accept_form_for($post_type, $options = array()) {
?>
  <form action="" method="post" id="proposta-form">

    <?php wp_nonce_field( "{$post_type}-submission", "{$post_type}-nonce" ); ?>

    <?php if ( array_key_exists('tax', $options) ): ?>
    <?php 
      $escull = "Escull un àmbit";
      if ( $options['tax']['parent_id'] == 8 ) {
        $escull = "Escull un barri";
      }
    ?>
    <label for="category"><?php echo $escull; ?> <span class="required">*</span></label>
    <select name="category" id="category">
      <option disabled selected> -- <?php echo $escull; ?> -- </option>
    <?php
    $terms = get_term_children( $options['tax']['parent_id'], $options['tax']['name'] );
    foreach($terms as $term_id) {
      $term = get_term( $term_id, $options['tax']['name'] );
      ?>
      <option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
      <?php
    }
    ?>
    </select><br />
    <?php endif; ?>
    
    <?php if ( post_type_supports($post_type, 'title') ): ?>
    <label for="post_title">Títol/Resum</label><br>
    <input type="text" id="post_title" name="post_title"><br>
    <?php endif; ?>

    <?php if ( post_type_supports($post_type, 'editor') ): ?>
    <label for="post_content">Proposta <span class="required">*</span></label><br>
    <textarea name="post_content" id="post_content" required></textarea>
    <?php endif; ?>

    <?php
      echo aina_add_custom_fields($post_type);
      echo wp_referer_field();
    ?>

    <p>
      <?php echo campanya_text('fields_are_required'); ?>
    </p>

    <input type="submit" value="<?php echo campanya_text('submit'); ?>">

  </form>
<?php
}

