
<!-- Main content -->
<section class="content">
     <div class="row">
       <div class="col-xs-12">
         <div class="box">
           <?php echo $this->session->flashdata('condition'); ?>
           <div class="box-header">
             <h3 class="box-title">Kargo Listesi</h3>
             <a href="<?php echo base_url('manage/cargoadd'); ?>" class="btn btn-primary pull-right" type="button"><i class="fa fa-plus"></i>Add</a>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
               <tr>
                    <th>S No</th>
                 <th>Sekili</th>
                 <th>Firma</th>
                 <th>Veziyyeti</th>
                  <th>Edit Delete</th>

               </tr>
               </thead>
               <tbody>
                 <?php $count =1; foreach ($info as $info) { ?>
               <tr>
                 <td><?php echo $count ++; ?></td>
                 <td>sekil</td>
                 <td>firma</td>
                 <td>veziyyeti</td>
                  <td><a href="<?php echo base_url('manage/cargoEdit/'.$info['Id'].''); ?>" class="btn btn-info">Dəyişdir</a>
                  <a href="<?php echo base_url('manage/cargoDelete/'.$info['Id'].''); ?>" class="btn btn-warning">Sil</a> </td>

               </tr>
             <?php } ?>
             </body>
             </table>
           </div>
           <!-- /.box-body -->
         </div>
         <!-- /.box -->
       </div>
       <!-- /.col -->
     </div>
     <!-- /.row -->
   </section>
   <!-- /.content -->
