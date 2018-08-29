<section class="content">

  <div class="box box-info">
           <div class="box-header with-border">
                <?php echo $this->session->flashdata('condition'); ?>
             <h3 class="box-title">Mesaj Oxuma etmək Formu</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form class="form-horizontal">
             <div class="box-body">
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Mesaj Göndərən</label>
                 <div class="col-sm-10">
                   <input type="text" disabled  value="<?php echo $info['name']; ?>"  class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">E-poçt</label>
                 <div class="col-sm-10">
                   <input type="text" disabled  value="<?php echo $info['email']; ?>"  class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">İp Adresi</label>
                 <div class="col-sm-10">
                   <input type="text" disabled  value="<?php echo $info['ip']; ?>"  class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Tarix</label>
                 <div class="col-sm-10">
                   <input type="text" disabled  value="<?php echo $info['date']; ?>"  class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Mövzu</label>
                 <div class="col-sm-10">
                   <input type="text" disabled  value="<?php echo $info['topic']; ?>"  class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Mesaj</label>
                 <div class="col-sm-10">
                   <textarea  class="form-control" disabled rows="8" cols="80"><?php echo $info['message']; ?></textarea>
                 </div>
               </div>
            </div>
             <!-- /.box-body -->
             <div class="box-footer">
               <a href="<?php echo base_url('manage/messages'); ?>" type="submit" class="btn btn-info">Geri Dön</a>
             </div>
             <!-- /.box-footer -->
           </form>
         </div>
         <!-- /.box -->

</section>
