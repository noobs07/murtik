<!DOCTYPE html>
<html>
<audio id="chatAudio">
  <source src="<?= base_url('assets')?>/sound/good-morning.mp3" type="audio/mpeg">
  <source src="<?= base_url('assets')?>/sound/good-morning.ogg" type="audio/mpeg">
 </audio>
    <head>
        <title>Dashboard | Admin Murah Tiketnya</title>
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
        <link rel="stylesheet" media="screen" href="<?= base_url('assets')?>/css/jquery.popdown.css">
 
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="<?= base_url('assets')?>/js/html5shiv.js"></script>
           <script type="text/javascript" src="<?= base_url('assets')?>/js/respond.min.js"></script>
        <![endif]-->
    <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  /*z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 30%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
</style>
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
                                    <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> <?php echo "$nama"?> <i class="caret"></i></a>
                                    <ul class="dropdown-menu">
<!--                                    <li><a href="#">Action</a></li>
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
<!-- Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h4>Notifikasi</h4>
    </div>
    <div class="modal-body">
      <div id="text"></div>
    </div>
    <!--div class="modal-footer">
      <h3>Modal Footer</h3>
    </div-->
  </div>

</div>
<!-- end of modal-->
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
                    <a href="#"><i class="glyphicon glyphicon-chevron-down"></i> Transaksi</a>
                    <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                        <li <?= (!empty($pages) && $pages=='all_trx'? 'class="active"':'')?>><a href="<?= base_url('all_trx')?>"><i class="glyphicon glyphicon-chevron-right"></i> Pesawat <span class="label label-primary " id="jumlah"></span></a></li>
                        <li <?= (!empty($pages) && $pages=='all_trx_kai'? 'class="active"':'')?>><a href="<?= base_url('all_trx_kai')?>"><i class="glyphicon glyphicon-chevron-right"></i> Kereta <span class="label label-primary " id="jumlah_kai"></span></a></li>
                        <li <?= (!empty($pages) && $pages=='all_trx_pelni'? 'class="active"':'')?>><a href="<?= base_url('all_trx_pelni')?>"><i class="glyphicon glyphicon-chevron-right"></i> PELNI <span class="label label-primary " id="jumlah_pelni"></span></a></li>
                        <li <?= (!empty($pages) && $pages=='all_trx_hotel'? 'class="active"':'')?>><a href="<?= base_url('all_trx_hotel')?>"><i class="glyphicon glyphicon-chevron-right"></i> Hotel <span class="label label-primary " id="jumlah_hotel"></span></a></li>
                        <li <?= (!empty($pages) && $pages=='cancelled_trx'? 'class="active"':'')?>><a href="<?= base_url('cancelled_trx')?>"><i class="glyphicon glyphicon-chevron-right"></i> Tiket Batal</a></li>
                    </ul>
                </li>
                <li>
                <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                        <li <?= (!empty($pages) && $pages=='confirmasi_bayar'? 'class="active"':'')?>>
                            <a href="<?= base_url('konfirmasi_bayar')?>"><i class="glyphicon glyphicon-chevron-right"></i> Konfirmasi Pembayaran<span class="label label-primary " id="jumlah_konfirmasi"></span></a>
                        </li>
                </ul>
                </li>

                     <!--manajemen user-->
                <li>
                <a href="#"><i class="glyphicon glyphicon-chevron-down"></i> Manage Admin</a>
                <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                    <li <?= (!empty($pages) && $pages=='alladmin'? 'class="active"':'')?>>
                        <a href="<?= base_url('alladmin') ?>"><i class="glyphicon glyphicon-chevron-right"></i>
                        All Admin </a>
                    </li>
                </ul>
                </li> 

                <li>
                
               <li <?= (!empty($pages) && $pages=='promo'? 'class=""':'')?>>
                    <a href="<?= base_url('promo') ?>"><i class="glyphicon glyphicon-chevron-down"></i> Promo</a>
                    <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                        <li <?= (!empty($pages) && $pages=='promo'? 'class="active"':'')?>>
                            <a href="<?= base_url('promo')?>"><i class="glyphicon glyphicon-chevron-right"></i> List Promo</a>
                        </li>
                        <li <?= (!empty($pages) && $pages=='diskon'? 'class="active"':'')?>>
                            <a href="<?= base_url('diskon')?>"><i class="glyphicon glyphicon-chevron-right"></i> List Diskon</a>
                        </li>
                        </ul>
                </li>

            </ul>
        </div>
        