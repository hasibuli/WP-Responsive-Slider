<?php 
function wprs_editable_style(){
    ?>
<style type="text/css">
 .bx-wrapper .bx-viewport {
	 border-radius: <?php $wprs_border_radius = get_option('wprs_border_radius'); if(!empty($wprs_border_radius)) {echo $wprs_border_radius;} else {echo "0";}?>px;
 	 border: <?php $wprs_border = get_option('wprs_border'); if(!empty($wprs_border)) {echo $wprs_border;} else {echo "5";}?>px solid <?php $wprs_bg_color = get_option('wprs_bg_color'); if(!empty($wprs_bg_color)) {echo $wprs_bg_color;} else {echo "#fff";}?>;
 }
.bx-wrapper .bx-pager.bx-default-pager a {
  background: <?php $wprs_pager_color = get_option('wprs_pager_color'); if(!empty($wprs_pager_color)) {echo $wprs_pager_color;} else {echo "#969696";}?> !important;;
}
.bx-wrapper .bx-pager.bx-default-pager a:hover, .bx-wrapper .bx-pager.bx-default-pager a.active{
  background: <?php $wprs_pager_color_hover = get_option('wprs_pager_color_hover'); if(!empty($wprs_pager_color_hover)) {echo $wprs_pager_color_hover;} else {echo "#cd0100";}?> !important;;
}
.wprs_color{display:none !important;}
</style>
<?php
}
add_action('wp_footer','wprs_editable_style', 100);
?>