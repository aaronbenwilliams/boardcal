<?php
/**
 * The template for displaying search forms in boardcal
 *
 * @package boardcal
 */
?>

<form role="search" method="get" class="form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <div class="input-group">
  	<label class="screen-reader-text" for="s"><?php _e( 'Search for:', 'boardcal' ); ?></label>
    <input type="text" class="form-control search-query" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'boardcal' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'boardcal' ); ?>" />
    <span class="input-group-btn">
      <button type="submit" class="btn btn-default" name="submit" id="searchsubmit" value="<?php echo _e( 'Search', 'boardcal' ); ?>"><?php echo esc_attr_x( 'Search', 'submit button', 'boardcal' ); ?></button>
    </span>
  </div>
</form>