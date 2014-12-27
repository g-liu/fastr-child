<?php
/**
 * The template for displaying search forms in fastr
 *
 * @package fastr
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'fastr' ); ?></span>
	<div class="input-group">
		<input type="search" class="search-field collapsed" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'fastr' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
		<input type="submit" class="search-submit" value="&#xf002;" />
	</div>
</form>
