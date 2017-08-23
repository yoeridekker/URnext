<?php 

global $urnext_options;

$fontlist = get_google_fonts_list();
$urnext_options = array(
    // section key 
    'urnext_style_options' => array(
        'name'          => __( 'URnext Theme Styles', 'urnext' ),
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
                'default'       => '',
                'label'         => __( 'Font', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'select',
                'choices'       => $fontlist,
                'description'   => __( 'Choose a Google Webfont for your theme', 'urnext' ),
                'style'         => 'font',
                'selector'      => 'html,body'
            ),
            'font_size' => array(
                'default'       => '15',
                'label'         => __( 'Fontsize', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'number',
                'description'   => __( 'Provide a font-size in pixels', 'urnext' ),
                'style'         => 'fontsize',
                'selector'      => 'html,body'
            ),
            'heading_font' => array(
                'default'       => '',
                'label'         => __( 'Headings Font', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'select',
                'choices'       => $fontlist,
                'description'   => __( 'Choose a Google Webfont for your theme headings', 'urnext' ),
                'style'         => 'font',
                'selector'      => 'h1,h2,h3,h4,h5,h6'
            ),

            // Body background and text color
            'body_color' => array(
                'default'       => '#00c7ce',
                'label'         => __( 'Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'selector'      => 'html,body'
            ),
            'text_color' => array(
                'default'       => '#ffffff',
                'label'         => __( 'Text Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
                'selector'      => 'html,body'
            ),
           
        )
    ),
    'urnext_header_style_options' => array(
        'name'          => __( 'URnext Header Styles', 'urnext' ),
        'description'   => __('Change header style options', 'urnext'), 
        'settings'      => array(

            // Top bar background and color 
            'top_bar_color' => array(
                'default'       => '#ffffff',
                'label'         => __( 'Top Bar Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color'
            ),
            'top_bar_text_color' => array(
                'default'       => '#000000',
                'label'         => __( 'Top Bar Font Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color'
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
                'default'       => '#ffffff',
                'label'         => __( 'Menu Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color'
            ),
            'menu_text_color' => array(
                'default'       => '#000000',
                'label'         => __( 'Menu Font Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color'
            ),
            'menu_color_opacity' => array(
                'default'       => '0',
                'label'         => __( 'Menu Opacity', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'number',
                'description'   => __( 'Set the menu opacity between 0 and 100', 'urnext' ), 
            ),

            // Header background and text color
            'header_color' => array(
                'default'       => '#ffffff',
                'label'         => __( 'Header Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color'
            ),
            'header_color_opacity' => array(
                'default'       => '0',
                'label'         => __( 'Header Opacity', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'number',
                'description'   => __( 'Set the header opacity between 0 and 100', 'urnext' ), 
            ),
            'header_text_color' => array(
                'default'       => '#000000',
                'label'         => __( 'Header Font Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color'
            ),
            'particles_js'      => array(
                'default'       => '',
                'label'         => __( 'Header Particles Animation', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'checkbox',
                'description'   => __( 'Check to set the header particles animation', 'urnext' ), 
            ),

            // Overlay 
            'header_overlay_color' => array(
                'default'       => '#ffffff',
                'label'         => __( 'Header Overlay Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color'
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
                'method'        => 'WP_Customize_Image_Control'
            ),
        ),
    ),
    'urnext_footer_options' => array(
        'name'          => __( 'URnext Footer Styles', 'urnext' ),
        'description'   => __('Change footer style options', 'urnext'), 
        'settings'      => array(

            // Body background and text color
            'footer_color' => array(
                'default'       => '#00c7ce',
                'label'         => __( 'Footer Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
            ),
            'footer_text_color' => array(
                'default'       => '#ffffff',
                'label'         => __( 'Footer Text Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control',
                'style'         => 'color',
            ),
            
        )
    ),
);

add_action( 'customize_register' , 'urnext_options' );

function urnext_options( $wp_customize ) {
    global $urnext_options;
    // Sections, settings and controls will be added here
    foreach( $urnext_options as $section => $settings ){
        
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
                    'default' => ( isset( $setting_data['default'] ) ? $setting_data['default'] : '' )
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

add_action( 'wp_head' , 'urnext_dynamic_css' );

function urnext_dynamic_css() {
    global $urnext_options;
    $css = '';
    $styles = array();

    foreach( $urnext_options as $urnext_option ):
        foreach( $urnext_option['settings'] as $setting => $details ):
            if( isset( $details['style'] ) && !empty( $details['style'] ) ):

                // Get the value
                $class      = str_replace('_', '-', $setting);
                $classname  = $class;
                $value      = get_theme_mod($setting);

                // Append to the classname if selector is not empty 
                if( isset( $details['selector'] ) && !empty( $details['selector'] ) ){
                    $classname.= ', ' . $details['selector'];
                }

                // For color options
                if( $details['style'] === 'color' ){

                    // Check if opacity is set
                    $opacity    = (string) get_theme_mod($setting . '_opacity');
                    $opacity    = $opacity === '' ? false : ( (int) $opacity / 100 );

                    // Create font color class, no opacity
                    $rgb = hex2rgba( $value, false );
                    $css.= sprintf('.%s{color:%s}', $classname, $rgb ); 

                    // Create background color class, use opacity
                    $rgba = hex2rgba( $value, $opacity );
                    $css.= sprintf('.bg-%s{background-color:%s}', $classname, $rgba ); 

                    // Create border color class, use opacity
                    $css.= sprintf('.border-%s{border-color:%s}', $classname, $rgba ); 

                    // Create after color class, use opacity
                    $css.= sprintf('.after-%s:after{background:%s}', $class, $rgba ); 
                }

                if( $details['style'] === 'font' ){
                    $font_options   = explode('|', $value );
                    $font_name      = $font_options[0];
                    $font_link      = $font_options[1];
                    $css.= sprintf(".%s{font-family:'%s',serif, sans-serif}", $classname, $font_name );
                    $styles[] = $font_link;
                }

                if( $details['style'] === 'fontsize' ){
                    $fontsize = (int) $value;
                    $lineheight = $fontsize + 14;
                    $css.= sprintf(".%s{font-size:%spx; line-height:%spx}", $classname, $fontsize, $lineheight);
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
 
function hex2rgba($color, $opacity = false) {
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
    $options    = array();
    $json_fonts = file_get_contents('fonts.json', true);

    if( $json_fonts ){
        $fonts = json_decode( $json_fonts, true );
        foreach( $fonts['items'] as $font ){

            // Set options
            $family     = $font['family'];
            $variants   = implode(',', $font['variants'] );
            $link       = sprintf('https://fonts.googleapis.com/css?family=%s:%s', $family, $variants );
            $options[ $family .'|'. $link ] = $family;

        }
    }
    return $options;
}