<?php
/**
 * The sidebar containing the main widget area
 *
 * @package _jbs
 */
?>
	
	</div><!-- close .main-content-inner -->
	
	<div class="sidebar col-sm-12 col-md-4">

		<?php // add the class "panel" below here to wrap the sidebar in Bootstrap style ;) ?>
		<div class="sidebar-padder">

			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
	
				<aside id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</aside>
	
				<aside id="archives" class="widget widget_archive">
					<h3 class="widget-title"><?php _e( 'Archives', '_jbs' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>
		
			<?php endif; ?>
			
		</div><!-- close .sidebar-padder -->
