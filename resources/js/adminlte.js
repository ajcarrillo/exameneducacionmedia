window.$ = window.jQuery = require('jquery');
require('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min');
require('admin-lte/dist/js/adminlte.min');

(function () {
    //$('.sidebar-menu').tree();
    $('div.alert').not('.alert-important').delay(5000).fadeOut(350);
})();
