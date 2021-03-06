<?php

#VMF_CAROUSEL
function VMF_CAROUSEL_ARR() { return array(
	"element" => "",
	"space" => "",
	"items_dd" => "",
	"items_md" => "",
	"items_sd" => "",
); }

function VMF_CAROUSEL_SHORTCODE( $atts, $content = null ) { $VMF_CAROUSEL_ARR = VMF_CAROUSEL_ARR(); $atts = shortcode_atts( $VMF_CAROUSEL_ARR, $atts ); ob_start(); ?>

	<script type="text/javascript">jQuery(document).ready(function(e) {
		setTimeout(function() {
			var owl = jQuery("<?php echo $atts["element"]; ?>");
			owl.owlCarousel({
				margin: <?php echo ( !empty($atts["space"]) ) ? $atts["space"] : 0; ?>,
				autoplay: true,
				autoplayTimeout: 6000,
				autoplayHoverPause: true,
				nav: true,
				navElement: 'div',
				navText: ['<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>', '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M313.941 216H12c-6.627 0-12 5.373-12 12v56c0 6.627 5.373 12 12 12h301.941v46.059c0 21.382 25.851 32.09 40.971 16.971l86.059-86.059c9.373-9.373 9.373-24.569 0-33.941l-86.059-86.059c-15.119-15.119-40.971-4.411-40.971 16.971V216z"></path></svg>'],
				dots: false,
				loop: true,
				responsiveClass: true,
				responsive: { 0: { items:  <?php echo $atts["items_sd"]; ?> }, 767: { items:  <?php echo $atts["items_md"]; ?> }, 1000: { items: <?php echo $atts["items_dd"]; ?> } }
			});
			owl.find(".owl-dots").remove();
			owl.find(".owl-nav").removeClass("disabled");
			owl.on('changed.owl.carousel', function(event) {
				owl.find(".owl-nav").removeClass("disabled");
			});
		});
  });</script>

<?php $OUTPUT = ob_get_contents(); ob_get_clean(); return $OUTPUT; } add_shortcode( 'VMF_CAROUSEL', 'VMF_CAROUSEL_SHORTCODE' );

if(class_exists("WPBakeryShortCode")) { # WP Bakery Class Exists
	class VC_VMF_CAROUSEL extends WPBakeryShortCode {
		function __construct() { add_action( 'init', array( $this, 'vc_vm_home_mapping' ) ); add_shortcode( 'vc_vm_home', array( $this, 'vc_vm_home_html' ) ); } #Element Init
		public function vc_vm_home_mapping() { if ( !defined( 'WPB_VC_VERSION' ) ) { return; } vc_map( array(
			'name' => __('CAROUSEL', 'eminutes'),
			'base' => 'VMF_CAROUSEL',
			'description' => __('CAROUSEL Shortcode', 'eminutes'),
			'category' => __('eminutes', 'eminutes'),
			'params' => array(
				array( 'type' => 'textfield', 'param_name' => 'element', 'heading' => 'Element ID / Class', ),
				array( 'type' => 'textfield', 'param_name' => 'space', 'heading' => 'Items Space', ),
				array( 'type' => 'textfield', 'param_name' => 'items_dd', 'heading' => 'Desktop Device Items', ),
				array( 'type' => 'textfield', 'param_name' => 'items_md', 'heading' => 'Medium Device Items', ),
				array( 'type' => 'textfield', 'param_name' => 'items_sd', 'heading' => 'Small Device Items', ),
			)
		) ); }
		public function vc_vm_home_html( $atts ) { $VMF_CAROUSEL_ARR = VMF_CAROUSEL_ARR(); extract(  shortcode_atts( $VMF_CAROUSEL_ARR, $atts ) ); $html = do_shortcode("[VMF_CAROUSEL]"); return $html; } #Fill $html
	} new VC_VMF_CAROUSEL(); #Element Class Init
} # WP Bakery Class Exists

?>
