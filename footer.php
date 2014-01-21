<?php
/**
 * Default Footer
 *
 */
?>

            </div><!-- /.row .content -->
        </div><!-- /.row -->


    <!-- End Template Content -->
        <footer>
        <div class="container">
              <p class="pull-right"><a href="#">Back to top</a></p>
                <p>&copy; <?php bloginfo('name'); ?> <?php the_time('Y') ?></p>
                  <?php
            if ( function_exists('dynamic_sidebar')) dynamic_sidebar("footer-content");
        ?>
            </div> <!-- /container -->
        </footer>
		<?php wp_footer(); ?>
  </body>
</html>