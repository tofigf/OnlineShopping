<section class="content">

  <div class="box box-info">
           <div class="box-header with-border">
                <?php echo $this->session->flashdata('condition'); ?>
             <h3 class="box-title">Zəmanət və geri qaytarılma</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form class="form-horizontal" action="<?php echo base_url('manage/warrantyEditing'); ?>" method="post">
             <div class="box-body">
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Basliq</label>
                 <div class="col-sm-10">
                   <input type="text" name="title" value="<?php echo $info['title']; ?>"  class="form-control">
                   <input type="hidden" name="Id" value="<?php echo $info['Id']; ?>">
                   <input type="hidden" name="status" value="<?php echo $info['status']; ?>">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Açıqlama</label>

                 <div class="col-sm-10">
                   <textarea name="description" id="editor1"  rows="8" cols="80"><?php echo $info['description']; ?></textarea>
                 </div>
               </div>

            </div>
             <!-- /.box-body -->
             <div class="box-footer">
               <a href="<?php echo base_url('manage/warrantyReturn'); ?>" type="submit" class="btn btn-warning">Cancel</a>
               <button type="submit" class="btn btn-info pull-right">Düzəlt</button>
             </div>
             <!-- /.box-footer -->
           </form>
         </div>
         <!-- /.box -->

</section>
