<section class="content">

  <div class="box box-info">
           <div class="box-header with-border">
             <h3 class="box-title">Düzəlişlər etmək Formu</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form class="form-horizontal" action="<?php echo base_url('manage/edit'); ?>" method="post">
             <div class="box-body">
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Site Title</label>
                 <div class="col-sm-10">
                   <input type="text" name="siteTitle" value="<?php echo $info['siteTitle'] ?>" class="form-control">
                   <input type="hidden" name="Id" value="<?php echo $info['Id']; ?>">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Site Url</label>

                 <div class="col-sm-10">
             <input type="text" name="siteUrl" value="<?php echo $info['siteUrl'] ?>" class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Site Desc</label>

                 <div class="col-sm-10">
             <input type="text" name="siteDesc" value="<?php echo $info['siteDesc'] ?>" class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Site Mail</label>

                 <div class="col-sm-10">
             <input type="text" name="siteMail" value="<?php echo $info['siteMail'] ?>" class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Site Keyw</label>

                 <div class="col-sm-10">
             <input type="text" name="siteKeyw" value="<?php echo $info['siteKeyw'] ?>" class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Site Info</label>

                 <div class="col-sm-10">
             <input type="text" name="siteInfo" value="<?php echo $info['siteInfo'] ?>" class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Site Phone</label>

                 <div class="col-sm-10">
             <input type="text" name="sitePhone" value="<?php echo $info['sitePhone'] ?>" class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Site Adress</label>

                 <div class="col-sm-10">
                   <textarea name="name" id="editor1"  rows="8" cols="80"><?php echo $info['siteAdress'] ?></textarea>
                 </div>
               </div>
             </div>
             <!-- /.box-body -->
             <div class="box-footer">
               <a href="<?php echo base_url('manage/generalsettings'); ?>" type="submit" class="btn btn-warning">Cancel</a>
               <button type="submit" class="btn btn-info pull-right">Sign in</button>
             </div>
             <!-- /.box-footer -->
           </form>
         </div>
         <!-- /.box -->

</section>
