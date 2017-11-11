let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// jQuery
mix.copy("vendor/bower_dl/adminlte/plugins/jQuery/*.js", 'resources/assets/js/');
mix.copy("vendor/bower_dl/adminlte/plugins/jQuery/*.js", 'resources/assets/plugins/jquery/');

// bootstarp
mix.copy("vendor/bower_dl/adminlte/dist/css/*.css", 'resources/assets/css/');
mix.copy("vendor/bower_dl/adminlte/dist/css/*.css", 'resources/assets/plugins/bootstrap/');
mix.copy("vendor/bower_dl/adminlte/dist/js/*.js", 'resources/assets/js/');
mix.copy("vendor/bower_dl/adminlte/dist/js/*.js", 'resources/assets/plugins/bootstrap');
mix.copy("vendor/bower_dl/adminlte/dist/fonts/*", 'resources/assets/fonts/');
mix.copy("vendor/bower_dl/adminlte/dist/fonts/*", 'resources/assets/plugins/fonts/');

// AdminLTE
mix.copy("vendor/bower_dl/adminlte/dist/css/*.css", 'resources/assets/css/');
mix.copy("vendor/bower_dl/adminlte/dist/css/skins/*", 'resources/assets/css/');
mix.copy("vendor/bower_dl/adminlte/dist/js/*.js", 'resources/assets/js/');
mix.copy("vendor/bower_dl/adminlte/dist/img/*", 'resources/assets/img/');

// Fontawesome
mix.copy("vendor/bower_dl/font-awesome/css/*", 'resources/assets/css/');
mix.copy("vendor/bower_dl/font-awesome/fonts/*", 'resources/assets/fonts/');

// Ionicons
mix.copy("vendor/bower_dl/Ionicons/css/*", 'resources/assets/css/');
mix.copy("vendor/bower_dl/Ionicons/fonts/*", 'resources/assets/fonts/');

// slimScroll
mix.copy("vendor/bower_dl/adminlte/plugins/slimScroll/*.js", 'resources/assets/js/');

// iCheck
mix.copy("vendor/bower_dl/adminlte/plugins/iCheck/*.js", 'resources/assets/js/');
mix.copy("vendor/bower_dl/adminlte/plugins/iCheck/*.css", 'resources/assets/css/');
mix.copy("vendor/bower_dl/adminlte/plugins/iCheck/square/*", 'resources/assets/css/');

// select2
mix.copy("vendor/bower_dl/adminlte/plugins/select2/*.js", 'resources/assets/js/');
mix.copy("vendor/bower_dl/adminlte/plugins/select2/*.css", 'resources/assets/css/');

// pace
mix.copy("vendor/bower_dl/adminlte/plugins/pace/*.css", 'resources/assets/css/');
mix.copy("vendor/bower_dl/adminlte/plugins/pace/*.js", 'resources/assets/js/');

//sweetalert
mix.copy("vendor/bower_dl/sweetalert/dist/*.css", 'resources/assets/css/');
mix.copy("vendor/bower_dl/sweetalert/dist/*.js", 'resources/assets/js/');
mix.copy("vendor/bower_dl/sweetalert/dist/*.gif", 'resources/assets/img/');

//datapicker
mix.copy("vendor/bower_dl/smalot-bootstrap-datetimepicker/js/*", 'resources/assets/plugins/datetimepicker/');
mix.copy("vendor/bower_dl/smalot-bootstrap-datetimepicker/css/*", 'resources/assets/plugins/datetimepicker/');

//dropzone
mix.copy("vendor/bower_dl/dropzone/dist/min/*", 'resources/assets/plugins/dropzone/');

//dataTable
mix.copy("vendor/bower_dl/datatables/media/css/*.css", 'resources/assets/plugins/dropzone/');
mix.copy("vendor/bower_dl/datatables/media/js/*.js", 'resources/assets/plugins/dropzone/');

//toastr
mix.copy("vendor/bower_dl/toastr/*.css", 'resources/assets/plugins/toastr/');
mix.copy("vendor/bower_dl/toastr/*.css", 'resources/assets/plugins/toastr/');

//fileupload
mix.copy("vendor/bower_dl/blueimp-file-upload/css/*.css", 'resources/assets/plugins/blueimp-file-upload/');
mix.copy("vendor/bower_dl/blueimp-file-upload/js/*.js", 'resources/assets/plugins/blueimp-file-upload/');
mix.copy("vendor/bower_dl/blueimp-file-upload/js/vendor/*.js", 'resources/assets/plugins/blueimp-file-upload/');

//fancybox
mix.copy("vendor/bower_dl/fancybox/source/*", 'resources/assets/plugins/fancybox/');

//压缩打包

mix.copy('resources/assets/plugins/', 'public/assets/plugins/');
mix.copy('resources/assets/language/', 'public/assets/language/');
mix.copy('resources/assets/fonts/', 'public/assets/fonts/');
mix.copy('resources/assets/img/', 'public/assets/img/');
mix.copy('resources/assets/images/', 'public/assets/images');


mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');

mix.scripts(
    [
        'resources/assets/js/jquery-2.2.3.min.js',
        'resources/assets/js/bootstrap.min.js',
        'resources/assets/js/jquery.slimscroll.min.js',
        'resources/assets/js/icheck.min.js',
        'resources/assets/js/adminlte.min.js',
        'resources/assets/js/select2.full.min.js',
        'resources/assets/js/sweetalert.min.js',
        'resources/assets/js/common.js',
    ],
    'public/assets/js/admin.js'
);

// 合并css样式
mix.styles(
    [
        'bootstrap.min.css',
        'font-awesome.min.css',
        'ionicons.min.css',
        'select2.min.css',
        'AdminLTE.min.css',
        'skin-purple.min.css',
        'purple.css',
        //'pace.min.css',
        'sweetalert.css',
        'common.css',

    ],
    'public/assets/css/admin.css',
    'resources/assets/css/'
);






