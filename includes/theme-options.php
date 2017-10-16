<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $urnext_theme_settings, $urnext_social_options;

$urnext_theme_settings = array( 

    // Post grid settings
    'post_grid' => array(
        'label' => esc_html__('Post Grid settings', 'urnext'),
        'fields'    => array(
            'grid_layout' => array(
                'label' => esc_html__('Use grid layout?', 'urnext'),
                'type'  => 'switch'
            ),
            'grid_column_count' => array(
                'label' => esc_html__('Grid column count', 'urnext'),
                'type'      => 'select',
                'options'   => array(
                    3   => esc_html__('3 columns', 'urnext'),
                    4   => esc_html__('4 columns', 'urnext'),
                )
            ),
            'grid_show_excerpt' => array(
                'label' => esc_html__('Show excerpt on grid items?', 'urnext'),
                'type'  => 'switch'
            ),
            'grid_column_margin' => array(
                'label' => esc_html__('Add margins to the grid?', 'urnext'),
                'type'  => 'switch'
            ),
            'square_grid_items' => array(
                'label' => esc_html__('Square grid items?', 'urnext'),
                'type'  => 'switch'
            ),
            'pagination_type' => array(
                'label'     => esc_html__('Pagination type', 'urnext'),
                'type'      => 'select',
                'options'   => array(
                    'normal'    => esc_html__('Normal (Pagination buttons)', 'urnext'),
                    'ajax'      => esc_html__('Ajax (Load more button)', 'urnext')
                )
            ),
        )
    ),

    // Options for social media, will be filled later
    'social' => array(
        'label'     => esc_html__('Social Media settings', 'urnext'),
        'fields'    => array()
    ),

    // Options for menu's
    'menus' => array(
        'label'     => esc_html__('Menu settings', 'urnext'),
        'fields'    => array(
            'main_menu_type' => array(
                'label'     => esc_html__('Main menu type', 'urnext'),
                'type'      => 'select',
                'default'   => 1,
                'options'   => array(
                    1   => esc_html__('Mega Menu', 'urnext'),
                    2   => esc_html__('Genie Menu', 'urnext'),
                )
            ),
            'main_menu_trigger' => array(
                'label'     => esc_html__('Open submenu on', 'urnext'),
                'type'      => 'select',
                'default'   => 'click',
                'options'   => array(
                    'click' => esc_html__('Click (default)', 'urnext'),
                    'hover' => esc_html__('Hover', 'urnext'),
                ),
                'hint'      => esc_html__('Set the responsive breakpoint', 'urnext')
            ),
            'menu_responsive_breakpoint' => array(
                'label'     => esc_html__('Responsive breakpoint', 'urnext'),
                'type'      => 'number',
                'default'   => '992',
                'step'      => '1',
                'min'       => '320',
                'hint'      => esc_html__('Set the responsive breakpoint. At this point we will show the mobile menu.', 'urnext')
            ),
        )
    ),

    // Options for contact page
    'contact' => array(
        'label'     => esc_html__('Contact settings', 'urnext'),
        'fields'    => array(
            'show_map' => array(
                'label' => esc_html__('Google Map on contact page?', 'urnext'),
                'type'  => 'switch'
            ),
            'google_maps_api_key' => array(
                'label' => esc_html__('Google Maps API key', 'urnext'),
                'hint'  => sprintf('<a target="_blank" href="https://developers.google.com/maps/documentation/javascript/get-api-key">%s</a>', esc_html__('Click here to request your Google API key', 'urnext') ),
                'type'  => 'text'
            ),
            'map_zoom' => array(
                'label'     => esc_html__('Google Maps zoom level', 'urnext'),
                'type'      => 'number',
                'default'   => '14',
                'step'      => '1',
                'min'       => '1',
                'max'       => '20',
                'hint'      => esc_html__('Set the zoom level between 1 and 20', 'urnext')
            ),
            'map_style' => array(
                'label'     => esc_html__('Google Maps style', 'urnext'),
                'type'      => 'select',
                'default'   => 0,
                'options'   => array(
                    0   => esc_html__('Default style', 'urnext'),
                    1   => esc_html__('Greyscale map style', 'urnext'),
                )
            ),
            'locations' => array(
                'label'     => esc_html__('Google Maps Location(s)', 'urnext'),
                'type'      => 'repeater',
                'fields'    => array(
                    'address' => array(
                        'label' => esc_html__('Address', 'urnext'),
                        'type'  => 'tinymce'
                    ),
                    'lat' => array(
                        'label' => esc_html__('Latitude', 'urnext'),
                        'type'  => 'number',
                        'step'  => '0.0000001'
                    ),
                    'lng' => array(
                        'label' => esc_html__('Longtitude', 'urnext'),
                        'type'  => 'number',
                        'step'  => '0.0000001'
                    ),
                    'icon' => array(
                        'label' => esc_html__('Custom map icon', 'urnext'),
                        'type'  => 'image',
                    )
                )
            )
        )
    ),

    /*
    // Options for the sidebar
    'sidebars' => array(
        'label' => esc_html__('Sidebars', 'urnext'),
        'fields'    => array(
            'show_sidebars' => array(
                'label'     => esc_html__('Show sidebars', 'urnext'),
                'type'      => 'multi_checkbox',
                'options'   => array(
                    'frontpage' => esc_html__('Show sidebars on the frontpage?', 'urnext'),
                    'page'      => esc_html__('Show sidebars on pages?', 'urnext'),
                    'post'      => esc_html__('Show sidebars on single posts?', 'urnext'),
                    'category'  => esc_html__('Show sidebars on categories?', 'urnext'),
                    'author'    => esc_html__('Show sidebars on author page?', 'urnext'),
                    '404'       => esc_html__('Show sidebars on 404 (not found) page?', 'urnext'),
                )
            ),
        )
    ),
    */

    // Options for the breadcrumbs
    'breadcrumbs' => array(
        'label' => esc_html__('Breadcrumb settings', 'urnext'),
        'fields'    => array(
            'hide_breadcrumbs' => array(
                'label'     => esc_html__('Show breadcrumbs', 'urnext'),
                'type'      => 'multi_checkbox',
                'alert'     => ( (int) get_theme_mod('breadcrumbs') === 1 ? esc_html__('Breadcrumbs are site-wide enabled!', 'urnext') : esc_html__('Breadcrumbs are site-wide disabled!', 'urnext') ),
                'options'   => array(
                    'frontpage' => esc_html__('Hide breadcrumbs on the frontpage?', 'urnext'),
                    'page'      => esc_html__('Hide breadcrumbs on pages?', 'urnext'),
                    'post'      => esc_html__('Hide breadcrumbs on single posts?', 'urnext'),
                    'category'  => esc_html__('Hide breadcrumbs on categories?', 'urnext'),
                    'author'    => esc_html__('Hide breadcrumbs on author page?', 'urnext'),
                    '404'       => esc_html__('Hide breadcrumbs on 404 (not found) page?', 'urnext'),
                    'search'    => esc_html__('Hide breadcrumbs on search page?', 'urnext'),
                    'shop'      => esc_html__('Hide breadcrumbs on shop pages?', 'urnext'),
                )
            ),
            'breadcrumbs_align' => array(
                'label'     => esc_html__('Align breadcrumbs', 'urnext'),
                'type'      => 'select',
                'options'   => array(
                    'align-left'    => esc_html__('Align left', 'urnext'),
                    'centered'      => esc_html__('Align center', 'urnext'),
                    'align-right'   => esc_html__('Align right', 'urnext'),
                )
            ),
            'breadcrumbs_separator' => array(
                'label'     => esc_html__('Breadcrumbs separator', 'urnext'),
                'type'      => 'text',
                'hint'      => esc_html__('Default breadcrumbs separator is a right chevron. Replace it with your own separator.', 'urnext'),
            ),
            'breadcrumbs_home_link' => array(
                'label'     => esc_html__('Show "You are here" text', 'urnext'),
                'type'      => 'switch',
            ),
        )
    ),

    // Options for WooCommerce
    'woocommerce' => array(
        'label' => esc_html__('WooCommerce settings', 'urnext'),
        'fields'    => array(
            'grid_layout_woocommerce' => array(
                'label'     => esc_html__('Show products in grid layout?', 'urnext'),
                'type'      => 'switch',
            ),
            'grid_column_count_woocommerce' => array(
                'label' => esc_html__('Grid column count', 'urnext'),
                'type'      => 'select',
                'options'   => array(
                    3   => esc_html__('3 columns', 'urnext'),
                    4   => esc_html__('4 columns', 'urnext'),
                )
            ),
            'grid_column_margin_woocommerce' => array(
                'label' => esc_html__('Add margins to the grid?', 'urnext'),
                'type'  => 'switch'
            )
        )
    ),

    // Options for the footer
    'footer' => array(
        'label' => esc_html__('Footer settings', 'urnext'),
        'fields'    => array(
            'copyright_text' => array(
                'label'     => esc_html__('Copyright text', 'urnext'),
                'type'      => 'tinymce'
            ),
            'footer_menu' => array(
                'label'     => esc_html__('Show disclaimer menu?', 'urnext'),
                'type'      => 'switch',
                'hint'      => esc_html__('Add a menu to the "disclaimer" menu if you enable this option.', 'urnext'),
            ),
            'footer_social_icons' => array(
                'label'     => esc_html__('Show social channels?', 'urnext'),
                'type'      => 'switch',
                'hint'      => esc_html__('Show the social channels in the bottom footer?.', 'urnext'),
            ),
        )
    ),

    'miscellaneous' => array(
        'label' => esc_html__('Miscellaneous settings', 'urnext'),
        'fields'    => array(
            'animations' => array(
                'label' => esc_html__('Enable animations', 'urnext'),
                'type'  => 'switch'
            ),
            'page_loader' => array(
                'label' => esc_html__('Page loader', 'urnext'),
                'type'      => 'select',
                'default'   => 1,
                'options'   => array(
                    0 => esc_html__('No pageloader animation', 'urnext'),
                    1 => esc_html__('Rotating Plane', 'urnext'),
                    2 => esc_html__('Double Bounce', 'urnext'),
                    3 => esc_html__('Wave', 'urnext'),
                    4 => esc_html__('Wandering Cubes', 'urnext'),
                    5 => esc_html__('Spinner', 'urnext'),
                    6 => esc_html__('Chasing Dots', 'urnext'),
                    7 => esc_html__('Three Bounce', 'urnext'),
                    8 => esc_html__('Circle', 'urnext'),
                    9 => esc_html__('Cube Grid', 'urnext'),
                    10 => esc_html__('Fading Circle', 'urnext'),
                    11 => esc_html__('Folding Cube', 'urnext'),
                )
            ),
            
            'animation_duration' => array(
                'label'     => esc_html__('Animation duration', 'urnext'),
                'type'      => 'number',
                'default'   => '1000',
                'step'      => '1',
                'min'       => '0',
                'max'       => '5000',
                'hint'      => esc_html__('Set the animation duration in milliseconds', 'urnext')
            ),
            'google_analytics' => array(
                'label' => esc_html__('Google Analytics code', 'urnext'),
                'type'  => 'textarea'
            )
        )
    ),
    
);

