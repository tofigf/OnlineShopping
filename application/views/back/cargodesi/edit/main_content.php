<section class="content">

  <div class="box box-info">
           <div class="box-header with-border">
                <?php echo $this->session->flashdata('condition'); ?>
             <h3 class="box-title">Kargo Desi Deyisilik etmək Formu</h3>
           </div>
           <!-- /.box-header -->
           <!-- form start -->
           <form class="form-horizontal" action="<?php echo base_url('manage/cargoDesiEditing'); ?>" method="post">
             <div class="box-body">
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Kargo Adi</label>
                 <div class="col-sm-4">
                <select class="form-control" name="cargoId">
                       <?php $cargo=cargoDesiCheck(); foreach ($cargo as $cargo) {
                           if ($cargo['Id'] ==  $info['cargoId']) { ?>
                          <option selected value="<?php echo $cargo['Id']; ?>"><?php echo $cargo['title']; ?></option>
                        <?php }else{ ?>
                          <option  value="<?php echo $cargo['Id']; ?>"><?php echo $cargo['title']; ?></option>
                        <?php } }?>
                </select>
                <input type="hidden" name="Id" value="<?php echo $info['Id']; ?>">

                 </div>
               </div>
               <div class="form-group">
                 <label for="inputEmail3" class="col-sm-2 control-label">Cargo Neqliyyet</label>
                 <div class="col-sm-4">
                  <input type="text" class="form-control" name="tutar" value="<?php echo $info['tutar']; ?>">
                 </div>
               </div>
               </div>

            </div>
             <!-- /.box-body -->
             <div class="box-footer">
               <a href="<?php echo base_url('manage/cargodesi'); ?>" type="submit" class="btn btn-warning">Cancel</a>
               <button type="submit" class="btn btn-info pull-right">Edit</button>
             </div>
             <!-- /.box-footer -->
           </form>
         </div>
         <!-- /.box -->

</section>
