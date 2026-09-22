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

function jones_stephens_nav_menu_link_attributes( $atts, $menu_item, $args, $depth ) {
    $menu_id = $args->menu_id ?? '';

    if ( 'primary-navigation-menu' === $menu_id ) {
        $atts['class'] = 'inline-flex items-center gap-2 py-2 text-base font-semibold text-ink no-underline transition-colors hover:text-brand-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-blue';
    }

    if ( 'mobile-navigation-menu' === $menu_id ) {
        $atts['class'] = 'block border-b border-slate-100 py-4 text-base font-semibold text-ink no-underline transition-colors hover:text-brand-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-blue';
    }

    if ( 'featured-categories-menu' === $menu_id ) {
        $atts['class'] = 'whitespace-nowrap py-2 font-semibold text-brand-blue no-underline transition-opacity hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-blue';
    }

    if ( 'shop-navigation-menu' === $menu_id ) {
        if ( 0 === $depth ) {
            $atts['class'] = 'flex min-h-14 w-full items-center justify-between gap-4 py-3 text-lg font-semibold text-ink no-underline transition-colors hover:text-brand-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-blue';
        } else {
            $atts['class'] = 'block py-2 text-sm font-medium text-slate-600 no-underline transition-colors hover:text-brand-blue focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-blue';
        }
    }

    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'jones_stephens_nav_menu_link_attributes', 10, 4 );

function jones_stephens_nav_menu_submenu_css_class( $classes, $args, $depth ) {
    if ( 'shop-menu' === ( $args->theme_location ?? '' ) ) {
        $classes[] = 'hidden m-0 ml-5 list-none border-l border-slate-200 pl-5';
    }

    return $classes;
}
add_filter( 'nav_menu_submenu_css_class', 'jones_stephens_nav_menu_submenu_css_class', 10, 3 );
