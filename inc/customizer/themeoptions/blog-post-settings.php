<?php
/*Blog Page Settings*/

Kirki::add_section( 'post_loop_settings_section', array(
    'title'          => esc_html__( 'Post Loop Settings', 'fashion-blogging' ),
    'panel'          => 'fashion_blogging_global_panel',
) );

Kirki::add_field( 'fashion_blogging_config', [
	'type'        => 'select',
	'settings'    => 'post_column',
	'label'       => esc_html__( 'Post Column', 'fashion-blogging' ),
	'section'     => 'post_loop_settings_section',
	'default'    => '3',
	'priority'    => 10,
	'choices' => [
			'4' => __( '4 Colmun', 'fashion-blogging' ),
			'3' => __( '3 Column', 'fashion-blogging' ),
			'2' => __( '2 Column', 'fashion-blogging' ),
		],
] );

Kirki::add_field( 'rs_personal_blog_config', array(
    'type'        => 'custom',
    'settings'    => 'sep_after_post_column',
    'label'       => '',
    'section'     => 'post_loop_settings_section',
    'default'     => '<hr>',
) );

Kirki::add_field( 'fashion_blogging_config', [
    'type'        => 'toggle',
    'settings'    => 'show_post_category',
    'label'       => esc_html__( 'Show Post Category', 'fashion-blogging' ),
    'section'     => 'post_loop_settings_section',
    'default'     => '1',
] );

Kirki::add_field( 'fashion_blogging_config', [
    'type'        => 'toggle',
    'settings'    => 'show_post_title',
    'label'       => esc_html__( 'Show Post Title', 'fashion-blogging' ),
    'section'     => 'post_loop_settings_section',
    'default'     => '1',
] );

Kirki::add_field( 'fashion_blogging_config', [
    'type'        => 'toggle',
    'settings'    => 'show_post_author',
    'label'       => esc_html__( 'Show Post Author', 'fashion-blogging' ),
    'section'     => 'post_loop_settings_section',
    'default'     => '1',
] );

Kirki::add_field( 'fashion_blogging_config', [
    'type'        => 'toggle',
    'settings'    => 'show_post_thumbnail',
    'label'       => esc_html__( 'Thumbnail  On//Off', 'fashion-blogging' ),
    'section'     => 'post_loop_settings_section',
    'default'     => '1',
] );
Kirki::add_field( 'fashion_blogging_config', [
    'type'        => 'toggle',
    'settings'    => 'show_post_excerpt',
    'label'       => esc_html__( 'Show Post Excerpt', 'fashion-blogging' ),
    'section'     => 'post_loop_settings_section',
    'default'     => '1',
] );

Kirki::add_field( 'fashion_blogging_config', [
    'type'        => 'toggle',
    'settings'    => 'show_post_date',
    'label'       => esc_html__( 'Show Post Date', 'fashion-blogging' ),
    'section'     => 'post_loop_settings_section',
    'default'     => '1',
] );