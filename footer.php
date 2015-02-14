<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package campanya
 */
?>

  </div><!-- #content -->

  <footer id="colophon" class="site-footer" role="contentinfo">
    <div class="container">
      <?php campanya_social_links(); ?>
      <div class="site-info">
        <small><?php content_region('termes-i-condicions'); ?></small>
      </div><!-- .site-info -->
    </div>
  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
