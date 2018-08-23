<section class="content">

  <div class="box box-info">
           <div class="box-header with-border">
                <?php echo $this->session->flashdata('condition'); ?>
             <h3 class="box-title">Məhsul Dəyişilik etmək Formu</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form class="form-horizontal" action="<?php echo base_url('manage/productediting'); ?>" method="post" enctype="multipart/form-data">
             <div class="box-body">
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Məhsul</label>
                 <div class="col-sm-3">
                   <input type="text" name="title" value="<?php echo $info['title']; ?>" class="form-control">
                   <input type="hidden" name="Id" value="<?php echo $info['Id']; ?>">
                    <input type="hidden" name="status" value="<?php echo $info['status']; ?>">

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
                   <input type="text" name="price" value="<?php echo $info['price']; ?>"  class="form-control">
                 </div>
                   <label for="inputEmail3" class="col-sm-2 control-label">Tarix</label>
                   <div class="col-sm-3">
                     <input type="date" name="date" value="<?php echo $info['date']; ?>"  class="form-control">
                   </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Şəkil1</label>
                 <div class="col-sm-3">
                     <input  name="img"  type="file" class="form-control">
                     <br>
                     <img src="<?php echo base_url(); echo $info['mini']; ?>" >
                     <p class="text-blue">Mövcud olan Şəkil</p>
                     <p class="text-red">Əgər dəyişilik etməycəkisinizsə şəkil seçməyiin!</p>
                 </div>
                   <label for="inputEmail3" class="col-sm-2 control-label">Şəkil2</label>
                   <div class="col-sm-3">
                     <input  name="img2"  type="file" class="form-control">
                     <br>
                     <img src="<?php echo base_url(); echo $info['mini2']; ?>" >
                     <p class="text-blue">Mövcud olan Şəkil</p>
                     <p class="text-red">Əgər dəyişilik etməycəkisinizsə şəkil seçməyiin!</p>
                   </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Şəkil3</label>
                 <div class="col-sm-3">
                     <input  name="img3"  type="file" class="form-control">
                     <br>
                     <img src="<?php echo base_url(); echo $info['mini3']; ?>" >
                     <p class="text-blue">Mövcud olan Şəkil</p>
                     <p class="text-red">Əgər dəyişilik etməycəkisinizsə şəkil seçməyiin!</p>
                 </div>
                   <label for="inputEmail3" class="col-sm-2 control-label">Şəkil4</label>
                   <div class="col-sm-3">
                     <input  name="img4"  type="file" class="form-control">
                     <br>
                     <img src="<?php echo base_url(); echo $info['mini4']; ?>" >
                     <p class="text-blue">Mövcud olan Şəkil</p>
                     <p class="text-red">Əgər dəyişilik etməycəkisinizsə şəkil seçməyiin!</p>
                   </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Məlumat</label>
                 <div class="col-sm-10">
                   <textarea name="info" id="editor1" rows="8" cols="80"><?php echo $info['info']; ?></textarea>
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Açıqlama</label>
                 <div class="col-sm-10">
                   <textarea name="description" id="editor2" rows="8" cols="80"><?php echo $info['description']; ?></textarea>
                 </div>
               </div>
             <!-- /.box-body -->
             <div class="box-footer">
               <a href="<?php echo base_url('manage/products'); ?>" type="submit" class="btn btn-warning">Cancel</a>
               <button type="submit" class="btn btn-info pull-right">Dəyişdir</button>
             </div>
             <!-- /.box-footer -->
           </form>
         </div>
         <!-- /.box -->

</section>
