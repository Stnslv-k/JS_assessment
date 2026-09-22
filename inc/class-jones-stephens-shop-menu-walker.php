<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Jones_Stephens_Shop_Menu_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        $menu_item          = $data_object;
        $menu_item->classes = is_array( $menu_item->classes ) ? $menu_item->classes : array();

        if ( 0 === $depth ) {
            $menu_item->classes[] = 'group';
        }

        $original_link_after = $args->link_after ?? '';

        if ( $this->has_children && 0 === $depth ) {
            $args->link_after = $original_link_after . '<span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-header-gray text-2xl leading-none text-brand-blue transition-transform group-hover:translate-x-1" aria-hidden="true">›</span>';
        }

        parent::start_el( $output, $menu_item, $depth, $args, $current_object_id );

        if ( null !== $args ) {
            $args->link_after = $original_link_after;
        }
    }
}
