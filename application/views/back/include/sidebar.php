 <?php $info = $this->session->userdata('info') ?>

<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url('assets/back/'); ?>dist/img/user1-128x128.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Admin</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Son Giriş Tarixi
          <br> <?php echo $info->LastLog; ?> </a>
      </div>
    </div>
<br>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header text-center" style="color:#fff">IdarəEtmə Paneli</li>
      <li><a href="<?php echo base_url('manage'); ?>"><i class="fa fa-dashboard"></i> <span>Ana Səhifə</span></a></li>


      <li class="treeview">
        <a href="#">
          <i class="fa fa-cogs"></i>
          <span>Ümumi Ayarlar</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url('manage/generalSettings') ?>"><i class="fa fa-circle-o"></i> Site Ayarlar</a></li>

        </ul>
      </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-truck"></i>
                <span>Cargo isleri</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('manage/cargolists') ?>"><i class="fa fa-circle-o"></i> Kargo Listesi</a></li>
                  <li><a href="<?php echo base_url('manage/cargodesi') ?>"><i class="fa fa-circle-o"></i> Kargo Desi</a></li>

              </ul>
            </li>


                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-user"></i>
                            <span>Üzvlər</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('manage/users') ?>"><i class="fa fa-circle-o"></i> Üzv Listesi</a></li>

                          </ul>
                        </li>



                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-university"></i>
                            <span>Bank isleri</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('manage/banklists') ?>"><i class="fa fa-circle-o"></i> Bank Listesi</a></li>

                          </ul>
                        </li>



                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Sifarişlər</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('manage/comingorder') ?>"><i class="fa fa-circle-o"></i> Gələn Sifarişlər</a></li>
                            <li><a href="<?php echo base_url('manage/sendingorder') ?>"><i class="fa fa-circle-o"></i>Göndərilən Sifarişlər</a></li>
                          </ul>
                        </li>




                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-recycle"></i>
                            <span>Tələblər</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('manage/changerequest') ?>"><i class="fa fa-circle-o"></i> Dəyişilik tələbləri</a></li>
                              <li><a href="<?php echo base_url('manage/cancelrequest') ?>"><i class="fa fa-circle-o"></i> Ləğv Tələbləri</a></li>

                          </ul>
                        </li>


                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-diamond"></i>
                            <span>Məhsullar</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('manage/products') ?>"><i class="fa fa-circle-o"></i> Məhsul Listi</a></li>

                          </ul>
                        </li>

                        <li class="treeview">
                          <a href="#">
                            <i class="fa fa-cubes"></i>
                            <span>Ümumi İşlər</span>
                            <span class="pull-right-container">
                              <i class="fa fa-angle-left pull-right"></i>
                            </span>
                          </a>
                          <ul class="treeview-menu">
                            <li><a href="<?php echo base_url('manage/secretcontract') ?>"><i class="fa fa-circle-o"></i>Gizli Sözdələşmə</a></li>
                            <li><a href="<?php echo base_url('manage/salescontract') ?>"><i class="fa fa-circle-o"></i>Satış Sözdələşmə</a></li>
                            <li><a href="<?php echo base_url('manage/frequentlyaskedquestions') ?>"><i class="fa fa-circle-o"></i>Ən çox verilən suallar</a></li>
                            <li><a href="<?php echo base_url('manage/Warrantyreturn') ?>"><i class="fa fa-circle-o"></i>Zəmanət və qaytarılma</a></li>
                            <li><a href="<?php echo base_url('manage/smedia') ?>"><i class="fa fa-circle-o"></i>Sosial Media</a></li>


                          </ul>
                        </li>

                                                <li class="treeview">
                                                  <a href="#">
                                                    <i class="fa fa-envelope"></i>
                                                    <span>Məhsullar</span>
                                                    <span class="pull-right-container">
                                                      <i class="fa fa-angle-left pull-right"></i>
                                                    </span>
                                                  </a>
                                                  <ul class="treeview-menu">
                                                    <li><a href="<?php echo base_url('manage/messages') ?>"><i class="fa fa-circle-o"></i> Mesajlar</a></li>

                                                  </ul>
                                                </li>



                                          <li class="treeview">
                                        <a href="#">
                                        <i class="fa fa-comments-o"></i>
                                        <span>Şərhlər</span>
                                          <span class="pull-right-container">
                                          <i class="fa fa-angle-left pull-right"></i>
                                              </span>
                                                </a>
                                                <ul class="treeview-menu">
                                          <li><a href="<?php echo base_url('manage/comments') ?>"><i class="fa fa-circle-o"></i> Şərh Listi</a></li>

                                            </ul>
                                          </li>













      <li>
        <a href="<?php echo base_url(); ?>" target="_blank">
          <i class="fa fa-external-link"></i> <span>Saytla Giriş</span>
        </a>
      </li>

      <li class="header">Islemler</li>
      <li><a href="<?php echo base_url('manage/logout'); ?>"><i class="fa fa-circle-o text-red"></i>

        <span><button class="btn btn-warning " type="button">Cixis</button></span></a></li>
      <li><a href="<?php echo base_url('manage/deletework'); ?>">
        <?php if($this->session->userdata('delete')){  ?>
        <i class="fa fa-circle-o text-success"></i>
        <span><button type="button" class="btn btn-success">Silme funksiyasi aciqdir</button>
         <?php } else{?>
    <i class="fa fa-circle-o text-danger"></i> <span><button type="button" class="btn btn-danger">Silme funksiyasi baglidir</button>
<?php } ?>
        </span></a></li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
