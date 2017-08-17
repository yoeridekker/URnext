<?php 

global $urnext_options;

$urnext_options = array(
    // section key 
    'urnext_style_options' => array(
        'name'          => __( 'Theme Style Settings', 'urnext' ),
        'description'   => __('Change theme style options here.', 'urnext'), 
        'settings'      => array(
            'body_color' => array(
                'default'       => '00c7ce',
                'label'         => __( 'Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control'
            ),
            'text_color' => array(
                'default'       => 'ffffff',
                'label'         => __( 'Text Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control'
            ),
            'header_color' => array(
                'default'       => 'ffffff',
                'label'         => __( 'Header Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control'
            ),
            'header_color_opacity' => array(
                'default'       => '1',
                'label'         => __( 'Header Opacity', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'text',
                'description'   => __( 'Set the header opacity between 0 and 100', 'urnext' ), 
            ),
            'header_text_color' => array(
                'default'       => '000000',
                'label'         => __( 'Header Font Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control'
            ),
            'menu_color' => array(
                'default'       => 'ffffff',
                'label'         => __( 'Menu Background Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control'
            ),
            'menu_text_color' => array(
                'default'       => '000000',
                'label'         => __( 'Menu Font Color', 'urnext' ), 
                'method'        => 'WP_Customize_Color_Control'
            ),
            'menu_color_opacity' => array(
                'default'       => '1',
                'label'         => __( 'Menu Opacity', 'urnext' ), 
                'method'        => 'WP_Customize_Control',
                'type'          => 'text',
                'description'   => __( 'Set the menu opacity between 0 and 100', 'urnext' ), 
            ),
            'logo' => array(
                'label'         => __( 'Upload your logo', 'urnext' ), 
                'method'        => 'WP_Customize_Image_Control'
            ),
        )
    )
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
            
            $wp_customize->add_setting( $setting,
                array(
                    'default' => ( isset( $setting_data['default'] ) ? $setting_data['default'] : '' )
                )
            );  

            $wp_customize->add_control( new $setting_data['method']( 
                $wp_customize, 
                $setting . '_control',
                array(
                    'label'    => $setting_data['label'], 
                    'section'  => $section,
                    'settings' => $setting,
                    'priority' => 10,
                ) 
            ));


        }
          

    }

}

add_action( 'wp_head' , 'urnext_dynamic_css' );

function urnext_dynamic_css() {
    global $urnext_options;
    $css = '';

    foreach( $urnext_options['urnext_style_options']['settings'] as $setting => $details ):
        if( $details['method'] == 'WP_Customize_Color_Control' ):

            $opacity    = (string) get_theme_mod($setting . '_opacity');
            $opacity    = $opacity === '' ? false : ( (int) $opacity / 100 );

            $classname  = str_replace('_', '-', $setting);
            $color      = get_theme_mod($setting);

            // Create font color class, no opacity
            $rgba = hex2rgba( $color, false );
            $css.= sprintf('.%s{color:%s}', $classname, $rgba ); 

            // Create background color class, use opacity
            $bg_rgba = hex2rgba( $color, $opacity );
            $css.= sprintf('.bg-%s{background-color:%s}', $classname, $bg_rgba ); 

        endif;
   endforeach;
	
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