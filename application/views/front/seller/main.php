<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]>
<html dir="ltr" lang="en" class="ie8"><![endif]-->
<!--[if IE 9 ]>
<html dir="ltr" lang="en" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="ltr" lang="tr">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>UDEMY | Başlık</title>
<meta property="og:url"           content="başlık" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="UDEMY | başlık" />
<meta property="og:description"   content="Codeigniter ile E-ticaret Eğitim Serisi" />
<meta property="og:image"         content="logo bu alana gelecek" />
<meta name="description" content="Codeigniter ile E-ticaret Eğitim Serisi" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="assets/front/image/favicon.ico" rel="icon" />
<?php $this->load->view('front/include/style'); ?>
</head>
<body class="common-home">
<?php $this->load->view('front/include/mobile'); ?>
<div id="page">
<div class="shadow"></div>
<div class="toprow-1">
<a class="swipe-control" href="#"><i class="fa fa-align-justify"></i></a>
</div>
<?php
$this->load->view('front/include/header');
$this->load->view('front/include/mobil_cat');
 ?>
<div class="header_modules"></div>
<div id="container">
<div class="container">
<div class="row">
<aside id="column-left" class="col-sm-3 ">
  <?php
$this->load->view('front/include/categories');
$this->load->view('front/include/users');
$this->load->view('front/include/specials');
$this->load->view('front/include/bestseller');
   ?>
</aside>
<div id="content" class="col-sm-9">
  <?php
$this->load->view('front/seller/breadcrumb');
$this->load->view('front/seller/main_content');
   ?>
</div>
</div>
</div>
</div>
<?php $this->load->view('front/include/footer'); ?>
</div>
<?php $this->load->view('front/include/script'); ?>
</body>
</html>
