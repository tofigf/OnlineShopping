messages
<!DOCTYPE html>
<html>

 <?php $this->load->view('back/include/head'); ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view('back/include/header'); ?>
<?php $this->load->view('back/include/sidebar'); ?>
  <div class="content-wrapper">
<?php $this->load->view('back/messages/edit/breadcrumb'); ?>
  <?php $this->load->view('back/messages/edit/main_content'); ?>
  </div>
  <?php $this->load->view('back/include/footer'); ?>
</div>
<?php $this->load->view('back/include/script'); ?>
</body>
</html>