/**
 * This file will dynamically add social channels options
 */
if( isset( $urnext_social_options ) && !empty( $urnext_social_options ) ){
    foreach( $urnext_social_options as $channel ){
        $urnext_theme_settings['social']['fields'][$channel] = array(
            'label' => sprintf('<span class="socialbadge %s socicon socicon-%s"></span> %s ', $channel, $channel, $channel ),
            'type'  => 'text',
            'hint'  => sprintf( esc_html__('Add your %s page url. Use a valid url.','urnext'), $channel, $channel )
        );
    }
}

/**
 * Hide WooCommmerce options if not active
 */
if( !URNEXT_WOOCOMMERCE_ACTIVE ){
    unset($urnext_theme_settings['woocommerce']);
}

/**
 * This file will create the theme options for the URnext theme
 */
class URnextSettingsPage{

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Holds all the settings
     */
    private $settings = array();

    /**
     * Start up
     */
    public function __construct( $settings ){
        $this->settings = $settings;
        add_action( 'admin_menu', array( $this, 'add_urnext_theme_settings_page' ) );
        add_action( 'admin_init', array( $this, 'urnext_theme_settings_page_init' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'urnext_theme_settings_load_script' ) );

        // Filters with html
        add_filter( 'sanitize_option_urnext_address', array( $this, 'sanitize_urnext_option_html' ), 10, 2 );

        // Filter numeric
        add_filter( 'sanitize_option_urnext_show_map', array( $this, 'sanitize_urnext_option_numeric' ), 10, 2 );
        add_filter( 'sanitize_option_urnext_map_zoom', array( $this, 'sanitize_urnext_option_numeric' ), 10, 2 );
        add_filter( 'sanitize_option_urnext_lat', array( $this, 'sanitize_urnext_option_numeric' ), 10, 2 );
        add_filter( 'sanitize_option_urnext_lng', array( $this, 'sanitize_urnext_option_numeric' ), 10, 2 );
        
        // Filter text
        add_filter( 'sanitize_option_urnext_google_maps_api_key', array( $this, 'sanitize_urnext_option_text' ), 10, 2 );

        // Filter url
        add_filter( 'sanitize_option_urnext_icon', array( $this, 'sanitize_urnext_option_url' ), 10, 2 );
    }

