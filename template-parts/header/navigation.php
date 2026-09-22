<?php
$shop_menu                = jones_stephens_get_menu_by_location( 'shop-menu' );
$featured_categories_menu = jones_stephens_get_menu_by_location( 'featured-categories-menu' );
?>

<header class="site-header" data-site-header>
    <div class="site-header__main">
        <div class="site-branding">
            <?php the_custom_logo(); ?>
        </div>

        <?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
            <nav class="primary-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'jones-stephens' ); ?>">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary-menu',
                        'container'      => false,
                        'menu_class'     => 'primary-menu',
                        'fallback_cb'    => false,
                        'depth'          => 2,
                    )
                );
                ?>
            </nav>
        <?php endif; ?>

        <div class="site-header__mobile-actions">
            <?php if ( $shop_menu ) : ?>
                <button
                    class="shop-toggle shop-toggle--mobile"
                    type="button"
                    data-shop-toggle
                    aria-expanded="false"
                    aria-controls="shop-navigation"
                >
                    <span><?php echo esc_html( $shop_menu->name ); ?></span>
                    <span class="shop-toggle__icon" aria-hidden="true">⌄</span>
                </button>
            <?php endif; ?>

            <?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
                <button
                    class="mobile-menu-toggle"
                    type="button"
                    data-mobile-menu-toggle
                    aria-expanded="false"
                    aria-controls="mobile-navigation"
                    aria-label="<?php esc_attr_e( 'Toggle main navigation', 'jones-stephens' ); ?>"
                >
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            <?php endif; ?>
        </div>
    </div>

    <?php if ( $shop_menu || $featured_categories_menu ) : ?>
        <div class="shop-bar">
            <?php if ( $shop_menu ) : ?>
                <button
                    class="shop-toggle"
                    type="button"
                    data-shop-toggle
                    aria-expanded="false"
                    aria-controls="shop-navigation"
                >
                    <span><?php echo esc_html( $shop_menu->name ); ?></span>
                    <span class="shop-toggle__icon" aria-hidden="true">⌄</span>
                </button>
            <?php endif; ?>

            <?php if ( $featured_categories_menu ) : ?>
                <div class="featured-categories">
                    <span class="featured-categories__label">
                        <?php echo esc_html( $featured_categories_menu->name ); ?>:
                    </span>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'featured-categories-menu',
                            'container'      => false,
                            'menu_class'     => 'featured-categories__menu',
                            'fallback_cb'    => false,
                            'depth'          => 1,
                        )
                    );
                    ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
        <div id="mobile-navigation" class="mobile-navigation" data-mobile-menu hidden>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary-menu',
                    'container'      => false,
                    'menu_class'     => 'mobile-navigation__menu',
                    'fallback_cb'    => false,
                    'depth'          => 2,
                )
            );
            ?>
        </div>
    <?php endif; ?>

    <?php if ( $shop_menu ) : ?>
        <div id="shop-navigation" class="shop-panel" data-shop-panel hidden>
            <div class="shop-panel__menu">
                <p class="shop-panel__title"><?php echo esc_html( $shop_menu->name ); ?></p>
                <nav aria-label="<?php echo esc_attr( $shop_menu->name ); ?>">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'shop-menu',
                            'container'      => false,
                            'menu_class'     => 'shop-menu',
                            'fallback_cb'    => false,
                            'walker'         => new Jones_Stephens_Shop_Menu_Walker(),
                            'depth'          => 0,
                        )
                    );
                    ?>
                </nav>
            </div>

            <button
                class="shop-panel__backdrop"
                type="button"
                data-shop-close
                aria-label="<?php esc_attr_e( 'Close shop navigation', 'jones-stephens' ); ?>"
            >
                <span class="shop-panel__close" aria-hidden="true">×</span>
            </button>
        </div>
    <?php endif; ?>
</header>
