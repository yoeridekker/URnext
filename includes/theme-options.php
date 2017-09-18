<?php
global $urnext_theme_settings;

$urnext_theme_settings = array( 
    'top_bar' => array(
        'label'     => __('Top bar','urnext'),
        'fields'    => array(
            'field_1' => array(
                'label' => __('Field 1', 'urnext'),
                'type'  => 'switch'
            ),
        )
    ),
    
    
    'post_grid' => array(
        'label' => __('Post grid', 'urnext'),
        'fields'    => array(
            'posts_per_page' => array(
                'label' => __('Posts per page', 'urnext'),
                'type'  => 'number'
            )
        )
    ),

    'header' => array(
        'label' => __('Header', 'urnext'),
        'fields'    => array(
            'field_2' => array(
                'label' => __('Field 2', 'urnext'),
                'type'  => 'switch'
            )
        )
    ),

    'breadcrumbs' => array(
        'label' => __('Breadcrumbs', 'urnext'),
        'fields'    => array(
            'show_breadcrumbs' => array(
                'label'     => __('Show breadcrumbs', 'urnext'),
                'type'      => 'multi_checkbox',
                'options'   => array(
                    'page'      => __('Show breadcrumbs on pages?', 'urnext'),
                    'post'      => __('Show breadcrumbs on single posts?', 'urnext'),
                    'category'  => __('Show breadcrumbs on categories?', 'urnext'),
                )
            ),
            'breadcrumbs_align' => array(
                'label'     => __('Align breadcrumbs', 'urnext'),
                'type'      => 'select',
                'options'   => array(
                    'align-left'    => __('Align left', 'urnext'),
                    'centered'      => __('Align center', 'urnext'),
                    'align-right'   => __('Align right', 'urnext'),
                )
            ),
        )
    ),

    'woocommerce' => array(
        'label' => __('Woocommerce', 'urnext'),
        'fields'    => array(
            'urnext_woocommerce_products_per_page' => array(
                'label' => __('Products per page', 'urnext'),
                'type'  => 'number'
            ),
            'urnext_woocommerce_products_columns' => array(
                'label' => __('Woocommerce Number of Product Columns', 'urnext'),
                'type'  => 'number'
            ),
            'urnext_woocommerce_testval' => array(
                'label' => __('Test', 'urnext'),
                'type'  => 'text'
            ),
            'urnext_woocommerce_textarea' => array(
                'label' => __('Textarea', 'urnext'),
                'type'  => 'textarea'
            )
        )
    ),

    'performance' => array(
        'label' => __('Performance', 'urnext'),
        'fields'    => array(
            'urnext_compile_js_css' => array(
                'label' => __('Compile JS and CSS', 'urnext'),
                'type'  => 'switch'
            )
        )
    ),
    
);
/**
*
* This file will create the theme options for the URnext theme
*
**/

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
    }

    public function urnext_theme_settings_load_script(){
        wp_enqueue_script( 'admin_switch_button', get_template_directory_uri() . '/assets/admin/js/jquery.switchButton.js', array('jquery', 'jquery-ui-widget', 'jquery-ui-core', 'jquery-effects-core'), null, true );
        wp_enqueue_script( 'urnext_admin_main', get_template_directory_uri() . '/assets/admin/js/admin.js', array('admin_switch_button'), null, true );
        wp_enqueue_style( 'urnext_wp_admin_css', get_template_directory_uri() . '/assets/admin/css/admin.css', false, '1.0.0' );
    }

    /**
     * Add options page
     */
    public function add_urnext_theme_settings_page(){

        // This page will be under "Settings"
        add_menu_page(
            __('URnext Theme Options', 'urnext'), 
            __('URnext', 'urnext'), 
            'manage_options', 
            'urnext_settings', 
            array( $this, 'create_urnext_theme_settings_admin_page' ),
            get_template_directory_uri() . '/assets/admin/images/icon.svg',
            3
        );

        // Now loop the settings
        foreach( $this->settings as $setting_name => $settings ){

            // Create submenu for the URnext settings
            add_submenu_page( 
                'urnext_settings',
                $settings['label'],
                $settings['label'],
                'manage_options',
                sprintf('urnext_page_%s', $setting_name ),
                array( $this, 'urnext_callback_setting_page')
                //array( $this, sprintf('urnext_callback_%s', $setting_name ) )
            );
        }
    }

    public function create_urnext_theme_settings_admin_page(){
        echo 'URnext info page';

        $mods = get_theme_mods();
        $opts = array();
        foreach( $this->settings as $setting_name => $details ){
            $opt_name = 'urnext_theme_option_name_' . $setting_name;
            $opts[$opt_name] = get_option( $opt_name );
        }
    }

    /**
     * Options page callbacks
     */
    public function urnext_callback_setting_page(){
        $screen = get_current_screen();
        $setting = str_replace('urnext_page_urnext_page_', '', $screen->id );
        $this->options = get_option( 'urnext_theme_option_name_' . $setting );
        ?>
        <div class="wrap urnext-options">
            <form method="post" action="options.php">
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
                sprintf( __('URnext Theme Options - %s', 'urnext'), $settings['label']), // Title
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
            }

        }

    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ){
        if( isset($input) && !empty( $input ) ){
            $return = array();
            foreach( $input as $key => $value ){
                $return[$key] = sanitize_option( $key, $value );
            }
            $input = $return;
        }
        //var_dump( $input );
        return $input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info(){
        print __('<p class="info">Change your theme settings below</p>', 'urnext');
    }

    /** 
     * Get the settings option array and print one of its values
     */

     
    public function multi_checkbox_callback( $args ){
        if( isset( $args['args']['options'] ) && !empty( $args['args']['options'] ) ){
            foreach( $args['args']['options'] as $key => $value ){
                $name = $args['name'];
                $checked = isset( $this->options[$name][$key] ) && (int) $this->options[$name][$key] === 1 ? ' checked' : '' ;
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
    }

    public function select_callback( $args ){
        $options    = '';
        $selected   = isset( $this->options[ $args['name'] ] ) ? esc_attr( $this->options[ $args['name'] ]) : '' ;

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
    }

    public function number_callback( $args ){
        printf(
            '<input type="number" id="%s" name="%s[%s]" value="%s" />',
            $args['name'],
            $args['section'],
            $args['name'],
            isset( $this->options[ $args['name'] ] ) ? esc_attr( $this->options[ $args['name'] ]) : ''
        );
    }

    public function textarea_callback( $args ){
        printf(
            '<textarea id="%s" name="%s[%s]">%s</textarea>',
            $args['name'],
            $args['section'],
            $args['name'],
            isset( $this->options[ $args['name'] ] ) ? esc_attr( $this->options[ $args['name'] ]) : ''
        );
    }
    

    /** 
     * Get the settings option array and print one of its values
     */
    public function text_callback( $args ){
        printf(
            '<input type="text" id="%s" name="%s[%s]" value="%s" />',
            $args['name'],
            $args['section'],
            $args['name'],
            isset( $this->options[ $args['name'] ] ) ? esc_attr( $this->options[ $args['name'] ]) : ''
        );
    }

    public function switch_callback( $args ){
        $checked = isset( $this->options[ $args['name'] ] ) && (int) $this->options[$args['name']] === 1 ? ' checked' : '' ;
        printf(
            '<div class="switch-wrapper"><input id="%s" class="switcher" name="%s[%s]" type="checkbox" value="1"%s></div>',
            $args['name'],
            $args['section'],
            $args['name'],
            $checked
        );
    }
}

if( is_admin() ) $urnext_settings_page = new URnextSettingsPage( $urnext_theme_settings );