    public function sanitize_urnext_option_text( $option_value, $option_name ){
        return sanitize_text_field( $option_value );
    }

    public function sanitize_urnext_option_html( $option_value, $option_name ){
        // @todo: fix the sanitize function for html
        return (string) $option_value;
    }

    public function sanitize_urnext_option_numeric( $option_value, $option_name ){
        return (float) $option_value;
    }

    public function sanitize_urnext_option_url( $option_value, $option_name ){
        return esc_url( $option_value );
    }

    /**
     * Load scripts and styles
     */
    public function urnext_theme_settings_load_script(){
        // Add the color picker css file       
        wp_enqueue_style( 'wp-color-picker' ); 
        wp_enqueue_style( 'urnext_socicon_css', get_template_directory_uri() . '/assets/css/socicon.css', false, '1.0.0' );
        wp_enqueue_style( 'urnext_wp_admin_css', get_template_directory_uri() . '/assets/admin/css/admin.css', false, '1.0.0' );
        wp_enqueue_media();
        wp_enqueue_script( 'admin_switch_button', get_template_directory_uri() . '/assets/admin/js/jquery.switchButton.js', array('jquery', 'jquery-ui-widget', 'jquery-ui-core', 'jquery-effects-core'), null, true );
        wp_enqueue_script( 'urnext_admin_main', get_template_directory_uri() . '/assets/admin/js/admin.js', array('admin_switch_button', 'wp-color-picker'), null, true );
    }

