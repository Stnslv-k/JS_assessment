# Header assessment

## How I would code it

I would register three menu locations:

- Primary Menu for About Us, Project Solutions, Resources and Contact Us.
- Shop Menu for the main shop navigation and its child items.
- Featured Categories Menu for the smaller category links shown in the grey bar.

I don't think ACF is needed for this header. The navigation structure, labels, links and order can already be managed with the native WordPress menu system.

There are no hardcoded menu items and no menu fallbacks. If a menu location is not assigned in WordPress, that part of the header is simply not rendered.

The visible labels for Shop All and Featured Categories are also not hardcoded. They come from the names of the menus assigned to those locations. For example, the editor can create a menu called `Shop All` and assign it to the Shop Menu location, then create another menu called `Featured Categories` and assign it to the Featured Categories Menu location.

The header markup is kept in one small template part. Tailwind CSS is used for the layout and responsive styles. Desktop and mobile use the same WordPress menu data, only the presentation changes for different screen sizes.

For the open and close behaviour I would use a small amount of vanilla JavaScript. A JS framework is not needed here. The buttons use `aria-expanded` and `aria-controls`, and Escape closes the open navigation.

## Walker_Nav_Menu

For the Shop Menu I would use a custom class which extends `Walker_Nav_Menu`.

WordPress already handles the menu tree and calls the Walker methods while it goes through parent and child menu items. I only change the parts of the generated markup which are useful for this design.

In this example:

- `start_el()` adds a consistent class to every shop item.
- WordPress sets the Walker's `$has_children` property before `start_el()` is called, so I use that to know if the current item has child items.
- If an item has children, the Walker adds another class and an arrow after the link text.
- I keep the inherited `start_lvl()` and `end_lvl()` behaviour, so WordPress still handles submenu markup and its normal filters.
- `parent::start_el()` is still used for the normal WordPress link output, attributes and filters instead of rebuilding all of that logic in the custom class.

The Walker is passed directly to `wp_nav_menu()`:

```php
wp_nav_menu(
    array(
        'theme_location' => 'shop-menu',
        'container'      => false,
        'menu_class'     => 'shop-menu',
        'fallback_cb'    => false,
        'walker'         => new Jones_Stephens_Shop_Menu_Walker(),
    )
);
```

A simplified part of the Walker looks like this:

```php
class Jones_Stephens_Shop_Menu_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        if ( $this->has_children ) {
            $data_object->classes[] = 'shop-menu-item--has-children';
        }

        parent::start_el( $output, $data_object, $depth, $args, $current_object_id );
    }
}
```

This keeps the class small, but gives control over the menu markup if the design becomes more complex later.

## Admin setup

The editor creates and assigns three menus in WordPress:

```text
Primary Menu
About Us
Project Solutions
Resources
Contact Us

Shop All
Piping Systems
    PEX
    Copper
Bathroom
Kitchen
Drainage

Featured Categories
PEX Systems
Water Supplies and Stops
Gas Connectors
Bath Waste Trim Kits
Tankless Water Heater Kits
```

The menu names are used as the visible section labels, and the menu items are used as the links. This keeps all navigation content editable without adding extra fields.


## Build

```bash
npm install
npm run build
```
