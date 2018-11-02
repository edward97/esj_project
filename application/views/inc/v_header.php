<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title?> .:</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha256-eSi1q2PG6J7g7ib17yAaWMcrr5GrtohYChqibrV7PBE=" crossorigin="anonymous" />

    <!-- Bootstrap CSS DataTables 4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap4.min.css" integrity="sha256-F+DaKAClQut87heMIC6oThARMuWne8+WzxIDT7jXuPA=" crossorigin="anonymous" />

    <!-- jQuery UI-CSS 1.12 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha256-rByPlHULObEjJ6XQxW/flG2r+22R5dKiAoef+aXWfik=" crossorigin="anonymous" />

    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous" />

    <!-- Malihu custom scrollbar plugin CSS -->
    <link rel="stylesheet" href="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?=base_url('assets/css/custom.css')?>" />
    <link rel="stylesheet" href="<?=base_url('assets/css/custom-themes.css')?>" />
    <link rel="shortcut icon" type="image/png" href="<?=base_url('assets/img/favicon.png')?>" />
</head>

<body>
    <!-- page-wrapper -->
    <div class="page-wrapper <?=$this->session->userdata('ses_color')?> <?=$this->session->userdata('ses_status')?> <?=$this->session->userdata('ses_bg')?> toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark" href="javascript:;">
            <i class="fas fa-bars"></i>
        </a>

        <!-- sidebar-wrapper -->
        <nav id="sidebar" class="sidebar-wrapper">
            <!-- sidebar-content -->
            <div class="sidebar-content">
                <!-- sidebar-brand -->
                <div class="sidebar-brand">
                    <a href="javascript:;">beta project v1.0</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
                <!-- end sidebar-brand -->

                <!-- sidebar-header -->
                <div class="sidebar-header">
                    <div class="user-pic">
                        <img class="img-responsive img-rounded" src="<?=base_url('/assets/img/user.jpg')?>" alt="Picture">
                    </div>
                    <div class="user-info">
                        <span class="user-name"><?=$this->session->userdata('ses_nm')?></span>
                        <span class="user-role">Administrator</span>

                        <span class="user-status">
                            <i class="fas fa-circle"></i>
                            <span>Online</span>
                        </span>
                    </div>
                </div>
                <!-- end sidebar-header -->

                <!-- sidebar-search -->
                <div class="sidebar-search">
                    <div class="input-group">
                        <input type="text" class="form-control search-menu" placeholder="Search...">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <!-- end sidebar-search -->

                <!-- sidebar-menu -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            <span>General</span>
                        </li>
                        <li>
                            <a href="<?=site_url('dashboard')?>" <?=at_link('dashboard')?>>
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-dropdown">
                            <a href="javascript:;">
                                <i class="fas fa-cogs"></i>
                                <span>Setup</span>
                                <span class="badge badge-pill badge-danger">New</span>
                            </a>
                            <div class="sidebar-submenu">
                                <ul>
                                    <li>
                                        <a href="<?=site_url('setup/divisi')?>" <?=at_link('setup/divisi')?>>Divisi</a>
                                    </li>
                                    <li>
                                        <a href="<?=site_url('setup/supplier')?>" <?=at_link('setup/supplier')?>>Supplier</a>
                                    </li>
                                    <li>
                                        <a href="<?=site_url('setup/user')?>" <?=at_link('setup/user')?>>User
                                            <span class="badge badge-pill badge-success">Pro</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Warehouse</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                      
                        <li class="header-menu">
                            <span>Extra</span>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fas fa-folder"></i>
                                <span>Examples</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">
                                <i class="fas fa-book"></i>
                                <span>Documentation</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?=site_url('database')?>" <?=at_link('database')?>>
                                <i class="fas fa-database"></i>
                                <span>Database</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- end sidebar-menu -->
            </div>
            <!-- end sidebar-content -->

            <!-- sidebar-footer -->
            <div class="sidebar-footer">
                <div class="dropdown">
                    <a href="javascript:;" class="" id="dropdownMenuNotification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge badge-pill badge-warning notification">3</span>
                    </a>
                    <div class="dropdown-menu notifications" aria-labelledby="dropdownMenuMessage">
                        <div class="notifications-header">
                            <i class="fas fa-bell"></i>
                            Notifications
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="notification-content">
                                <div class="icon">
                                    <i class="fas fa-check text-success border border-success"></i>
                                </div>
                                <div class="content">
                                    <div class="notification-detail">Lorem ipsum dolor sit amet consectetur adipisicing elit. In totam explicabo</div>
                                    <div class="notification-time">
                                        6 minutes ago
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="notification-content">
                                <div class="icon">
                                    <i class="fas fa-exclamation text-info border border-info"></i>
                                </div>
                                <div class="content">
                                    <div class="notification-detail">Lorem ipsum dolor sit amet consectetur adipisicing elit. In totam explicabo</div>
                                    <div class="notification-time">
                                        Today
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="notification-content">
                                <div class="icon">
                                    <i class="fas fa-exclamation-triangle text-warning border border-warning"></i>
                                </div>
                                <div class="content">
                                    <div class="notification-detail">Lorem ipsum dolor sit amet consectetur adipisicing elit. In totam explicabo</div>
                                    <div class="notification-time">
                                        Yesterday
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-center" href="javascript:;">View all notifications</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="javascript:;" class="" id="dropdownMenuMessage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-envelope"></i>
                        <span class="badge badge-pill badge-success notification">7</span>
                    </a>
                    <div class="dropdown-menu messages" aria-labelledby="dropdownMenuMessage">
                        <div class="messages-header">
                            <i class="fas fa-envelope"></i>
                            Messages
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="message-content">
                                <div class="pic">
                                    <img src="<?=base_url('assets/img/user.jpg')?>" alt="">
                                </div>
                                <div class="content">
                                    <div class="message-title">
                                        <strong> Jhon doe</strong>
                                    </div>
                                    <div class="message-detail">Lorem ipsum dolor sit amet consectetur adipisicing elit. In totam explicabo</div>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="message-content">
                                <div class="pic">
                                    <img src="<?=base_url('assets/img/user.jpg')?>" alt="">
                                </div>
                                <div class="content">
                                    <div class="message-title">
                                        <strong> Jhon doe</strong>
                                    </div>
                                    <div class="message-detail">Lorem ipsum dolor sit amet consectetur adipisicing elit. In totam explicabo</div>
                                </div>
                            </div>
                        </a>
                        <a class="dropdown-item" href="javascript:;">
                            <div class="message-content">
                                <div class="pic">
                                    <img src="<?=base_url('assets/img/user.jpg')?>" alt="">
                                </div>
                                <div class="content">
                                    <div class="message-title">
                                        <strong> Jhon doe</strong>
                                    </div>
                                    <div class="message-detail">Lorem ipsum dolor sit amet consectetur adipisicing elit. In totam explicabo</div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-center" href="javascript:;">View all messages</a>
                    </div>
                </div>
                <div class="dropdown">
                    <a href="javascript:;" class="" id="dropdownMenuMessage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                        <span class="badge-sonar"></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuMessage">
                        <a class="dropdown-item" href="javascript:;">My profile</a>
                        <a class="dropdown-item" href="javascript:;">Help</a>
                        <a class="dropdown-item" href="javascript:;">Setting</a>
                    </div>
                </div>
                <div>
                    <a href="javascript:;" id="sign-out">
                        <i class="fas fa-power-off"></i>
                    </a>
                </div>
            </div>
            <!-- end sidebar-footer -->
        </nav>
        <!-- end sidebar-wrapper -->
        