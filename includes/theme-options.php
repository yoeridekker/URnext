<?php

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
     * Start up
     */
    public function __construct(){
        add_action( 'admin_menu', array( $this, 'add_urnext_theme_settings_page' ) );
        add_action( 'admin_init', array( $this, 'urnext_theme_settings_page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_urnext_theme_settings_page(){
        // This page will be under "Settings"
        add_options_page(
            __('URnext Theme Options', 'urnext'), 
            __('Theme Options', 'urnext'), 
            'manage_options', 
            'urnext-settings', 
            array( $this, 'create_urnext_theme_settings_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_urnext_theme_settings_admin_page(){
        // Set class property
        $this->options = get_option( 'urnext_theme_option_name' );
        var_dump( $this->options );
        ?>
        <div class="wrap">
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'urnext_theme_option_group' );
                do_settings_sections( 'my-setting-admin' );
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

        register_setting(
            'urnext_theme_option_group', // Option group
            'urnext_theme_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            __('URnext Theme Options', 'urnext'), // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );  

        add_settings_field(
            'id_number', // ID
            'ID Number', // Title 
            array( $this, 'id_number_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );      

        add_settings_field(
            'title', 
            'Title', 
            array( $this, 'title_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input ){

        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print __('Change your theme settings below', 'urnext');
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function id_number_callback()
    {
        printf(
            '<input type="text" id="id_number" name="urnext_theme_option_name[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function title_callback()
    {
        printf(
            '<input type="text" id="title" name="urnext_theme_option_name[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }
}

if( is_admin() )
    $urnext_settings_page = new URnextSettingsPage();