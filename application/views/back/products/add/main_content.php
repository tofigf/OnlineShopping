<section class="content">

  <div class="box box-info">
           <div class="box-header with-border">
                <?php echo $this->session->flashdata('condition'); ?>
             <h3 class="box-title">Məhsul Əlavə etmək Formu</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form class="form-horizontal" action="<?php echo base_url('manage/productadding'); ?>" method="post" enctype="multipart/form-data">
             <div class="box-body">
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Məhsul</label>
                 <div class="col-sm-3">
                   <input type="text" name="title"  class="form-control">
                 </div>
                   <label for="inputEmail3" class="col-sm-2 control-label">Kateqoriya</label>
                   <div class="col-sm-3">

                    <select class="form-control" name="catId">
                  <?php $categories = categoriCheck(); foreach ($categories as $category) {?>
                    <option value="<?php echo $category['Id']; ?>"><?php echo $category['type']; ?></option>
                  <?php } ?>
                    </select>
                   </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Qiymət</label>
                 <div class="col-sm-3">
                   <input type="text" name="price"  class="form-control">
                 </div>
                   <label for="inputEmail3" class="col-sm-2 control-label">Tarix</label>
                   <div class="col-sm-3">
                     <input type="date" name="date"  class="form-control">
                   </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Şəkil1</label>
                 <div class="col-sm-3">
                     <input  name="img"  type="file" class="form-control">
                 </div>
                   <label for="inputEmail3" class="col-sm-2 control-label">Şəkil2</label>
                   <div class="col-sm-3">
                     <input  name="img2"  type="file" class="form-control">
                   </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Şəkil3</label>
                 <div class="col-sm-3">
                     <input  name="img3"  type="file" class="form-control">
                 </div>
                   <label for="inputEmail3" class="col-sm-2 control-label">Şəkil4</label>
                   <div class="col-sm-3">
                     <input  name="img4"  type="file" class="form-control">
                   </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Məlumat</label>
                 <div class="col-sm-10">
                   <textarea name="info" id="editor1" rows="8" cols="80"></textarea>
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Açıqlama</label>
                 <div class="col-sm-10">
                   <textarea name="description" id="editor2" rows="8" cols="80"></textarea>
                 </div>
               </div>
             <!-- /.box-body -->
             <div class="box-footer">
               <a href="<?php echo base_url('manage/products'); ?>" type="submit" class="btn btn-warning">Cancel</a>
               <button type="submit" class="btn btn-info pull-right">Əlavə et</button>
             </div>
             <!-- /.box-footer -->
           </form>
         </div>
         <!-- /.box -->

</section>
