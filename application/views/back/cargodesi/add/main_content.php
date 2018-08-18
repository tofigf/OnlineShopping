<section class="content">

  <div class="box box-info">
           <div class="box-header with-border">
                <?php echo $this->session->flashdata('condition'); ?>
             <h3 class="box-title">Kargo Əlavə etmək Formu</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form class="form-horizontal" action="<?php echo base_url('manage/cargodesiAdding'); ?>" method="post" enctype="multipart/form-data">
             <div class="box-body">
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Kargo Basliq</label>
                 <div class="col-sm-4">
                <select class="form-control" name="cargoId">
                  <?php $info =cargoDesiCheck(); foreach ($info as $info) { ?>
                  <option value="<?php echo $info['Id']; ?>"><?php echo $info['title']; ?></option>
                <?php } ?>
                </select>
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Tutar</label>
                 <div class="col-sm-4">
             <input  name="tutar" type="text" class="form-control">
                 </div>
               </div>
            </div>
             <!-- /.box-body -->
             <div class="box-footer">
               <a href="<?php echo base_url('manage/cargodesi'); ?>" type="submit" class="btn btn-warning">Cancel</a>
               <button type="submit" class="btn btn-info pull-right">Sign in</button>
             </div>
             <!-- /.box-footer -->
           </form>
         </div>
         <!-- /.box -->

</section>