    /**
     * Add options page
     */
    public function add_urnext_theme_settings_page(){

        // This page will be under "Settings"
        add_theme_page(
            esc_html__('URnext Theme Options', 'urnext'), 
            esc_html__('URnext', 'urnext'), 
            'manage_options', 
            'urnext_settings', 
            array( $this, 'create_urnext_theme_settings_admin_page' ),
            get_template_directory_uri() . '/assets/admin/images/icon.svg',
            3
        );

        // Now loop the settings
        foreach( $this->settings as $setting_name => $settings ){
            // Create submenu for the theme settings
            add_theme_page( 
                $settings['label'],
                $settings['label'],
                'manage_options',
                sprintf('urnext_page_%s', $setting_name ),
                array( $this, 'urnext_callback_setting_page')
            );
        }
    }

    /**
     * Add options page html
     */
    public function create_urnext_theme_settings_admin_page(){
        echo 'URnext info page';

        $mods = get_theme_mods();
        $opts = array();
        foreach( $this->settings as $setting_name => $details ){
            $opt_name = 'urnext_theme_option_name_' . $setting_name;
            $opts[$opt_name] = get_option( $opt_name );
        }
        echo '<pre>';
        var_dump( $opts );
        echo '</pre>';
    }

    /**
     * Options page callbacks
     */
    public function urnext_callback_setting_page(){
        $screen         = get_current_screen();        
        $setting        = str_replace('appearance_page_urnext_page_', '', $screen->id );
        $this->options  = get_option( 'urnext_theme_option_name_' . $setting );
        ?>
        <div class="wrap urnext-options">
            <form method="post" action="options.php" id="theme-options-panel">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'urnext_theme_option_group_' . $setting );
                do_settings_sections( 'urnext_page_' . $setting );
                submit_button();
            ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function urnext_theme_settings_page_init(){

        foreach( $this->settings as $setting_name => $settings ){

            register_setting(
                'urnext_theme_option_group_' . $setting_name, // Option group
                'urnext_theme_option_name_' . $setting_name, // Option name
                array( $this, 'sanitize' ) // Sanitize
            );

            add_settings_section(
                sprintf('section_id_%s', $setting_name ), // ID
                sprintf( '%s - %s', esc_html__('URnext Theme Options', 'urnext'), $settings['label'] ), // Title
                array( $this, 'print_section_info' ), // Callback
                sprintf('urnext_page_%s', $setting_name ) // Page
            );

            foreach( $settings['fields'] as $field_name => $field ){
                add_settings_field(
                    $field_name, // ID
                    $field['label'], // Title 
                    array( $this, sprintf('%s_callback', $field['type'] ) ), // Callback
                    sprintf('urnext_page_%s', $setting_name ), // Page
                    sprintf('section_id_%s', $setting_name ), // Section      
                    array(
                        'name'      => $field_name,
                        'section'   => 'urnext_theme_option_name_' . $setting_name,
                        'args'      => $field
                    )    
                );

                // Create dynamic filters
                $filter_function    = sprintf('urnext_do_filter_%s_%s', $setting_name, $field_name);
                $filter_name        = sprintf('urnext_filter_%s_%s', $setting_name, $field_name);
                
                //echo $filter_function .'<br>';
                // Check if the filter exists
                if( method_exists( $this, $filter_function ) ){
                    add_filter( $filter_name, array( $this , $filter_function ), 9999, 1); 
                }
            }
        }
    }
    
