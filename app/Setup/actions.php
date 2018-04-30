<?php

namespace Tonik\Theme\App\Setup;

/*
|-----------------------------------------------------------
| Theme Actions
|-----------------------------------------------------------
|
| This file purpose is to include your custom
| actions hooks, which process a various
| logic at specific parts of WordPress.
|
*/
use function Tonik\Theme\App\template;


/**
 * Renders post thumbnail by its formats.
 *
 * @see do_action('theme/index/post/thumbnail')
 * @uses resources/templates/partials/post/thumbnail-{format}.tpl.php
 */
function render_post_thumbnail()
{
  template(['partials/post/thumbnail', get_post_format()]);
}
add_action('theme/index/post/thumbnail', __NAMESPACE__ . '\\render_post_thumbnail');

/**
 * Renders post contents by its formats.
 *
 * @see do_action('theme/index/post/content')
 * @uses resources/templates/partials/post/content-{format}.tpl.php
 */
function render_post_content()
{
  template(['partials/post/content', get_post_format()]);
}
add_action('theme/single/content', __NAMESPACE__ . '\\render_post_content');

/**
 * Renders empty post content where there is no posts.
 *
 * @see do_action('theme/index/content/none')
 * @uses resources/templates/partials/index/content-none.tpl.php
 */
function render_empty_content()
{
  template(['partials/index/content', 'none']);
}
add_action('theme/index/content/none', __NAMESPACE__ . '\\render_empty_content');

/**
 * Renders sidebar content.
 *
 * @see do_action('theme/index/sidebar')
 * @see do_action('theme/single/sidebar')
 * @uses resources/templates/partials/sidebar.tpl.php
 */
function render_sidebar()
{
  get_sidebar();
}
add_action('theme/index/sidebar', __NAMESPACE__ . '\\render_sidebar');
add_action('theme/single/sidebar', __NAMESPACE__ . '\\render_sidebar');

/**
 * Renders [button] shortcode after homepage content.
 *
 * @see do_action('theme/header/end')
 * @uses resources/templates/shortcodes/button.tpl.php
 */
function render_documentation_button()
{
  echo do_shortcode("[button href='https://github.com/tonik/tonik']Checkout documentation →[/button]");
}
add_action('theme/header/end', __NAMESPACE__ . '\\render_documentation_button');
