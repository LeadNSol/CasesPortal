<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Education </title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url(); ?>css/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url(); ?>css/green.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url(); ?>css/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url(); ?>css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">

    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url(); ?>css/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url(); ?>css/custom.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>css/ubk_style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/carousel_style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>js/jquery.min.js" rel="stylesheet">
    <link href="<?php echo base_url(); ?>js/office.js" rel="stylesheet">
    <!-- datepicker flatpickr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/flatpickr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.2.3/themes/dark.css">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="javascript:void(0);" class="site_title"><i class="fa fa-home"></i>
                        <span>DASHBOARD</span></a>
                </div>
                <div class="clearfix"></div>
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3></h3>
                        <ul class="nav side-menu">
                            <li>
                                <a href="<?php echo base_url(); ?>go_home">
                                    <i class="fa fa-home" aria-hidden="true"></i> Home
                                </a>
                            </li>
                            <li class="">
                                <a>
                                    <i class="fa fa-certificate" aria-hidden="true"></i>Manage Cases<span
                                            class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu" style="display: none;">
                                    <li>
                                        <a href="<?php echo base_url(); ?>add_case">Add New Case</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>add_new">New Case</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>add_case_hearing">Add Case Hearing</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url(); ?>load_case_images_view">Add Case Files (Images)</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url() ?>go_home">List of Cases</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a>
                                    <i class="fa fa-product-hunt" aria-hidden="true"></i>Property Details<span
                                            class="fa fa-chevron-down"></span>
                                </a>
                                <ul class="nav child_menu" style="display: none;">
                                    <li>
                                        <a href="<?php echo base_url(); ?>add_hiba_nama">Add Hiba Nama</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url() ?>list_hiba_nama">List of Hiba Nama's</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url() ?>list_hiba_nama">Properties</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                </div>
                <!-- /sidebar menu -->
            </div>
        </div>
