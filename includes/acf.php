<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_banner',
		'title' => 'Banner',
		'fields' => array (
			array (
				'key' => 'field_59ce6b315f67c',
				'label' => 'Select banner',
				'name' => 'urnext_select_banner',
				'type' => 'select',
				'choices' => array (
					'default' => 'Theme Default (showing the featured image)',
					'custom' => 'Add a custom banner',
					'shortcode' => 'Use a shortcode in the banner',
					'none' => 'Hide the banner',
				),
				'default_value' => 'default',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_59ce6b9a668e5',
				'label' => 'Banner caption',
				'name' => 'urnext_banner_caption',
				'type' => 'wysiwyg',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_59ce6b315f67c',
							'operator' => '==',
							'value' => 'default',
						),
						array (
							'field' => 'field_59ce6b315f67c',
							'operator' => '==',
							'value' => 'custom',
						),
					),
					'allorany' => 'any',
				),
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
            ),
            array (
				'key' => 'field_59d0fb0b52271',
				'label' => 'Caption width',
				'name' => 'urnext_caption_width',
                'type' => 'number',
                'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_59ce6b315f67c',
							'operator' => '==',
							'value' => 'default',
						),
						array (
							'field' => 'field_59ce6b315f67c',
							'operator' => '==',
							'value' => 'custom',
						),
					),
					'allorany' => 'any',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '%',
				'min' => 0,
				'max' => 100,
				'step' => 1,
            ),
            array (
				'key' => 'field_59d0fb0b52888',
				'label' => 'Caption left offset',
				'name' => 'urnext_caption_left_offset',
                'type' => 'number',
                'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_59ce6b315f67c',
							'operator' => '==',
							'value' => 'default',
						),
						array (
							'field' => 'field_59ce6b315f67c',
							'operator' => '==',
							'value' => 'custom',
						),
					),
					'allorany' => 'any',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '%',
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			array (
				'key' => 'field_59d0fb5bdc154',
				'label' => 'Caption background color',
				'name' => 'urnext_caption_background_color',
                'type' => 'color_picker',
                'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_59ce6b315f67c',
							'operator' => '==',
							'value' => 'default',
						),
						array (
							'field' => 'field_59ce6b315f67c',
							'operator' => '==',
							'value' => 'custom',
						),
					),
					'allorany' => 'any',
				),
				'default_value' => '',
			),
			array (
				'key' => 'field_59d0fbc5dc156',
				'label' => 'Caption background opacity',
				'name' => 'urnext_caption_background_opacity',
                'type' => 'number',
                'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_59ce6b315f67c',
							'operator' => '==',
							'value' => 'default',
						),
						array (
							'field' => 'field_59ce6b315f67c',
							'operator' => '==',
							'value' => 'custom',
						),
					),
					'allorany' => 'any',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '%',
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
			array (
				'key' => 'field_59ce6bcc668e7',
				'label' => 'Banner image',
				'name' => 'urnext_banner_image',
				'type' => 'image',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_59ce6b315f67c',
							'operator' => '==',
							'value' => 'custom',
						),
					),
					'allorany' => 'all',
				),
				'save_format' => 'object',
				'preview_size' => 'large',
				'library' => 'all',
			),
			array (
				'key' => 'field_59ce6bfc668e8',
				'label' => 'Shortcode',
				'name' => 'urnext_banner_shortcode',
				'type' => 'text',
				'instructions' => 'Add a custom shortcode in the banner section',
				'required' => 1,
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_59ce6b315f67c',
							'operator' => '==',
							'value' => 'shortcode',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '[your-shortcode var="value"]',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
