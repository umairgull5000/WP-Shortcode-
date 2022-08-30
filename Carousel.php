<?php

#FE_IMAGE_CAROUSEL
function FE_IMAGE_CAROUSEL_ARR() { return array(
    "images" => "",
	"element" => "",
	"space" => "",
	"items_dd" => "",
	"items_md" => "",
	"items_sd" => "",
); }

function FE_IMAGE_CAROUSEL_SHORTCODE( $atts, $content = null ) { $FE_IMAGE_CAROUSEL_ARR = FE_IMAGE_CAROUSEL_ARR(); $atts = shortcode_atts( $FE_IMAGE_CAROUSEL_ARR, $atts ); ob_start(); ?>

    <style>
        .owl-nav > div { position: absolute; top: 50%; left: -20px; width: 100%; transform: translateY(-50%); }
        .owl-nav > div.owl-next { left: auto; right: -20px; width: auto; }
    </style>

    <div id="FE_IMAGE_CAROUSEL" class="FE_IMAGE_CAROUSEL">
        <div class="FE_IMAGE_CAROUSEL--inner">
            <div class="FE_IMAGE_CAROUSEL--wrap">
                <div id="<?php echo (!empty($atts["element"])) ? $atts["element"] : "owl_carousel"; ?>" class="FE_IMAGE_CAROUSEL--carousel owl-carousel">
                    <?php if(!empty($atts["images"])) {
                        $images = $atts["images"];
                        $images = explode(",", $images);
                        if( is_array($images) && count($images) > 0 ) {
                            foreach( $images as $img ) {
                                echo '<div class="FE_IMAGE_CAROUSEL--item">';
                                echo wp_get_attachment_image( $img, "full" );
                                echo '</div>';
                            }
                        }
                    } ?>
                </div>
            </div>
        </div>
    </div>

	<script type="text/javascript">jQuery(document).ready(function(e) {
		setTimeout(function() {
			var owl = jQuery("<?php echo (!empty($atts["element"])) ? $atts["element"] : ".owl-carousel"; ?>");
			owl.owlCarousel({
				margin: <?php echo ( !empty($atts["space"]) ) ? $atts["space"] : 0; ?>,
				autoplay: true,
				autoplayTimeout: 3000,
				autoplayHoverPause: true,
				nav: true,
				navElement: 'div',
				navText: [
                    '<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="24" cy="24" r="23" transform="rotate(-180 24 24)" fill="#FF5316" stroke="#FF5316" stroke-width="2"/><path d="M18.44 22.44a1.5 1.5 0 0 0 0 2.12l9.545 9.547a1.5 1.5 0 1 0 2.122-2.122L21.62 23.5l8.486-8.485a1.5 1.5 0 1 0-2.122-2.122L18.44 22.44zM21.5 22h-2v3h2v-3z" fill="#fff"/></svg>',
                    '<svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="24" cy="24" r="23" fill="#FF5316" stroke="#FF5316" stroke-width="2"/><path d="M29.56 25.56a1.5 1.5 0 0 0 0-2.12l-9.545-9.547a1.5 1.5 0 1 0-2.122 2.122L26.38 24.5l-8.486 8.485a1.5 1.5 0 1 0 2.122 2.122l9.546-9.546zM26.5 26h2v-3h-2v3z" fill="#fff"/></svg>'
                ],
				dots: false,
				loop: true,
				responsiveClass: true,
				responsive: {
                    0: { items:  <?php echo (!empty($atts["items_sd"])) ? $atts["items_sd"] : 1; ?> },
                    767: { items:  <?php echo (!empty($atts["items_md"])) ? $atts["items_md"] : 2; ?> },
                    1000: { items: <?php echo (!empty($atts["items_dd"])) ? $atts["items_dd"] : 4; ?> }
                }
			});
			// owl.find(".owl-dots").remove();
			// owl.find(".owl-nav").removeClass("disabled");
			owl.on('changed.owl.carousel', function(event) {
				owl.find(".owl-nav").removeClass("disabled");
			});
		});
    });</script>

<?php $OUTPUT = ob_get_contents(); ob_get_clean(); return $OUTPUT; } add_shortcode( 'FE_IMAGE_CAROUSEL', 'FE_IMAGE_CAROUSEL_SHORTCODE' );

if(class_exists("WPBakeryShortCode")) { # WP Bakery Class Exists
	class VC_FE_IMAGE_CAROUSEL extends WPBakeryShortCode {
		function __construct() { add_action( 'init', array( $this, 'vc_vm_home_mapping' ) ); add_shortcode( 'vc_vm_home', array( $this, 'vc_vm_home_html' ) ); } #Element Init
		public function vc_vm_home_mapping() { if ( !defined( 'WPB_VC_VERSION' ) ) { return; } vc_map( array(
			'name' => __('Image Carousel', 'fe'),
			'base' => 'FE_IMAGE_CAROUSEL',
			'description' => __('Image Carousel Shortcode', 'fe'),
			'category' => __('Fort Equipment', 'fe'),
			'params' => array(
				array( 'type' => 'attach_images', 'param_name' => 'images', 'heading' => 'Images', ),
				array( 'type' => 'textfield', 'param_name' => 'element', 'heading' => 'Element ID / Class', ),
				array( 'type' => 'textfield', 'param_name' => 'space', 'heading' => 'Items Space', ),
				array( 'type' => 'textfield', 'param_name' => 'items_dd', 'heading' => 'Desktop Device Items', ),
				array( 'type' => 'textfield', 'param_name' => 'items_md', 'heading' => 'Medium Device Items', ),
				array( 'type' => 'textfield', 'param_name' => 'items_sd', 'heading' => 'Small Device Items', ),
			)
		) ); }
		public function vc_vm_home_html( $atts ) { $FE_IMAGE_CAROUSEL_ARR = FE_IMAGE_CAROUSEL_ARR(); extract(  shortcode_atts( $FE_IMAGE_CAROUSEL_ARR, $atts ) ); $html = do_shortcode("[FE_IMAGE_CAROUSEL]"); return $html; } #Fill $html
	} new VC_FE_IMAGE_CAROUSEL(); #Element Class Init
} # WP Bakery Class Exists

?>
