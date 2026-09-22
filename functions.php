<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once get_template_directory() . '/inc/class-jones-stephens-shop-menu-walker.php';

function jones_stephens_theme_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo' );

    register_nav_menus(
        array(
            'primary-menu'             => __( 'Primary Menu', 'jones-stephens' ),
            'shop-menu'                => __( 'Shop Menu', 'jones-stephens' ),
            'featured-categories-menu' => __( 'Featured Categories Menu', 'jones-stephens' ),
        )
    );
}
add_action( 'after_setup_theme', 'jones_stephens_theme_setup' );

function jones_stephens_enqueue_assets() {
    $theme_version = wp_get_theme()->get( 'Version' );

    wp_enqueue_style(
        'jones-stephens-app',
        get_template_directory_uri() . '/assets/dist/css/app.css',
        array(),
        $theme_version
    );

    wp_enqueue_script(
        'jones-stephens-navigation',
        get_template_directory_uri() . '/assets/js/navigation.js',
        array(),
        $theme_version,
        true
    );
}
add_action( 'wp_enqueue_scripts', 'jones_stephens_enqueue_assets' );

function jones_stephens_get_menu_by_location( $location ) {
    $locations = get_nav_menu_locations();

    if ( empty( $locations[ $location ] ) ) {
        return null;
    }

    $menu = wp_get_nav_menu_object( $locations[ $location ] );

    return $menu instanceof WP_Term ? $menu : null;
}
