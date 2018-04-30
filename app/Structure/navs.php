<?php

namespace Tonik\Theme\App\Structure;

/*
|----------------------------------------------------------------
| Theme Navigation Areas
|----------------------------------------------------------------
|
| This file is for registering your theme custom navigation areas
| where various menus can be assigned by site administrators.
|
*/

use function Tonik\Theme\App\config;

/**
 * Registers navigation areas.
 *
 * @return void
 */
function register_navigation_areas()
{
  register_nav_menus([
    'primary' => __('Primary', config('textdomain')),
  ]);
}
add_action('after_setup_theme', __NAMESPACE__ . '\\register_navigation_areas');
