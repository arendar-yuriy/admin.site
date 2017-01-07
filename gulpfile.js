require('es6-promise').polyfill();
var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    //mix.sass('app.scss').version('public/css/app.css');
    mix.scripts(
        [
            'plugins/loaders/pace.min.js',
            'libraries/jquery.min.js',
            'libraries/bootstrap.min.js',
            'plugins/loaders/blockui.min.js',
            'plugins/forms/styling/uniform.min.js',
            'plugins/notifications/pnotify.min.js',
            'plugins/forms/selects/select2.min.js',
            'core/app.js',
            'core/main.js'
        ], 'public/js/auth.js');

    mix.scripts(
        [
            'plugins/loaders/pace.min.js',
            'libraries/jquery.min.js',
            'libraries/bootstrap.min.js',
            'libraries/effects.min.js',
            'libraries/interactions.min.js',
            'plugins/loaders/blockui.min.js',
            'plugins/forms/styling/uniform.min.js',
            'plugins/forms/editable/editable.min.js',
            'plugins/notifications/pnotify.min.js',
            'plugins/notifications/sweet_alert.min.js',
            'plugins/visualization/d3/d3.min.js',
            'plugins/pickers/pickadate/picker.js',
            'plugins/pickers/pickadate/picker.date.js',
            'plugins/visualization/d3/d3_tooltip.js',
            'plugins/forms/selects/select2.min.js',
            'plugins/forms/styling/switchery.min.js',
            'plugins/ui/nicescroll.min.js',
            'pages/layout_fixed_custom.js',
            'plugins/pickers/anytime.min.js',
            'plugins/ui/moment/moment.min.js',
            'plugins/pickers/daterangepicker.js',
            'plugins/ui/headroom/headroom.min.js',
            'plugins/ui/headroom/headroom_jquery.min.js',
            'plugins/media/fancybox.min.js',
            'plugins/media/cropper.min.js',
            'plugins/tables/datatables/datatables.min.js',
            'plugins/forms/selects/select2.min.js',
            'plugins/notifications/bootbox.min.js',
            'plugins/uploaders/dropzone.min.js',
            'libraries/jquery.nestable.js',
            'plugins/trees/fancytree_all.min.js',
            'plugins/trees/fancytree_childcounter.js',
            'core/app.js',
            'standalonepopup.js',
            'jquery.colorbox-min.js',
            'core/nestable.js',
            'core/layout.js',
            'core/form.js',
            'core/main.js'

        ], 'public/js/app.js');

    mix.styles([
        'bootstrap.min.css',
        'core.min.css',
        'components.min.css',
        'colors.min.css'
    ], 'public/css/auth.css');

    mix.styles([
        'bootstrap.min.css',
        'core.css',
        'components.css',
        'nestable.css',
        'colors.css',
        'cropper.css',
        'colorbox.css',
        'custom.css'
    ], 'public/css/app.css');
});

