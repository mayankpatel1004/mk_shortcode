<?php
/**
 * Plugin Name: Mk Shortcode
 * Plugin URI: http://www.mayankpatel104.blogspot.in/
 * Description: Place this code to your required file : Place [mk_shortcode_followus] to any posts or pages and if(function_exists('fnDisplayShortcodesnew')){ fnDisplayShortcodesnew();} to any php files e.g. header.php,index.php and so on.
 * Version: 1.0
 * Author: Mayank Patel
 * Author URI: http://www.mayankpatel104.blogspot.in/
 * License: A "mk-shortcode"
 */
 
define( 'PLUGIN_HTTP_PATH' , WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__) , "" , plugin_basename(__FILE__) ) );
define( 'PLUGIN_ABSPATH' , WP_PLUGIN_DIR . '/' . str_replace(basename( __FILE__) , "" , plugin_basename(__FILE__) ) );

///Add mk_shortcodes to any posts or pages ////
add_shortcode("mk_shortcodes", "fnDisplayShortcodes");
function fnDisplayShortcodes()
{
	return "Shortcode is returned";
}

///Place this to any files if(function_exists('fnDisplayShortcodesnew')){ fnDisplayShortcodesnew();} ////
function fnDisplayShortcodesnew()
{
	echo "Shortcode is returned!!!!!!!!!!!!!!!!!";
}



//****************************************** Widget code start ********************************////
class mk_widget extends WP_Widget
{
	function __construct()
	{
		parent::__construct('mk_widget',__('MK Widget', 'mk_widget_domain'), array( 'description' => __( 'Sample Widget By Mayank Patel', 'mk_widget_description' ),));
	}

	public function widget($args,$instance)
	{
		$title = apply_filters('widget_title',$instance['title']);
		$description = apply_filters('widget_description',$instance['description']);
		$url = apply_filters('widget_url',$instance['url']);
		echo $args['before_widget'];
		if(!empty($title))
		{
			echo $args['before_title'] . $title . $args['after_title'];
		}
		if(!empty($description))
		{
			echo $description . $args['after_title'];
		}
		if(!empty($url))
		{
			echo "<br />".$url;
		}
		echo $args['after_widget'];
	}
	
	public function form($instance)
	{
		$description = "";
		$url = "";
		$title = "";
		if(isset($instance['description']))
		{
			$description = $instance['description'];
		}
		if(isset($instance['url']))
		{
			$url = $instance['url'];
		}
		if(isset($instance['title']))
		{
			$title = $instance['title'];
		}
		else
		{
			$title = __('New title','mk_widget_description');
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'Description' ); ?>"><?php _e( 'Description:' ); ?></label> 
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $description ); ?></textarea>
		</p>
	<?php 
	}
	public function update($new_instance,$old_instance)
	{
		$instance = array();
		$instance['title'] = (!empty($new_instance['title']))?strip_tags($new_instance['title']):'';
		$instance['description'] = (!empty($new_instance['description']))?strip_tags($new_instance['description']):'';
		$instance['url'] = (!empty($new_instance['url']))?strip_tags($new_instance['url']):'';
		return $instance;
	}
}

function wpb_load_widget()
{
	register_widget( 'mk_widget' );
}
add_action( 'widgets_init', 'wpb_load_widget' );
//****************************************** Widget code over ********************************////
?>