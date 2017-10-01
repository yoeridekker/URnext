<?php 

global $urnext_theme_options;

$fontlist = get_google_fonts_list();
$urnext_theme_options = array(
    // section key 
    'urnext_header_caption' => array(
        'name'          => __( 'Header Caption', 'urnext' ),
        'description'   => __('Change the header caption', 'urnext'), 
        'settings'      => array(
            'header_caption_text' => array(
                'default'       => '',
                'label'         => __( 'Header Caption Text', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'textarea',
                'description'   => __( 'Set the header caption text', 'urnext' ),
            ),
        )
    ),
    'urnext_style_options' => array(
        'name'          => __( 'Theme Styles', 'urnext' ),
        'description'   => __('Change theme style options', 'urnext'), 
        'settings'      => array(
            
            // Layout 
            'layout' => array(
                'default'       => 'layout-full',
                'label'         => __( 'Layout', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'select',
                'choices'       => array(
                    'layout-full'  => 'Fullscreen',
                    'layout-boxed' => 'Boxed'
                ),
                'description'   => __( 'Choose a layout for your theme', 'urnext' ),
            ),

            // Fonts
            'font' => array(
                'default'       => 'system',
                'label'         => __( 'Font', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'select',
                'choices'       => $fontlist,
                'description'   => __( 'Choose a Google Webfont for your theme', 'urnext' ),
                'style'         => 'font',
                'selector'      => 'body'
            ),
            'font_weight' => array(
                'default'       => 'normal',
                'label'         => __( 'Font weight', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'text',
                'description'   => __( 'Provide a font-weight (normal|bold|bolder|lighter|number|initial)', 'urnext' ),
                'style'         => 'fontweight',
                'selector'      => 'body'
            ),
            'font_size' => array(
                'default'       => '16',
                'label'         => __( 'Fontsize', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'number',
                'description'   => __( 'Provide a font-size in pixels', 'urnext' ),
                'style'         => 'fontsize',
                'selector'      => 'body'
            ),
            'heading_font' => array(
                'default'       => 'system',
                'label'         => __( 'Headings Font', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'select',
                'choices'       => $fontlist,
                'description'   => __( 'Choose a Google Webfont for your theme headings', 'urnext' ),
                'style'         => 'font',
                'selector'      => 'h1,h2,h3,h4,h5,h6'
            ),
            'heading_font_weight' => array(
                'default'       => 'normal',
                'label'         => __( 'Heading font weight', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'text',
                'description'   => __( 'Provide a font-weight (normal|bold|bolder|lighter|number|initial)', 'urnext' ),
                'style'         => 'fontweight',
                'selector'      => 'h1,h2,h3,h4,h5,h6'
            ),
            'heading_text_transform' => array(
                'default'       => 'none',
                'label'         => __( 'Heading text transform', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'text',
                'description'   => __( 'Provide text-transform (none|capitalize|uppercase|lowercase|initial|inherit)', 'urnext' ),
                'style'         => 'text-transform',
                'selector'      => 'h1,h2,h3,h4,h5,h6'
            ),

            // Body background and text color
            'body_color' => array(
                'default'       => '#ffffff',
                'label'         => __( 'Body Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'selector'      => 'html,body',
                'opacity'       => 100
            ),
            'page_color' => array(
                'default'       => '#ffffff',
                'label'         => __( 'Page Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 100
            ),
            'text_color' => array(
                'default'       => '#444444',
                'label'         => __( 'Text Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'selector'      => 'html,body',
                'opacity'       => 100
            ),
            'heading_color' => array(
                'default'       => '#444444',
                'label'         => __( 'Heading Text Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'selector'      => 'h1,h2,h3,h4,h5,h6',
                'only_global'   => true,
                'opacity'       => 100
            ),

            // Hyperlink styles
            'a_color' => array(
                'default'       => '#222222',
                'label'         => __( 'Link Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'selector'      => 'body a,body a:active,body a:visited',
                'only_global'   => true,
                'opacity'       => 100
            ),
            'a_color_hover' => array(
                'default'       => '#000000',
                'label'         => __( 'Link Hover Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'selector'      => 'body a:hover',
                'only_global'   => true,
                'opacity'       => 100
            ),

            // Border styles
            'border_color' => array(
                'default'       => '#222222',
                'label'         => __( 'Border Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 100
            ),
            'border_color_opacity' => array(
                'default'       => '100',
                'label'         => __( 'Border Color Opacity', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'number',
                'description'   => __( 'Set the border color opacity between 0 and 100', 'urnext' ), 
            ),

            // Breadcrumbs
            'breadcrumbs' => array(
                'default'       => '',
                'label'         => __( 'Show breadcrumbs?', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'checkbox',
                'description'   => __( 'Check to enable breadcrumbs', 'urnext' ), 
            ),  

            // Primary color
            'primary_color' => array(
                'default'       => '#00c7ce',
                'label'         => __( 'Primary Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 100,
                'description'   => __('The primary color is used for hover effects, overlays and other additional styles','urnext')
            ), 
            'primary_text_color' => array(
                'default'       => '#ffffff',
                'label'         => __( 'Primary Text Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 100,
                'description'   => __('The primary color is used for hover effects, overlays and other additional styles','urnext')
            ),  
           
        )
    ),
    'urnext_header_style_options' => array(
        'name'          => __( 'Header Styles', 'urnext' ),
        'description'   => __('Change header style options', 'urnext'), 
        'settings'      => array(

            // Top bar background and color 
            'top_bar_color' => array(
                'default'       => '#ffffff',
                'label'         => __( 'Top Bar Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 0
            ),
            'top_bar_text_color' => array(
                'default'       => '#ffffff',
                'label'         => __( 'Top Bar Font Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 100
            ),
            'top_bar_color_opacity' => array(
                'default'       => '0',
                'label'         => __( 'Top Bar Background Opacity', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'number',
                'description'   => __( 'Set the top bar opacity between 0 and 100', 'urnext' ), 
            ),

            // Menu background and text color
            'menu_color' => array(
                'default'       => '#67bbbf',
                'label'         => __( 'Menu Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 100
            ),
            'menu_text_color' => array(
                'default'       => '#ffffff',
                'label'         => __( 'Menu Font Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 100
            ),
            'menu_color_opacity' => array(
                'default'       => '100',
                'label'         => __( 'Menu Opacity', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'number',
                'description'   => __( 'Set the menu opacity between 0 and 100', 'urnext' ), 
            ),

            // Header background and text color
            'header_color' => array(
                'default'       => '#67bbbf',
                'label'         => __( 'Header Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 100
            ),
            'header_color_opacity' => array(
                'default'       => '100',
                'label'         => __( 'Header Opacity', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'number',
                'description'   => __( 'Set the header opacity between 0 and 100', 'urnext' ), 
            ),
            'header_text_color' => array(
                'default'       => '#ffffff',
                'label'         => __( 'Header Font Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 100
            ),
            'header_parallax' => array(
                'default'       => '',
                'label'         => __( 'Header Parallax', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'checkbox',
                'description'   => __( 'Check to activate the parallax effect on the header', 'urnext' ), 
            ),
            'sticky_header'     => array(
                'default'       => '',
                'label'         => __( 'Sticky Header', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'checkbox',
                'description'   => __( 'Check to make the header sticky', 'urnext' ), 
            ),
            'fullheight_header'     => array(
                'default'       => '',
                'label'         => __( 'Full-height Header', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'checkbox',
                'description'   => __( 'Check to make the header fullheight', 'urnext' ), 
            ),
            'hide_header'     => array(
                'default'       => '',
                'label'         => __( 'Hide Header', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'checkbox',
                'description'   => __( 'Check to make the header hide on sroll', 'urnext' ), 
            ),

            // Overlay 
            'header_overlay_color' => array(
                'default'       => '#ffffff',
                'label'         => __( 'Header Overlay Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 0, 
            ),
            'header_overlay_color_opacity' => array(
                'default'       => '0',
                'label'         => __( 'Header Overlay Opacity', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'number',
                'description'   => __( 'Set the header opacity between 0 and 100', 'urnext' ),
            ),

            // Logo
            'logo' => array(
                'label'         => __( 'Upload your logo', 'urnext' ), 
                'default'       => get_template_directory_uri() . '/images/logo.png',
                'method'        => 'WP_Customize_Image_Control'
            ),
        ),
    ),
    'urnext_footer_options' => array(
        'name'          => __( 'Footer Styles', 'urnext' ),
        'description'   => __('Change footer style options', 'urnext'), 
        'settings'      => array(

            // Footer background and text color
            'footer_color' => array(
                'default'       => '#dddddd',
                'label'         => __( 'Footer Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 100
            ),
            'footer_text_color' => array(
                'default'       => '#555555',
                'label'         => __( 'Footer Text Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 100
            ),

            // Footer link color
            'a_footer_color' => array(
                'default'       => '#000000',
                'label'         => __( 'Footer Link Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'selector'      => 'body #footer a,body #footer a:active,body #footer a:visited',
                'only_global'   => true,
                'opacity'       => 100
            ),
            'a_footer_color_hover' => array(
                'default'       => '#777777',
                'label'         => __( 'Footer Link Hover Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'selector'      => 'body #footer a:hover',
                'only_global'   => true,
                'opacity'       => 100
            ),

            // Border styles
            'footer_border_color' => array(
                'default'       => '#222222',
                'label'         => __( 'Footer Border Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'opacity'       => 100
            ),
            'footer_border_color_opacity' => array(
                'default'       => '100',
                'label'         => __( 'Footer Border Color Opacity', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'number',
                'description'   => __( 'Set the footer border color opacity between 0 and 100', 'urnext' ), 
            ),
            
        )
    ),
);

add_action( 'customize_register' , 'urnext_init_theme_options' );

function urnext_init_theme_options( $wp_customize ) {
    global $urnext_theme_options;
    // Sections, settings and controls will be added here
    foreach( $urnext_theme_options as $section => $settings ){
        
        // First add the section
        $wp_customize->add_section( 
            $section, 
            array(
                'title'       => $settings['name'],
                'priority'    => 100,
                'capability'  => 'edit_theme_options',
                'description' => $settings['description'], 
            ) 
        );

        // Now add the settings
        foreach( $settings['settings'] as $setting => $setting_data ){
            
            // Set the empty options 
            $options = array();

            // Add setting
            $wp_customize->add_setting( $setting,
                array(
                    'default' => ( isset( $setting_data['default'] ) ? $setting_data['default'] : '' ),
                    'sanitize_callback' => 'urnext_sanitize_customizer_setting',
                )
            ); 
            
            // Set the minimal options
            $options = array(
                'label'    => $setting_data['label'], 
                'section'  => $section,
                'settings' => $setting,
                'priority' => 10,
            );

            // If we have a type, add it
            if( isset( $setting_data['type'] ) && !empty( $setting_data['type'] ) ){
                $options['type'] = $setting_data['type'];
            }

            // If we have a description, add it
            if( isset( $setting_data['description'] ) && !empty( $setting_data['description'] ) ){
                $options['description'] = $setting_data['description'];
            }

            // If we have choices, add it
            if( isset( $setting_data['choices'] ) && !empty( $setting_data['choices'] ) ){
                $options['choices'] = $setting_data['choices'];
            }
            
            // Create the control
            $wp_customize->add_control( 
                new $setting_data['method']( 
                    $wp_customize, 
                    $setting . '_control',
                    $options
                )
            );

        }
          

    }

}

function urnext_sanitize_customizer_setting( $input ){
    return (string) $input;
}


add_action( 'wp_head' , 'urnext_dynamic_css' );

function urnext_dynamic_css() {
    global $urnext_theme_options;
    $css = '';
    $styles = array();

    foreach( $urnext_theme_options as $urnext_option ):
        foreach( $urnext_option['settings'] as $setting => $details ):
            if( isset( $details['style'] ) && !empty( $details['style'] ) ):

                // Get the value
                $class      = str_replace('_', '-', $setting);
                $classname  = $class;
                $value      = get_theme_mod($setting);

                // if we have no value, set the default
                if( (string) $value === '' && isset( $details['default'] ) ){
                    $value = $details['default'];
                }
                $rgb = urnext_hex2rgba( $value, false );

                // Append to the classname if selector is not empty 
                if( isset( $details['selector'] ) && !empty( $details['selector'] ) ){
                    if( isset( $details['only_global'] ) && $details['only_global'] ){
                        $css.= sprintf('%s{color:%s}', $details['selector'], $rgb );
                    }else{
                        $classname.= ', ' . $details['selector'];
                    }
                }

                // For color options
                if( $details['style'] === 'color' ){

                    // Check if opacity is set
                    $get_opacity    = (string) get_theme_mod($setting . '_opacity');
                    $opacity        = $get_opacity === '' && isset( $details['opacity'] ) ? (int) $details['opacity'] : (int) $get_opacity ;
                    $opacity        = ( $opacity / 100 );

                    // Create font color class, no opacity
                    $css.= sprintf('.%s{color:%s}', $classname, $rgb ); 

                    // Create background color class, use opacity
                    $rgba = urnext_hex2rgba( $value, $opacity );
                    $css.= sprintf('.bg-%s{background-color:%s}', $classname, $rgba ); 

                    // Create border color class, use opacity
                    $css.= sprintf('.border-%s{border-color:%s !important}', $classname, $rgba ); 

                    // Create after color class, use opacity
                    $css.= sprintf('.after-%s:after{background:%s}', $class, $rgba ); 
                }

                if( $details['style'] === 'font' && $value !== 'system' ){
                    $font_options   = explode('|', $value );
                    $font_name      = $font_options[0];
                    $font_link      = $font_options[1];
                    $css.= sprintf(".%s{font-family:'%s',serif, sans-serif}", $classname, $font_name );
                    $styles[] = $font_link;
                }

                if( $details['style'] === 'fontweight' && $value !== 'normal' ){
                    $css.= sprintf(".%s{font-weight:%s}", $classname, $value );
                }
                
                if( $details['style'] === 'text-transform' && $value !== 'none' ){
                    $css.= sprintf(".%s{text-transform:%s}", $classname, $value );
                }
                
                if( $details['style'] === 'fontsize' ){
                    $size       = (int) $value;
                    $fontsize   = round( ( $size / 10 ), 1);
                    $lineheight = round( ( $size + 8 ) / 10, 1);
                    $css.= sprintf(".%s{font-size:%srem; line-height:%srem}", $classname, $fontsize, $lineheight);
                }

            endif;
        endforeach;
    endforeach;
	
    // Include fonts if needed
    if( count( $styles ) > 0 ){
        $styles = array_unique( $styles );
        foreach( $styles as $style ){
            printf('<link href="%s" rel="stylesheet">', $style );
        }
    }

    // Print addiional css
    echo '<style>'. $css .'</style>';
}

/* Convert hexdec color string to rgb(a) string */
 
function urnext_hex2rgba($color, $opacity = false) {
    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color)) return $default; 

    //Sanitize $color if "#" is provided 
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
            return $default;
    }

    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if( $opacity !== false ){
        if( abs($opacity) > 1 ) $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return $output;
}

function get_google_fonts_list(){
    global $google_font_list;

    $options    = array();
    $options['system'] = 'System font';

    foreach( $google_font_list['items'] as $font ){

        // Set options
        $family     = $font['family'];
        $variants   = implode(',', $font['variants'] );
        $link       = sprintf('https://fonts.googleapis.com/css?family=%s:%s', $family, $variants );
        $options[ $family .'|'. $link ] = $family;

    }

    return $options;
}