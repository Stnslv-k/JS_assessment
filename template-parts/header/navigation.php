<?php
$shop_menu                = jones_stephens_get_menu_by_location( 'shop-menu' );
$featured_categories_menu = jones_stephens_get_menu_by_location( 'featured-categories-menu' );
?>

<header class="relative z-50 border-t-4 border-brand-blue bg-white shadow-sm" data-site-header>
    <div class="mx-auto flex h-20 max-w-site items-center justify-between px-4 lg:h-24 lg:px-10">
        <div class="shrink-0 [&_.custom-logo-link]:block [&_.custom-logo]:block [&_.custom-logo]:h-auto [&_.custom-logo]:max-h-16 [&_.custom-logo]:w-auto [&_.custom-logo]:max-w-[220px]">
            <?php the_custom_logo(); ?>
        </div>

        <?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
            <nav class="hidden lg:block" aria-label="<?php esc_attr_e( 'Primary navigation', 'jones-stephens' ); ?>">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary-menu',
                        'container'      => false,
                        'menu_id'        => 'primary-navigation-menu',
                        'menu_class'     => 'm-0 flex list-none items-center gap-8 p-0 xl:gap-10',
                        'fallback_cb'    => false,
                        'depth'          => 2,
                    )
                );
                ?>
            </nav>
        <?php endif; ?>

        <div class="flex items-center gap-3 lg:hidden">
            <?php if ( $shop_menu ) : ?>
                <button
                    class="group inline-flex items-center gap-2 rounded-full border-0 bg-brand-blue px-5 py-3 text-sm font-bold text-white transition-colors hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-blue"
                    type="button"
                    data-shop-toggle
                    aria-expanded="false"
                    aria-controls="shop-navigation"
                >
                    <span><?php echo esc_html( $shop_menu->name ); ?></span>
                    <span class="text-lg leading-none transition-transform group-aria-expanded:rotate-180" aria-hidden="true">⌄</span>
                </button>
            <?php endif; ?>

            <?php if ( has_nav_menu( 'primary-menu' ) ) : ?>
                <button
                    class="flex h-11 w-11 flex-col items-center justify-center gap-1.5 border-0 bg-transparent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-blue"
                    type="button"
                    data-mobile-menu-toggle
                    aria-expanded="false"
                    aria-controls="mobile-navigation"
                    aria-label="<?php esc_attr_e( 'Toggle main navigation', 'jones-stephens' ); ?>"
                >
                    <span class="h-0.5 w-7 bg-slate-600"></span>
                    <span class="h-0.5 w-7 bg-slate-600"></span>
                    <span class="h-0.5 w-7 bg-slate-600"></span>
                </button>
            <?php endif; ?>
        </div>
    </div>

    <?php if ( $shop_menu || $featured_categories_menu ) : ?>
        <div class="hidden min-h-20 items-center gap-10 bg-header-gray px-8 lg:flex">
            <?php if ( $shop_menu ) : ?>
                <button
                    class="group inline-flex shrink-0 items-center gap-3 rounded-full border-0 bg-brand-blue px-7 py-4 text-base font-bold text-white transition-colors hover:bg-blue-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-brand-blue"
                    type="button"
                    data-shop-toggle
                    aria-expanded="false"
                    aria-controls="shop-navigation"
                >
                    <span><?php echo esc_html( $shop_menu->name ); ?></span>
                    <span class="text-xl leading-none transition-transform group-aria-expanded:rotate-180" aria-hidden="true">⌄</span>
                </button>
            <?php endif; ?>

            <?php if ( $featured_categories_menu ) : ?>
                <div class="flex min-w-0 flex-1 items-center justify-center gap-8">
                    <span class="shrink-0 text-base font-medium text-slate-700">
                        <?php echo esc_html( $featured_categories_menu->name ); ?>:
                    </span>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'featured-categories-menu',
                            'container'      => false,
                            'menu_id'        => 'featured-categories-menu',
                            'menu_class'     => 'm-0 flex list-none flex-wrap items-center justify-center gap-x-8 gap-y-1 p-0',
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
        <div
            id="mobile-navigation"
            class="absolute left-0 right-0 top-full hidden bg-white px-6 py-4 shadow-lg lg:hidden"
            data-mobile-menu
        >
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary-menu',
                    'container'      => false,
                    'menu_id'        => 'mobile-navigation-menu',
                    'menu_class'     => 'm-0 list-none p-0',
                    'fallback_cb'    => false,
                    'depth'          => 2,
                )
            );
            ?>
        </div>
    <?php endif; ?>

    <?php if ( $shop_menu ) : ?>
        <div
            id="shop-navigation"
            class="fixed inset-x-0 bottom-0 top-20 z-40 hidden overflow-y-auto bg-white lg:absolute lg:bottom-auto lg:top-full lg:min-h-[520px] lg:grid-cols-[minmax(24rem,32rem)_1fr] lg:overflow-visible lg:bg-transparent"
            data-shop-panel
        >
            <div class="bg-white px-6 py-8 lg:px-12 lg:py-10">
                <p class="mb-8 mt-0 text-xl font-bold text-brand-blue">
                    <?php echo esc_html( $shop_menu->name ); ?>
                </p>

                <nav aria-label="<?php echo esc_attr( $shop_menu->name ); ?>">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'shop-menu',
                            'container'      => false,
                            'menu_id'        => 'shop-navigation-menu',
                            'menu_class'     => 'm-0 list-none p-0',
                            'fallback_cb'    => false,
                            'walker'         => new Jones_Stephens_Shop_Menu_Walker(),
                            'depth'          => 0,
                        )
                    );
                    ?>
                </nav>
            </div>

            <button
                class="relative hidden border-0 bg-black/95 lg:block"
                type="button"
                data-shop-close
                aria-label="<?php esc_attr_e( 'Close shop navigation', 'jones-stephens' ); ?>"
            >
                <span class="absolute left-6 top-3 text-5xl font-light leading-none text-white" aria-hidden="true">×</span>
            </button>
        </div>
    <?php endif; ?>
</header>
