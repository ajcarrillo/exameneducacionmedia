window.$ = window.jQuery = require('jquery');
require('admin-lte/plugins/bootstrap/js/bootstrap.bundle.min');
require('admin-lte/dist/js/adminlte.min');

(function () {
    //$('.sidebar-menu').tree();
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
        //$('div.alert').not('.alert-important').delay(5000).fadeOut(350);
    })
})();
