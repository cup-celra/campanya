<?php
/**
 * Forms
 */

function aina_accept_form_for($post_type, $options = array()) {
?>
  <form action="" method="post" id="proposta-form">

    <?php wp_nonce_field( "{$post_type}-submission", "{$post_type}-nonce" ); ?>

    <?php if ( post_type_supports($post_type, 'title') ): ?>
    <label for="post_title">Títol</label><br>
    <input type="text" id="post_title" name="post_title"><br>
    <?php endif; ?>

    <?php if ( array_key_exists('tax', $options) ): ?>
    <label for="">Escull un àmbit</label>
    <select name="category">
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

    <?php if ( post_type_supports($post_type, 'editor') ): ?>
    <label>Proposta</label><br>
    <textarea name="post_content"></textarea>
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

