<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package _jbs
 */
?>
			</div><!-- close .*-inner (main-content or sidebar, depending if sidebar is used) -->
		</div><!-- close .row -->
	</div><!-- close .container -->
</div><!-- close .main-content -->

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="container">
		<div class="row">
			<div class="site-footer-inner col-sm-12">
			
				<div class="site-info">
					<?php do_action( '_jbs_credits' ); ?>
					<?php printf( __( '&copy; %1$s by %2$s', '_jbs' ), date('Y'), esc_attr( get_bloginfo( 'name', 'display' ) ) ); ?>
					<span class="sep"> | </span>
					<?php printf( __( 'Theme: %1$s by %2$s.', '_jbs' ), '_jbs', '<a href="http://www.jeffbrockstudio.com/" rel="designer">Jeff Brock Studio</a>' ); ?>
				</div><!-- close .site-info -->
			
			</div>	
		</div>
	</div><!-- close .container -->
</footer><!-- close #colophon -->

<?php wp_footer(); ?>

</body>
</html>