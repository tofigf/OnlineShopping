products
<!DOCTYPE html>
<html>

 <?php $this->load->view('back/include/head'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view('back/include/header'); ?>
<?php $this->load->view('back/include/sidebar'); ?>
  <div class="content-wrapper">
<?php $this->load->view('back/products/add/breadcrumb'); ?>
  <?php $this->load->view('back/products/add/main_content'); ?>
  </div>
  <?php $this->load->view('back/include/footer'); ?>
</div>
<?php $this->load->view('back/include/script'); ?>
</body>
</html>
