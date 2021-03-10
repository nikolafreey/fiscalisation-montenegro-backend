let mix = require('laravel-mix');

mix.styles([
    // Toastr
    'public/admin2/css/toastr.css',
    // Datatables
    'public/admin2/custom/datatables-combined-1.10.23/datatables.min.css',
    // Jquery confirm
    'public/admin2/css/jquery-confirm.css',
    // Lightadmin
    'public/admin2/css/main.css',
    // Custom
    'public/admin2/css/custom.css',
], 'public/css/all.css')
    .scripts([
        // Bootstrap v4.0.0 dependencies
        'public/admin2/js/popper.min.js',
        'public/admin2/js/util.js',
        'public/admin2/js/alert.js',
        'public/admin2/js/button.js',
        'public/admin2/js/carousel.js',
        'public/admin2/js/collapse.js',
        'public/admin2/js/dropdown.js',
        'public/admin2/js/modal.js',
        'public/admin2/js/tab.js',
        'public/admin2/js/tooltip.js',
        'public/admin2/js/popover.js',
        // Notifications
        'public/admin2/js/toastr.min.js',
        // Popup confirmation
        'public/admin2/js/jquery-confirm.js',
        // Datatables
        'public/admin2/custom/datatables-combined-1.10.23/datatables.min.js',
        // Lightadmin
        'public/admin2/js/main.js',
    ], 'public/js/all.js')
    .version();
