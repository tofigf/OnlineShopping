<section class="content">

  <div class="box box-info">
           <div class="box-header with-border">
                <?php echo $this->session->flashdata('condition'); ?>
             <h3 class="box-title">Bank Düzəliş etmək Formu</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form class="form-horizontal" action="<?php echo base_url('manage/bankediting'); ?>" method="post" enctype="multipart/form-data">
             <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">Bank Adi</label>
               <div class="col-sm-4">
                 <input type="text" name="title"  class="form-control" value="<?php echo $info['title']; ?>" required  placeholder="Bank adi">
                             <input type="hidden" name="Id" value="<?php echo $info['Id']; ?>">
                            <input type="hidden" name="status" value="<?php echo $info['status']; ?>">
               </div>
             </div>
             <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">Flial Adi</label>
               <div class="col-sm-4">
                 <input type="text" name="flial" value="<?php echo $info['flial']; ?>"  class="form-control" required  placeholder="Flial adi">
               </div>
             </div>
             <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">İban No</label>
               <div class="col-sm-4">
                 <input type="text" name="iban"  class="form-control" value="<?php echo $info['iban']; ?>" required  placeholder="Bank iban nömrəsi">
               </div>
             </div>
             <div class="form-group">
               <label for="inputEmail3" class="col-sm-2 control-label">Hesab No</label>
               <div class="col-sm-4">
                 <input type="text" name="hesabno" value="<?php echo $info['hesabno']; ?>"  class="form-control" required  placeholder="Hesab No">
               </div>
             </div>
             <div class="form-group">
               <label for="inputPassword3" class="col-sm-2 control-label">Şəkil</label>

               <div class="col-sm-4">
                 <input  name="img"  type="file" class="form-control">
               </div>
             </div>
             <div class="form-group">
               <label for="inputPassword3" class="col-sm-2 control-label">Şəkil</label>

               <div class="col-sm-4">
              <img src="<?php echo base_url(); echo $info['mini']; ?>">
               </div>

             </div>
                <p class="text-aqua">Dəyişdirməyəcəsiniz şəkil yükləməyin..</p>
           </div>
             <!-- /.box-body -->
             <div class="box-footer">
               <a href="<?php echo base_url('manage/cargoLists'); ?>" type="submit" class="btn btn-warning">Cancel</a>
               <button type="submit" class="btn btn-info pull-right">Edit</button>
             </div>
             <!-- /.box-footer -->
           </form>
         </div>
         <!-- /.box -->

</section>
