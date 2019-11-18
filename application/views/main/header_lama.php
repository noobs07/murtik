<!DOCTYPE html>
<html>
    <audio id="chatAudio">
  <source src="<?= base_url('assets')?>/sound/y.mp3" type="audio/mpeg">
 </audio>
    <head>
        <title>Dashboard | Admin Murah Tiektnya</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="<?= base_url('assets')?>/css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="<?= base_url('assets')?>/css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="<?= base_url('assets')?>/css/bootstrap-admin-theme.css">
        <link rel="stylesheet" media="screen" href="<?= base_url('assets')?>/css/bootstrap-admin-theme-change-size.css">

        <!-- Vendors -->
        <link rel="stylesheet" media="screen" href="<?= base_url('assets')?>/vendors/easypiechart/jquery.easy-pie-chart.css">
        <link rel="stylesheet" media="screen" href="<?= base_url('assets')?>/vendors/easypiechart/jquery.easy-pie-chart_custom.css">

        <!-- Pop up -->
        <link rel="stylesheet" href="<?= base_url('assets')?>/css/jquery.popdown.css">



        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="<?= base_url('assets')?>/js/html5shiv.js"></script>
           <script type="text/javascript" src="<?= base_url('assets')?>/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bootstrap-admin-with-small-navbar">
        <!-- small navbar -->
        <nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-left bootstrap-admin-theme-change-size hidden">
                                <li class="text">Change size:</li>
                                <li><a class="size-changer small">Small</a></li>
                                <li><a class="size-changer large active">Large</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <?php if(isset($login_users) && $login_users==true):?>
                                <li class="dropdown">
                                    <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i>  <?php echo "$nama"?> <i class="caret"></i></a>
                                    <ul class="dropdown-menu">
<!--                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                       <li><a href="#">Something else here</a></li>
                                        <li role="presentation" class="divider"></li>-->
                                        <li><a href="<?= base_url('logout')?>">Logout</a></li>
                                    </ul>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- main / large navbar -->
        <nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar bootstrap-admin-navbar-under-small" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="about.html">Admin Panel</a>
                        </div>
                        <div class="collapse navbar-collapse main-navbar-collapse hidden">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#">Link</a></li>
                                <li><a href="#">Link</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-hover="dropdown">Dropdown <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation" class="dropdown-header">Dropdown header</li>
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation" class="dropdown-header">Dropdown header</li>
                                        <li><a href="#">Separated link</a></li>
                                        <li><a href="#">One more separated link</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div>
                </div>
            </div><!-- /.container -->
        </nav>
        
        <div class="container">
    <!-- left, vertical navbar & content -->
    <div class="row">
        <!-- left, vertical navbar -->
        <div class="col-md-2 bootstrap-admin-col-left">
            <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
                
                <li>
                    <a href="#"><i class="glyphicon glyphicon-chevron-down"></i> Transaksi </a>
                    <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                        <li <?= (!empty($pages) && $pages=='home'? 'class="active"':'')?>> 
                            <a href="<?= base_url('new-trx')?>"><i class="glyphicon glyphicon-chevron-right"></i> Transaksi Baru<span class="label label-primary " id="jumlah"></span></a>
                        </li>
                        <li <?= (!empty($pages) && $pages=='confirm_trx'? 'class="active"':'')?>><a href="<?= base_url('confirm-trx')?>"><i class="glyphicon glyphicon-chevron-right"></i> Pembayaran Terkonfirmasi</a></li>
                        <li <?= (!empty($pages) && $pages=='finished_trx'? 'class="active"':'')?>><a href="<?= base_url('finished-trx')?>"><i class="glyphicon glyphicon-chevron-right"></i> Tiket Terkonfirmasi</a></li>
                        <li <?= (!empty($pages) && $pages=='cancelled_trx'? 'class="active"':'')?>><a href="<?= base_url('cancelled-trx')?>"><i class="glyphicon glyphicon-chevron-right"></i> Tiket Batal</a></li>
                        <li <?= (!empty($pages) && $pages=='all_trx'? 'class="active"':'')?>><a href="<?= base_url('all-trx')?>"><i class="glyphicon glyphicon-chevron-right"></i> Semua Transaksi</a></li>
                    </ul>
                    <a href="#"><i class="glyphicon glyphicon-chevron-down"></i> Manage Admin</a>
                <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                    <li <?= (!empty($pages) && $pages=='admin'? 'class="active"':'')?>>
                        <a href="<?= base_url('admin') ?>"><i class="glyphicon glyphicon-chevron-right"></i>
                        Admin </a>
                    </li>
                   </ul>
                </li>
                <li>
                    <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                        <li <?= (!empty($pages) && $pages=='confirmasi_bayar'? 'class="active"':'')?>>
                            <a href="<?= base_url('konfirmasi-bayar')?>"><i class="glyphicon glyphicon-chevron-right"></i> Detil Pembayaran</a>
                        </li>
                </ul>
                </li>                 
            </ul>
        </div>
        
    
        