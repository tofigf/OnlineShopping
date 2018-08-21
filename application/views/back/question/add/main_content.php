<section class="content">

  <div class="box box-info">
           <div class="box-header with-border">
                <?php echo $this->session->flashdata('condition'); ?>
             <h3 class="box-title">Ən çox verilən suallar</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form class="form-horizontal" action="<?php echo base_url('manage/questionAdding'); ?>" method="post">
             <div class="box-body">
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Basliq</label>
                 <div class="col-sm-10">
                   <input type="text" name="title"  class="form-control">
                 </div>
               </div>
               <div class="form-group">
                 <label for="inputPassword3" class="col-sm-2 control-label">Açıqlama</label>

                 <div class="col-sm-10">
                   <textarea name="description" id="editor1"  rows="8" cols="80"></textarea>
                 </div>
               </div>

            </div>
             <!-- /.box-body -->
             <div class="box-footer">
               <a href="<?php echo base_url('manage/frequentlyAskedQuestions'); ?>" type="submit" class="btn btn-warning">Cancel</a>
               <button type="submit" class="btn btn-info pull-right">Sign in</button>
             </div>
             <!-- /.box-footer -->
           </form>
         </div>
         <!-- /.box -->

</section>
