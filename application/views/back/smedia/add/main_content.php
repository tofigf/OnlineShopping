<section class="content">

  <div class="box box-info">
           <div class="box-header with-border">
                <?php echo $this->session->flashdata('condition'); ?>
             <h3 class="box-title">Sosial Şəbəkə Əlavə etmək Formu</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form class="form-horizontal" action="<?php echo base_url('manage/smediaAdding'); ?>" method="post">
             <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">İstifadəçi Adı</label>
               <div class="col-sm-4">
                 <input type="text" name="title"  class="form-control" required  placeholder="Sosial Şəbəkə adi">
               </div>
             </div>
             <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">İstifadəçi linki</label>
               <div class="col-sm-4">
                 <input type="text" name="url"  class="form-control" required  placeholder="İstifadəçi linki">
               </div>
             </div>
           </div>
             <div class="box-body">
             <!-- /.box-body -->
             <div class="box-footer">
               <a href="<?php echo base_url('manage/smedia'); ?>" type="submit" class="btn btn-warning">Cancel</a>
               <button type="submit" class="btn btn-info pull-right">Əlavə Et</button>
             </div>
             <!-- /.box-footer -->
           </form>
         </div>
         <!-- /.box -->

</section>
