<?php
/**
 * Widget Extension for WP Master Widget
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Japonesa_Restaurant
 */
class Wp_Master_Widget_Widget extends WP_Widget{
	function __construct() {
		parent::__construct(
			'wp_master_widget_widget',
			__( 'WP Master Widget', 'wp-master-widget' ),
			array(
				'classname'		=>	__( 'widget-wp-master-widget', 'wp-master-widget' ),
				'description'	=>	__( 'All in one widget with full custom control. Combines image, text, icon, banner, and more features.', 'wp-master-widget' )
			)
		);
	}
	
	public function widget( $args, $instance ){
		$container_css = '';
		$before_widget = $args['before_widget'];
		
		if( strpos( $before_widget, 'class' ) === false ){
			$before_widget = str_replace( '>', 'class="' . $container_css .'">', $before_widget );
		} else {
			$before_widget = str_replace('class="', 'class="' . $container_css .  ' ', $before_widget);
		}

		echo $before_widget;
		
		if( isset( $instance['wpmw'] ) && is_array( $instance['wpmw'] ) ){
			$wpmw_data = $instance['wpmw'];
			$html_output = '<div class="wp-master-widget">';
			$dynamic_css = '';
			
			foreach( $wpmw_data as $unique_id => $data ){
				
				$type = substr( $unique_id, 0, 2 );
				
				if( $type == 'ti' ){ //title
					$element_class = trim( 'wpmw-section-title' . ' ' . $data['class'] );
					$html_output .='<div id="wpmw-' . $unique_id . '" class="' . $element_class . '">';
					
					if( !empty( $data['content'] ) ){ // content inside the widget
						
						$html_output .= '<' . $data['tag'] . '>';
						
						if( $data['link'] == 'no' ){
							$css_array = array(
								'margin-top' 			=> $data['margin_top'],
								'margin-right' 		=> $data['margin_right'],
								'margin-bottom' 	=> $data['margin_bottom'],
								'margin-left' 		=> $data['margin_left'],
								'meta-margin' 		=> $data['margin_unit'],
								'font-size'				=> $data['size'],
								'line-height'			=> $data['line_height'],
								'meta-font-size'	=> $data['unit'],
								'font-weight'			=> $data['weight'],
								'font-style'			=> $data['style'],
								'color'						=> $data['color'],
								'text-decoration'	=> $data['decoration'],
								'text-align'			=> $data['align']
							);
							$dynamic_css .= '
								div#wpmw-' . $unique_id . ' ' . $data['tag'] . '{
									' . $this->wpmw_css_builder( $css_array ) . '
								}
							';
							
							$html_output .= $data['content'];
						} else {
							$css_array = array(
								'margin-top' 			=> $data['margin_top'],
								'margin-right' 		=> $data['margin_right'],
								'margin-bottom' 	=> $data['margin_bottom'],
								'margin-left' 		=> $data['margin_left'],
								'meta-margin' 		=> $data['margin_unit'],
							);
							$dynamic_css .= '
								div#wpmw-' . $unique_id . ' ' . $data['tag'] . '{
									' . $this->wpmw_css_builder( $css_array ) . '
								}
							';

							$css_array = array(
								'font-size'				=> $data['size'],
								'line-height'			=> $data['line_height'],
								'meta-font-size'	=> $data['unit'],
								'font-weight'			=> $data['weight'],
								'font-style'			=> $data['style'],
								'color'						=> $data['color'],
								'text-decoration'	=> $data['decoration'],
								'text-align'			=> $data['align']
							);
							$dynamic_css .= '
								div#wpmw-' . $unique_id . ' ' . $data['tag'] . ' a{
									' . $this->wpmw_css_builder( $css_array ) . '
								}
							';

							$css_array = array(
								'color'						=> $data['link_color_h'],
								'font-weight' 		=> $data['weight_h'],
								'font-style'			=> $data['style_h'],
								'text-decoration'	=> $data['decoration_h']
							);
							$dynamic_css .= '
								div#wpmw-' . $unique_id . ' ' . $data['tag'] . ' a:hover{
									' . $this->wpmw_css_builder( $css_array ) . '
								}
							';

							$html_output .= '<a href="' . $data['link_url'] . '"' . ( ( $data['link'] == 'new' ) ? ' target="_blank"' : '' ) . '>' . $data['content'] . '</a>';
						}
						$html_output .= '</' . $data['tag'] . '>';
					}
					$html_output .= '</div>';
				} elseif( $type == 'te' ){ //text
					$element_class = trim( 'wpmw-section-title' . ' ' . $data['class'] );
					$html_output .='<div id="wpmw-' . $unique_id . '" class="' . $element_class . '">';
					if( !empty( $data['content'] ) ){ // content inside the widget
						
						//CSS - Content
						$css_array = array(
							'margin-top' 			=> $data['margin_top'],
							'margin-right' 		=> $data['margin_right'],
							'margin-bottom' 	=> $data['margin_bottom'],
							'margin-left' 		=> $data['margin_left'],
							'meta-margin' 		=> $data['margin_unit'],
							'font-size'				=> $data['size'],
							'line-height'			=> $data['line_height'],
							'meta-font-size'	=> $data['unit'],
							'font-weight'			=> $data['weight'],
							'font-style'			=> $data['style'],
							'color'						=> $data['color'],
							'text-decoration'	=> $data['decoration'],
							'text-align'			=> $data['align']
						);
						$dynamic_css .= '
							div#wpmw-' . $unique_id . ' ' . $data['tag'] . '{
								' . $this->wpmw_css_builder( $css_array ) . '
							}
						';
						
						//CSS Link
						$css_array = array(
							'color'						=> $data['link_color']
						);
						$dynamic_css .= '
							div#wpmw-' . $unique_id . ' ' . $data['tag'] . ' a{
								' . $this->wpmw_css_builder( $css_array ) . '
							}
						';
						
						//CSS LInk:Hover
						$css_array = array(
							'font-weight'			=> $data['weight_h'],
							'font-style'			=> $data['style_h'],
							'color'						=> $data['link_color_h'],
							'text-decoration'	=> $data['decoration_h'],
						);
						$dynamic_css .= '
							div#wpmw-' . $unique_id . ' ' . $data['tag'] . ' a:hover{
								' . $this->wpmw_css_builder( $css_array ) . '
							}
						';
						$html_output .= '<' . $data['tag'] . '>' . do_shortcode( $data['content'] ) . '</' . $data['tag'] . '>';
					}
					$html_output .='</div>';
				} elseif( $type == 'im' ){ //image
					$element_class = trim( 'wpmw-section-image' . ' ' . $data['class'] );
				
					//image wrapper text-alignment
					$css_array = array(
						'text-align'			=> $data['align']
					);
					$dynamic_css .= '
						div#wpmw-' . $unique_id . ' .wpmw-image-wrapper {
							' . $this->wpmw_css_builder( $css_array ) . '
						}
					';
					
					$css_array = array(
						'margin-top' 			=> $data['margin_top'],
						'margin-right' 		=> $data['margin_right'],
						'margin-bottom' 	=> $data['margin_bottom'],
						'margin-left' 		=> $data['margin_left'],
						'meta-margin' 		=> $data['margin_unit'],
						'width'						=> $data['width'],
						'meta-width-unit'	=> $data['unit'],
						'filter'					=> array(
							'blur'				=> $data['blur'],
							'brightness'	=> $data['brightness'],
							'contrast'		=> $data['contrast'],
							'grayscale'		=> $data['grayscale'],
							'huerotate'		=> $data['huerotate'],
							'invert'			=> $data['invert'],
							'opacity'			=> $data['opacity'],
							'saturate'		=> $data['saturate'],
							'sepia'				=> $data['sepia'],
						),
						'rotate'			=> $data['rotate'],
					);
					$dynamic_css .= '
						div#wpmw-' . $unique_id . ' img {
							' . $this->wpmw_css_builder( $css_array ) . '
						}
					';
					
					if( $data['hover'] == 'yes' ){
						$css_array = array(
							'filter'					=> array(
								'blur'				=> $data['blur_h'],
								'brightness'	=> $data['brightness_h'],
								'contrast'		=> $data['contrast_h'],
								'grayscale'		=> $data['grayscale_h'],
								'huerotate'		=> $data['huerotate_h'],
								'invert'			=> $data['invert_h'],
								'opacity'			=> $data['opacity_h'],
								'saturate'		=> $data['saturate_h'],
								'sepia'				=> $data['sepia_h'],
							),
							'rotate'			=> $data['rotate_h'],
							'transition-duration'	=> $data['duration'],
							'transition-delay'	=> $data['delay'],
							'transition-timing-function'	=> $data['timing'],
						);
						$dynamic_css .= '
							div#wpmw-' . $unique_id . ' img:hover {
								' . $this->wpmw_css_builder( $css_array ) . '
							}
						';
					}
					
					$html_output .='<div id="wpmw-' . $unique_id . '" class="' . $element_class . '"><div class="wpmw-image-wrapper">';
					if( $data['link'] == 'no' ){
						$html_output .= '<img src="' . $data['image_url'] . '" alt="' . $data['alt_text'] . '" />';
					} else {
						$link_target = '';
						if( $data['link'] == 'new' ){
							$link_target = ' target="_blank"';
						}
						
						$html_output .= '<a href="' . $data['link_url'] . '"' . $link_target . '><img src="' . $data['image_url'] . '" alt="' . $data['alt_text'] . '" /></a>';
					}
					$html_output .= '</div></div>';
				} elseif( $type == 'ic' ){ //icon
					$element_class = trim( 'wpmw-section-icon' . ' ' . $data['class'] );
					
					$css_array = array(
						'margin-top' 			=> $data['margin_top'],
						'margin-right' 		=> $data['margin_right'],
						'margin-bottom' 	=> $data['margin_bottom'],
						'margin-left' 		=> $data['margin_left'],
						'meta-margin' 		=> $data['margin_unit'],
						'color'						=> $data['color'],
						'font-size'				=> $data['size'],
						'meta-font-size'	=> $data['unit'],
					);
					$dynamic_css .= '
						div#wpmw-' . $unique_id . ' i.fa {
							' . $this->wpmw_css_builder( $css_array ) . '
						}
					';
					$css_array = array(
						'text-align'			=> $data['align']
					);
					$dynamic_css .= '
						div#wpmw-' . $unique_id . ' .wpmw-icon-wrapper {
							' . $this->wpmw_css_builder( $css_array ) . '
						}
					';
					
					$html_output .= '<div id="wpmw-' . $unique_id . '" class="' . $element_class . '"><div class="wpmw-icon-wrapper">';
					
					if( $data['link'] == 'no' ){
						$html_output .= '<i class="fa fa-' . $data['icon_class'] . '" aria-hidden="true"></i>';
					} else {
						$css_array = array(
							'color'						=> $data['link_color_h'],
						);
						$dynamic_css .= '
							div#wpmw-' . $unique_id . ' a i.fa:hover {
								' . $this->wpmw_css_builder( $css_array ) . '
							}
						';
						$link_target = '';
						if( $data['link'] == 'new' ){
							$link_target = ' target="_blank"';
						}
						$html_output .= '<a href="' . $data['link_url'] . '"' . $link_target . '><i class="fa fa-' . $data['icon_class'] . '" aria-hidden="true"></i></a>';
					}
					
					$html_output .= '</div></div>';
				}
			}
			
			wp_enqueue_style( 'wpmw-master-widget-dynamic-css', plugins_url( 'public/css/wp-master-widget-dynamic.css', plugin_dir_path( __FILE__ ) ) );
			wp_add_inline_style( 'wpmw-master-widget-dynamic-css', $dynamic_css );
			echo $html_output;
		}
		echo $args['after_widget'];
	}
	
	/*
	 * Takes array set of css prperty and value and returns string of css properties... English is hard.
	 */
	private function wpmw_css_builder( $data ){
		$css = '';
		if( !empty( $data ) && is_array( $data ) ){
			foreach( $data as $key => $val ){
				if( strpos( $key, 'meta-' ) !== 0 ){ //meta fields. i.e. unit.
					if( strpos( $key, 'margin-' ) === 0 ){ // when margin is passed
						if( strlen( $val ) > 0 ){ //has value assigned
							if( $val === "0.0" ){
								$css .= $key . ':auto;';
							} elseif( $val == 0 ){
								$css .= $key . ':0;';
							} else {
								$css .= $key . ':' . $val . $data['meta-margin'] . ';';
							} 
						}
					} elseif( $key == 'font-size' || $key == 'line-height' ){
						if( !empty( $val ) ){
							$css .= $key . ':' . $val . $data['meta-font-size'] . ';';
						}
					} elseif( $key == 'filter' && is_array( $val ) ){
						$css_filter = '';
						foreach( $val as $filter_prop => $filter_val ){
							if( trim( $filter_val ) != '' ){
								if( $filter_prop == 'blur' ){
									$css_filter .= 'blur(' . $filter_val . 'px) ';
								} elseif( $filter_prop == 'huerotate' ){
									$css_filter .= 'hue-rotate(' . $filter_val . 'deg) ';
								} elseif( $filter_prop == 'rotate' ){
									$css_filter .= 'rotate(' . $filter_val . 'deg) ';
								} else {
									$css_filter .= $filter_prop . '(' . $filter_val . '%) ';
								}
							}
						}
						$css_filter = trim( $css_filter );
						$css .= '-webkit-filter:' . $css_filter . ';';
						$css .= 'filter:' . $css_filter . ';';
					} elseif( $key == 'width' ){
						$width_unit = $data['meta-width-unit'];
						if( $width_unit == 'percent' ){
							$width_unit = '%';
						}
						$css .= $key . ':' . $val . $width_unit . ';';
					} elseif( $key == 'transition-delay' ){
						$css .= '-webkit-' . $key . ':' . $val . 's;';
						$css .= $key . ':' . $val . 's;';
					} elseif( $key == 'transition-duration' ){
						$css .= '-webkit-' . $key . ':' . $val . 's;';
						$css .= $key . ':' . $val . 's;';
					} elseif( $key == 'transition-timing-function' ){
						$css .= '-webkit-' . $key . ':' . $val . ';';
						$css .= $key . ':' . $val . ';';
					} elseif( $key == 'rotate' ) {
						$css .= '-ms-transform:' . $key . '(' . $val . 'deg);';
						$css .= '-webkit-transform:' . $key . '(' . $val . 'deg);';
						$css .= 'transform:' . $key . '(' . $val . 'deg);';
					} else {
						if( !empty( $val ) ){
							$css .= $key . ':' . $val . ';';
						}
					}
				}
			}
		}
		return $css;
	}

	// Widget Backend 
	public function form( $instance ) {

		$html_controls = '
			<div class="wpmw-controls">
				<div class="wpmw-widget-button wpmw-title" data-wpmw-type="title" data-wpmw-name="'. $this->get_field_name('wpmw') .'"> ' . __( 'Title', 'wp-master-widget' ) .  '</div>
				<div class="wpmw-widget-button wpmw-text" data-wpmw-type="text" data-wpmw-name="'. $this->get_field_name('wpmw') .'"> ' . __( 'Text', 'wp-master-widget' ) .  '</div>
				<div class="wpmw-widget-button wpmw-image" data-wpmw-type="image" data-wpmw-name="'. $this->get_field_name('wpmw') .'"> ' . __( 'Image', 'wp-master-widget' ) .  '</div>
				<div class="wpmw-widget-button wpmw-icon"  data-wpmw-type="icon" data-wpmw-name="'. $this->get_field_name('wpmw') .'"> ' . __( 'Icon', 'wp-master-widget' ) .  '</div>
			</div>
		';
		/*
			<div class="wpmw-widget-button wpmw-embed" data-wpmw-type="embed" data-wpmw-name="'. $this->get_field_name('wpmw') .'"> ' . __( 'Embed', 'wp-master-widget' ) .  '</div>
				<div class="wpmw-widget-button wpmw-banner" data-wpmw-type="banner" data-wpmw-name="'. $this->get_field_name('wpmw') .'"> ' . __( 'Banner', 'wp-master-widget' ) .  '</div>
		*/
		
		$existing_fields = '';
		if( !empty( $instance['wpmw'] ) ){
			$wpmw_data = $instance['wpmw'];
			foreach( $wpmw_data as $unique_id => $data ){
				$type = substr( $unique_id, 0, 2 );
				if( $type == 'ti' ){ //title
					$existing_fields .= '
						<div class="wpmw-widget-panel">
							<h3 class="wpmw-widget-header"><i class="fa fa-bars wpmw-control-move" aria-hidden="true"></i>Title<i class="fa fa-window-close wpmw-control-remove" aria-hidden="true"></i></h3>
							<div class="wpmw-widget-settings">
							' . $this->wpmw_control_title( $this->get_field_name( 'wpmw' ), $unique_id, $data ) . '
							</div>
						</div>
					';
				} elseif( $type == 'te' ){ //text
					$existing_fields .= '
						<div class="wpmw-widget-panel">
							<h3 class="wpmw-widget-header"><i class="fa fa-bars wpmw-control-move" aria-hidden="true"></i>Text<i class="fa fa-window-close wpmw-control-remove" aria-hidden="true"></i></h3>
							<div class="wpmw-widget-settings">
							' . $this->wpmw_control_text( $this->get_field_name( 'wpmw' ), $unique_id, $data ) . '
							</div>
						</div>
					';
				} elseif( $type == 'im' ){ //image
					$existing_fields .= '
						<div class="wpmw-widget-panel">
							<h3 class="wpmw-widget-header"><i class="fa fa-bars wpmw-control-move" aria-hidden="true"></i>Image<i class="fa fa-window-close wpmw-control-remove" aria-hidden="true"></i></h3>
							<div class="wpmw-widget-settings">
							' . $this->wpmw_control_image( $this->get_field_name( 'wpmw' ), $unique_id, $data ) . '
							</div>
						</div>
					';
				} elseif( $type == 'ic' ){ //icon
					$existing_fields .= '
						<div class="wpmw-widget-panel">
							<h3 class="wpmw-widget-header"><i class="fa fa-bars wpmw-control-move" aria-hidden="true"></i>Icon<i class="fa fa-window-close wpmw-control-remove" aria-hidden="true"></i></h3>
							<div class="wpmw-widget-settings">
							' . $this->wpmw_control_icon( $this->get_field_name( 'wpmw' ), $unique_id, $data ) . '
							</div>
						</div>
					';
				}
			}
		}

		$html_widget_area = '
			<div class="wpmw-widgets"> ' . $existing_fields . '
			</div>
		';

		$html_icon_font_awesome = '
			<div id="wpmw-icons-modal" class="wpmw-font-awesome-icons wpmw-modal">
				<div class="wpmw-modal-container">
					<div class="wpmw-modal-content">
						<div class="wpmw-modal-header"><h2 class="wpmw-modal-title">Select an Icon</h2><span class="wpmw-modal-close">&times;</span></div>
						<div class="wpmw-font-awesome-container">' . $this->display_font_awesome_icons() . '</div>
					</div>
				</div>
			</div>
		';

		$html_output = '<div class="wpmw-container">' . $html_controls . $html_widget_area . $html_icon_font_awesome . '</div>';
		//$html_output .= 'Instance:<br><pre>'.print_r($instance, true).'</pre>';
		_e( $html_output );
		//printf( $html_output );
	}	
	
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		//die( '<pre>' . print_r( $new_instance, true ) . '</pre>' );
		/*
		 *	Maybe implement sorting elements here
		 *
		 */
		if( !empty( $new_instance['wpmw'] ) ){
			$wpmw_data = $new_instance['wpmw'];
			foreach( $wpmw_data as $unique_id => $data ){
				$type = substr( $unique_id, 0, 2 );
				if( $type == 'ti' ){ //title
					$order 			= filter_var( $data['order'], FILTER_SANITIZE_NUMBER_INT );
					$ti_content 			= $this->sanitize_html_text_field( $data['content'] );
					$ti_tag 					= $this->sanitize_simple_string_no_html( $data['tag'] );
					$ti_class 				= $this->sanitize_multiple_html_classes( $data['class'] );
					$ti_align 				= $this->sanitize_simple_string_no_html( $data['align'] );
					$ti_margin_top 		= $this->sanitize_decimal_numbers( $data['margin_top'] );
					$ti_margin_right 	= $this->sanitize_decimal_numbers( $data['margin_right'] );
					$ti_margin_bottom = $this->sanitize_decimal_numbers( $data['margin_bottom'] );
					$ti_margin_left 	= $this->sanitize_decimal_numbers( $data['margin_left'] );
					$ti_margin_unit 	= $this->sanitize_simple_string_no_html( $data['margin_unit'] );
					$ti_size					= $this->sanitize_decimal_numbers( $data['size'] );
					$ti_line_height		=	$this->sanitize_decimal_numbers( $data['line_height'] );
					$ti_unit 					= $this->sanitize_simple_string_no_html( $data['unit'] );
					$ti_weight 				= $this->sanitize_simple_string_no_html( $data['weight'] );
					$ti_style 				= $this->sanitize_simple_string_no_html( $data['style'] );
					$ti_decoration 		= $this->sanitize_simple_string_no_html( $data['decoration'] );
					$ti_color 				= $this->sanitize_color_field( $data['color'] );
					$ti_link 					= $this->sanitize_simple_string_no_html( $data['link'] );
					$ti_link_url 			= $this->sanitize_url_field( $data['link_url'] );
					$ti_link_color_h	= $this->sanitize_color_field( $data['link_color_h'] );
					$ti_weight_h			= $this->sanitize_simple_string_no_html( $data['weight_h'] );
					$ti_style_h				= $this->sanitize_simple_string_no_html( $data['style_h'] );
					$ti_decoration_h	= $this->sanitize_simple_string_no_html( $data['decoration_h'] );
					
					$new_instance['wpmw'][$unique_id]['order'] 					= $order;
					$new_instance['wpmw'][$unique_id]['content'] 				= $ti_content;
					$new_instance['wpmw'][$unique_id]['tag'] 						= $ti_tag;
					$new_instance['wpmw'][$unique_id]['class'] 					= $ti_class;
					$new_instance['wpmw'][$unique_id]['align'] 					= $ti_align;
					$new_instance['wpmw'][$unique_id]['margin_top'] 		= $ti_margin_top;
					$new_instance['wpmw'][$unique_id]['margin_right']		= $ti_margin_right;
					$new_instance['wpmw'][$unique_id]['margin_bottom'] 	= $ti_margin_bottom;
					$new_instance['wpmw'][$unique_id]['margin_left'] 		= $ti_margin_left;
					$new_instance['wpmw'][$unique_id]['margin_unit'] 		= $ti_margin_unit;
					$new_instance['wpmw'][$unique_id]['size'] 					= $ti_size;
					$new_instance['wpmw'][$unique_id]['line_height'] 		= $ti_line_height;
					$new_instance['wpmw'][$unique_id]['unit'] 					= $ti_unit;
					$new_instance['wpmw'][$unique_id]['weight'] 				= $ti_weight;
					$new_instance['wpmw'][$unique_id]['style'] 					= $ti_style;
					$new_instance['wpmw'][$unique_id]['decoration'] 		= $ti_decoration;
					$new_instance['wpmw'][$unique_id]['color']					= $ti_color;
					$new_instance['wpmw'][$unique_id]['link'] 					= $ti_link;
					$new_instance['wpmw'][$unique_id]['link_url'] 			= $ti_link_url;
					$new_instance['wpmw'][$unique_id]['link_color_h'] 	= $ti_link_color_h;
					$new_instance['wpmw'][$unique_id]['weight_h'] 			= $ti_weight_h;
					$new_instance['wpmw'][$unique_id]['style_h'] 				= $ti_style_h;
					$new_instance['wpmw'][$unique_id]['decoration_h'] 	= $ti_decoration_h;
				} elseif( $type == 'te' ){ //text
					$order 						= filter_var( $data['order'], FILTER_SANITIZE_NUMBER_INT );
					$te_content 			= $this->sanitize_html_text_field( $data['content'] );
					$te_tag 					= $this->sanitize_simple_string_no_html( $data['tag'] );
					$te_class 				= $this->sanitize_multiple_html_classes( $data['class'] );
					$te_align 				= $this->sanitize_simple_string_no_html( $data['align'] );
					$te_margin_top 		= $this->sanitize_decimal_numbers( $data['margin_top'] );
					$te_margin_right 	= $this->sanitize_decimal_numbers( $data['margin_right'] );
					$te_margin_bottom = $this->sanitize_decimal_numbers( $data['margin_bottom'] );
					$te_margin_left 	= $this->sanitize_decimal_numbers( $data['margin_left'] );
					$te_margin_unit 	= $this->sanitize_simple_string_no_html( $data['margin_unit'] );
					$te_size					= $this->sanitize_decimal_numbers( $data['size'] );
					$te_line_height		=	$this->sanitize_decimal_numbers( $data['line_height'] );
					$te_unit 					= $this->sanitize_simple_string_no_html( $data['unit'] );
					$te_weight 				= $this->sanitize_simple_string_no_html( $data['weight'] );
					$te_style 				= $this->sanitize_simple_string_no_html( $data['style'] );
					$te_decoration 		= $this->sanitize_simple_string_no_html( $data['decoration'] );
					$te_color 				= $this->sanitize_color_field( $data['color'] );
					$te_link_color 		= $this->sanitize_color_field( $data['link_color'] );
					$te_link_color_h 	= $this->sanitize_url_field( $data['link_color_h'] );
					$te_weight_h			= $this->sanitize_simple_string_no_html( $data['weight_h'] );
					$te_style_h				= $this->sanitize_simple_string_no_html( $data['style_h'] );
					$te_decoration_h	= $this->sanitize_simple_string_no_html( $data['decoration_h'] );

					$new_instance['wpmw'][$unique_id]['order'] 					= $order;
					$new_instance['wpmw'][$unique_id]['content'] 				= $te_content;
					$new_instance['wpmw'][$unique_id]['tag'] 						= $te_tag;
					$new_instance['wpmw'][$unique_id]['class'] 					= $te_class;
					$new_instance['wpmw'][$unique_id]['align'] 					= $te_align;
					$new_instance['wpmw'][$unique_id]['margin_top'] 		= $te_margin_top;
					$new_instance['wpmw'][$unique_id]['margin_right']		= $te_margin_right;
					$new_instance['wpmw'][$unique_id]['margin_bottom'] 	= $te_margin_bottom;
					$new_instance['wpmw'][$unique_id]['margin_left'] 		= $te_margin_left;
					$new_instance['wpmw'][$unique_id]['margin_unit'] 		= $te_margin_unit;
					$new_instance['wpmw'][$unique_id]['size'] 					= $te_size;
					$new_instance['wpmw'][$unique_id]['line_height'] 		= $te_line_height;
					$new_instance['wpmw'][$unique_id]['unit'] 					= $te_unit;
					$new_instance['wpmw'][$unique_id]['weight'] 				= $te_weight;
					$new_instance['wpmw'][$unique_id]['style'] 					= $te_style;
					$new_instance['wpmw'][$unique_id]['decoration'] 		= $te_decoration;
					$new_instance['wpmw'][$unique_id]['color']					= $te_color;
					$new_instance['wpmw'][$unique_id]['link_color']			= $te_link_color;
					$new_instance['wpmw'][$unique_id]['link_color_h']		= $te_link_color_h;
					$new_instance['wpmw'][$unique_id]['weight_h'] 			= $te_weight_h;
					$new_instance['wpmw'][$unique_id]['style_h'] 				= $te_style_h;
					$new_instance['wpmw'][$unique_id]['decoration_h'] 	= $te_decoration_h;

				} elseif( $type == 'im' ){ //image
					$order						=	filter_var( $data['order'], FILTER_SANITIZE_NUMBER_INT );
					$im_image_url 		=	$this->sanitize_url_field( $data['image_url'] );
					$im_image_thumb 	=	$this->sanitize_url_field( $data['image_thumb'] );
					$im_alt_text 			=	$this->sanitize_simple_string_no_html( $data['alt_text'] );
					$im_class 				=	$this->sanitize_multiple_html_classes( $data['class'] );
					$im_align 				=	$this->sanitize_simple_string_no_html( $data['align'] );
					$im_blur 					=	$this->sanitize_decimal_numbers( $data['blur'] );
					$im_brightness 		=	$this->sanitize_decimal_numbers( $data['brightness'] );
					$im_contrast 			=	$this->sanitize_decimal_numbers( $data['contrast'] );
					$im_grayscale 		=	$this->sanitize_decimal_numbers( $data['grayscale'] );
					$im_huerotate 		=	$this->sanitize_decimal_numbers( $data['huerotate'] );
					$im_invert 				=	$this->sanitize_decimal_numbers( $data['invert'] );
					$im_opacity 			=	$this->sanitize_decimal_numbers( $data['opacity'] );
					$im_saturate 			=	$this->sanitize_decimal_numbers( $data['saturate'] );
					$im_sepia 				=	$this->sanitize_decimal_numbers( $data['sepia'] );
					$im_rotate 				=	$this->sanitize_decimal_numbers( $data['rotate'] );
					$im_margin_top 		=	$this->sanitize_decimal_numbers( $data['margin_top'] );
					$im_margin_right 	=	$this->sanitize_decimal_numbers( $data['margin_right'] );
					$im_margin_bottom =	$this->sanitize_decimal_numbers( $data['margin_bottom'] );
					$im_margin_left 	=	$this->sanitize_decimal_numbers( $data['margin_left'] );
					$im_margin_unit 	=	$this->sanitize_simple_string_no_html( $data['margin_unit'] );
					$im_width 				=	$this->sanitize_decimal_numbers( $data['width'] );
					$im_unit 					=	$this->sanitize_simple_string_no_html( $data['unit'] );
					$im_link 					=	$this->sanitize_simple_string_no_html( $data['link'] );
					$im_link_url			=	$this->sanitize_url_field( $data['link_url'] );
					$im_hover 				=	$this->sanitize_simple_string_no_html( $data['hover'] );
					$im_delay 				=	$this->sanitize_decimal_numbers( $data['delay'] );
					$im_duration 			=	$this->sanitize_decimal_numbers( $data['duration'] );
					$im_timing 				=	$this->sanitize_decimal_numbers( $data['timing'] );
					$im_blur_h 				=	$this->sanitize_decimal_numbers( $data['blur_h'] );
					$im_brightness_h 	=	$this->sanitize_decimal_numbers( $data['brightness_h'] );
					$im_contrast_h 		=	$this->sanitize_decimal_numbers( $data['contrast_h'] );
					$im_grayscale_h 	=	$this->sanitize_decimal_numbers( $data['grayscale_h'] );
					$im_huerotate_h 	=	$this->sanitize_decimal_numbers( $data['huerotate_h'] );
					$im_invert_h 			=	$this->sanitize_decimal_numbers( $data['invert_h'] );
					$im_opacity_h 		=	$this->sanitize_decimal_numbers( $data['opacity_h'] );
					$im_saturate_h 		=	$this->sanitize_decimal_numbers( $data['saturate_h'] );
					$im_sepia_h 			=	$this->sanitize_decimal_numbers( $data['sepia_h'] );
					$im_rotate_h 			=	$this->sanitize_decimal_numbers( $data['rotate_h'] );
					
					$new_instance['wpmw'][$unique_id]['order']					=	$order;
					$new_instance['wpmw'][$unique_id]['image_url']			=	$im_image_url;
					$new_instance['wpmw'][$unique_id]['image_thumb']		=	$im_image_thumb;
					$new_instance['wpmw'][$unique_id]['alt_text']				=	$im_alt_text;
					$new_instance['wpmw'][$unique_id]['class']					=	$im_class;
					$new_instance['wpmw'][$unique_id]['align']					=	$im_align;
					$new_instance['wpmw'][$unique_id]['blur']						=	$im_blur;
					$new_instance['wpmw'][$unique_id]['brightness']			=	$im_brightness;
					$new_instance['wpmw'][$unique_id]['contrast']				=	$im_contrast;
					$new_instance['wpmw'][$unique_id]['grayscale']			=	$im_grayscale;
					$new_instance['wpmw'][$unique_id]['huerotate']			=	$im_huerotate;
					$new_instance['wpmw'][$unique_id]['invert']					=	$im_invert;
					$new_instance['wpmw'][$unique_id]['opacity']				=	$im_opacity;
					$new_instance['wpmw'][$unique_id]['saturate']				=	$im_saturate;
					$new_instance['wpmw'][$unique_id]['sepia']					=	$im_sepia;
					$new_instance['wpmw'][$unique_id]['rotate']					=	$im_rotate;
					$new_instance['wpmw'][$unique_id]['margin_top']			=	$im_margin_top;
					$new_instance['wpmw'][$unique_id]['margin_right']		=	$im_margin_right;
					$new_instance['wpmw'][$unique_id]['margin_bottom']	=	$im_margin_bottom;
					$new_instance['wpmw'][$unique_id]['margin_left']		=	$im_margin_left;
					$new_instance['wpmw'][$unique_id]['margin_unit']		=	$im_margin_unit;
					$new_instance['wpmw'][$unique_id]['width']					=	$im_width;
					$new_instance['wpmw'][$unique_id]['unit']						=	$im_unit;
					$new_instance['wpmw'][$unique_id]['link']						=	$im_link;
					$new_instance['wpmw'][$unique_id]['link_url']				=	$im_link_url;
					$new_instance['wpmw'][$unique_id]['hover']					=	$im_hover;
					$new_instance['wpmw'][$unique_id]['delay']					=	$im_delay;
					$new_instance['wpmw'][$unique_id]['duration']				=	$im_duration;
					$new_instance['wpmw'][$unique_id]['timing']					=	$im_timing;
					$new_instance['wpmw'][$unique_id]['blur_h']					=	$im_blur_h;
					$new_instance['wpmw'][$unique_id]['brightness_h']		=	$im_brightness_h;
					$new_instance['wpmw'][$unique_id]['contrast_h']			=	$im_contrast_h;
					$new_instance['wpmw'][$unique_id]['grayscale_h']		=	$im_grayscale_h;
					$new_instance['wpmw'][$unique_id]['huerotate_h']		=	$im_huerotate_h;
					$new_instance['wpmw'][$unique_id]['invert_h']				=	$im_invert_h;
					$new_instance['wpmw'][$unique_id]['opacity_h']			=	$im_opacity_h;
					$new_instance['wpmw'][$unique_id]['saturate_h']			=	$im_saturate_h;
					$new_instance['wpmw'][$unique_id]['sepia_h']				=	$im_sepia_h;
					$new_instance['wpmw'][$unique_id]['rotate_h']				=	$im_rotate_h;
				} elseif( $type == 'ic' ){ //icon
					$order							= filter_var( $data['order'], FILTER_SANITIZE_NUMBER_INT );
					$ic_icon_class			= $this->sanitize_multiple_html_classes( $data['icon_class'] );
					$ic_size						= $this->sanitize_decimal_numbers( $data['size'] );
					$ic_unit						= $this->sanitize_simple_string_no_html( $data['unit'] );
					$ic_class						= $this->sanitize_multiple_html_classes( $data['class'] );
					$ic_align						= $this->sanitize_simple_string_no_html( $data['align'] );
					$ic_margin_top			= $this->sanitize_decimal_numbers( $data['margin_top'] );
					$ic_margin_right		= $this->sanitize_decimal_numbers( $data['margin_right'] );
					$ic_margin_bottom		= $this->sanitize_decimal_numbers( $data['margin_bottom'] );
					$ic_margin_left			= $this->sanitize_decimal_numbers( $data['margin_left'] );
					$ic_margin_unit			= $this->sanitize_simple_string_no_html( $data['margin_unit'] );
					$ic_color						= $this->sanitize_color_field( $data['color'] );
					$ic_link						= $this->sanitize_simple_string_no_html( $data['link'] );
					$ic_link_url				= $this->sanitize_url_field( $data['link_url'] );
					$ic_link_color_h		= $this->sanitize_color_field( $data['link_color_h'] );
					
					$new_instance['wpmw'][$unique_id]['order']					=	$order;
					$new_instance['wpmw'][$unique_id]['icon_class']			=	$ic_icon_class;
					$new_instance['wpmw'][$unique_id]['size']						=	$ic_size;
					$new_instance['wpmw'][$unique_id]['unit']						=	$ic_unit;
					$new_instance['wpmw'][$unique_id]['class']					=	$ic_class;
					$new_instance['wpmw'][$unique_id]['align']					=	$ic_align;
					$new_instance['wpmw'][$unique_id]['margin_top']			=	$ic_margin_top;
					$new_instance['wpmw'][$unique_id]['margin_right']		=	$ic_margin_right;
					$new_instance['wpmw'][$unique_id]['margin_bottom']	=	$ic_margin_bottom;
					$new_instance['wpmw'][$unique_id]['margin_left']		=	$ic_margin_left;
					$new_instance['wpmw'][$unique_id]['margin_unit']		=	$ic_margin_unit;
					$new_instance['wpmw'][$unique_id]['color']					=	$ic_color;
					$new_instance['wpmw'][$unique_id]['link']						=	$ic_link;
					$new_instance['wpmw'][$unique_id]['link_url']				=	$ic_link_url;
					$new_instance['wpmw'][$unique_id]['link_color_h']		=	$ic_link_color_h;
				}
			}
		}
	
		return $new_instance;
	}
	
	//sanitization for input fields
	private function wp_master_widget_sanitize_html( $arr ){
		$clean = array();
		if( is_array( $arr ) ){
			foreach( $arr as $key => $val ){
				$clean[$key] = wp_kses_post( force_balance_tags( $val ) );
			}
		}
		
		return $clean;
	}
	
	/**
	 * Returns HTML for Widget Title Object
	 *
	 * @since    1.0.0
	 */
	public function wpmw_ajax_make_widget_object(){
		$ajax_nonce = $_REQUEST['ajax_nonce'];
		
		if( !wp_verify_nonce( $ajax_nonce, 'wpmw-widget-control-nonce' ) ){
			$return_output = array(
				'result'	=>	'failed',
				'output'	=>	'Check Session Security - Nonce Validation Failed'
			);
			die( json_encode( $return_output ) );
		} else {
			//only allows letters
			$type = sanitize_html_class( $_REQUEST['wpmw_type'] );
			$type = preg_replace( '/[^a-z]/', '', $type ); // Only letters allowed in small caps
			
			//only allows letters, numbers, underscore, dash, and square brackets
			$name = sanitize_text_field( $_REQUEST['wpmw_name'] );
			$name = preg_replace( '/[^a-zA-Z0-9-_\]\[]/', '', $name ); 
			
			$unique_id = substr( md5( uniqid( rand(), true ) ),0,6 );// creates a 6 digit token
			$unique_id = substr( $type, 0, 2 ) . $unique_id;
			
			$html_output = '
				<div class="wpmw-widget-panel">
					<h3 class="wpmw-widget-header"><i class="fa fa-bars wpmw-control-move" aria-hidden="true"></i>' . $type . '<i class="fa fa-window-close wpmw-control-remove" aria-hidden="true"></i></h3>
					<div class="wpmw-widget-settings">
			';
			if( $type == 'title' ){
				$html_output .= $this->wpmw_control_title( $name, $unique_id );
			} elseif( $type == 'text' ){
				$html_output .= $this->wpmw_control_text( $name, $unique_id );
			} elseif( $type == 'image' ){
				$html_output .= $this->wpmw_control_image( $name, $unique_id );
			} elseif( $type == 'icon' ){
				$html_output .= $this->wpmw_control_icon( $name, $unique_id );
			} 
			$html_output .= '	
					</div>
				</div>
			';
			$return_output = array(
				'result'		=>	'success',
				'output'	=> 	$html_output
			);
			echo json_encode( $return_output );
			die();
		}
	}
	
	/*
	 *	Icon Widget Settings
	 */
	private function wpmw_control_icon( $name, $unique_id, $data = array() ){
		$name = $name . '[' . $unique_id . ']';
		if( empty( $data ) ){
			$order							= '';
			$ic_icon_class			= '';
			$ic_size						= '5';
			$ic_unit						= 'rem';
			$ic_class						= '';
			$ic_align						= 'center';
			$ic_margin_top			= '';
			$ic_margin_right		= '';
			$ic_margin_bottom		= '';
			$ic_margin_left			= '';
			$ic_margin_unit			= 'rem';
			$ic_color						= '#000000';
			$ic_link						= 'no';
			$ic_link_url				= '';
			$ic_link_color_h		= '#4169e1';
		} else {
			$order							= $data['order'];
			$ic_icon_class			= $data['icon_class'];
			$ic_size						= $data['size'];
			$ic_unit						= $data['unit'];
			$ic_class						= $data['class'];
			$ic_align						= $data['align'];
			$ic_margin_top			= $data['margin_top'];
			$ic_margin_right		= $data['margin_right'];
			$ic_margin_bottom		= $data['margin_bottom'];
			$ic_margin_left			= $data['margin_left'];
			$ic_margin_unit			= $data['margin_unit'];
			$ic_color						= $data['color'];
			$ic_link						= $data['link'];
			$ic_link_url				= $data['link_url'];
			$ic_link_color_h		= $data['link_color_h'];
		}

		$preview_text = '<span class="wpmw-widget-icon-label">' . __( 'Select Icon', 'wp-master-widget' ) . '</span>';
		if( !empty( $ic_icon_class ) ){
			$preview_text = '<i class="fa fa-' . $ic_icon_class . '" aria-hidden="true"></i>';
		}
		
		$html_output = '
			<input type="hidden" class="wpmw-widget-order" name="' . $name . '[order]" value="' . $order . '" />
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Selected Icon', 'wp-master-widget' ) . '</label>
				<div class="wpmw-widget-icon-preview">' . $preview_text . '</div>
				<div class="wpmw-widget-icon-control-button wpmw-widget-icon-add">' . __( 'Select Icon', 'wp-master-widget' ) . '</div>
				<div class="wpmw-widget-icon-control-button wpmw-widget-icon-remove">' . __( 'Remove', 'wp-master-widget' ) . '</div>
				<input type="hidden" class="wpmw-widget-icon-class" name="' . $name . '[icon_class]" value="' . $ic_icon_class . '" />
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-inline">
					<strong class="wpmw-widget-block">' . __( 'Icon Size', 'wp-master-widget' ) . '</strong>
					<input type="number" min="0.1" step="0.1" class="wpmw-widget-input wpmw-widget-font-size wpmw-widget-block" name="' . $name . '[size]" value="' . $ic_size	 . '" />
				</label>
				<label class="wpmw-widget-inline">
					<strong class="wpmw-widget-block">' . __( 'Unit', 'wp-master-widget' ) . '</strong>
					<select class="wpmw-widget-select wpmw-widget-icon-unit wpmw-widget-block" name="' . $name . '[unit]">
						<option value="rem"' . selected( $ic_unit, 'rem', false ) . '>rem</option>
						<option value="em"' . selected( $ic_unit, 'em', false ) . '>em</option>
						<option value="px"' . selected( $ic_unit, 'px', false ) . '>px</option>
					</select>
				</label>
				<label class="wpmw-widget-inline">
					<strong class="wpmw-widget-block">' . __( 'Custom Class', 'wp-master-widget' ) . '</strong>
					<input type="text" class="wpmw-widget-input wpmw-widget-icon-class wpmw-widget-block" name="' . $name . '[class]" value="' . $ic_class . '" />
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Icon Alignment', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-radio">
					<input type="radio" name="' . $name . '[align]" value="left"' . checked( $ic_align, 'left', false ) . '> ' . __( 'Left', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" name="' . $name . '[align]" value="center"' . checked( $ic_align, 'center', false ) . '> ' . __( 'Center', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" name="' . $name . '[align]" value="right"' . checked( $ic_align, 'right', false ) . '> ' . __( 'Right', 'wp-master-widget' ) . '
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Margins', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Top', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.1" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_top]" value="' . $ic_margin_top . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Right', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.1" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_right]" value="' . $ic_margin_right . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Bottom', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.1" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_bottom]" value="' . $ic_margin_bottom . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Left', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.1" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_left]" value="' . $ic_margin_left . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Unit', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-margin-unit wpmw-widget-block" name="' . $name . '[margin_unit]">
						<option value="rem"' . selected( $ic_margin_unit, 'rem', false ) . '>rem</option>
						<option value="em"' . selected( $ic_margin_unit, 'em', false ) . '>em</option>
						<option value="px"' . selected( $ic_margin_unit, 'px', false ) . '>px</option>
					</select>
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Icon Color', 'wp-master-widget' ) . '</label>
				<input type="text" class="wpmw-widget-color" data-alpha="true" name="' . $name . '[color]" value="' . $ic_color . '" />
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Hyperlink', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-radio">
					<input type="radio" class="wpmw-widget-link-option" name="' . $name . '[link]" value="no"' . checked( $ic_link, 'no', false ) . '> ' . __( 'No', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" class="wpmw-widget-link-option" name="' . $name . '[link]" value="yes"' . checked( $ic_link, 'yes', false ) . '> ' . __( 'Yes', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" class="wpmw-widget-link-option" name="' . $name . '[link]" value="new"' . checked( $ic_link, 'new', false ) . '> ' . __( 'Yes - New Window', 'wp-master-widget' ) . '
				</label>
			</div>
			<div class="wpmw-widget-link-conditional" style="display:none;">
				<div class="wpmw-widget-option">
					<label class="wpmw-widget-label">' . __( 'Link URL', 'wp-master-widget' ) . '</label>
					<input type="text" class="wpmw-widget-input wpmw-widget-link-url wpmw-widget-block" name="' . $name . '[link_url]" value="' . $ic_link_url . '" />
				</div>
				<div class="wpmw-widget-option">
					<label class="wpmw-widget-label">' . __( 'Icon Hover Color', 'wp-master-widget' ) . '</label>
					<input type="text" class="wpmw-widget-color" data-alpha="true" name="' . $name . '[link_color_h]" value="' . $ic_link_color_h . '" />
				</div>
			</div>
		';

		return $html_output;
	}

	/*
	 *	Image Widget Settings
	 */
	private function wpmw_control_image( $name, $unique_id, $data = array() ){
		$name = $name . '[' . $unique_id . ']';
		if( empty( $data ) ){ //set defaults here
			$order 							= '';
			$im_image_url 			= '';
			$im_image_thumb 		= '';
			$im_alt_text 				= '';
			$im_class 					= '';
			$im_align 					= 'center';
			$im_blur 						= '';
			$im_brightness 			= '';
			$im_contrast 				= '';
			$im_grayscale 			= '';
			$im_huerotate 			= '';
			$im_invert 					= '';
			$im_opacity 				= '';
			$im_saturate 				= '';
			$im_sepia 					= '';
			$im_rotate 					= '';
			$im_margin_top 			= '';
			$im_margin_right 		= '';
			$im_margin_bottom 	= '';
			$im_margin_left 		= '';
			$im_margin_unit 		= '';
			$im_width 					= '100';
			$im_unit 						= 'percent';
			$im_link 						= 'no';
			$im_link_url				= '';
			$im_hover 					= 'no';
			$im_delay 					= '';
			$im_duration 				= '';
			$im_timing 					= '';
			$im_blur_h 					= '';
			$im_brightness_h 		= '';
			$im_contrast_h 			= '';
			$im_grayscale_h 		= '';
			$im_huerotate_h 		= '';
			$im_invert_h 				= '';
			$im_opacity_h 			= '';
			$im_saturate_h 			= '';
			$im_sepia_h 				= '';
			$im_rotate_h 				= '';
		} else {
			$order							= $data['order'];
			$im_image_url 			=	$data['image_url'];
			$im_image_thumb 		=	$data['image_thumb'];
			$im_alt_text 				=	$data['alt_text'];
			$im_class 					=	$data['class'];
			$im_align 					=	$data['align'];
			$im_blur 						=	$data['blur'];
			$im_brightness 			=	$data['brightness'];
			$im_contrast 				=	$data['contrast'];
			$im_grayscale 			=	$data['grayscale'];
			$im_huerotate 			=	$data['huerotate'];
			$im_invert 					=	$data['invert'];
			$im_opacity 				=	$data['opacity'];
			$im_saturate 				=	$data['saturate'];
			$im_sepia 					=	$data['sepia'];
			$im_rotate 					=	$data['rotate'];
			$im_margin_top 			=	$data['margin_top'];
			$im_margin_right 		=	$data['margin_right'];
			$im_margin_bottom 	=	$data['margin_bottom'];
			$im_margin_left 		=	$data['margin_left'];
			$im_margin_unit 		=	$data['margin_unit'];
			$im_width 					=	$data['width'];
			$im_unit 						=	$data['unit'];
			$im_link 						=	$data['link'];
			$im_link_url				=	$data['link_url'];
			$im_hover 					=	$data['hover'];
			$im_delay 					=	$data['delay'];
			$im_duration 				=	$data['duration'];
			$im_timing 					=	$data['timing'];
			$im_blur_h 					=	$data['blur_h'];
			$im_brightness_h 		=	$data['brightness_h'];
			$im_contrast_h 			=	$data['contrast_h'];
			$im_grayscale_h 		=	$data['grayscale_h'];
			$im_huerotate_h 		=	$data['huerotate_h'];
			$im_invert_h 				=	$data['invert_h'];
			$im_opacity_h 			=	$data['opacity_h'];
			$im_saturate_h 			=	$data['saturate_h'];
			$im_sepia_h 				=	$data['sepia_h'];
			$im_rotate_h 				=	$data['rotate_h'];
		}
		
		$preview_text = '<span class="wpmw-widget-image-label">' . __( 'Select Image', 'wp-master-widget' ) . '</span>';
		if( !empty( $im_image_thumb ) ){
			$preview_text = '<img src="' . $im_image_thumb . '" />';
		}
		$html_output = '
			<input type="hidden" class="wpmw-widget-order" name="' . $name . '[order]" value="' . $order . '" />
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Image', 'wp-master-widget' ) . '</label>
				<div class="wpmw-widget-image-preview">' . $preview_text . '</div>
				<div class="wpmw-widget-image-control-button wpmw-widget-image-add">' . __( 'Add Image', 'wp-master-widget' ) . '</div>
				<div class="wpmw-widget-image-control-button wpmw-widget-image-remove">' . __( 'Remove', 'wp-master-widget' ) . '</div>
				<input type="hidden" class="wpmw-widget-image-url" name="' . $name . '[image_url]" value="' . $im_image_url . '" />
				<input type="hidden" class="wpmw-widget-image-thumb" name="' . $name . '[image_thumb]" value="' . $im_image_thumb . '" />
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-inline">
					<strong class="wpmw-widget-block">' . __( 'Alt Text', 'wp-master-widget' ) . '</strong>
					<input type="text" class="wpmw-widget-input wpmw-widget-text-class wpmw-widget-block" name="' . $name . '[alt_text]" value="' . $im_alt_text . '" />
				</label>
				<label class="wpmw-widget-inline">
					<strong class="wpmw-widget-block">' . __( 'Custom Class', 'wp-master-widget' ) . '</strong>
					<input type="text" class="wpmw-widget-input wpmw-widget-text-class wpmw-widget-block" name="' . $name . '[class]" value="' . $im_class . '" />
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Alignment', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-radio">
					<input type="radio" name="' . $name . '[align]" value="left"' . checked( $im_align, 'left', false ) . '> ' . __( 'Left', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" name="' . $name . '[align]" value="center"' . checked( $im_align, 'center', false ) . '> ' . __( 'Center', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" name="' . $name . '[align]" value="right"' . checked( $im_align, 'right', false ) . '> ' . __( 'Right', 'wp-master-widget' ) . '
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Effects', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-inline wpmw-option-series">
					<span class="wpmw-widget-block">' . __( 'Blur (px)', 'wp-master-widget' ) . '</span>
					<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[blur]" min="0" max="1000" step="1" value="' . $im_blur . '" />
				</label>
				<label class="wpmw-widget-inline wpmw-option-series">
					<span class="wpmw-widget-block">' . __( 'Brightness (%)', 'wp-master-widget' ) . '</span>
					<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[brightness]" min="0" max="1000" step="5" value="' . $im_brightness . '" />
				</label>
				<label class="wpmw-widget-inline wpmw-option-series">
					<span class="wpmw-widget-block">' . __( 'Contrast (%)', 'wp-master-widget' ) . '</span>
					<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[contrast]" min="0" max="1000" step="5" value="' . $im_contrast . '" />
				</label>
				<label class="wpmw-widget-inline wpmw-option-series">
					<span class="wpmw-widget-block">' . __( 'Grayscale (%)', 'wp-master-widget' ) . '</span>
					<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[grayscale]" min="0" max="1000" step="5" value="' . $im_grayscale . '" />
				</label>
				<label class="wpmw-widget-inline wpmw-option-series">
					<span class="wpmw-widget-block">' . __( 'Hue Rotate (deg)', 'wp-master-widget' ) . '</span>
					<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[huerotate]" min="0" max="360" step="5" value="' . $im_huerotate . '" />
				</label>
				<label class="wpmw-widget-inline wpmw-option-series">
					<span class="wpmw-widget-block">' . __( 'Invert (%)', 'wp-master-widget' ) . '</span>
					<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[invert]" min="0" max="1000" step="5" value="' . $im_invert . '" />
				</label>
				<label class="wpmw-widget-inline wpmw-option-series">
					<span class="wpmw-widget-block">' . __( 'Opacity (%)', 'wp-master-widget' ) . '</span>
					<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[opacity]" min="0" max="100" step="5" value="' . $im_opacity . '" />
				</label>
				<label class="wpmw-widget-inline wpmw-option-series">
					<span class="wpmw-widget-block">' . __( 'Saturate (%)', 'wp-master-widget' ) . '</span>
					<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[saturate]" min="0" max="1000" step="5" value="' . $im_saturate . '" />
				</label>
				<label class="wpmw-widget-inline wpmw-option-series">
					<span class="wpmw-widget-block">' . __( 'Sepia (%)', 'wp-master-widget' ) . '</span>
					<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[sepia]" min="0" max="100" step="5" value="' . $im_sepia . '" />
				</label>
				<label class="wpmw-widget-inline wpmw-option-series">
					<span class="wpmw-widget-block">' . __( 'Rotate (deg)', 'wp-master-widget' ) . '</span>
					<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[rotate]" min="-360" max="360" step="5" value="' . $im_rotate . '" />
				</label>
				<p class="wpmw-widget-option-desc">' . __( 'Leave the fields blank to disable the effects.', 'wp-master-widget' ) . '</p>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Margins', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Top', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.1" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_top]" value="' . $im_margin_top . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Right', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.1" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_right]" value="' . $im_margin_right . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Bottom', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.1" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_bottom]" value="' . $im_margin_bottom . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Left', 'wp-master-widget' ) . '</span>
					<input type="number" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_left]" value="' . $im_margin_left . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Unit', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-margin-unit wpmw-widget-block" name="' . $name . '[margin_unit]">
						<option value="rem"' . selected( $im_margin_unit, 'rem', false ) . '>rem</option>
						<option value="em"' . selected( $im_margin_unit, 'em', false ) . '>em</option>
						<option value="px"' . selected( $im_margin_unit, 'px', false ) . '>px</option>
					</select>
				</label>
				<p class="wpmw-widget-option-desc">' . __( 'Set value to 0.0 to use "auto" for margin. Leaving this field blank will not make any changes to the margin settings.', 'wp-master-widget' ) . '</p>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-inline">
					<strong class="wpmw-widget-block">' . __( 'Image Width', 'wp-master-widget' ) . '</strong>
					<input type="number" min="1" step="1" class="wpmw-widget-input wpmw-widget-font-size wpmw-widget-block" name="' . $name . '[width]" value="' . $im_width . '" />
				</label>
				<label class="wpmw-widget-inline">
					<strong class="wpmw-widget-block">' . __( 'Unit', 'wp-master-widget' ) . '</strong>
					<select class="wpmw-widget-select wpmw-widget-text-unit wpmw-widget-block" name="' . $name . '[unit]">
						<option value="percent"' . selected( $im_unit, 'percent', false ) . '>%</option>
						<option value="rem"' . selected( $im_unit, 'rem', false ) . '>rem</option>
						<option value="em"' . selected( $im_unit, 'em', false ) . '>em</option>
						<option value="px"' . selected( $im_unit, 'px', false ) . '>px</option>
					</select>
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Hyperlink', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-radio">
					<input type="radio" class="wpmw-widget-link-option" name="' . $name . '[link]" value="no"' . checked( $im_link, 'no', false ) . '> ' . __( 'No', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" class="wpmw-widget-link-option" name="' . $name . '[link]" value="yes"' . checked( $im_link, 'yes', false ) . '> ' . __( 'Yes', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" class="wpmw-widget-link-option" name="' . $name . '[link]" value="new"' . checked( $im_link, 'new', false ) . '> ' . __( 'Yes - New Window', 'wp-master-widget' ) . '
				</label>
			</div>
			<div class="wpmw-widget-link-conditional" style="display:none;">
				<div class="wpmw-widget-option">
					<label class="wpmw-widget-label">' . __( 'Link URL', 'wp-master-widget' ) . '</label>
					<input type="text" class="wpmw-widget-input wpmw-widget-link-url wpmw-widget-block" name="' . $name . '[link_url]" value="' . $im_link_url . '" />
				</div>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Hover Effects', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-radio">
					<input type="radio" class="wpmw-widget-hover-option" name="' . $name . '[hover]" value="no"' . checked( $im_hover, 'no', false ) . '> ' . __( 'No', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" class="wpmw-widget-hover-option" name="' . $name . '[hover]" value="yes"' . checked( $im_hover, 'yes', false ) . '> ' . __( 'Yes', 'wp-master-widget' ) . '
				</label>
			</div>
			<div class="wpmw-widget-hover-conditional" style="display:none;">
				<div class="wpmw-widget-option">
					<label class="wpmw-widget-label">' . __( 'Transition Options', 'wp-master-widget' ) . '</label>
					<label class="wpmw-widget-inline">
						<span class="wpmw-widget-block">' . __( 'Delay', 'wp-master-widget' ) . '</span>
						<input type="number" min="0" step="0.1" class="wpmw-widget-input wpmw-widget-font-size wpmw-widget-block" name="' . $name . '[delay]" value="' . $im_delay . '" />
					</label>
					<label class="wpmw-widget-inline">
						<span class="wpmw-widget-block">' . __( 'Duration', 'wp-master-widget' ) . '</span>
						<input type="number" min="0" step="0.1" class="wpmw-widget-input wpmw-widget-font-size wpmw-widget-block" name="' . $name . '[duration]" value="' . $im_duration . '" />
					</label>
					<label class="wpmw-widget-inline">
						<span class="wpmw-widget-block">' . __( 'Timing', 'wp-master-widget' ) . '</span>
						<select class="wpmw-widget-select wpmw-widget-text-unit wpmw-widget-block" name="' . $name . '[timing]">
							<option value="ease"' . selected( $im_timing, 'ease', false ) . '>ease</option>
							<option value="linear"' . selected( $im_timing, 'linear', false ) . '>linear</option>
							<option value="ease-in"' . selected( $im_timing, 'ease-in', false ) . '>ease-in</option>
							<option value="ease-out"' . selected( $im_timing, 'ease-out', false ) . '>ease-out</option>
							<option value="ease-in-out"' . selected( $im_timing, 'ease-in-out', false ) . '>ease-in-out</option>
						</select>
					</label>
					<p class="wpmw-widget-option-desc">' . __( 'Delay and duration values are in seconds.', 'wp-master-widget' ) . '</p>
				</div>
				<div class="wpmw-widget-option">
					<label class="wpmw-widget-label">' . __( 'Hover Transition Effects', 'wp-master-widget' ) . '</label>
					<label class="wpmw-widget-inline wpmw-option-series">
						<span class="wpmw-widget-block">' . __( 'Blur (px)', 'wp-master-widget' ) . '</span>
						<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[blur_h]" min="0" max="1000" step="1" value="' . $im_blur_h . '" />
					</label>
					<label class="wpmw-widget-inline wpmw-option-series">
						<span class="wpmw-widget-block">' . __( 'Brightness (%)', 'wp-master-widget' ) . '</span>
						<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[brightness_h]" min="0" max="1000" step="5" value="' . $im_brightness_h . '" />
					</label>
					<label class="wpmw-widget-inline wpmw-option-series">
						<span class="wpmw-widget-block">' . __( 'Contrast (%)', 'wp-master-widget' ) . '</span>
						<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[contrast_h]" min="0" max="1000" step="5" value="' . $im_contrast_h . '" />
					</label>
					<label class="wpmw-widget-inline wpmw-option-series">
						<span class="wpmw-widget-block">' . __( 'Grayscale (%)', 'wp-master-widget' ) . '</span>
						<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[grayscale_h]" min="0" max="1000" step="5" value="' . $im_grayscale_h . '" />
					</label>
					<label class="wpmw-widget-inline wpmw-option-series">
						<span class="wpmw-widget-block">' . __( 'Hue Rotate (deg)', 'wp-master-widget' ) . '</span>
						<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[huerotate_h]" min="0" max="360" step="5" value="' . $im_huerotate_h . '" />
					</label>
					<label class="wpmw-widget-inline wpmw-option-series">
						<span class="wpmw-widget-block">' . __( 'Invert (%)', 'wp-master-widget' ) . '</span>
						<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[invert_h]" min="0" max="1000" step="5" value="' . $im_invert_h . '" />
					</label>
					<label class="wpmw-widget-inline wpmw-option-series">
						<span class="wpmw-widget-block">' . __( 'Opacity (%)', 'wp-master-widget' ) . '</span>
						<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[opacity_h]" min="0" max="100" step="5" value="' . $im_opacity_h . '" />
					</label>
					<label class="wpmw-widget-inline wpmw-option-series">
						<span class="wpmw-widget-block">' . __( 'Saturate (%)', 'wp-master-widget' ) . '</span>
						<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[saturate_h]" min="0" max="1000" step="5" value="' . $im_saturate_h . '" />
					</label>
					<label class="wpmw-widget-inline wpmw-option-series">
						<span class="wpmw-widget-block">' . __( 'Sepia (%)', 'wp-master-widget' ) . '</span>
						<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[sepia_h]" min="0" max="100" step="5" value="' . $im_sepia_h . '" />
					</label>
					<label class="wpmw-widget-inline wpmw-option-series">
						<span class="wpmw-widget-block">' . __( 'Rotate (deg)', 'wp-master-widget' ) . '</span>
						<input type="number" class="wpmw-widget-input wpmw-widget-image-effect wpmw-widget-block" name="' . $name . '[rotate_h]" min="-360" max="360" step="5" value="' . $im_rotate_h . '" />
					</label>
					<p class="wpmw-widget-option-desc">' . __( 'Leave the fields blank to disable the effects.', 'wp-master-widget' ) . '</p>
				</div>
			</div>
		';
	
		return $html_output;
	}
	
	
	/*
	 *	Text Widget Settings
	 *
	 *	[order] => 
	 *	[content] => 
	 *	[align] =>
	 *	[class] => 
	 *	[size] => 
	 *	[unit] => 
	 *	[weight] => 
	 *	[style] => 
	 *	[decoration] => 
	 *	[color] =>
	 *	[link_color] =>
	 */
	private function wpmw_control_text( $name, $unique_id, $data = array() ){
		$name = $name . '[' . $unique_id . ']';
		if( empty( $data ) ){ //set defaults here
			$order						= '';
			$te_content				= '';
			$te_tag						= 'h3';
			$te_class					= '';
			$te_align					= 'left';
			$te_margin_top		= '';
			$te_margin_right	= '';
			$te_margin_bottom	= '';
			$te_margin_left		= '';
			$te_margin_unit		= 'rem';
			$te_size					= '1';
			$te_line_height		=	'1.5';
			$te_unit					= 'rem';
			$te_weight				= 'normal';
			$te_style					= 'normal';
			$te_decoration		= 'none';
			$te_color					= '#000000';
			$te_link_color		= '#000000';
			$te_link_color_h	= '#4169e1';
			$te_weight_h			= 'normal';
			$te_style_h				= 'normal';
			$te_decoration_h	= 'none';
		} else {
			$order						= $data['order'];
			$te_content				= $data['content'];
			$te_tag						= $data['tag'];
			$te_class					= $data['class'];
			$te_align					= $data['align'];
			$te_margin_top		= $data['margin_top'];
			$te_margin_right	= $data['margin_right'];
			$te_margin_bottom	= $data['margin_bottom'];
			$te_margin_left		= $data['margin_left'];
			$te_margin_unit		= $data['margin_unit'];
			$te_size					= $data['size'];
			$te_line_height		=	$data['line_height'];
			$te_unit					= $data['unit'];
			$te_weight				= $data['weight'];
			$te_style					= $data['style'];
			$te_decoration		= $data['decoration'];
			$te_color					= $data['color'];
			$te_link_color		= $data['link_color'];
			$te_link_color_h	= $data['link_color_h'];
			$te_weight_h			= $data['weight_h'];
			$te_style_h				= $data['style_h'];
			$te_decoration_h	= $data['decoration_h'];
		}

		$html_output = '
			<input type="hidden" class="wpmw-widget-order" name="' . $name . '[order]" value="' . $order . '" />
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Input Text', 'wp-master-widget' ) . '</label>
				<p class="wpmw-widget-option-desc">' . __( '(You can use "shortcode".)', 'wp-master-widget' ) . '</p>
				<textarea type="text" class="wpmw-widget-textarea wpmw-widget-content" name="' . $name . '[content]" rows="6">' . $te_content . '</textarea>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-inline">
					<strong class="wpmw-widget-block">' . __( 'Tag', 'wp-master-widget' ) . '</strong>
					<select class="wpmw-widget-select wpmw-widget-text-tag wpmw-widget-block" name="' . $name . '[tag]">
						<option value="p"' . selected( $te_tag, 'p', false ) . '>p</option>
						<option value="div"' . selected( $te_tag, 'h2', false ) . '>div</option>
						<option value="section"' . selected( $te_tag, 'section', false ) . '>Section</option>
					</select>
				</label>
				<label class="wpmw-widget-inline">
					<strong class="wpmw-widget-block">' . __( 'Custom Class', 'wp-master-widget' ) . '</strong>
					<input type="text" class="wpmw-widget-input wpmw-widget-text-class wpmw-widget-block" name="' . $name . '[class]" value="' . $te_class . '" />
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Text Alignment', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-radio">
					<input type="radio" name="' . $name . '[align]" value="left"' . checked( $te_align, 'left', false ) . '> ' . __( 'Left', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" name="' . $name . '[align]" value="center"' . checked( $te_align, 'center', false ) . '> ' . __( 'Center', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" name="' . $name . '[align]" value="right"' . checked( $te_align, 'right', false ) . '> ' . __( 'Right', 'wp-master-widget' ) . '
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Margins', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Top', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.5" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_top]" value="' . $te_margin_top . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Right', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.5" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_right]" value="' . $te_margin_right . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Bottom', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.5" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_bottom]" value="' . $te_margin_bottom . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Left', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.5" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_left]" value="' . $te_margin_left . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Unit', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-margin-unit wpmw-widget-block" name="' . $name . '[margin_unit]">
						<option value="rem"' . selected( $te_margin_unit, 'rem', false ) . '>rem</option>
						<option value="em"' . selected( $te_margin_unit, 'em', false ) . '>em</option>
						<option value="px"' . selected( $te_margin_unit, 'px', false ) . '>px</option>
					</select>
				</label>
				<p class="wpmw-widget-option-desc">' . __( 'Set value to 0.0 to use "auto" for margin. Leaving this field blank will not make any changes to the margin settings.', 'wp-master-widget' ) . '</p>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Font Sizing', 'wp-master-widget' ) . '</label>
					<label class="wpmw-widget-inline">
						<span class="wpmw-widget-block">' . __( 'Font Size', 'wp-master-widget' ) . '</span>
						<input type="number" min="0.1" step="0.5" class="wpmw-widget-input wpmw-widget-font-size wpmw-widget-block" name="' . $name . '[size]" value="' . $te_size . '" />
					</label>
					<label class="wpmw-widget-inline">
						<span class="wpmw-widget-block">' . __( 'Line Height', 'wp-master-widget' ) . '</span>
						<input type="number" min="0.1" step="0.5" class="wpmw-widget-input wpmw-widget-line-height wpmw-widget-block" name="' . $name . '[line_height]" value="' . $te_line_height . '" />
					</label>
					<label class="wpmw-widget-inline">
						<span class="wpmw-widget-block">' . __( 'Unit', 'wp-master-widget' ) . '</span>
						<select class="wpmw-widget-select wpmw-widget-text-unit wpmw-widget-block" name="' . $name . '[unit]">
							<option value="rem"' . selected( $te_unit, 'rem', false ) . '>rem</option>
							<option value="em"' . selected( $te_unit, 'em', false ) . '>em</option>
							<option value="px"' . selected( $te_unit, 'px', false ) . '>px</option>
						</select>
					</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Font Styles', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Weight', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-text-unit wpmw-widget-block" name="' . $name . '[weight]">
						<option value="normal"' . selected( $te_weight, 'normal', false ) . '>normal</option>
						<option value="bold"' . selected( $te_weight, 'bold', false ) . '>bold</option>
						<option value="bolder"' . selected( $te_weight, 'bolder', false ) . '>bolder</option>
						<option value="lighter"' . selected( $te_weight, 'lighter', false ) . '>lighter</option>
						<option value="100"' . selected( $te_weight, '100', false ) . '>100</option>
						<option value="200"' . selected( $te_weight, '200', false ) . '>200</option>
						<option value="300"' . selected( $te_weight, '300', false ) . '>300</option>
						<option value="400"' . selected( $te_weight, '400', false ) . '>400</option>
						<option value="500"' . selected( $te_weight, '500', false ) . '>500</option>
						<option value="600"' . selected( $te_weight, '600', false ) . '>600</option>
						<option value="700"' . selected( $te_weight, '700', false ) . '>700</option>
						<option value="800"' . selected( $te_weight, '800', false ) . '>800</option>
						<option value="900"' . selected( $te_weight, '900', false ) . '>900</option>
					</select>
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Style', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-text-unit wpmw-widget-block" name="' . $name . '[style]">
						<option value="normal"' . selected( $te_style, 'normal', false ) . '>normal</option>
						<option value="italic"' . selected( $te_style, 'italic', false ) . '>italic</option>
						<option value="oblique"' . selected( $te_style, 'oblique', false ) . '>oblique</option>
					</select>
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Decoration', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-text-unit wpmw-widget-block" name="' . $name . '[decoration]">
						<option value="none"' . selected( $te_decoration, 'none', false ) . '>none</option>
						<option value="underline"' . selected( $te_decoration, 'underline', false ) . '>underline</option>
						<option value="overline"' . selected( $te_decoration, 'overline', false ) . '>overline</option>
						<option value="line-through"' . selected( $te_decoration, 'line-through', false ) . '>line-through</option>
					</select>
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Font Color', 'wp-master-widget' ) . '</label>
				<input type="text" class="wpmw-widget-color" data-alpha="true" name="' . $name . '[color]" value="' . $te_color . '" />
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-inline">
					<strong class="wpmw-widget-block">' . __( 'Link Color', 'wp-master-widget' ) . '</strong>
					<input type="text" class="wpmw-widget-color" name="' . $name . '[link_color]" value="' . $te_link_color . '" />
				</label>
				<label class="wpmw-widget-inline">
					<strong class="wpmw-widget-block">' . __( 'Link Hover Color', 'wp-master-widget' ) . '</strong>
					<input type="text" class="wpmw-widget-color" name="' . $name . '[link_color_h]" value="' . $te_link_color_h . '" />
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Link Hover Styles', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Weight', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-block" name="' . $name . '[weight_h]">
						<option value="normal"' . selected( $te_weight_h, 'normal', false ) . '>normal</option>
						<option value="bold"' . selected( $te_weight_h, 'bold', false ) . '>bold</option>
						<option value="bolder"' . selected( $te_weight_h, 'bolder', false ) . '>bolder</option>
						<option value="lighter"' . selected( $te_weight_h, 'lighter', false ) . '>lighter</option>
						<option value="100"' . selected( $te_weight_h, '100', false ) . '>100</option>
						<option value="200"' . selected( $te_weight_h, '200', false ) . '>200</option>
						<option value="300"' . selected( $te_weight_h, '300', false ) . '>300</option>
						<option value="400"' . selected( $te_weight_h, '400', false ) . '>400</option>
						<option value="500"' . selected( $te_weight_h, '500', false ) . '>500</option>
						<option value="600"' . selected( $te_weight_h, '600', false ) . '>600</option>
						<option value="700"' . selected( $te_weight_h, '700', false ) . '>700</option>
						<option value="800"' . selected( $te_weight_h, '800', false ) . '>800</option>
						<option value="900"' . selected( $te_weight_h, '900', false ) . '>900</option>
					</select>
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Style', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-text-unit wpmw-widget-block" name="' . $name . '[style_h]">
						<option value="normal"' . selected( $te_style_h, 'normal', false ) . '>normal</option>
						<option value="italic"' . selected( $te_style_h, 'italic', false ) . '>italic</option>
						<option value="oblique"' . selected( $te_style_h, 'oblique', false ) . '>oblique</option>
					</select>
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Decoration', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-text-unit wpmw-widget-block" name="' . $name . '[decoration_h]">
						<option value="none"' . selected( $te_decoration_h, 'none', false ) . '>none</option>
						<option value="underline"' . selected( $te_decoration_h, 'underline', false ) . '>underline</option>
						<option value="overline"' . selected( $te_decoration_h, 'overline', false ) . '>overline</option>
						<option value="line-through"' . selected( $te_decoration_h, 'line-through', false ) . '>line-through</option>
					</select>
				</label>
			</div>
		';
		return $html_output;
	}
	
	/*
	 *	Title Widget Settings
	 *
	 *	[order] => 
	 *	[content] => 
	 *	[align] =>
	 *	[tag] =>
	 *	[class] => 
	 *	[size] => 
	 *	[unit] => 
	 *	[weight] => 
	 *	[style] => 
	 *	[decoration] => 
	 *	[color] =>
	 *	[link] => 
	 *	[link_url] => 
	 *	[link_color] =>
	 */
	private function wpmw_control_title( $name, $unique_id, $data = array() ){
		$name = $name . '[' . $unique_id . ']';
		if( empty( $data ) ){ //set defaults here
			$order						= '';
			$ti_content				= '';
			$ti_tag						= 'h3';
			$ti_class					= '';
			$ti_align					= 'left';
			$ti_margin_top		= '';
			$ti_margin_right	= '';
			$ti_margin_bottom	= '';
			$ti_margin_left		= '';
			$ti_margin_unit		= 'rem';
			$ti_size					= '1';
			$ti_line_height		=	'1.5';
			$ti_unit					= 'rem';
			$ti_weight				= 'normal';
			$ti_style					= 'normal';
			$ti_decoration		= 'none';
			$ti_color					= '#000000';
			$ti_link					= 'no';
			$ti_link_url			= '';
			$ti_link_color_h	= '#4169e1';
			$ti_weight_h			= 'normal';
			$ti_style_h				= 'normal';
			$ti_decoration_h	= 'none';
		} else {
			$order						= $data['order'];
			$ti_content				= $data['content'];
			$ti_tag						= $data['tag'];
			$ti_class					= $data['class'];
			$ti_align					= $data['align'];
			$ti_margin_top		= $data['margin_top'];
			$ti_margin_right	= $data['margin_right'];
			$ti_margin_bottom	= $data['margin_bottom'];
			$ti_margin_left		= $data['margin_left'];
			$ti_margin_unit		= $data['margin_unit'];
			$ti_size					= $data['size'];
			$ti_line_height		=	$data['line_height'];
			$ti_unit					= $data['unit'];
			$ti_weight				= $data['weight'];
			$ti_style					= $data['style'];
			$ti_decoration		= $data['decoration'];
			$ti_color					= $data['color'];
			$ti_link					= $data['link'];
			$ti_link_url			= $data['link_url'];
			$ti_link_color_h	= $data['link_color_h'];
			$ti_weight_h			= $data['weight_h'];
			$ti_style_h				= $data['style_h'];
			$ti_decoration_h	= $data['decoration_h'];
		}
		
		$html_output = '
			<input type="hidden" class="wpmw-widget-order" name="' . $name . '[order]" value="' . $order . '" />
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Input Title', 'wp-master-widget' ) . '</label>
				<input type="text" class="wpmw-widget-input wpmw-widget-content" name="' . $name . '[content]" value="' . $ti_content . '" />
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-inline">
					<strong class="wpmw-widget-block">' . __( 'Tag', 'wp-master-widget' ) . '</strong>
					<select class="wpmw-widget-select wpmw-widget-title-tag wpmw-widget-block" name="' . $name . '[tag]">
						<option value="h1"' . selected( $ti_tag, 'h1', false ) . '>H1</option>
						<option value="h2"' . selected( $ti_tag, 'h2', false ) . '>H2</option>
						<option value="h3"' . selected( $ti_tag, 'h3', false ) . '>H3</option>
						<option value="h4"' . selected( $ti_tag, 'h4', false ) . '>H4</option>
						<option value="h5"' . selected( $ti_tag, 'h5', false ) . '>H5</option>
						<option value="h6"' . selected( $ti_tag, 'h6', false ) . '>H6</option>
						<option value="p"' . selected( $ti_tag, 'p', false ) . '>P</option>
					</select>
				</label>
				<label class="wpmw-widget-inline">
					<strong class="wpmw-widget-block">' . __( 'Custom Class', 'wp-master-widget' ) . '</strong>
					<input type="text" class="wpmw-widget-input wpmw-widget-title-class wpmw-widget-block" name="' . $name . '[class]" value="' . $ti_class . '" />
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Text Alignment', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-radio">
					<input type="radio" name="' . $name . '[align]" value="left"' . checked( $ti_align, 'left', false ) . '"> ' . __( 'Left', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" name="' . $name . '[align]" value="center"' . checked( $ti_align, 'center', false ) . '"> ' . __( 'Center', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" name="' . $name . '[align]" value="right"' . checked( $ti_align, 'right', false ) . '"> ' . __( 'Right', 'wp-master-widget' ) . '
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Margins', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Top', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.5" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_top]" value="' . $ti_margin_top . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Right', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.5" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_right]" value="' . $ti_margin_right . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Bottom', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.5" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_bottom]" value="' . $ti_margin_bottom . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Left', 'wp-master-widget' ) . '</span>
					<input type="number" step="0.5" class="wpmw-widget-input wpmw-widget-margin wpmw-widget-block" name="' . $name . '[margin_left]" value="' . $ti_margin_left . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Unit', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-margin-unit wpmw-widget-block" name="' . $name . '[margin_unit]">
						<option value="rem"' . selected( $ti_margin_unit, 'rem', false ) . '>rem</option>
						<option value="em"' . selected( $ti_margin_unit, 'em', false ) . '>em</option>
						<option value="px"' . selected( $ti_margin_unit, 'px', false ) . '>px</option>
					</select>
				</label>
				<p class="wpmw-widget-option-desc">' . __( 'Set value to 0.0 to use "auto" for margin. Leaving this field blank will not make any changes to the margin settings.', 'wp-master-widget' ) . '</p>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Font Sizing', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Font Size', 'wp-master-widget' ) . '</span>
					<input type="number" min="0.1" step="0.5" class="wpmw-widget-input wpmw-widget-font-size wpmw-widget-block" name="' . $name . '[size]" value="' . $ti_size . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Line Height', 'wp-master-widget' ) . '</span>
					<input type="number" min="0.1" step="0.5" class="wpmw-widget-input wpmw-widget-line-height wpmw-widget-block" name="' . $name . '[line_height]" value="' . $ti_line_height . '" />
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Unit', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-title-unit wpmw-widget-block" name="' . $name . '[unit]">
						<option value="rem"' . selected( $ti_unit, 'rem', false ) . '>rem</option>
						<option value="em"' . selected( $ti_unit, 'em', false ) . '>em</option>
						<option value="px"' . selected( $ti_unit, 'px', false ) . '>px</option>
					</select>
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Font Styles', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Weight', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-title-unit wpmw-widget-block" name="' . $name . '[weight]">
						<option value="normal"' . selected( $ti_weight, 'normal', false ) . '>normal</option>
						<option value="bold"' . selected( $ti_weight, 'bold', false ) . '>bold</option>
						<option value="bolder"' . selected( $ti_weight, 'bolder', false ) . '>bolder</option>
						<option value="lighter"' . selected( $ti_weight, 'lighter', false ) . '>lighter</option>
						<option value="100"' . selected( $ti_weight, '100', false ) . '>100</option>
						<option value="200"' . selected( $ti_weight, '200', false ) . '>200</option>
						<option value="300"' . selected( $ti_weight, '300', false ) . '>300</option>
						<option value="400"' . selected( $ti_weight, '400', false ) . '>400</option>
						<option value="500"' . selected( $ti_weight, '500', false ) . '>500</option>
						<option value="600"' . selected( $ti_weight, '600', false ) . '>600</option>
						<option value="700"' . selected( $ti_weight, '700', false ) . '>700</option>
						<option value="800"' . selected( $ti_weight, '800', false ) . '>800</option>
						<option value="900"' . selected( $ti_weight, '900', false ) . '>900</option>
					</select>
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Style', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-title-unit wpmw-widget-block" name="' . $name . '[style]">
						<option value="normal"' . selected( $ti_style, 'normal', false ) . '>normal</option>
						<option value="italic"' . selected( $ti_style, 'italic', false ) . '>italic</option>
						<option value="oblique"' . selected( $ti_style, 'oblique', false ) . '>oblique</option>
					</select>
				</label>
				<label class="wpmw-widget-inline">
					<span class="wpmw-widget-block">' . __( 'Decoration', 'wp-master-widget' ) . '</span>
					<select class="wpmw-widget-select wpmw-widget-title-unit wpmw-widget-block" name="' . $name . '[decoration]">
						<option value="none"' . selected( $ti_decoration, 'none', false ) . '>none</option>
						<option value="underline"' . selected( $ti_decoration, 'underline', false ) . '>underline</option>
						<option value="overline"' . selected( $ti_decoration, 'overline', false ) . '>overline</option>
						<option value="line-through"' . selected( $ti_decoration, 'line-through', false ) . '>line-through</option>
					</select>
				</label>
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Font Color', 'wp-master-widget' ) . '</label>
				<input type="text" class="wpmw-widget-color" data-alpha="true" name="' . $name . '[color]" value="' . $ti_color . '" />
			</div>
			<div class="wpmw-widget-option">
				<label class="wpmw-widget-label">' . __( 'Hyperlink', 'wp-master-widget' ) . '</label>
				<label class="wpmw-widget-radio">
					<input type="radio" class="wpmw-widget-link-option" name="' . $name . '[link]" value="no"' . checked( $ti_link, 'no', false ) . '> ' . __( 'No', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" class="wpmw-widget-link-option" name="' . $name . '[link]" value="yes"' . checked( $ti_link, 'yes', false ) . '> ' . __( 'Yes', 'wp-master-widget' ) . '
				</label>
				<label class="wpmw-widget-radio">
					<input type="radio" class="wpmw-widget-link-option" name="' . $name . '[link]" value="new"' . checked( $ti_link, 'new', false ) . '> ' . __( 'Yes - New Window', 'wp-master-widget' ) . '
				</label>
			</div>
			<div class="wpmw-widget-link-conditional" style="display:none;">
				<div class="wpmw-widget-option">
					<label class="wpmw-widget-label">' . __( 'Link URL', 'wp-master-widget' ) . '</label>
					<input type="text" class="wpmw-widget-input wpmw-widget-link-url wpmw-widget-block" name="' . $name . '[link_url]" value="' . $ti_link_url . '" />
				</div>
				<div class="wpmw-widget-option">
					<label class="wpmw-widget-label">' . __( 'Link Hover Style', 'wp-master-widget' ) . '</label>
					<label class="wpmw-widget-inline">
						<span class="wpmw-widget-block">' . __( 'Color', 'wp-master-widget' ) . '</span>
						<input type="text" class="wpmw-widget-color" name="' . $name . '[link_color_h]" value="' . $ti_link_color_h . '" />
					</label>
					<label class="wpmw-widget-inline">
						<span class="wpmw-widget-block">' . __( 'Weight', 'wp-master-widget' ) . '</span>
						<select class="wpmw-widget-select wpmw-widget-block" name="' . $name . '[weight_h]">
							<option value="normal"' . selected( $ti_weight_h, 'normal', false ) . '>normal</option>
							<option value="bold"' . selected( $ti_weight_h, 'bold', false ) . '>bold</option>
							<option value="bolder"' . selected( $ti_weight_h, 'bolder', false ) . '>bolder</option>
							<option value="lighter"' . selected( $ti_weight_h, 'lighter', false ) . '>lighter</option>
							<option value="100"' . selected( $ti_weight_h, '100', false ) . '>100</option>
							<option value="200"' . selected( $ti_weight_h, '200', false ) . '>200</option>
							<option value="300"' . selected( $ti_weight_h, '300', false ) . '>300</option>
							<option value="400"' . selected( $ti_weight_h, '400', false ) . '>400</option>
							<option value="500"' . selected( $ti_weight_h, '500', false ) . '>500</option>
							<option value="600"' . selected( $ti_weight_h, '600', false ) . '>600</option>
							<option value="700"' . selected( $ti_weight_h, '700', false ) . '>700</option>
							<option value="800"' . selected( $ti_weight_h, '800', false ) . '>800</option>
							<option value="900"' . selected( $ti_weight_h, '900', false ) . '>900</option>
						</select>
					</label>
					<label class="wpmw-widget-inline">
						<span class="wpmw-widget-block">' . __( 'Style', 'wp-master-widget' ) . '</span>
						<select class="wpmw-widget-select wpmw-widget-block" name="' . $name . '[style_h]">
							<option value="normal"' . selected( $ti_style_h, 'normal', false ) . '>normal</option>
							<option value="italic"' . selected( $ti_style_h, 'italic', false ) . '>italic</option>
							<option value="oblique"' . selected( $ti_style_h, 'oblique', false ) . '>oblique</option>
						</select>
					</label>
					<label class="wpmw-widget-inline">
						<span class="wpmw-widget-block">' . __( 'Decoration', 'wp-master-widget' ) . '</span>
						<select class="wpmw-widget-select wpmw-widget-block" name="' . $name . '[decoration_h]">
							<option value="none"' . selected( $ti_decoration_h, 'none', false ) . '>none</option>
							<option value="underline"' . selected( $ti_decoration_h, 'underline', false ) . '>underline</option>
							<option value="overline"' . selected( $ti_decoration_h, 'overline', false ) . '>overline</option>
							<option value="line-through"' . selected( $ti_decoration_h, 'line-through', false ) . '>line-through</option>
						</select>
					</label>
				</div>
			</div>
		';
		return $html_output;
	}
	
	private function sanitize_html_text_field( $input ){
		if( strlen( trim( $input ) ) < 1){
			return '';
		}
			
		return wp_kses_post( force_balance_tags( $input ) );
	}
	
	//allow alphanumeric, underscore, and dash
	private function sanitize_simple_string_no_html( $input ){
		if( strlen( trim( $input ) ) < 1){
			return '';
		}
		
		return preg_replace( '/[^\w-]/', '', $input );
	}
	
	private function sanitize_multiple_html_classes( $input ){
		if( strlen( trim( $input ) ) < 1 ){
			return '';
		}
		
		$classes = explode( " ", $input );
		$return_input = '';
		foreach( $classes as $class ){
			$return_input .= sanitize_html_class( $class ) . " ";
		}
		
		return trim( $return_input );
	}
	
	private function sanitize_decimal_numbers( $input ){
		if( strlen( trim( $input ) ) < 1 ){
			return '';
		}
		
		return filter_var( $input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
	}
	
	private function sanitize_url_field( $input ){
		if( empty( trim( $input ) ) ){
			return '';
		}
		
		return esc_url( $input );
	}
	
	private function sanitize_color_field( $input ){
		if( empty( trim( $input ) ) ){
			return '';
		}
		
		return filter_var( $input, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW |  FILTER_FLAG_STRIP_HIGH );
	}
	
	/*
	 * Returns HTML contains list of FontAwesome Icons - Version 4.7.0 - Updated 08/15/2017
	 */
	private function display_font_awesome_icons(){
		$html_icons ='
			<section id="web-application">
				<h2 class="page-header">Web Application Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="address-book"><i class="fa fa-address-book" aria-hidden="true"></i> address-book</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="address-book-o"><i class="fa fa-address-book-o" aria-hidden="true"></i> address-book-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="address-card"><i class="fa fa-address-card" aria-hidden="true"></i> address-card</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="address-card-o"><i class="fa fa-address-card-o" aria-hidden="true"></i> address-card-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="adjust"><i class="fa fa-adjust" aria-hidden="true"></i> adjust</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="american-sign-language-interpreting"><i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i> american-sign-language-interpreting</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="anchor"><i class="fa fa-anchor" aria-hidden="true"></i> anchor</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="archive"><i class="fa fa-archive" aria-hidden="true"></i> archive</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="area-chart"><i class="fa fa-area-chart" aria-hidden="true"></i> area-chart</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrows"><i class="fa fa-arrows" aria-hidden="true"></i> arrows</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrows-h"><i class="fa fa-arrows-h" aria-hidden="true"></i> arrows-h</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrows-v"><i class="fa fa-arrows-v" aria-hidden="true"></i> arrows-v</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="american-sign-language-interpreting"><i class="fa fa-asl-interpreting" aria-hidden="true"></i> asl-interpreting <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="assistive-listening-systems"><i class="fa fa-assistive-listening-systems" aria-hidden="true"></i> assistive-listening-systems</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="asterisk"><i class="fa fa-asterisk" aria-hidden="true"></i> asterisk</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="at"><i class="fa fa-at" aria-hidden="true"></i> at</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="audio-description"><i class="fa fa-audio-description" aria-hidden="true"></i> audio-description</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="car"><i class="fa fa-automobile" aria-hidden="true"></i> automobile <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="balance-scale"><i class="fa fa-balance-scale" aria-hidden="true"></i> balance-scale</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="ban"><i class="fa fa-ban" aria-hidden="true"></i> ban</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="university"><i class="fa fa-bank" aria-hidden="true"></i> bank <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bar-chart"><i class="fa fa-bar-chart" aria-hidden="true"></i> bar-chart</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bar-chart"><i class="fa fa-bar-chart-o" aria-hidden="true"></i> bar-chart-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="barcode"><i class="fa fa-barcode" aria-hidden="true"></i> barcode</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bars"><i class="fa fa-bars" aria-hidden="true"></i> bars</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bath"><i class="fa fa-bath" aria-hidden="true"></i> bath</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bath"><i class="fa fa-bathtub" aria-hidden="true"></i> bathtub <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="battery-full"><i class="fa fa-battery" aria-hidden="true"></i> battery <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="battery-empty"><i class="fa fa-battery-0" aria-hidden="true"></i> battery-0 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="battery-quarter"><i class="fa fa-battery-1" aria-hidden="true"></i> battery-1 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="battery-half"><i class="fa fa-battery-2" aria-hidden="true"></i> battery-2 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="battery-three-quarters"><i class="fa fa-battery-3" aria-hidden="true"></i> battery-3 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="battery-full"><i class="fa fa-battery-4" aria-hidden="true"></i> battery-4 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="battery-empty"><i class="fa fa-battery-empty" aria-hidden="true"></i> battery-empty</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="battery-full"><i class="fa fa-battery-full" aria-hidden="true"></i> battery-full</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="battery-half"><i class="fa fa-battery-half" aria-hidden="true"></i> battery-half</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="battery-quarter"><i class="fa fa-battery-quarter" aria-hidden="true"></i> battery-quarter</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="battery-three-quarters"><i class="fa fa-battery-three-quarters" aria-hidden="true"></i> battery-three-quarters</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bed"><i class="fa fa-bed" aria-hidden="true"></i> bed</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="beer"><i class="fa fa-beer" aria-hidden="true"></i> beer</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bell"><i class="fa fa-bell" aria-hidden="true"></i> bell</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bell-o"><i class="fa fa-bell-o" aria-hidden="true"></i> bell-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bell-slash"><i class="fa fa-bell-slash" aria-hidden="true"></i> bell-slash</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bell-slash-o"><i class="fa fa-bell-slash-o" aria-hidden="true"></i> bell-slash-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bicycle"><i class="fa fa-bicycle" aria-hidden="true"></i> bicycle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="binoculars"><i class="fa fa-binoculars" aria-hidden="true"></i> binoculars</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="birthday-cake"><i class="fa fa-birthday-cake" aria-hidden="true"></i> birthday-cake</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="blind"><i class="fa fa-blind" aria-hidden="true"></i> blind</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bluetooth"><i class="fa fa-bluetooth" aria-hidden="true"></i> bluetooth</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bluetooth-b"><i class="fa fa-bluetooth-b" aria-hidden="true"></i> bluetooth-b</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bolt"><i class="fa fa-bolt" aria-hidden="true"></i> bolt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bomb"><i class="fa fa-bomb" aria-hidden="true"></i> bomb</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="book"><i class="fa fa-book" aria-hidden="true"></i> book</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bookmark"><i class="fa fa-bookmark" aria-hidden="true"></i> bookmark</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bookmark-o"><i class="fa fa-bookmark-o" aria-hidden="true"></i> bookmark-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="braille"><i class="fa fa-braille" aria-hidden="true"></i> braille</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="briefcase"><i class="fa fa-briefcase" aria-hidden="true"></i> briefcase</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bug"><i class="fa fa-bug" aria-hidden="true"></i> bug</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="building"><i class="fa fa-building" aria-hidden="true"></i> building</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="building-o"><i class="fa fa-building-o" aria-hidden="true"></i> building-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bullhorn"><i class="fa fa-bullhorn" aria-hidden="true"></i> bullhorn</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bullseye"><i class="fa fa-bullseye" aria-hidden="true"></i> bullseye</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bus"><i class="fa fa-bus" aria-hidden="true"></i> bus</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="taxi"><i class="fa fa-cab" aria-hidden="true"></i> cab <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="calculator"><i class="fa fa-calculator" aria-hidden="true"></i> calculator</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="calendar"><i class="fa fa-calendar" aria-hidden="true"></i> calendar</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="calendar-check-o"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> calendar-check-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="calendar-minus-o"><i class="fa fa-calendar-minus-o" aria-hidden="true"></i> calendar-minus-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="calendar-o"><i class="fa fa-calendar-o" aria-hidden="true"></i> calendar-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="calendar-plus-o"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> calendar-plus-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="calendar-times-o"><i class="fa fa-calendar-times-o" aria-hidden="true"></i> calendar-times-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="camera"><i class="fa fa-camera" aria-hidden="true"></i> camera</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="camera-retro"><i class="fa fa-camera-retro" aria-hidden="true"></i> camera-retro</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="car"><i class="fa fa-car" aria-hidden="true"></i> car</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-down"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i> caret-square-o-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-left"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> caret-square-o-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-right"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> caret-square-o-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-up"><i class="fa fa-caret-square-o-up" aria-hidden="true"></i> caret-square-o-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cart-arrow-down"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> cart-arrow-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cart-plus"><i class="fa fa-cart-plus" aria-hidden="true"></i> cart-plus</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc"><i class="fa fa-cc" aria-hidden="true"></i> cc</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="certificate"><i class="fa fa-certificate" aria-hidden="true"></i> certificate</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="check"><i class="fa fa-check" aria-hidden="true"></i> check</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="check-circle"><i class="fa fa-check-circle" aria-hidden="true"></i> check-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="check-circle-o"><i class="fa fa-check-circle-o" aria-hidden="true"></i> check-circle-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="check-square"><i class="fa fa-check-square" aria-hidden="true"></i> check-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="check-square-o"><i class="fa fa-check-square-o" aria-hidden="true"></i> check-square-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="child"><i class="fa fa-child" aria-hidden="true"></i> child</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="circle"><i class="fa fa-circle" aria-hidden="true"></i> circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="circle-o"><i class="fa fa-circle-o" aria-hidden="true"></i> circle-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="circle-o-notch"><i class="fa fa-circle-o-notch" aria-hidden="true"></i> circle-o-notch</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="circle-thin"><i class="fa fa-circle-thin" aria-hidden="true"></i> circle-thin</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="clock-o"><i class="fa fa-clock-o" aria-hidden="true"></i> clock-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="clone"><i class="fa fa-clone" aria-hidden="true"></i> clone</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="times"><i class="fa fa-close" aria-hidden="true"></i> close <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cloud"><i class="fa fa-cloud" aria-hidden="true"></i> cloud</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cloud-download"><i class="fa fa-cloud-download" aria-hidden="true"></i> cloud-download</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cloud-upload"><i class="fa fa-cloud-upload" aria-hidden="true"></i> cloud-upload</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="code"><i class="fa fa-code" aria-hidden="true"></i> code</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="code-fork"><i class="fa fa-code-fork" aria-hidden="true"></i> code-fork</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="coffee"><i class="fa fa-coffee" aria-hidden="true"></i> coffee</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cog"><i class="fa fa-cog" aria-hidden="true"></i> cog</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cogs"><i class="fa fa-cogs" aria-hidden="true"></i> cogs</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="comment"><i class="fa fa-comment" aria-hidden="true"></i> comment</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="comment-o"><i class="fa fa-comment-o" aria-hidden="true"></i> comment-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="commenting"><i class="fa fa-commenting" aria-hidden="true"></i> commenting</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="commenting-o"><i class="fa fa-commenting-o" aria-hidden="true"></i> commenting-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="comments"><i class="fa fa-comments" aria-hidden="true"></i> comments</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="comments-o"><i class="fa fa-comments-o" aria-hidden="true"></i> comments-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="compass"><i class="fa fa-compass" aria-hidden="true"></i> compass</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="copyright"><i class="fa fa-copyright" aria-hidden="true"></i> copyright</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="creative-commons"><i class="fa fa-creative-commons" aria-hidden="true"></i> creative-commons</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="credit-card"><i class="fa fa-credit-card" aria-hidden="true"></i> credit-card</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="credit-card-alt"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> credit-card-alt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="crop"><i class="fa fa-crop" aria-hidden="true"></i> crop</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="crosshairs"><i class="fa fa-crosshairs" aria-hidden="true"></i> crosshairs</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cube"><i class="fa fa-cube" aria-hidden="true"></i> cube</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cubes"><i class="fa fa-cubes" aria-hidden="true"></i> cubes</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cutlery"><i class="fa fa-cutlery" aria-hidden="true"></i> cutlery</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tachometer"><i class="fa fa-dashboard" aria-hidden="true"></i> dashboard <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="database"><i class="fa fa-database" aria-hidden="true"></i> database</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="deaf"><i class="fa fa-deaf" aria-hidden="true"></i> deaf</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="deaf"><i class="fa fa-deafness" aria-hidden="true"></i> deafness <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="desktop"><i class="fa fa-desktop" aria-hidden="true"></i> desktop</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="diamond"><i class="fa fa-diamond" aria-hidden="true"></i> diamond</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="dot-circle-o"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> dot-circle-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="download"><i class="fa fa-download" aria-hidden="true"></i> download</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="id-card"><i class="fa fa-drivers-license" aria-hidden="true"></i> drivers-license <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="id-card-o"><i class="fa fa-drivers-license-o" aria-hidden="true"></i> drivers-license-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pencil-square-o"><i class="fa fa-edit" aria-hidden="true"></i> edit <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="ellipsis-h"><i class="fa fa-ellipsis-h" aria-hidden="true"></i> ellipsis-h</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="ellipsis-v"><i class="fa fa-ellipsis-v" aria-hidden="true"></i> ellipsis-v</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="envelope"><i class="fa fa-envelope" aria-hidden="true"></i> envelope</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="envelope-o"><i class="fa fa-envelope-o" aria-hidden="true"></i> envelope-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="envelope-open"><i class="fa fa-envelope-open" aria-hidden="true"></i> envelope-open</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="envelope-open-o"><i class="fa fa-envelope-open-o" aria-hidden="true"></i> envelope-open-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="envelope-square"><i class="fa fa-envelope-square" aria-hidden="true"></i> envelope-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="eraser"><i class="fa fa-eraser" aria-hidden="true"></i> eraser</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="exchange"><i class="fa fa-exchange" aria-hidden="true"></i> exchange</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="exclamation"><i class="fa fa-exclamation" aria-hidden="true"></i> exclamation</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="exclamation-circle"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> exclamation-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="exclamation-triangle"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> exclamation-triangle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="external-link"><i class="fa fa-external-link" aria-hidden="true"></i> external-link</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="external-link-square"><i class="fa fa-external-link-square" aria-hidden="true"></i> external-link-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="eye"><i class="fa fa-eye" aria-hidden="true"></i> eye</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="eye-slash"><i class="fa fa-eye-slash" aria-hidden="true"></i> eye-slash</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="eyedropper"><i class="fa fa-eyedropper" aria-hidden="true"></i> eyedropper</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="fax"><i class="fa fa-fax" aria-hidden="true"></i> fax</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="rss"><i class="fa fa-feed" aria-hidden="true"></i> feed <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="female"><i class="fa fa-female" aria-hidden="true"></i> female</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="fighter-jet"><i class="fa fa-fighter-jet" aria-hidden="true"></i> fighter-jet</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-archive-o"><i class="fa fa-file-archive-o" aria-hidden="true"></i> file-archive-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-audio-o"><i class="fa fa-file-audio-o" aria-hidden="true"></i> file-audio-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-code-o"><i class="fa fa-file-code-o" aria-hidden="true"></i> file-code-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-excel-o"><i class="fa fa-file-excel-o" aria-hidden="true"></i> file-excel-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-image-o"><i class="fa fa-file-image-o" aria-hidden="true"></i> file-image-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-video-o"><i class="fa fa-file-movie-o" aria-hidden="true"></i> file-movie-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-pdf-o"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> file-pdf-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-image-o"><i class="fa fa-file-photo-o" aria-hidden="true"></i> file-photo-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-image-o"><i class="fa fa-file-picture-o" aria-hidden="true"></i> file-picture-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-powerpoint-o"><i class="fa fa-file-powerpoint-o" aria-hidden="true"></i> file-powerpoint-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-audio-o"><i class="fa fa-file-sound-o" aria-hidden="true"></i> file-sound-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-video-o"><i class="fa fa-file-video-o" aria-hidden="true"></i> file-video-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-word-o"><i class="fa fa-file-word-o" aria-hidden="true"></i> file-word-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-archive-o"><i class="fa fa-file-zip-o" aria-hidden="true"></i> file-zip-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="film"><i class="fa fa-film" aria-hidden="true"></i> film</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="filter"><i class="fa fa-filter" aria-hidden="true"></i> filter</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="fire"><i class="fa fa-fire" aria-hidden="true"></i> fire</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="fire-extinguisher"><i class="fa fa-fire-extinguisher" aria-hidden="true"></i> fire-extinguisher</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="flag"><i class="fa fa-flag" aria-hidden="true"></i> flag</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="flag-checkered"><i class="fa fa-flag-checkered" aria-hidden="true"></i> flag-checkered</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="flag-o"><i class="fa fa-flag-o" aria-hidden="true"></i> flag-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bolt"><i class="fa fa-flash" aria-hidden="true"></i> flash <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="flask"><i class="fa fa-flask" aria-hidden="true"></i> flask</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="folder"><i class="fa fa-folder" aria-hidden="true"></i> folder</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="folder-o"><i class="fa fa-folder-o" aria-hidden="true"></i> folder-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="folder-open"><i class="fa fa-folder-open" aria-hidden="true"></i> folder-open</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="folder-open-o"><i class="fa fa-folder-open-o" aria-hidden="true"></i> folder-open-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="frown-o"><i class="fa fa-frown-o" aria-hidden="true"></i> frown-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="futbol-o"><i class="fa fa-futbol-o" aria-hidden="true"></i> futbol-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="gamepad"><i class="fa fa-gamepad" aria-hidden="true"></i> gamepad</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="gavel"><i class="fa fa-gavel" aria-hidden="true"></i> gavel</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cog"><i class="fa fa-gear" aria-hidden="true"></i> gear <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cogs"><i class="fa fa-gears" aria-hidden="true"></i> gears <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="gift"><i class="fa fa-gift" aria-hidden="true"></i> gift</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="glass"><i class="fa fa-glass" aria-hidden="true"></i> glass</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="globe"><i class="fa fa-globe" aria-hidden="true"></i> globe</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="graduation-cap"><i class="fa fa-graduation-cap" aria-hidden="true"></i> graduation-cap</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="users"><i class="fa fa-group" aria-hidden="true"></i> group <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-rock-o"><i class="fa fa-hand-grab-o" aria-hidden="true"></i> hand-grab-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-lizard-o"><i class="fa fa-hand-lizard-o" aria-hidden="true"></i> hand-lizard-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-paper-o"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> hand-paper-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-peace-o"><i class="fa fa-hand-peace-o" aria-hidden="true"></i> hand-peace-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-pointer-o"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> hand-pointer-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-rock-o"><i class="fa fa-hand-rock-o" aria-hidden="true"></i> hand-rock-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-scissors-o"><i class="fa fa-hand-scissors-o" aria-hidden="true"></i> hand-scissors-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-spock-o"><i class="fa fa-hand-spock-o" aria-hidden="true"></i> hand-spock-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-paper-o"><i class="fa fa-hand-stop-o" aria-hidden="true"></i> hand-stop-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="handshake-o"><i class="fa fa-handshake-o" aria-hidden="true"></i> handshake-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="deaf"><i class="fa fa-hard-of-hearing" aria-hidden="true"></i> hard-of-hearing <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hashtag"><i class="fa fa-hashtag" aria-hidden="true"></i> hashtag</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hdd-o"><i class="fa fa-hdd-o" aria-hidden="true"></i> hdd-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="headphones"><i class="fa fa-headphones" aria-hidden="true"></i> headphones</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="heart"><i class="fa fa-heart" aria-hidden="true"></i> heart</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="heart-o"><i class="fa fa-heart-o" aria-hidden="true"></i> heart-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="heartbeat"><i class="fa fa-heartbeat" aria-hidden="true"></i> heartbeat</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="history"><i class="fa fa-history" aria-hidden="true"></i> history</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="home"><i class="fa fa-home" aria-hidden="true"></i> home</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bed"><i class="fa fa-hotel" aria-hidden="true"></i> hotel <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hourglass"><i class="fa fa-hourglass" aria-hidden="true"></i> hourglass</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hourglass-start"><i class="fa fa-hourglass-1" aria-hidden="true"></i> hourglass-1 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hourglass-half"><i class="fa fa-hourglass-2" aria-hidden="true"></i> hourglass-2 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hourglass-end"><i class="fa fa-hourglass-3" aria-hidden="true"></i> hourglass-3 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hourglass-end"><i class="fa fa-hourglass-end" aria-hidden="true"></i> hourglass-end</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hourglass-half"><i class="fa fa-hourglass-half" aria-hidden="true"></i> hourglass-half</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hourglass-o"><i class="fa fa-hourglass-o" aria-hidden="true"></i> hourglass-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hourglass-start"><i class="fa fa-hourglass-start" aria-hidden="true"></i> hourglass-start</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="i-cursor"><i class="fa fa-i-cursor" aria-hidden="true"></i> i-cursor</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="id-badge"><i class="fa fa-id-badge" aria-hidden="true"></i> id-badge</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="id-card"><i class="fa fa-id-card" aria-hidden="true"></i> id-card</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="id-card-o"><i class="fa fa-id-card-o" aria-hidden="true"></i> id-card-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="picture-o"><i class="fa fa-image" aria-hidden="true"></i> image <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="inbox"><i class="fa fa-inbox" aria-hidden="true"></i> inbox</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="industry"><i class="fa fa-industry" aria-hidden="true"></i> industry</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="info"><i class="fa fa-info" aria-hidden="true"></i> info</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="info-circle"><i class="fa fa-info-circle" aria-hidden="true"></i> info-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="university"><i class="fa fa-institution" aria-hidden="true"></i> institution <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="key"><i class="fa fa-key" aria-hidden="true"></i> key</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="keyboard-o"><i class="fa fa-keyboard-o" aria-hidden="true"></i> keyboard-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="language"><i class="fa fa-language" aria-hidden="true"></i> language</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="laptop"><i class="fa fa-laptop" aria-hidden="true"></i> laptop</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="leaf"><i class="fa fa-leaf" aria-hidden="true"></i> leaf</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="gavel"><i class="fa fa-legal" aria-hidden="true"></i> legal <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="lemon-o"><i class="fa fa-lemon-o" aria-hidden="true"></i> lemon-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="level-down"><i class="fa fa-level-down" aria-hidden="true"></i> level-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="level-up"><i class="fa fa-level-up" aria-hidden="true"></i> level-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="life-ring"><i class="fa fa-life-bouy" aria-hidden="true"></i> life-bouy <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="life-ring"><i class="fa fa-life-buoy" aria-hidden="true"></i> life-buoy <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="life-ring"><i class="fa fa-life-ring" aria-hidden="true"></i> life-ring</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="life-ring"><i class="fa fa-life-saver" aria-hidden="true"></i> life-saver <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="lightbulb-o"><i class="fa fa-lightbulb-o" aria-hidden="true"></i> lightbulb-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="line-chart"><i class="fa fa-line-chart" aria-hidden="true"></i> line-chart</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="location-arrow"><i class="fa fa-location-arrow" aria-hidden="true"></i> location-arrow</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="lock"><i class="fa fa-lock" aria-hidden="true"></i> lock</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="low-vision"><i class="fa fa-low-vision" aria-hidden="true"></i> low-vision</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="magic"><i class="fa fa-magic" aria-hidden="true"></i> magic</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="magnet"><i class="fa fa-magnet" aria-hidden="true"></i> magnet</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="share"><i class="fa fa-mail-forward" aria-hidden="true"></i> mail-forward <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="reply"><i class="fa fa-mail-reply" aria-hidden="true"></i> mail-reply <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="reply-all"><i class="fa fa-mail-reply-all" aria-hidden="true"></i> mail-reply-all <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="male"><i class="fa fa-male" aria-hidden="true"></i> male</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="map"><i class="fa fa-map" aria-hidden="true"></i> map</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="map-marker"><i class="fa fa-map-marker" aria-hidden="true"></i> map-marker</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="map-o"><i class="fa fa-map-o" aria-hidden="true"></i> map-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="map-pin"><i class="fa fa-map-pin" aria-hidden="true"></i> map-pin</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="map-signs"><i class="fa fa-map-signs" aria-hidden="true"></i> map-signs</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="meh-o"><i class="fa fa-meh-o" aria-hidden="true"></i> meh-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="microchip"><i class="fa fa-microchip" aria-hidden="true"></i> microchip</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="microphone"><i class="fa fa-microphone" aria-hidden="true"></i> microphone</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="microphone-slash"><i class="fa fa-microphone-slash" aria-hidden="true"></i> microphone-slash</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="minus"><i class="fa fa-minus" aria-hidden="true"></i> minus</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="minus-circle"><i class="fa fa-minus-circle" aria-hidden="true"></i> minus-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="minus-square"><i class="fa fa-minus-square" aria-hidden="true"></i> minus-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="minus-square-o"><i class="fa fa-minus-square-o" aria-hidden="true"></i> minus-square-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="mobile"><i class="fa fa-mobile" aria-hidden="true"></i> mobile</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="mobile"><i class="fa fa-mobile-phone" aria-hidden="true"></i> mobile-phone <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="money"><i class="fa fa-money" aria-hidden="true"></i> money</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="moon-o"><i class="fa fa-moon-o" aria-hidden="true"></i> moon-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="graduation-cap"><i class="fa fa-mortar-board" aria-hidden="true"></i> mortar-board <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="motorcycle"><i class="fa fa-motorcycle" aria-hidden="true"></i> motorcycle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="mouse-pointer"><i class="fa fa-mouse-pointer" aria-hidden="true"></i> mouse-pointer</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="music"><i class="fa fa-music" aria-hidden="true"></i> music</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bars"><i class="fa fa-navicon" aria-hidden="true"></i> navicon <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="newspaper-o"><i class="fa fa-newspaper-o" aria-hidden="true"></i> newspaper-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="object-group"><i class="fa fa-object-group" aria-hidden="true"></i> object-group</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="object-ungroup"><i class="fa fa-object-ungroup" aria-hidden="true"></i> object-ungroup</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="paint-brush"><i class="fa fa-paint-brush" aria-hidden="true"></i> paint-brush</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="paper-plane"><i class="fa fa-paper-plane" aria-hidden="true"></i> paper-plane</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="paper-plane-o"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> paper-plane-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="paw"><i class="fa fa-paw" aria-hidden="true"></i> paw</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pencil"><i class="fa fa-pencil" aria-hidden="true"></i> pencil</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pencil-square"><i class="fa fa-pencil-square" aria-hidden="true"></i> pencil-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pencil-square-o"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> pencil-square-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="percent"><i class="fa fa-percent" aria-hidden="true"></i> percent</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="phone"><i class="fa fa-phone" aria-hidden="true"></i> phone</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="phone-square"><i class="fa fa-phone-square" aria-hidden="true"></i> phone-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="picture-o"><i class="fa fa-photo" aria-hidden="true"></i> photo <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="picture-o"><i class="fa fa-picture-o" aria-hidden="true"></i> picture-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pie-chart"><i class="fa fa-pie-chart" aria-hidden="true"></i> pie-chart</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="plane"><i class="fa fa-plane" aria-hidden="true"></i> plane</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="plug"><i class="fa fa-plug" aria-hidden="true"></i> plug</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="plus"><i class="fa fa-plus" aria-hidden="true"></i> plus</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="plus-circle"><i class="fa fa-plus-circle" aria-hidden="true"></i> plus-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="plus-square"><i class="fa fa-plus-square" aria-hidden="true"></i> plus-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="plus-square-o"><i class="fa fa-plus-square-o" aria-hidden="true"></i> plus-square-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="podcast"><i class="fa fa-podcast" aria-hidden="true"></i> podcast</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="power-off"><i class="fa fa-power-off" aria-hidden="true"></i> power-off</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="print"><i class="fa fa-print" aria-hidden="true"></i> print</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="puzzle-piece"><i class="fa fa-puzzle-piece" aria-hidden="true"></i> puzzle-piece</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="qrcode"><i class="fa fa-qrcode" aria-hidden="true"></i> qrcode</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="question"><i class="fa fa-question" aria-hidden="true"></i> question</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="question-circle"><i class="fa fa-question-circle" aria-hidden="true"></i> question-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="question-circle-o"><i class="fa fa-question-circle-o" aria-hidden="true"></i> question-circle-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="quote-left"><i class="fa fa-quote-left" aria-hidden="true"></i> quote-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="quote-right"><i class="fa fa-quote-right" aria-hidden="true"></i> quote-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="random"><i class="fa fa-random" aria-hidden="true"></i> random</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="recycle"><i class="fa fa-recycle" aria-hidden="true"></i> recycle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="refresh"><i class="fa fa-refresh" aria-hidden="true"></i> refresh</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="registered"><i class="fa fa-registered" aria-hidden="true"></i> registered</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="times"><i class="fa fa-remove" aria-hidden="true"></i> remove <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bars"><i class="fa fa-reorder" aria-hidden="true"></i> reorder <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="reply"><i class="fa fa-reply" aria-hidden="true"></i> reply</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="reply-all"><i class="fa fa-reply-all" aria-hidden="true"></i> reply-all</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="retweet"><i class="fa fa-retweet" aria-hidden="true"></i> retweet</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="road"><i class="fa fa-road" aria-hidden="true"></i> road</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="rocket"><i class="fa fa-rocket" aria-hidden="true"></i> rocket</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="rss"><i class="fa fa-rss" aria-hidden="true"></i> rss</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="rss-square"><i class="fa fa-rss-square" aria-hidden="true"></i> rss-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bath"><i class="fa fa-s15" aria-hidden="true"></i> s15 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="search"><i class="fa fa-search" aria-hidden="true"></i> search</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="search-minus"><i class="fa fa-search-minus" aria-hidden="true"></i> search-minus</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="search-plus"><i class="fa fa-search-plus" aria-hidden="true"></i> search-plus</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="paper-plane"><i class="fa fa-send" aria-hidden="true"></i> send <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="paper-plane-o"><i class="fa fa-send-o" aria-hidden="true"></i> send-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="server"><i class="fa fa-server" aria-hidden="true"></i> server</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="share"><i class="fa fa-share" aria-hidden="true"></i> share</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="share-alt"><i class="fa fa-share-alt" aria-hidden="true"></i> share-alt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="share-alt-square"><i class="fa fa-share-alt-square" aria-hidden="true"></i> share-alt-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="share-square"><i class="fa fa-share-square" aria-hidden="true"></i> share-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="share-square-o"><i class="fa fa-share-square-o" aria-hidden="true"></i> share-square-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="shield"><i class="fa fa-shield" aria-hidden="true"></i> shield</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="ship"><i class="fa fa-ship" aria-hidden="true"></i> ship</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="shopping-bag"><i class="fa fa-shopping-bag" aria-hidden="true"></i> shopping-bag</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="shopping-basket"><i class="fa fa-shopping-basket" aria-hidden="true"></i> shopping-basket</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="shopping-cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i> shopping-cart</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="shower"><i class="fa fa-shower" aria-hidden="true"></i> shower</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sign-in"><i class="fa fa-sign-in" aria-hidden="true"></i> sign-in</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sign-language"><i class="fa fa-sign-language" aria-hidden="true"></i> sign-language</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sign-out"><i class="fa fa-sign-out" aria-hidden="true"></i> sign-out</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="signal"><i class="fa fa-signal" aria-hidden="true"></i> signal</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sign-language"><i class="fa fa-signing" aria-hidden="true"></i> signing <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sitemap"><i class="fa fa-sitemap" aria-hidden="true"></i> sitemap</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sliders"><i class="fa fa-sliders" aria-hidden="true"></i> sliders</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="smile-o"><i class="fa fa-smile-o" aria-hidden="true"></i> smile-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="snowflake-o"><i class="fa fa-snowflake-o" aria-hidden="true"></i> snowflake-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="futbol-o"><i class="fa fa-soccer-ball-o" aria-hidden="true"></i> soccer-ball-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sort"><i class="fa fa-sort" aria-hidden="true"></i> sort</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sort-alpha-asc"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i> sort-alpha-asc</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sort-alpha-desc"><i class="fa fa-sort-alpha-desc" aria-hidden="true"></i> sort-alpha-desc</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sort-amount-asc"><i class="fa fa-sort-amount-asc" aria-hidden="true"></i> sort-amount-asc</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sort-amount-desc"><i class="fa fa-sort-amount-desc" aria-hidden="true"></i> sort-amount-desc</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sort-asc"><i class="fa fa-sort-asc" aria-hidden="true"></i> sort-asc</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sort-desc"><i class="fa fa-sort-desc" aria-hidden="true"></i> sort-desc</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sort-desc"><i class="fa fa-sort-down" aria-hidden="true"></i> sort-down <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sort-numeric-asc"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i> sort-numeric-asc</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sort-numeric-desc"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i> sort-numeric-desc</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sort-asc"><i class="fa fa-sort-up" aria-hidden="true"></i> sort-up <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="space-shuttle"><i class="fa fa-space-shuttle" aria-hidden="true"></i> space-shuttle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="spinner"><i class="fa fa-spinner" aria-hidden="true"></i> spinner</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="spoon"><i class="fa fa-spoon" aria-hidden="true"></i> spoon</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="square"><i class="fa fa-square" aria-hidden="true"></i> square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="square-o"><i class="fa fa-square-o" aria-hidden="true"></i> square-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="star"><i class="fa fa-star" aria-hidden="true"></i> star</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="star-half"><i class="fa fa-star-half" aria-hidden="true"></i> star-half</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="star-half-o"><i class="fa fa-star-half-empty" aria-hidden="true"></i> star-half-empty <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="star-half-o"><i class="fa fa-star-half-full" aria-hidden="true"></i> star-half-full <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="star-half-o"><i class="fa fa-star-half-o" aria-hidden="true"></i> star-half-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="star-o"><i class="fa fa-star-o" aria-hidden="true"></i> star-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sticky-note"><i class="fa fa-sticky-note" aria-hidden="true"></i> sticky-note</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sticky-note-o"><i class="fa fa-sticky-note-o" aria-hidden="true"></i> sticky-note-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="street-view"><i class="fa fa-street-view" aria-hidden="true"></i> street-view</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="suitcase"><i class="fa fa-suitcase" aria-hidden="true"></i> suitcase</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sun-o"><i class="fa fa-sun-o" aria-hidden="true"></i> sun-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="life-ring"><i class="fa fa-support" aria-hidden="true"></i> support <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tablet"><i class="fa fa-tablet" aria-hidden="true"></i> tablet</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tachometer"><i class="fa fa-tachometer" aria-hidden="true"></i> tachometer</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tag"><i class="fa fa-tag" aria-hidden="true"></i> tag</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tags"><i class="fa fa-tags" aria-hidden="true"></i> tags</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tasks"><i class="fa fa-tasks" aria-hidden="true"></i> tasks</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="taxi"><i class="fa fa-taxi" aria-hidden="true"></i> taxi</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="television"><i class="fa fa-television" aria-hidden="true"></i> television</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="terminal"><i class="fa fa-terminal" aria-hidden="true"></i> terminal</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thermometer-full"><i class="fa fa-thermometer" aria-hidden="true"></i> thermometer <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thermometer-empty"><i class="fa fa-thermometer-0" aria-hidden="true"></i> thermometer-0 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thermometer-quarter"><i class="fa fa-thermometer-1" aria-hidden="true"></i> thermometer-1 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thermometer-half"><i class="fa fa-thermometer-2" aria-hidden="true"></i> thermometer-2 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thermometer-three-quarters"><i class="fa fa-thermometer-3" aria-hidden="true"></i> thermometer-3 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thermometer-full"><i class="fa fa-thermometer-4" aria-hidden="true"></i> thermometer-4 <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thermometer-empty"><i class="fa fa-thermometer-empty" aria-hidden="true"></i> thermometer-empty</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thermometer-full"><i class="fa fa-thermometer-full" aria-hidden="true"></i> thermometer-full</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thermometer-half"><i class="fa fa-thermometer-half" aria-hidden="true"></i> thermometer-half</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thermometer-quarter"><i class="fa fa-thermometer-quarter" aria-hidden="true"></i> thermometer-quarter</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thermometer-three-quarters"><i class="fa fa-thermometer-three-quarters" aria-hidden="true"></i> thermometer-three-quarters</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thumb-tack"><i class="fa fa-thumb-tack" aria-hidden="true"></i> thumb-tack</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thumbs-down"><i class="fa fa-thumbs-down" aria-hidden="true"></i> thumbs-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thumbs-o-down"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> thumbs-o-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thumbs-o-up"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> thumbs-o-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thumbs-up"><i class="fa fa-thumbs-up" aria-hidden="true"></i> thumbs-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="ticket"><i class="fa fa-ticket" aria-hidden="true"></i> ticket</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="times"><i class="fa fa-times" aria-hidden="true"></i> times</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="times-circle"><i class="fa fa-times-circle" aria-hidden="true"></i> times-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="times-circle-o"><i class="fa fa-times-circle-o" aria-hidden="true"></i> times-circle-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="window-close"><i class="fa fa-times-rectangle" aria-hidden="true"></i> times-rectangle <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="window-close-o"><i class="fa fa-times-rectangle-o" aria-hidden="true"></i> times-rectangle-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tint"><i class="fa fa-tint" aria-hidden="true"></i> tint</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-down"><i class="fa fa-toggle-down" aria-hidden="true"></i> toggle-down <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-left"><i class="fa fa-toggle-left" aria-hidden="true"></i> toggle-left <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="toggle-off"><i class="fa fa-toggle-off" aria-hidden="true"></i> toggle-off</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="toggle-on"><i class="fa fa-toggle-on" aria-hidden="true"></i> toggle-on</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-right"><i class="fa fa-toggle-right" aria-hidden="true"></i> toggle-right <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-up"><i class="fa fa-toggle-up" aria-hidden="true"></i> toggle-up <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="trademark"><i class="fa fa-trademark" aria-hidden="true"></i> trademark</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="trash"><i class="fa fa-trash" aria-hidden="true"></i> trash</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="trash-o"><i class="fa fa-trash-o" aria-hidden="true"></i> trash-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tree"><i class="fa fa-tree" aria-hidden="true"></i> tree</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="trophy"><i class="fa fa-trophy" aria-hidden="true"></i> trophy</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="truck"><i class="fa fa-truck" aria-hidden="true"></i> truck</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tty"><i class="fa fa-tty" aria-hidden="true"></i> tty</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="television"><i class="fa fa-tv" aria-hidden="true"></i> tv <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="umbrella"><i class="fa fa-umbrella" aria-hidden="true"></i> umbrella</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="universal-access"><i class="fa fa-universal-access" aria-hidden="true"></i> universal-access</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="university"><i class="fa fa-university" aria-hidden="true"></i> university</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="unlock"><i class="fa fa-unlock" aria-hidden="true"></i> unlock</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="unlock-alt"><i class="fa fa-unlock-alt" aria-hidden="true"></i> unlock-alt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sort"><i class="fa fa-unsorted" aria-hidden="true"></i> unsorted <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="upload"><i class="fa fa-upload" aria-hidden="true"></i> upload</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="user"><i class="fa fa-user" aria-hidden="true"></i> user</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="user-circle"><i class="fa fa-user-circle" aria-hidden="true"></i> user-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="user-circle-o"><i class="fa fa-user-circle-o" aria-hidden="true"></i> user-circle-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="user-o"><i class="fa fa-user-o" aria-hidden="true"></i> user-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="user-plus"><i class="fa fa-user-plus" aria-hidden="true"></i> user-plus</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="user-secret"><i class="fa fa-user-secret" aria-hidden="true"></i> user-secret</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="user-times"><i class="fa fa-user-times" aria-hidden="true"></i> user-times</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="users"><i class="fa fa-users" aria-hidden="true"></i> users</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="address-card"><i class="fa fa-vcard" aria-hidden="true"></i> vcard <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="address-card-o"><i class="fa fa-vcard-o" aria-hidden="true"></i> vcard-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="video-camera"><i class="fa fa-video-camera" aria-hidden="true"></i> video-camera</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="volume-control-phone"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> volume-control-phone</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="volume-down"><i class="fa fa-volume-down" aria-hidden="true"></i> volume-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="volume-off"><i class="fa fa-volume-off" aria-hidden="true"></i> volume-off</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="volume-up"><i class="fa fa-volume-up" aria-hidden="true"></i> volume-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="exclamation-triangle"><i class="fa fa-warning" aria-hidden="true"></i> warning <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wheelchair"><i class="fa fa-wheelchair" aria-hidden="true"></i> wheelchair</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wheelchair-alt"><i class="fa fa-wheelchair-alt" aria-hidden="true"></i> wheelchair-alt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wifi"><i class="fa fa-wifi" aria-hidden="true"></i> wifi</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="window-close"><i class="fa fa-window-close" aria-hidden="true"></i> window-close</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="window-close-o"><i class="fa fa-window-close-o" aria-hidden="true"></i> window-close-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="window-maximize"><i class="fa fa-window-maximize" aria-hidden="true"></i> window-maximize</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="window-minimize"><i class="fa fa-window-minimize" aria-hidden="true"></i> window-minimize</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="window-restore"><i class="fa fa-window-restore" aria-hidden="true"></i> window-restore</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wrench"><i class="fa fa-wrench" aria-hidden="true"></i> wrench</span> </div>
				</div>
			</section>
			<section id="accessibility">
				<h2 class="page-header">Accessibility Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="american-sign-language-interpreting"><i class="fa fa-american-sign-language-interpreting" aria-hidden="true"></i> american-sign-language-interpreting</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="american-sign-language-interpreting"><i class="fa fa-asl-interpreting" aria-hidden="true"></i> asl-interpreting <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="assistive-listening-systems"><i class="fa fa-assistive-listening-systems" aria-hidden="true"></i> assistive-listening-systems</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="audio-description"><i class="fa fa-audio-description" aria-hidden="true"></i> audio-description</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="blind"><i class="fa fa-blind" aria-hidden="true"></i> blind</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="braille"><i class="fa fa-braille" aria-hidden="true"></i> braille</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc"><i class="fa fa-cc" aria-hidden="true"></i> cc</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="deaf"><i class="fa fa-deaf" aria-hidden="true"></i> deaf</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="deaf"><i class="fa fa-deafness" aria-hidden="true"></i> deafness <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="deaf"><i class="fa fa-hard-of-hearing" aria-hidden="true"></i> hard-of-hearing <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="low-vision"><i class="fa fa-low-vision" aria-hidden="true"></i> low-vision</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="question-circle-o"><i class="fa fa-question-circle-o" aria-hidden="true"></i> question-circle-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sign-language"><i class="fa fa-sign-language" aria-hidden="true"></i> sign-language</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sign-language"><i class="fa fa-signing" aria-hidden="true"></i> signing <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tty"><i class="fa fa-tty" aria-hidden="true"></i> tty</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="universal-access"><i class="fa fa-universal-access" aria-hidden="true"></i> universal-access</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="volume-control-phone"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> volume-control-phone</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wheelchair"><i class="fa fa-wheelchair" aria-hidden="true"></i> wheelchair</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wheelchair-alt"><i class="fa fa-wheelchair-alt" aria-hidden="true"></i> wheelchair-alt</span> </div>
				</div>
			</section>
			<section id="hand">
				<h2 class="page-header">Hand Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-rock-o"><i class="fa fa-hand-grab-o" aria-hidden="true"></i> hand-grab-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-lizard-o"><i class="fa fa-hand-lizard-o" aria-hidden="true"></i> hand-lizard-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-o-down"><i class="fa fa-hand-o-down" aria-hidden="true"></i> hand-o-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-o-left"><i class="fa fa-hand-o-left" aria-hidden="true"></i> hand-o-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-o-right"><i class="fa fa-hand-o-right" aria-hidden="true"></i> hand-o-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-o-up"><i class="fa fa-hand-o-up" aria-hidden="true"></i> hand-o-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-paper-o"><i class="fa fa-hand-paper-o" aria-hidden="true"></i> hand-paper-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-peace-o"><i class="fa fa-hand-peace-o" aria-hidden="true"></i> hand-peace-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-pointer-o"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> hand-pointer-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-rock-o"><i class="fa fa-hand-rock-o" aria-hidden="true"></i> hand-rock-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-scissors-o"><i class="fa fa-hand-scissors-o" aria-hidden="true"></i> hand-scissors-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-spock-o"><i class="fa fa-hand-spock-o" aria-hidden="true"></i> hand-spock-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-paper-o"><i class="fa fa-hand-stop-o" aria-hidden="true"></i> hand-stop-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thumbs-down"><i class="fa fa-thumbs-down" aria-hidden="true"></i> thumbs-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thumbs-o-down"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> thumbs-o-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thumbs-o-up"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> thumbs-o-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="thumbs-up"><i class="fa fa-thumbs-up" aria-hidden="true"></i> thumbs-up</span> </div>
				</div>
			</section>
			<section id="transportation">
				<h2 class="page-header">Transportation Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="ambulance"><i class="fa fa-ambulance" aria-hidden="true"></i> ambulance</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="car"><i class="fa fa-automobile" aria-hidden="true"></i> automobile <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bicycle"><i class="fa fa-bicycle" aria-hidden="true"></i> bicycle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bus"><i class="fa fa-bus" aria-hidden="true"></i> bus</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="taxi"><i class="fa fa-cab" aria-hidden="true"></i> cab <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="car"><i class="fa fa-car" aria-hidden="true"></i> car</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="fighter-jet"><i class="fa fa-fighter-jet" aria-hidden="true"></i> fighter-jet</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="motorcycle"><i class="fa fa-motorcycle" aria-hidden="true"></i> motorcycle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="plane"><i class="fa fa-plane" aria-hidden="true"></i> plane</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="rocket"><i class="fa fa-rocket" aria-hidden="true"></i> rocket</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="ship"><i class="fa fa-ship" aria-hidden="true"></i> ship</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="space-shuttle"><i class="fa fa-space-shuttle" aria-hidden="true"></i> space-shuttle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="subway"><i class="fa fa-subway" aria-hidden="true"></i> subway</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="taxi"><i class="fa fa-taxi" aria-hidden="true"></i> taxi</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="train"><i class="fa fa-train" aria-hidden="true"></i> train</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="truck"><i class="fa fa-truck" aria-hidden="true"></i> truck</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wheelchair"><i class="fa fa-wheelchair" aria-hidden="true"></i> wheelchair</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wheelchair-alt"><i class="fa fa-wheelchair-alt" aria-hidden="true"></i> wheelchair-alt</span> </div>
				</div>
			</section>
			<section id="gender">
				<h2 class="page-header">Gender Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="genderless"><i class="fa fa-genderless" aria-hidden="true"></i> genderless</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="transgender"><i class="fa fa-intersex" aria-hidden="true"></i> intersex <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="mars"><i class="fa fa-mars" aria-hidden="true"></i> mars</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="mars-double"><i class="fa fa-mars-double" aria-hidden="true"></i> mars-double</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="mars-stroke"><i class="fa fa-mars-stroke" aria-hidden="true"></i> mars-stroke</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="mars-stroke-h"><i class="fa fa-mars-stroke-h" aria-hidden="true"></i> mars-stroke-h</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="mars-stroke-v"><i class="fa fa-mars-stroke-v" aria-hidden="true"></i> mars-stroke-v</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="mercury"><i class="fa fa-mercury" aria-hidden="true"></i> mercury</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="neuter"><i class="fa fa-neuter" aria-hidden="true"></i> neuter</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="transgender"><i class="fa fa-transgender" aria-hidden="true"></i> transgender</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="transgender-alt"><i class="fa fa-transgender-alt" aria-hidden="true"></i> transgender-alt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="venus"><i class="fa fa-venus" aria-hidden="true"></i> venus</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="venus-double"><i class="fa fa-venus-double" aria-hidden="true"></i> venus-double</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="venus-mars"><i class="fa fa-venus-mars" aria-hidden="true"></i> venus-mars</span> </div>
				</div>
			</section>
			<section id="file-type">
				<h2 class="page-header">File Type Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file"><i class="fa fa-file" aria-hidden="true"></i> file</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-archive-o"><i class="fa fa-file-archive-o" aria-hidden="true"></i> file-archive-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-audio-o"><i class="fa fa-file-audio-o" aria-hidden="true"></i> file-audio-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-code-o"><i class="fa fa-file-code-o" aria-hidden="true"></i> file-code-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-excel-o"><i class="fa fa-file-excel-o" aria-hidden="true"></i> file-excel-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-image-o"><i class="fa fa-file-image-o" aria-hidden="true"></i> file-image-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-video-o"><i class="fa fa-file-movie-o" aria-hidden="true"></i> file-movie-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-o"><i class="fa fa-file-o" aria-hidden="true"></i> file-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-pdf-o"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> file-pdf-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-image-o"><i class="fa fa-file-photo-o" aria-hidden="true"></i> file-photo-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-image-o"><i class="fa fa-file-picture-o" aria-hidden="true"></i> file-picture-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-powerpoint-o"><i class="fa fa-file-powerpoint-o" aria-hidden="true"></i> file-powerpoint-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-audio-o"><i class="fa fa-file-sound-o" aria-hidden="true"></i> file-sound-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-text"><i class="fa fa-file-text" aria-hidden="true"></i> file-text</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-text-o"><i class="fa fa-file-text-o" aria-hidden="true"></i> file-text-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-video-o"><i class="fa fa-file-video-o" aria-hidden="true"></i> file-video-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-word-o"><i class="fa fa-file-word-o" aria-hidden="true"></i> file-word-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-archive-o"><i class="fa fa-file-zip-o" aria-hidden="true"></i> file-zip-o <span class="text-muted">(alias)</span></span> </div>
				</div>
			</section>
			<section id="spinner">
				<h2 class="page-header">Spinner Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="circle-o-notch"><i class="fa fa-circle-o-notch" aria-hidden="true"></i> circle-o-notch</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cog"><i class="fa fa-cog" aria-hidden="true"></i> cog</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cog"><i class="fa fa-gear" aria-hidden="true"></i> gear <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="refresh"><i class="fa fa-refresh" aria-hidden="true"></i> refresh</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="spinner"><i class="fa fa-spinner" aria-hidden="true"></i> spinner</span> </div>
				</div>
			</section>
			<section id="form-control">
				<h2 class="page-header">Form Control Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="check-square"><i class="fa fa-check-square" aria-hidden="true"></i> check-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="check-square-o"><i class="fa fa-check-square-o" aria-hidden="true"></i> check-square-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="circle"><i class="fa fa-circle" aria-hidden="true"></i> circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="circle-o"><i class="fa fa-circle-o" aria-hidden="true"></i> circle-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="dot-circle-o"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> dot-circle-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="minus-square"><i class="fa fa-minus-square" aria-hidden="true"></i> minus-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="minus-square-o"><i class="fa fa-minus-square-o" aria-hidden="true"></i> minus-square-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="plus-square"><i class="fa fa-plus-square" aria-hidden="true"></i> plus-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="plus-square-o"><i class="fa fa-plus-square-o" aria-hidden="true"></i> plus-square-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="square"><i class="fa fa-square" aria-hidden="true"></i> square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="square-o"><i class="fa fa-square-o" aria-hidden="true"></i> square-o</span> </div>
				</div>
			</section>
			<section id="payment">
				<h2 class="page-header">Payment Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-amex"><i class="fa fa-cc-amex" aria-hidden="true"></i> cc-amex</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-diners-club"><i class="fa fa-cc-diners-club" aria-hidden="true"></i> cc-diners-club</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-discover"><i class="fa fa-cc-discover" aria-hidden="true"></i> cc-discover</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-jcb"><i class="fa fa-cc-jcb" aria-hidden="true"></i> cc-jcb</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-mastercard"><i class="fa fa-cc-mastercard" aria-hidden="true"></i> cc-mastercard</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-paypal"><i class="fa fa-cc-paypal" aria-hidden="true"></i> cc-paypal</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-stripe"><i class="fa fa-cc-stripe" aria-hidden="true"></i> cc-stripe</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-visa"><i class="fa fa-cc-visa" aria-hidden="true"></i> cc-visa</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="credit-card"><i class="fa fa-credit-card" aria-hidden="true"></i> credit-card</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="credit-card-alt"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> credit-card-alt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="google-wallet"><i class="fa fa-google-wallet" aria-hidden="true"></i> google-wallet</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="paypal"><i class="fa fa-paypal" aria-hidden="true"></i> paypal</span> </div>
				</div>
			</section>
			<section id="chart">
				<h2 class="page-header">Chart Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="area-chart"><i class="fa fa-area-chart" aria-hidden="true"></i> area-chart</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bar-chart"><i class="fa fa-bar-chart" aria-hidden="true"></i> bar-chart</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bar-chart"><i class="fa fa-bar-chart-o" aria-hidden="true"></i> bar-chart-o <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="line-chart"><i class="fa fa-line-chart" aria-hidden="true"></i> line-chart</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pie-chart"><i class="fa fa-pie-chart" aria-hidden="true"></i> pie-chart</span> </div>
				</div>
			</section>
			<section id="currency">
				<h2 class="page-header">Currency Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="btc"><i class="fa fa-bitcoin" aria-hidden="true"></i> bitcoin <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="btc"><i class="fa fa-btc" aria-hidden="true"></i> btc</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="jpy"><i class="fa fa-cny" aria-hidden="true"></i> cny <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="usd"><i class="fa fa-dollar" aria-hidden="true"></i> dollar <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="eur"><i class="fa fa-eur" aria-hidden="true"></i> eur</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="eur"><i class="fa fa-euro" aria-hidden="true"></i> euro <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="gbp"><i class="fa fa-gbp" aria-hidden="true"></i> gbp</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="gg"><i class="fa fa-gg" aria-hidden="true"></i> gg</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="gg-circle"><i class="fa fa-gg-circle" aria-hidden="true"></i> gg-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="ils"><i class="fa fa-ils" aria-hidden="true"></i> ils</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="inr"><i class="fa fa-inr" aria-hidden="true"></i> inr</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="jpy"><i class="fa fa-jpy" aria-hidden="true"></i> jpy</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="krw"><i class="fa fa-krw" aria-hidden="true"></i> krw</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="money"><i class="fa fa-money" aria-hidden="true"></i> money</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="jpy"><i class="fa fa-rmb" aria-hidden="true"></i> rmb <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="rub"><i class="fa fa-rouble" aria-hidden="true"></i> rouble <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="rub"><i class="fa fa-rub" aria-hidden="true"></i> rub</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="rub"><i class="fa fa-ruble" aria-hidden="true"></i> ruble <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="inr"><i class="fa fa-rupee" aria-hidden="true"></i> rupee <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="ils"><i class="fa fa-shekel" aria-hidden="true"></i> shekel <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="ils"><i class="fa fa-sheqel" aria-hidden="true"></i> sheqel <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="try"><i class="fa fa-try" aria-hidden="true"></i> try</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="try"><i class="fa fa-turkish-lira" aria-hidden="true"></i> turkish-lira <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="usd"><i class="fa fa-usd" aria-hidden="true"></i> usd</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="krw"><i class="fa fa-won" aria-hidden="true"></i> won <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="jpy"><i class="fa fa-yen" aria-hidden="true"></i> yen <span class="text-muted">(alias)</span></span> </div>
				</div>
			</section>
			<section id="text-editor">
				<h2 class="page-header">Text Editor Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="align-center"><i class="fa fa-align-center" aria-hidden="true"></i> align-center</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="align-justify"><i class="fa fa-align-justify" aria-hidden="true"></i> align-justify</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="align-left"><i class="fa fa-align-left" aria-hidden="true"></i> align-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="align-right"><i class="fa fa-align-right" aria-hidden="true"></i> align-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bold"><i class="fa fa-bold" aria-hidden="true"></i> bold</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="link"><i class="fa fa-chain" aria-hidden="true"></i> chain <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="chain-broken"><i class="fa fa-chain-broken" aria-hidden="true"></i> chain-broken</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="clipboard"><i class="fa fa-clipboard" aria-hidden="true"></i> clipboard</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="columns"><i class="fa fa-columns" aria-hidden="true"></i> columns</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="files-o"><i class="fa fa-copy" aria-hidden="true"></i> copy <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="scissors"><i class="fa fa-cut" aria-hidden="true"></i> cut <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="outdent"><i class="fa fa-dedent" aria-hidden="true"></i> dedent <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="eraser"><i class="fa fa-eraser" aria-hidden="true"></i> eraser</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file"><i class="fa fa-file" aria-hidden="true"></i> file</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-o"><i class="fa fa-file-o" aria-hidden="true"></i> file-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-text"><i class="fa fa-file-text" aria-hidden="true"></i> file-text</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="file-text-o"><i class="fa fa-file-text-o" aria-hidden="true"></i> file-text-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="files-o"><i class="fa fa-files-o" aria-hidden="true"></i> files-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="floppy-o"><i class="fa fa-floppy-o" aria-hidden="true"></i> floppy-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="font"><i class="fa fa-font" aria-hidden="true"></i> font</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="header"><i class="fa fa-header" aria-hidden="true"></i> header</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="indent"><i class="fa fa-indent" aria-hidden="true"></i> indent</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="italic"><i class="fa fa-italic" aria-hidden="true"></i> italic</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="link"><i class="fa fa-link" aria-hidden="true"></i> link</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="list"><i class="fa fa-list" aria-hidden="true"></i> list</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="list-alt"><i class="fa fa-list-alt" aria-hidden="true"></i> list-alt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="list-ol"><i class="fa fa-list-ol" aria-hidden="true"></i> list-ol</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="list-ul"><i class="fa fa-list-ul" aria-hidden="true"></i> list-ul</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="outdent"><i class="fa fa-outdent" aria-hidden="true"></i> outdent</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="paperclip"><i class="fa fa-paperclip" aria-hidden="true"></i> paperclip</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="paragraph"><i class="fa fa-paragraph" aria-hidden="true"></i> paragraph</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="clipboard"><i class="fa fa-paste" aria-hidden="true"></i> paste <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="repeat"><i class="fa fa-repeat" aria-hidden="true"></i> repeat</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="undo"><i class="fa fa-rotate-left" aria-hidden="true"></i> rotate-left <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="repeat"><i class="fa fa-rotate-right" aria-hidden="true"></i> rotate-right <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="floppy-o"><i class="fa fa-save" aria-hidden="true"></i> save <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="scissors"><i class="fa fa-scissors" aria-hidden="true"></i> scissors</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="strikethrough"><i class="fa fa-strikethrough" aria-hidden="true"></i> strikethrough</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="subscript"><i class="fa fa-subscript" aria-hidden="true"></i> subscript</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="superscript"><i class="fa fa-superscript" aria-hidden="true"></i> superscript</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="table"><i class="fa fa-table" aria-hidden="true"></i> table</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="text-height"><i class="fa fa-text-height" aria-hidden="true"></i> text-height</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="text-width"><i class="fa fa-text-width" aria-hidden="true"></i> text-width</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="th"><i class="fa fa-th" aria-hidden="true"></i> th</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="th-large"><i class="fa fa-th-large" aria-hidden="true"></i> th-large</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="th-list"><i class="fa fa-th-list" aria-hidden="true"></i> th-list</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="underline"><i class="fa fa-underline" aria-hidden="true"></i> underline</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="undo"><i class="fa fa-undo" aria-hidden="true"></i> undo</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="chain-broken"><i class="fa fa-unlink" aria-hidden="true"></i> unlink <span class="text-muted">(alias)</span></span> </div>
				</div>
			</section>
			<section id="directional">
				<h2 class="page-header">Directional Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="angle-double-down"><i class="fa fa-angle-double-down" aria-hidden="true"></i> angle-double-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="angle-double-left"><i class="fa fa-angle-double-left" aria-hidden="true"></i> angle-double-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="angle-double-right"><i class="fa fa-angle-double-right" aria-hidden="true"></i> angle-double-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="angle-double-up"><i class="fa fa-angle-double-up" aria-hidden="true"></i> angle-double-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="angle-down"><i class="fa fa-angle-down" aria-hidden="true"></i> angle-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="angle-left"><i class="fa fa-angle-left" aria-hidden="true"></i> angle-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="angle-right"><i class="fa fa-angle-right" aria-hidden="true"></i> angle-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="angle-up"><i class="fa fa-angle-up" aria-hidden="true"></i> angle-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrow-circle-down"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i> arrow-circle-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrow-circle-left"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> arrow-circle-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrow-circle-o-down"><i class="fa fa-arrow-circle-o-down" aria-hidden="true"></i> arrow-circle-o-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrow-circle-o-left"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> arrow-circle-o-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrow-circle-o-right"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> arrow-circle-o-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrow-circle-o-up"><i class="fa fa-arrow-circle-o-up" aria-hidden="true"></i> arrow-circle-o-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrow-circle-right"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> arrow-circle-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrow-circle-up"><i class="fa fa-arrow-circle-up" aria-hidden="true"></i> arrow-circle-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrow-down"><i class="fa fa-arrow-down" aria-hidden="true"></i> arrow-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrow-left"><i class="fa fa-arrow-left" aria-hidden="true"></i> arrow-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrow-right"><i class="fa fa-arrow-right" aria-hidden="true"></i> arrow-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrow-up"><i class="fa fa-arrow-up" aria-hidden="true"></i> arrow-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrows"><i class="fa fa-arrows" aria-hidden="true"></i> arrows</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrows-alt"><i class="fa fa-arrows-alt" aria-hidden="true"></i> arrows-alt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrows-h"><i class="fa fa-arrows-h" aria-hidden="true"></i> arrows-h</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrows-v"><i class="fa fa-arrows-v" aria-hidden="true"></i> arrows-v</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-down"><i class="fa fa-caret-down" aria-hidden="true"></i> caret-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-left"><i class="fa fa-caret-left" aria-hidden="true"></i> caret-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-right"><i class="fa fa-caret-right" aria-hidden="true"></i> caret-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-down"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i> caret-square-o-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-left"><i class="fa fa-caret-square-o-left" aria-hidden="true"></i> caret-square-o-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-right"><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> caret-square-o-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-up"><i class="fa fa-caret-square-o-up" aria-hidden="true"></i> caret-square-o-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-up"><i class="fa fa-caret-up" aria-hidden="true"></i> caret-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="chevron-circle-down"><i class="fa fa-chevron-circle-down" aria-hidden="true"></i> chevron-circle-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="chevron-circle-left"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i> chevron-circle-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="chevron-circle-right"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> chevron-circle-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="chevron-circle-up"><i class="fa fa-chevron-circle-up" aria-hidden="true"></i> chevron-circle-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="chevron-down"><i class="fa fa-chevron-down" aria-hidden="true"></i> chevron-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="chevron-left"><i class="fa fa-chevron-left" aria-hidden="true"></i> chevron-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="chevron-right"><i class="fa fa-chevron-right" aria-hidden="true"></i> chevron-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="chevron-up"><i class="fa fa-chevron-up" aria-hidden="true"></i> chevron-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="exchange"><i class="fa fa-exchange" aria-hidden="true"></i> exchange</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-o-down"><i class="fa fa-hand-o-down" aria-hidden="true"></i> hand-o-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-o-left"><i class="fa fa-hand-o-left" aria-hidden="true"></i> hand-o-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-o-right"><i class="fa fa-hand-o-right" aria-hidden="true"></i> hand-o-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hand-o-up"><i class="fa fa-hand-o-up" aria-hidden="true"></i> hand-o-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="long-arrow-down"><i class="fa fa-long-arrow-down" aria-hidden="true"></i> long-arrow-down</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="long-arrow-left"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> long-arrow-left</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="long-arrow-right"><i class="fa fa-long-arrow-right" aria-hidden="true"></i> long-arrow-right</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="long-arrow-up"><i class="fa fa-long-arrow-up" aria-hidden="true"></i> long-arrow-up</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-down"><i class="fa fa-toggle-down" aria-hidden="true"></i> toggle-down <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-left"><i class="fa fa-toggle-left" aria-hidden="true"></i> toggle-left <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-right"><i class="fa fa-toggle-right" aria-hidden="true"></i> toggle-right <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="caret-square-o-up"><i class="fa fa-toggle-up" aria-hidden="true"></i> toggle-up <span class="text-muted">(alias)</span></span> </div>
				</div>
			</section>
			<section id="video-player">
				<h2 class="page-header">Video Player Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="arrows-alt"><i class="fa fa-arrows-alt" aria-hidden="true"></i> arrows-alt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="backward"><i class="fa fa-backward" aria-hidden="true"></i> backward</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="compress"><i class="fa fa-compress" aria-hidden="true"></i> compress</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="eject"><i class="fa fa-eject" aria-hidden="true"></i> eject</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="expand"><i class="fa fa-expand" aria-hidden="true"></i> expand</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="fast-backward"><i class="fa fa-fast-backward" aria-hidden="true"></i> fast-backward</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="fast-forward"><i class="fa fa-fast-forward" aria-hidden="true"></i> fast-forward</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="forward"><i class="fa fa-forward" aria-hidden="true"></i> forward</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pause"><i class="fa fa-pause" aria-hidden="true"></i> pause</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pause-circle"><i class="fa fa-pause-circle" aria-hidden="true"></i> pause-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pause-circle-o"><i class="fa fa-pause-circle-o" aria-hidden="true"></i> pause-circle-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="play"><i class="fa fa-play" aria-hidden="true"></i> play</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="play-circle"><i class="fa fa-play-circle" aria-hidden="true"></i> play-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="play-circle-o"><i class="fa fa-play-circle-o" aria-hidden="true"></i> play-circle-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="random"><i class="fa fa-random" aria-hidden="true"></i> random</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="step-backward"><i class="fa fa-step-backward" aria-hidden="true"></i> step-backward</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="step-forward"><i class="fa fa-step-forward" aria-hidden="true"></i> step-forward</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="stop"><i class="fa fa-stop" aria-hidden="true"></i> stop</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="stop-circle"><i class="fa fa-stop-circle" aria-hidden="true"></i> stop-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="stop-circle-o"><i class="fa fa-stop-circle-o" aria-hidden="true"></i> stop-circle-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="youtube-play"><i class="fa fa-youtube-play" aria-hidden="true"></i> youtube-play</span> </div>
				</div>
			</section>
			<section id="brand">
				<h2 class="page-header">Brand Icons</h2>
				<div class="row fontawesome-icon-list margin-bottom-lg">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="500px"><i class="fa fa-500px" aria-hidden="true"></i> 500px</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="adn"><i class="fa fa-adn" aria-hidden="true"></i> adn</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="amazon"><i class="fa fa-amazon" aria-hidden="true"></i> amazon</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="android"><i class="fa fa-android" aria-hidden="true"></i> android</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="angellist"><i class="fa fa-angellist" aria-hidden="true"></i> angellist</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="apple"><i class="fa fa-apple" aria-hidden="true"></i> apple</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bandcamp"><i class="fa fa-bandcamp" aria-hidden="true"></i> bandcamp</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="behance"><i class="fa fa-behance" aria-hidden="true"></i> behance</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="behance-square"><i class="fa fa-behance-square" aria-hidden="true"></i> behance-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bitbucket"><i class="fa fa-bitbucket" aria-hidden="true"></i> bitbucket</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bitbucket-square"><i class="fa fa-bitbucket-square" aria-hidden="true"></i> bitbucket-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="btc"><i class="fa fa-bitcoin" aria-hidden="true"></i> bitcoin <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="black-tie"><i class="fa fa-black-tie" aria-hidden="true"></i> black-tie</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bluetooth"><i class="fa fa-bluetooth" aria-hidden="true"></i> bluetooth</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="bluetooth-b"><i class="fa fa-bluetooth-b" aria-hidden="true"></i> bluetooth-b</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="btc"><i class="fa fa-btc" aria-hidden="true"></i> btc</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="buysellads"><i class="fa fa-buysellads" aria-hidden="true"></i> buysellads</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-amex"><i class="fa fa-cc-amex" aria-hidden="true"></i> cc-amex</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-diners-club"><i class="fa fa-cc-diners-club" aria-hidden="true"></i> cc-diners-club</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-discover"><i class="fa fa-cc-discover" aria-hidden="true"></i> cc-discover</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-jcb"><i class="fa fa-cc-jcb" aria-hidden="true"></i> cc-jcb</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-mastercard"><i class="fa fa-cc-mastercard" aria-hidden="true"></i> cc-mastercard</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-paypal"><i class="fa fa-cc-paypal" aria-hidden="true"></i> cc-paypal</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-stripe"><i class="fa fa-cc-stripe" aria-hidden="true"></i> cc-stripe</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="cc-visa"><i class="fa fa-cc-visa" aria-hidden="true"></i> cc-visa</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="chrome"><i class="fa fa-chrome" aria-hidden="true"></i> chrome</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="codepen"><i class="fa fa-codepen" aria-hidden="true"></i> codepen</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="codiepie"><i class="fa fa-codiepie" aria-hidden="true"></i> codiepie</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="connectdevelop"><i class="fa fa-connectdevelop" aria-hidden="true"></i> connectdevelop</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="contao"><i class="fa fa-contao" aria-hidden="true"></i> contao</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="css3"><i class="fa fa-css3" aria-hidden="true"></i> css3</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="dashcube"><i class="fa fa-dashcube" aria-hidden="true"></i> dashcube</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="delicious"><i class="fa fa-delicious" aria-hidden="true"></i> delicious</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="deviantart"><i class="fa fa-deviantart" aria-hidden="true"></i> deviantart</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="digg"><i class="fa fa-digg" aria-hidden="true"></i> digg</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i> dribbble</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="dropbox"><i class="fa fa-dropbox" aria-hidden="true"></i> dropbox</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="drupal"><i class="fa fa-drupal" aria-hidden="true"></i> drupal</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="edge"><i class="fa fa-edge" aria-hidden="true"></i> edge</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="eercast"><i class="fa fa-eercast" aria-hidden="true"></i> eercast</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="empire"><i class="fa fa-empire" aria-hidden="true"></i> empire</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="envira"><i class="fa fa-envira" aria-hidden="true"></i> envira</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="etsy"><i class="fa fa-etsy" aria-hidden="true"></i> etsy</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="expeditedssl"><i class="fa fa-expeditedssl" aria-hidden="true"></i> expeditedssl</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="font-awesome"><i class="fa fa-fa" aria-hidden="true"></i> fa <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="facebook"><i class="fa fa-facebook" aria-hidden="true"></i> facebook</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="facebook"><i class="fa fa-facebook-f" aria-hidden="true"></i> facebook-f <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="facebook-official"><i class="fa fa-facebook-official" aria-hidden="true"></i> facebook-official</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="facebook-square"><i class="fa fa-facebook-square" aria-hidden="true"></i> facebook-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="firefox"><i class="fa fa-firefox" aria-hidden="true"></i> firefox</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="first-order"><i class="fa fa-first-order" aria-hidden="true"></i> first-order</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="flickr"><i class="fa fa-flickr" aria-hidden="true"></i> flickr</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="font-awesome"><i class="fa fa-font-awesome" aria-hidden="true"></i> font-awesome</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="fonticons"><i class="fa fa-fonticons" aria-hidden="true"></i> fonticons</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="fort-awesome"><i class="fa fa-fort-awesome" aria-hidden="true"></i> fort-awesome</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="forumbee"><i class="fa fa-forumbee" aria-hidden="true"></i> forumbee</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="foursquare"><i class="fa fa-foursquare" aria-hidden="true"></i> foursquare</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="free-code-camp"><i class="fa fa-free-code-camp" aria-hidden="true"></i> free-code-camp</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="empire"><i class="fa fa-ge" aria-hidden="true"></i> ge <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="get-pocket"><i class="fa fa-get-pocket" aria-hidden="true"></i> get-pocket</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="gg"><i class="fa fa-gg" aria-hidden="true"></i> gg</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="gg-circle"><i class="fa fa-gg-circle" aria-hidden="true"></i> gg-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="git"><i class="fa fa-git" aria-hidden="true"></i> git</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="git-square"><i class="fa fa-git-square" aria-hidden="true"></i> git-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="github"><i class="fa fa-github" aria-hidden="true"></i> github</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="github-alt"><i class="fa fa-github-alt" aria-hidden="true"></i> github-alt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="github-square"><i class="fa fa-github-square" aria-hidden="true"></i> github-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="gitlab"><i class="fa fa-gitlab" aria-hidden="true"></i> gitlab</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="gratipay"><i class="fa fa-gittip" aria-hidden="true"></i> gittip <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="glide"><i class="fa fa-glide" aria-hidden="true"></i> glide</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="glide-g"><i class="fa fa-glide-g" aria-hidden="true"></i> glide-g</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="google"><i class="fa fa-google" aria-hidden="true"></i> google</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="google-plus"><i class="fa fa-google-plus" aria-hidden="true"></i> google-plus</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="google-plus-official"><i class="fa fa-google-plus-circle" aria-hidden="true"></i> google-plus-circle <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="google-plus-official"><i class="fa fa-google-plus-official" aria-hidden="true"></i> google-plus-official</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="google-plus-square"><i class="fa fa-google-plus-square" aria-hidden="true"></i> google-plus-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="google-wallet"><i class="fa fa-google-wallet" aria-hidden="true"></i> google-wallet</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="gratipay"><i class="fa fa-gratipay" aria-hidden="true"></i> gratipay</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="grav"><i class="fa fa-grav" aria-hidden="true"></i> grav</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hacker-news"><i class="fa fa-hacker-news" aria-hidden="true"></i> hacker-news</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="houzz"><i class="fa fa-houzz" aria-hidden="true"></i> houzz</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="html5"><i class="fa fa-html5" aria-hidden="true"></i> html5</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="imdb"><i class="fa fa-imdb" aria-hidden="true"></i> imdb</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="instagram"><i class="fa fa-instagram" aria-hidden="true"></i> instagram</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="internet-explorer"><i class="fa fa-internet-explorer" aria-hidden="true"></i> internet-explorer</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="ioxhost"><i class="fa fa-ioxhost" aria-hidden="true"></i> ioxhost</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="joomla"><i class="fa fa-joomla" aria-hidden="true"></i> joomla</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="jsfiddle"><i class="fa fa-jsfiddle" aria-hidden="true"></i> jsfiddle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="lastfm"><i class="fa fa-lastfm" aria-hidden="true"></i> lastfm</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="lastfm-square"><i class="fa fa-lastfm-square" aria-hidden="true"></i> lastfm-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="leanpub"><i class="fa fa-leanpub" aria-hidden="true"></i> leanpub</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i> linkedin</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="linkedin-square"><i class="fa fa-linkedin-square" aria-hidden="true"></i> linkedin-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="linode"><i class="fa fa-linode" aria-hidden="true"></i> linode</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="linux"><i class="fa fa-linux" aria-hidden="true"></i> linux</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="maxcdn"><i class="fa fa-maxcdn" aria-hidden="true"></i> maxcdn</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="meanpath"><i class="fa fa-meanpath" aria-hidden="true"></i> meanpath</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="medium"><i class="fa fa-medium" aria-hidden="true"></i> medium</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="meetup"><i class="fa fa-meetup" aria-hidden="true"></i> meetup</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="mixcloud"><i class="fa fa-mixcloud" aria-hidden="true"></i> mixcloud</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="modx"><i class="fa fa-modx" aria-hidden="true"></i> modx</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="odnoklassniki"><i class="fa fa-odnoklassniki" aria-hidden="true"></i> odnoklassniki</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="odnoklassniki-square"><i class="fa fa-odnoklassniki-square" aria-hidden="true"></i> odnoklassniki-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="opencart"><i class="fa fa-opencart" aria-hidden="true"></i> opencart</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="openid"><i class="fa fa-openid" aria-hidden="true"></i> openid</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="opera"><i class="fa fa-opera" aria-hidden="true"></i> opera</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="optin-monster"><i class="fa fa-optin-monster" aria-hidden="true"></i> optin-monster</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pagelines"><i class="fa fa-pagelines" aria-hidden="true"></i> pagelines</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="paypal"><i class="fa fa-paypal" aria-hidden="true"></i> paypal</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pied-piper"><i class="fa fa-pied-piper" aria-hidden="true"></i> pied-piper</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pied-piper-alt"><i class="fa fa-pied-piper-alt" aria-hidden="true"></i> pied-piper-alt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pied-piper-pp"><i class="fa fa-pied-piper-pp" aria-hidden="true"></i> pied-piper-pp</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i> pinterest</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pinterest-p"><i class="fa fa-pinterest-p" aria-hidden="true"></i> pinterest-p</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="pinterest-square"><i class="fa fa-pinterest-square" aria-hidden="true"></i> pinterest-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="product-hunt"><i class="fa fa-product-hunt" aria-hidden="true"></i> product-hunt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="qq"><i class="fa fa-qq" aria-hidden="true"></i> qq</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="quora"><i class="fa fa-quora" aria-hidden="true"></i> quora</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="rebel"><i class="fa fa-ra" aria-hidden="true"></i> ra <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="ravelry"><i class="fa fa-ravelry" aria-hidden="true"></i> ravelry</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="rebel"><i class="fa fa-rebel" aria-hidden="true"></i> rebel</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="reddit"><i class="fa fa-reddit" aria-hidden="true"></i> reddit</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="reddit-alien"><i class="fa fa-reddit-alien" aria-hidden="true"></i> reddit-alien</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="reddit-square"><i class="fa fa-reddit-square" aria-hidden="true"></i> reddit-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="renren"><i class="fa fa-renren" aria-hidden="true"></i> renren</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="rebel"><i class="fa fa-resistance" aria-hidden="true"></i> resistance <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="safari"><i class="fa fa-safari" aria-hidden="true"></i> safari</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="scribd"><i class="fa fa-scribd" aria-hidden="true"></i> scribd</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="sellsy"><i class="fa fa-sellsy" aria-hidden="true"></i> sellsy</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="share-alt"><i class="fa fa-share-alt" aria-hidden="true"></i> share-alt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="share-alt-square"><i class="fa fa-share-alt-square" aria-hidden="true"></i> share-alt-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="shirtsinbulk"><i class="fa fa-shirtsinbulk" aria-hidden="true"></i> shirtsinbulk</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="simplybuilt"><i class="fa fa-simplybuilt" aria-hidden="true"></i> simplybuilt</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="skyatlas"><i class="fa fa-skyatlas" aria-hidden="true"></i> skyatlas</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="skype"><i class="fa fa-skype" aria-hidden="true"></i> skype</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="slack"><i class="fa fa-slack" aria-hidden="true"></i> slack</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="slideshare"><i class="fa fa-slideshare" aria-hidden="true"></i> slideshare</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="snapchat"><i class="fa fa-snapchat" aria-hidden="true"></i> snapchat</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="snapchat-ghost"><i class="fa fa-snapchat-ghost" aria-hidden="true"></i> snapchat-ghost</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="snapchat-square"><i class="fa fa-snapchat-square" aria-hidden="true"></i> snapchat-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="soundcloud"><i class="fa fa-soundcloud" aria-hidden="true"></i> soundcloud</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="spotify"><i class="fa fa-spotify" aria-hidden="true"></i> spotify</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="stack-exchange"><i class="fa fa-stack-exchange" aria-hidden="true"></i> stack-exchange</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="stack-overflow"><i class="fa fa-stack-overflow" aria-hidden="true"></i> stack-overflow</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="steam"><i class="fa fa-steam" aria-hidden="true"></i> steam</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="steam-square"><i class="fa fa-steam-square" aria-hidden="true"></i> steam-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="stumbleupon"><i class="fa fa-stumbleupon" aria-hidden="true"></i> stumbleupon</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="stumbleupon-circle"><i class="fa fa-stumbleupon-circle" aria-hidden="true"></i> stumbleupon-circle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="superpowers"><i class="fa fa-superpowers" aria-hidden="true"></i> superpowers</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="telegram"><i class="fa fa-telegram" aria-hidden="true"></i> telegram</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tencent-weibo"><i class="fa fa-tencent-weibo" aria-hidden="true"></i> tencent-weibo</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="themeisle"><i class="fa fa-themeisle" aria-hidden="true"></i> themeisle</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="trello"><i class="fa fa-trello" aria-hidden="true"></i> trello</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tripadvisor"><i class="fa fa-tripadvisor" aria-hidden="true"></i> tripadvisor</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tumblr"><i class="fa fa-tumblr" aria-hidden="true"></i> tumblr</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="tumblr-square"><i class="fa fa-tumblr-square" aria-hidden="true"></i> tumblr-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="twitch"><i class="fa fa-twitch" aria-hidden="true"></i> twitch</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="twitter"><i class="fa fa-twitter" aria-hidden="true"></i> twitter</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="twitter-square"><i class="fa fa-twitter-square" aria-hidden="true"></i> twitter-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="usb"><i class="fa fa-usb" aria-hidden="true"></i> usb</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="viacoin"><i class="fa fa-viacoin" aria-hidden="true"></i> viacoin</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="viadeo"><i class="fa fa-viadeo" aria-hidden="true"></i> viadeo</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="viadeo-square"><i class="fa fa-viadeo-square" aria-hidden="true"></i> viadeo-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="vimeo"><i class="fa fa-vimeo" aria-hidden="true"></i> vimeo</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="vimeo-square"><i class="fa fa-vimeo-square" aria-hidden="true"></i> vimeo-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="vine"><i class="fa fa-vine" aria-hidden="true"></i> vine</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="vk"><i class="fa fa-vk" aria-hidden="true"></i> vk</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="weixin"><i class="fa fa-wechat" aria-hidden="true"></i> wechat <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="weibo"><i class="fa fa-weibo" aria-hidden="true"></i> weibo</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="weixin"><i class="fa fa-weixin" aria-hidden="true"></i> weixin</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i> whatsapp</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wikipedia-w"><i class="fa fa-wikipedia-w" aria-hidden="true"></i> wikipedia-w</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="windows"><i class="fa fa-windows" aria-hidden="true"></i> windows</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wordpress"><i class="fa fa-wordpress" aria-hidden="true"></i> wordpress</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wpbeginner"><i class="fa fa-wpbeginner" aria-hidden="true"></i> wpbeginner</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wpexplorer"><i class="fa fa-wpexplorer" aria-hidden="true"></i> wpexplorer</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wpforms"><i class="fa fa-wpforms" aria-hidden="true"></i> wpforms</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="xing"><i class="fa fa-xing" aria-hidden="true"></i> xing</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="xing-square"><i class="fa fa-xing-square" aria-hidden="true"></i> xing-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="y-combinator"><i class="fa fa-y-combinator" aria-hidden="true"></i> y-combinator</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hacker-news"><i class="fa fa-y-combinator-square" aria-hidden="true"></i> y-combinator-square <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="yahoo"><i class="fa fa-yahoo" aria-hidden="true"></i> yahoo</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="y-combinator"><i class="fa fa-yc" aria-hidden="true"></i> yc <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hacker-news"><i class="fa fa-yc-square" aria-hidden="true"></i> yc-square <span class="text-muted">(alias)</span></span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="yelp"><i class="fa fa-yelp" aria-hidden="true"></i> yelp</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="yoast"><i class="fa fa-yoast" aria-hidden="true"></i> yoast</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="youtube"><i class="fa fa-youtube" aria-hidden="true"></i> youtube</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="youtube-play"><i class="fa fa-youtube-play" aria-hidden="true"></i> youtube-play</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="youtube-square"><i class="fa fa-youtube-square" aria-hidden="true"></i> youtube-square</span> </div>
				</div>
			</section>
			<section id="medical">
				<h2 class="page-header">Medical Icons</h2>
				<div class="row fontawesome-icon-list">
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="ambulance"><i class="fa fa-ambulance" aria-hidden="true"></i> ambulance</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="h-square"><i class="fa fa-h-square" aria-hidden="true"></i> h-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="heart"><i class="fa fa-heart" aria-hidden="true"></i> heart</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="heart-o"><i class="fa fa-heart-o" aria-hidden="true"></i> heart-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="heartbeat"><i class="fa fa-heartbeat" aria-hidden="true"></i> heartbeat</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="hospital-o"><i class="fa fa-hospital-o" aria-hidden="true"></i> hospital-o</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="medkit"><i class="fa fa-medkit" aria-hidden="true"></i> medkit</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="plus-square"><i class="fa fa-plus-square" aria-hidden="true"></i> plus-square</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="stethoscope"><i class="fa fa-stethoscope" aria-hidden="true"></i> stethoscope</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="user-md"><i class="fa fa-user-md" aria-hidden="true"></i> user-md</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wheelchair"><i class="fa fa-wheelchair" aria-hidden="true"></i> wheelchair</span> </div>
					<div class="fa-icon-container"><span class="wpmw-fa-icon" id="wheelchair-alt"><i class="fa fa-wheelchair-alt" aria-hidden="true"></i> wheelchair-alt</span> </div>
				</div>
			</section>
		';
		return $html_icons;
	}
}