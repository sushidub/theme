# Reduction Notes &mdash; *tonik-theme*

> The following is the short list of reduction items to the tonik/theme &mdash; [parent theme](https://github.com/tonik/theme/tree/master). Most of the work here is minimal and only serves to nullify statements or strip out anything that might be visually rendered via parent theme once the 'forthcoming' [child theme](https://github.com/sushidub/tonik-child-theme) is built and compiled. This approach may not be the best workflow in building out tonik/theme with child theme, but it's what made sense at the time I originally pulled the repo down *(mid-March)* from [tonik](https://github.com/tonik).

<br><br>
> <span style="color:#FB006D">Required Global update:</span> All namespaces must match [tonik/theme](https://github.com/sushidub/tonik-theme/commit/10a79e6684dfe30698da94db6d49862a5c144381) conventions. Double check we haven't copy/pasted legacy namespace from previous theme work. Also, since namespace paths are used everywhere throughout parent/child theme, might be wise to leverage PHP's `__NAMESPACE__` constant in preventing NS errors/typos.

```php
namespace Tonik\Theme\App\Setup;

function render_sidebar()
{
  get_sidebar();
}
add_action('theme/index/sidebar', __NAMESPACE__ . '\\render_sidebar');
```
<br>

## `app`
`/Http - assets.php`
+ remove statement `wp_enqueue_style` in `register_stylesheets()`
+ remove the function `register_scripts()` and its hook
+ remove statement `add_editor_style` in `register_editor_stylesheets()`
+ remove the function `move_jquery_to_the_footer()` and its hook

`/Setup - actions.php`
+ add all the custom functions currently in the file (`app/Setup/actions.php`) - nothing currently relevant in tonik-theme

`/Structure - posttypes.php`
+ remove the function `register_book_post_type()` and its hook

`/Structure - thumbnails.php`
+ remove the statement `add_image_size()` in the function `add_image_sizes()`

`/Structure - templates.php`
+ remove the whole templates.php file

## `resources`
`/assets/sass - *.scss`
+ remove the entire `sass` folder

`/assets/js - app.js`
+ comment out the import(s) statements

`/templates/*`
+ most of these files will end up being eclipsed by child theme (child theme file names must match the corresponding parent file name)

## `config`
`- app.php`
+ autoload array needs to match whatever is removed from the app directory

`- app.json`
+ remove everything leaving empty object, e.g. `{}`
> #### **Why do this?**<br><span style="font-weight:400;font-size:.75rem;">...*since we're only building one file into `public`, remove this object and add the file into app.config manually. Should more than one file end up needing to be compiled to `public`, then reinstate the obj.*</span>

## `build`
`- app.config.js`
+ Here we'll add the one and only file `./resources/assets/js/app.js` that ends up being compiled into the `public` dist folder since we removed all the object properties in `config/app.json` file
+ ...in the `module.exports` `merge()` function add the following to the `assets` array as shown:

```
assets: [ '*./resources/assets/js/app.js*' ],
```
+ the rest of this file is moot since it deals with build tasks that assume the parent theme has theme customizations compiled for entire theme. we do that in the child theme
+ With the absence of any scss/sass compiled with `npm run dev`, the `settings.styleLint` property produces the following error:
```
Error: resources/assets/**/*.s?(c|a)ss does not match any files
```

`- webpack.config.js`
> NOTE: at the time of posting this, [tonik](https://github.com/tonik) added minor changes to the webpack [`build`](https://github.com/tonik/theme/blob/master/build/webpack.config.js) configuration for [tonik/theme &mdash; v3.0.0](https://github.com/tonik/theme/tree/master). ~~The changes don't affect our customizations here. I'll need to integrate them into the child theme build tho.~~
+ ~~remove the `devtool` property from `module.exports` obj since we aren't compiling anything in this theme that needs sourcemaps~~
+ ~~same as above, remove the `module` prop and `rules` array~~
+ ~~in the `plugins` array, remove `webpack.LoaderOptionsPlugin`, `ExtractTextPlugin`, and `CopyPlugin` instance.~~


