<?php

/**
 * Front End Customizer
 *
 * WordPress 3.4 Required
 */
 
add_action( 'customize_register', 'ws_options_register' );

function ws_options_register($wp_customize) {

	/**
	 * This is optional, but if you want to reuse some of the defaults
	 * or values you already have built in the options panel, you
	 * can load them into $options for easy reference
	 */
	 
	$options = optionsframework_options();
	
	/* Basic */

	$wp_customize->add_section( 'ws_options_sec_brand', array(
		'title' => __( 'Brand', 'ws_options' ),
		'priority' => 100
	) );
	
	$wp_customize->add_setting( 'ws_options[ws_brand]', array(
		'default' => $options['ws_brand']['std'],
		'type' => 'option'
	) );	
	
	$wp_customize->add_control( 'ws_options_ws_brand', array(
		'label' => $options['ws_brand']['name'],
		'section' => 'ws_options_sec_brand',
		'settings' => 'ws_options[ws_brand]',
		'type' => $options['ws_brand']['type'],
		'choices' => $options['ws_brand']['options']
	) );	
	
	$wp_customize->add_setting( 'ws_options[ws_brand_font_text]', array(
		'default' => $options['ws_brand_font_text']['std'],
		'type' => 'option'
	) );

	$wp_customize->add_control( 'ws_options_ws_brand_font_text', array(
		'label' => $options['ws_brand_font_text']['name'],
		'section' => 'ws_options_sec_brand',
		'settings' => 'ws_options[ws_brand_font_text]',
		'type' => $options['ws_brand_font_text']['type']
	) );
	
	$wp_customize->add_setting( 'ws_options[ws_brand_font_type]', array(
		'default' => $options['ws_brand_font_type']['std'],
		'type' => 'option'
	) );	
	
	$wp_customize->add_control( 'ws_options_ws_brand_font_type', array(
		'label' => $options['ws_brand_font_type']['name'],
		'section' => 'ws_options_sec_brand',
		'settings' => 'ws_options[ws_brand_font_type]',
		'type' => $options['ws_brand_font_type']['type'],
		'choices' => $options['ws_brand_font_type']['options']
	) );	
	
}