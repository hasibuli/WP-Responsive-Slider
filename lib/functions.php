<?php
function register_wprs_page() {
	add_submenu_page( 'edit.php?post_type=wp-responsive-slider', 'WPT Responsive Slider Settings', 'Slider Settings', 'manage_options', 'wprs', 'wprs_page_function' ); 
}
add_action('admin_menu', 'register_wprs_page');

function wprs_page_function() {
	
	echo '<div class="newsWrap">';
		echo '<h1>WPRS Resesponsive Slider Configurations</h1>';
?>
   <div id="nhtLeft">  
    <form method="post" action="options.php">
	<?php wp_nonce_field('update-options'); ?>
		        
		<div class="inside">
        <h3>Insert your text & background color</h3>
        <p>WP Resesponsive Slider is a fully responsive wordpress image slider plugin. "PLEASE DON'T USE VARIOUS SIZE IMAGE ON SLIDER. USE SAME SIZE IMAGE". <br />
        Just copy and paste "<strong>if(function_exists('wprs_resesponsive_slider')){wprs_post_slide_loop();}</strong> in the template code or <strong>[WPRS-SLIDER]</strong> in the post/page" where you want to display slider.</p>
        

			<table class="form-table">
				<tr>
					<th><label for="wprs_border_radius">Border Radius</label></th>
					<td><input type="text" name="wprs_border_radius" value="<?php $wprs_border_radius = get_option('wprs_border_radius'); if(!empty($wprs_border_radius)) {echo $wprs_border_radius;} else {echo "0";}?>">px;</td>
				</tr>
				<tr>
					<th><label for="wprs_border">Slider Border </label></th>
					<td><input type="text" name="wprs_border" value="<?php $wprs_border = get_option('wprs_border'); if(!empty($wprs_border)) {echo $wprs_border;} else {echo "5";}?>">px;</td>
				</tr>
				<tr>
					<th><label for="wprs_bg_color">Slider Border Color </label></th>
					<td><input type="text" name="wprs_bg_color" id="wprs_bg_color" value="<?php $wprs_bg_color = get_option('wprs_bg_color'); if(!empty($wprs_bg_color)) {echo $wprs_bg_color;} else {echo "#fff";}?>" class="color-picker nht_bg_color" /></td>
				</tr>
                <tr>
					<th><label for="wprs_pager_color">Pagination Color</label></th>
					<td><input type="text" name="wprs_pager_color" id="wprs_pager_color" value="<?php $wprs_pager_color = get_option('wprs_pager_color'); if(!empty($wprs_pager_color)) {echo $wprs_pager_color;} else {echo "#969696";}?>" class="color-picker wprs_pager_color" /></td>
				</tr>
				<tr>
					<th><label for="wprs_pager_color_hover">Pagination Color Hover</label></th>
					<td><input type="text" name="wprs_pager_color_hover" id="wprs_pager_color_hover" value="<?php $wprs_pager_color_hover = get_option('wprs_pager_color_hover'); if(!empty($wprs_pager_color_hover)) {echo $wprs_pager_color_hover;} else {echo "#cd0100";}?>" class="color-picker wprs_pager_color_hover" /></td>
				</tr>
		</table>
	
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="wprs_border_radius, wprs_border, wpt_thumb_size, wprs_bg_color, wprs_pager_color, wprs_pager_color_hover" />
		<p class="submit"><input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" class="button button-primary" /></p>
	</form>
    
  </div>
  </div>
 
  <div id="nhtRight">
  <div class="nhtWidget">
<p><h3>Donate and support the development.</h3> With your help I can make Simple Fields even better! $5, $10, $100 – any amount is fine! :)</p>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="82C6LTLMFLUFW">
<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
</form>

  </div>
  </div>
 <div class="clrFix"></div> 
  </div>
<div class="clrFix"></div>
<?php		
	echo '</div>';
}