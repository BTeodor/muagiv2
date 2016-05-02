var del = require('del');
var elixir = require('laravel-elixir');

elixir.extend('remove', function(path) {
    new elixir.Task('remove', function() {
        del(path);
    });
});

elixir(function(mix) {
    // mix.copy(
    //    'resources/assets/fonts',
    //    'public/build/fonts'
    // );

    mix.less('custom.less', 'public/css/dashboard/');

    mix.browserify('bootstrap.min.js', 'public/js/dashboard/');

    // Copy bootstrap and AdminLTE CSS files to public directory
    mix.copy('bower_components/AdminLTE/bootstrap/css/bootstrap.css', 'public/css/dashboard/bootstrap.css');
    mix.copy('bower_components/AdminLTE/dist/css/AdminLTE.css', 'public/css/dashboard/admin-lte.css');
    mix.copy('bower_components/AdminLTE/dist/css/skins/_all-skins.css', 'public/css/dashboard/admin-lte-skin.css');
    mix.copy('bower_components/AdminLTE/dist/js/app.js', 'public/js/dashboard/admin-lte.js');


    // Copy fonts from Glypicons
    mix.copy('bower_components/AdminLTE/bootstrap/fonts', 'public/build/fonts');

    // Font Awesome
    mix.copy('bower_components/font-awesome/css/font-awesome.css', 'public/css/dashboard/font-awesome.css');
    mix.copy('bower_components/font-awesome/fonts', 'public/build/fonts');

    // iCheck
    mix.copy('bower_components/AdminLTE/plugins/iCheck/square/blue.css', 'public/css/dashboard/i-check-blue.css');
    mix.copy('bower_components/AdminLTE/plugins/iCheck/flat/flat.css', 'public/css/dashboard/i-check-flat.css');
    mix.copy('bower_components/AdminLTE/plugins/iCheck/square/blue.png', 'public/build/css/blue.png');
    mix.copy('bower_components/AdminLTE/plugins/iCheck/flat/flat.png', 'public/build/css/flat.png');
    mix.copy('bower_components/AdminLTE/plugins/iCheck/icheck.js', 'public/js/dashboard/i-check.js');

    // ChartJS
    mix.copy('bower_components/AdminLTE/plugins/chartjs/Chart.min.js', 'public/js/dashboard/Chart.min.js');

    // Datatables
    mix.copy('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.css', 'public/css/dashboard/dataTables.bootstrap.css');
    mix.copy('bower_components/AdminLTE/plugins/datatables/jquery.dataTables.min.js', 'public/js/dashboard/jquery.dataTables.min.js');
    mix.copy('bower_components/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js', 'public/js/dashboard/dataTables.bootstrap.min.js');

    // SweetAlert
    mix.copy('bower_components/sweetalert/dist/sweetalert.css', 'public/css/dashboard/sweetalert.css');
    mix.copy('bower_components/sweetalert/dist/sweetalert.min.js', 'public/js/dashboard/sweetalert.min.js');

    // Select2
    mix.copy('bower_components/AdminLTE/plugins/select2/select2.min.css', 'public/css/dashboard/select2.min.css');
    mix.copy('bower_components/AdminLTE/plugins/select2/select2.full.min.js', 'public/js/dashboard/select2.full.min.js');

    // Bootstrap Switch
    mix.copy('bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css', 'public/css/dashboard/bootstrap-switch.min.css');
    mix.copy('bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js', 'public/js/dashboard/bootstrap-switch.min.js');

    //Others
    mix.copy('resources/assets/js/app.js', 'public/js/dashboard/app.js');
    mix.copy('resources/assets/js/croppie/croppie.js', 'public/js/dashboard/croppie.js');
    mix.copy('resources/assets/js/moment.min.js', 'public/js/dashboard/moment.min.js');
    mix.copy('resources/assets/js/delete.handler.js', 'public/js/dashboard/delete.handler.js');
    mix.copy('resources/assets/js/bootstrap-datetimepicker.min.js', 'public/js/dashboard/bootstrap-datetimepicker.min.js');

    mix.copy('resources/assets/css/bootstrap-datetimepicker.min.css', 'public/css/dashboard/bootstrap-datetimepicker.min.css');
    mix.copy('resources/assets/js/croppie/croppie.css', 'public/css/dashboard/croppie.css');

    // Merge all dashboard CSS files in one file.
    mix.styles([
        '/dashboard/bootstrap.css',
        '/dashboard/dataTables.bootstrap.css',
        '/dashboard/admin-lte.css',
        'dashboard/admin-lte-skin.css',
        'dashboard/font-awesome.css',
        '/dashboard/i-check-blue.css',
        '/dashboard/i-check-flat.css',
        '/dashboard/custom.css',
        '/dashboard/bootstrap-datetimepicker.min.css',
        '/dashboard/croppie.css',
        '/dashboard/sweetalert.css',
        '/dashboard/bootstrap-switch.min.css',
        '/dashboard/select2.min.css'
    ], './public/css/dashboard.css', './public/css');


    // Merge all dashboard JS  files in one file.
    mix.scripts([
        '/dashboard/bootstrap.min.js',
        '/dashboard/jquery.dataTables.min.js',
        '/dashboard/dataTables.bootstrap.min.js',
        '/dashboard/admin-lte.js',
        '/dashboard/i-check.js',
        '/dashboard/Chart.min.js',
        '/dashboard/app.js',
        '/dashboard/croppie.js',
        '/dashboard/moment.min.js',
        '/dashboard/delete.handler.js',
        '/dashboard/bootstrap-datetimepicker.min.js',
        '/dashboard/sweetalert.min.js',
        '/dashboard/bootstrap-switch.min.js',
        'dashboard/select2.full.min.js'
    ], './public/js/dashboard.js', './public/js');


    // frontend
    mix.copy('bower_components/bootstrap/dist/css/bootstrap.min.css', 'public/css/frontend/bootstrap.min.css');
    mix.copy('bower_components/bootstrap/dist/js/bootstrap.min.js', 'public/js/frontend/bootstrap.min.js');
    mix.copy('resources/assets/css/flag-icon.min.css', 'public/css/frontend/flag-icon.min.css');
    mix.copy('resources/assets/flags', 'public/build/flags');
    
    // Merge all frontend CSS files in one file.
    mix.styles([
        '/frontend/bootstrap.min.css',
        '/frontend/flag-icon.min.css'
    ], './public/css/frontend.css', './public/css');

    // Merge all frontend JS  files in one file.
    mix.scripts([
        '/frontend/bootstrap.min.js'
    ], './public/js/frontend.js', './public/js');

    mix.version([
      "public/css/dashboard.css",
      "public/css/frontend.css",
      "public/js/dashboard.js",
      "public/js/frontend.js"
      ]);

    elixir(function(mix) {
      mix.remove([ 'public/css', 'public/js', 'public/fonts' ]);
    });
});
