# tonik-theme reduction items

The following is the short list of reduction items to the tonik-theme (parent theme). Most of it just works to nullify or strip out anything that might be visually rendered when child theme is built and compiled to its `public` folder. This approach may not be the best workflow in building out tonik with a child theme but its what made sense to me at the time (end of March, 18') I pulled the repo down from tonik. 

---

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

---

## `resources`
`/assets/sass - *.scss`
+ remove the entire `sass` folder

`/assets/js - app.js`
+ comment out the import(s) statements

`/templates/*`
+ most of these files will end up being eclipsed by child theme (child theme file names must match the corresponding parent file name)

---

## `config`
`- app.php`
+ autoload array needs to match whatever is removed from the app directory

`- app.json`
+ remove everything leaving empty object, e.g. `{}`
> #### **Why do this?**<br><span style="font-weight:normal;font-size:.85rem;">...*since we're only building one file into `public`, remove this object and add the file into app.config manually. Should more than one file end up needing to be compiled to `public`, then reinstate the obj.*</span>

---

## `build`
`- app.config.js`
+ Here we'll add the one and only file `./resources/assets/js/app.js` that ends up being compiled into the `public` dist folder since we removed all the object properties in `config/app.json` file
+ ...in the `module.exports` `merge()` function add the following to the `assets` array as shown:

```
assets: [ '*./resources/assets/js/app.js*' ],
```
+ the rest of this file is moot since it deals with build tasks that assume the parent theme has theme customizations compiled for entire theme. we do that in the child theme

`- webpack.config.js` *note: as of 3.0.0 [tonik master](https://github.com/tonik/theme/blob/master/build/webpack.config.js) added to and changed some of the webpack build config, all of which can be integrated into child theme build*
+ remove the `devtool` property from `module.exports` obj since we aren't compiling anything in this theme that needs sourcemaps
+ same as above, remove the `module` prop and `rules` array
+ in the `plugins` array, remove `webpack.LoaderOptionsPlugin`, `ExtractTextPlugin`, and `CopyPlugin` instance.


