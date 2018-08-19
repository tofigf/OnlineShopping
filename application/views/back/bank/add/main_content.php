<section class="content">

  <div class="box box-info">
           <div class="box-header with-border">
                <?php echo $this->session->flashdata('condition'); ?>
             <h3 class="box-title">Bank Əlavə etmək Formu</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form class="form-horizontal" action="<?php echo base_url('manage/bankAdding'); ?>" method="post" enctype="multipart/form-data">
             <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">Bank Adi</label>
               <div class="col-sm-4">
                 <input type="text" name="title"  class="form-control" required  placeholder="Bank adi">
               </div>
             </div>
             <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">Flial Adi</label>
               <div class="col-sm-4">
                 <input type="text" name="flial"  class="form-control" required  placeholder="Flial adi">
               </div>
             </div>
             <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">İban No</label>
               <div class="col-sm-4">
                 <input type="text" name="iban"  class="form-control" required  placeholder="Bank iban nömrəsi">
               </div>
             </div>
             <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">Hesab No</label>
               <div class="col-sm-4">
                 <input type="text" name="hesabno"  class="form-control" required  placeholder="Hesab No">
               </div>
             </div>
             <div class="form-group">
               <label for="inputPassword3" class="col-sm-2 control-label">Şəkil</label>

               <div class="col-sm-4">
                 <input  name="img"  type="file" class="form-control">
               </div>
             </div>
           </div>
             <div class="box-body">
             <!-- /.box-body -->
             <div class="box-footer">
               <a href="<?php echo base_url('manage/bank'); ?>" type="submit" class="btn btn-warning">Cancel</a>
               <button type="submit" class="btn btn-info pull-right">Əlavə Et</button>
             </div>
             <!-- /.box-footer -->
           </form>
         </div>
         <!-- /.box -->

</section>
