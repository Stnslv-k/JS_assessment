<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jones_Stephens_Shop_Menu_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $menu_item = $data_object;
        $menu_item->classes = is_array( $menu_item->classes ) ? $menu_item->classes : array();
        $menu_item->classes[] = 'shop-menu__item';

        $original_link_after = isset( $args->link_after ) ? $args->link_after : '';

        if ( $this->has_children ) {
            $menu_item->classes[] = 'shop-menu__item--has-children';
            $args->link_after = $original_link_after . '<span class="shop-menu__arrow" aria-hidden="true">›</span>';
        }

        parent::start_el( $output, $menu_item, $depth, $args, $current_object_id );

        if ( null !== $args ) {
            $args->link_after = $original_link_after;
        }
    }
}
