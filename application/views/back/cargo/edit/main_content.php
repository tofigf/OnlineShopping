<section class="content">

  <div class="box box-info">
           <div class="box-header with-border">
                <?php echo $this->session->flashdata('condition'); ?>
             <h3 class="box-title">Kargo Əlavə etmək Formu</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form class="form-horizontal" action="<?php echo base_url('manage/cargoediting'); ?>" method="post" enctype="multipart/form-data">
             <div class="box-body">
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Kargo Basliq</label>
                 <div class="col-sm-10">
                   <input type="text" name="title" value="<?php echo $info['title']; ?>"  class="form-control">
                   <input type="hidden" name="Id" value="<?php echo $info['Id']; ?>">
                    <input type="hidden" name="status" value="<?php echo $info['status']; ?>">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Şəkil</label>

                 <div class="col-sm-10">
             <input  name="img"  type="file" class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Movcud Şəkil</label>

                 <div class="col-sm-10">
          <img src="<?php echo base_url(); echo $info['mini']; ?>" alt="">
          <p class="text-aqua">Dəyişdirməyəksinisə şəkil seçməyin</p>
                 </div>
               </div>
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