    /**
     * Filter for specific settings
     *
     * @param array $data contains the setting input
     */
    public function urnext_do_filter_contact_locations( $data ){
        return $data;
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */

    private function recursive_sanitize_option_input(&$item, $key, $lastkey = false ){
        if ( is_array($item) ){
            $lastkey = $key;
            array_walk ($item, array( $this, 'recursive_sanitize_option_input') , $lastkey);
        }else{
            $sanitize_key = 'urnext_'. ( $lastkey ? $lastkey : $key );
            $item = sanitize_option( $sanitize_key, $item );
            //echo $sanitize_key . '<br>';
        }
    }

    public function sanitize( $input ){
        array_walk ($input, array( $this, 'recursive_sanitize_option_input') );
        //var_dump( $input ); die;
        return $input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info(){
        printf('<p class="info">%s</p>', esc_html__('Change your theme settings below', 'urnext') );
    }

    /** 
     * Print the info text if set
     */
     public function print_hint( $args ){
        if( isset( $args['hint'] ) && !empty( $args['hint'] ) ){
            printf('<p class="hint">%s</p>', $args['hint'] );
        }
    }

    /** 
     * Print alert text if set
     */
     public function print_alert( $args ){
        if( isset( $args['alert'] ) && !empty( $args['alert'] ) ){
            printf('<p class="alert">%s</p>', $args['alert'] );
        }
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function get_option_value( $args ){
        $section_name   = str_replace('urnext_theme_option_name_', '', $args['section'] );
        $filter         = sprintf('urnext_filter_%s_%s', $section_name, $args['name']);
        $value          = isset( $this->options[ $args['name'] ] ) ? esc_attr( $this->options[ $args['name'] ]) : '' ;
        
        if( isset( $args['value'] ) ){
            $value = esc_attr($args['value']);
        }

        if( $value === '' && isset( $args['args']['default'] ) && !empty($args['args']['default']) ){
            $value = esc_attr($args['args']['default']);
        }

        return apply_filters( $filter , $value);
    }

    public function create_repeater_options_object( $args ){
        $result = array();
        if( isset( $this->options[$args['name']] ) && !empty( $this->options[$args['name']] ) ){
            foreach( $this->options[$args['name']] as $field => $values ){
                if( !empty( $values ) ){
                    foreach( $values as $index => $value ){
                        $result[$index][$field] = $value;
                    }
                }
            }
        }
        $this->options[$args['name']] = $result;
    }

    public function create_repeater_field( $args, $index, $values ){
        printf('<div class="repeatable" data-field="%s">', $args['name'] );
        printf('<a href="#" data-for="%s" class="deletebutton">%s</a>', $args['name'], esc_html__('Delete row', 'urnext' ) );
        foreach( $args['args']['fields'] as $sub_field_name => $sub_field ){   
            $sub_args = array(
                'args'      => $sub_field,
                'name'      => sprintf('%s][%s][', $args['name'], $sub_field_name),
                'section'   => $args['section'],
                'value'     => ( isset($values[$sub_field_name]) ? $values[$sub_field_name] : '' )
            );
            printf('<label>%s</label>', $sub_args['args']['label'] );
            call_user_func_array(
                array( $this, sprintf('%s_callback', $sub_args['args']['type']) ), 
                array( $sub_args )
            );
        }
        print('</div>');
    }

    public function repeater_callback( $args ){
        $this->create_repeater_options_object( $args );
        $this->print_alert( $args['args'] );
        printf('<div class="repeatcontainer" id="urnext-repeat-%s-container">', $args['name'] );
        if( isset( $args['args']['fields'] ) && !empty( $args['args']['fields'] ) && is_array( $args['args']['fields'] ) ){
            $counter = isset( $this->options[$args['name']] ) && !empty( $this->options[$args['name']] ) ? count( $this->options[$args['name']] ) : 0 ;
            if( $counter === 0 ){
                $this->create_repeater_field( $args, $counter, false );
            }else{
                for( $i = 0; $i < $counter; $i++ ){
                    $this->create_repeater_field( $args, $i, $this->options[$args['name']][$i] );
                }
            }
        }
        print('</div>');
        printf('<a href="#" data-for="%s" class="repeatbutton button button-primary" id="urnext-repeat-%s">%s</a>', $args['name'], $args['name'], esc_html__('Add row', 'urnext' ) );
        printf('<a href="#" data-for="%s" class="repeatbutton copy button button-primary" id="urnext-repeat-%s">%s</a>', $args['name'], $args['name'], esc_html__('Copy row', 'urnext' ) );
        $this->print_hint( $args['args'] );
    }
     
    public function multi_checkbox_callback( $args ){
        $this->print_alert( $args['args'] );
        if( isset( $args['args']['options'] ) && !empty( $args['args']['options'] ) ){
            foreach( $args['args']['options'] as $key => $value ){
                $name = $args['name'];
                $checked = (int) $this->get_option_value( $args ) === 1 ? ' checked' : '' ;
                printf(
                    '<div class="switch-wrapper"><label for="%s">%s</label><input id="%s" class="switcher" name="%s[%s][%s]" type="checkbox" value="1"%s></div>',
                    $name . $key,
                    $value,
                    $name . $key,
                    $args['section'],
                    $name,
                    $key,
                    $checked
                );
            }
        }
        $this->print_hint( $args['args'] );
    }

    public function select_callback( $args ){
        $this->print_alert( $args['args'] );
        $options    = '';
        $selected   = $this->get_option_value( $args );
        if( isset( $args['args']['options'] ) && !empty( $args['args']['options'] ) ){
            foreach( $args['args']['options'] as $key => $value ){
                $options.= sprintf(
                    '<option value="%s"%s>%s</option>',
                    $key,
                    ( $selected == $key ? ' selected' : '' ),
                    $value
                );
            }
        }
        printf(
            '<select id="%s" name="%s[%s]">%s</select>',
            $args['name'],
            $args['section'],
            $args['name'],
            $options
        );
        $this->print_hint( $args['args'] );
    }

    public function number_callback( $args ){
        $this->print_alert( $args['args'] );
        printf(
            '<input type="number" id="%s" min="%s" max="%s" step="%s" name="%s[%s]" value="%s" />',
            $args['name'],
            ( isset( $args['args']['min'] ) ? (string) $args['args']['min'] : '' ),
            ( isset( $args['args']['max'] ) ? (string) $args['args']['max'] : '' ),
            ( isset( $args['args']['step'] ) ? (string) $args['args']['step'] : 1 ),
            $args['section'],
            $args['name'],
            $this->get_option_value( $args )
        );
        $this->print_hint( $args['args'] );
    }

    public function textarea_callback( $args ){
        $this->print_alert( $args['args'] );
        printf(
            '<textarea id="%s" name="%s[%s]">%s</textarea>',
            $args['name'],
            $args['section'],
            $args['name'],
            $this->get_option_value( $args )
        );
        $this->print_hint( $args['args'] );
    }

    public function tinymce_callback( $args ){
        $this->print_alert( $args['args'] );
        $content    = html_entity_decode( $this->get_option_value( $args ) );
        $editor_id  = sanitize_html_class($args['name']) . uniqid() ;
        $settings   = array(
            'textarea_name' => sprintf('%s[%s]', $args['section'], $args['name'] ),
            'media_buttons' => false,
            'textarea_rows' => 5,
            'wpautop'       => true
        );
        wp_editor( $content, $editor_id, $settings );
        $this->print_hint( $args['args'] );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function text_callback( $args ){
        $this->print_alert( $args['args'] );
        printf(
            '<input type="text" id="%s" name="%s[%s]" value="%s" />',
            $args['name'],
            $args['section'],
            $args['name'],
            $this->get_option_value( $args )
        );
        $this->print_hint( $args['args'] );
    }

    public function image_callback( $args ){
        $this->print_alert( $args['args'] );
        printf(
            '<div class="file-selector-box"><button class="image-upload button-primary" id="for_%s">%s</button><input id="%s" type="text" name="%s[%s]" value="%s"></div>',
            $args['name'],
            esc_html__('Select/replace image', 'urnext'),
            $args['name'],
            $args['section'],
            $args['name'],
            $this->get_option_value( $args )
        );
        $this->print_hint( $args['args'] );
    }

    public function color_callback( $args ){
        $this->print_alert( $args['args'] );
        printf(
            '<input type="text" id="%s" class="color-field" name="%s[%s]" value="%s" />',
            $args['name'],
            $args['section'],
            $args['name'],
            $this->get_option_value( $args )
        );
        $this->print_hint( $args['args'] );
    }

    public function switch_callback( $args ){
        $this->print_alert( $args['args'] );
        $checked = (int) $this->get_option_value( $args ) === 1 ? ' checked' : '' ;
        printf(
            '<div class="switch-wrapper"><input id="%s" class="switcher" name="%s[%s]" type="checkbox" value="1"%s></div>',
            $args['name'],
            $args['section'],
            $args['name'],
            $checked
        );
        $this->print_hint( $args['args'] );
    }
}

if( is_admin() ) $urnext_settings_page = new URnextSettingsPage( $urnext_theme_settings );