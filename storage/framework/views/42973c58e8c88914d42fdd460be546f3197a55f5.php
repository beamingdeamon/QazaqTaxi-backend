<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="taxi comapny admin template">
    <meta name="author" content="Apporio">
    <title><?php echo e(Auth::user('taxicompany')->name); ?></title>

    <link rel="apple-touch-icon" href="<?php echo e(asset('theme/images/apple-touch-icon.png')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('theme/images/favicon.ico')); ?>">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo e(asset('global/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/css/bootstrap-extend.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('theme/css/site.min.css')); ?>">

    <!-- Plugins -->
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/animsition/animsition.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/asscrollable/asScrollable.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/intro-js/introjs.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/slidepanel/slidePanel.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/flag-icon-css/flag-icon.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('theme/examples/css/forms/layouts.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/datatables.net-bs4/dataTables.bootstrap4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('theme/examples/css/tables/datatable.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/chartist/chartist.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/asspinner/asSpinner.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/asspinner/asSpinner.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/aspieprogress/asPieProgress.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('theme/examples/css/dashboard/ecommerce.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/select2/select2.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/bootstrap-select/bootstrap-select.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/clockpicker/clockpicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/bootstrap-datepicker/bootstrap-datepicker.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/multi-select/multi-select.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('theme/examples/css/uikit/badges.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('theme/examples/css/structure/alerts.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/typeahead-js/typeahead.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/vendor/summernote/summernote.css')); ?>">

    <!-- Fonts -->
    <link rel="stylesheet" href="<?php echo e(asset('global/fonts/weather-icons/weather-icons.css')); ?>">

    <!-- Fonts -->
    <link rel="stylesheet" href="<?php echo e(asset('global/fonts/font-awesome/font-awesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('global/fonts/web-icons/web-icons.min.css')); ?>">
    <link rel='stylesheet' href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic">

    <!--[if lt IE 9]>
    <script src="<?php echo e(asset('global/vendor/html5shiv/html5shiv.min.js')); ?>"></script>
    <![endif]-->

    <!--[if lt IE 10]>
    <script src="<?php echo e(asset('global/vendor/media-match/media.match.min.js')); ?>"></script>
    <script src="<?php echo e(asset('global/vendor/respond/respond.min.js')); ?>"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="<?php echo e(asset('global/vendor/breakpoints/breakpoints.js')); ?>"></script>
    <script>
        Breakpoints();
    </script>
    <style>
        .custom-hidden {
            display: none;
        }
        .modal-open .select2-container {
            z-index: 0 ! important;
        }
    </style>
</head>
<body class="animsition"><?php /**PATH /home/qazaq/public_html/admin.qazaq.taxi/ms-v3/resources/views/taxicompany/element/header.blade.php ENDPATH**/ ?>