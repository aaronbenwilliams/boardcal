<?php

/**
 * Social  Widget
 * boardcal Theme
 */
class boardcal_social_widget extends WP_Widget
{
	 function boardcal_social_widget(){

        $widget_ops = array('classname' => 'boardcal-social','description' => esc_html__( "boardcal theme widget to display social media icons" ,'boardcal') );
		    parent::__construct('boardcal-social', esc_html__('boardcal Social Widget','boardcal'), $widget_ops);
    }

    function widget($args , $instance) {
    	extract($args);
        $title = isset($instance['title']) ? $instance['title'] : esc_html__('Follow us' , 'boardcal');

      echo $before_widget;
      echo $before_title;
      echo $title;
      echo $after_title;

    /**
     * Widget Content
     */
    ?>

    <!-- social icons -->
    <div class="social-icons sticky-sidebar-social">


    <?php boardcal_social_icons(); ?>


    </div><!-- end social icons -->


		<?php

		echo $after_widget;
    }


    function form($instance) {
      if(!isset($instance['title'])) $instance['title'] = esc_html__('Follow us' , 'boardcal');
    ?>

      <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title ','boardcal') ?></label>

      <input type="text" value="<?php echo esc_attr($instance['title']); ?>"
                          name="<?php echo $this->get_field_name('title'); ?>"
                          id="<?php $this->get_field_id('title'); ?>"
                          class="widefat" />
      </p>

    	<?php
    }

}

?>
