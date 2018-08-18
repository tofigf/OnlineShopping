
<!-- Main content -->
<section class="content">
     <div class="row">
       <div class="col-xs-12">
         <div class="box">
           <?php echo $this->session->flashdata('condition'); ?>
           <div class="box-header">
             <h3 class="box-title">Kargo Desi Listesi</h3>
             <a href="<?php echo base_url('manage/cargodesiadd'); ?>" class="btn btn-primary pull-right" type="button"><i class="fa fa-plus"></i>Cargo neqliyyat vasitesi elave et</a>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
               <tr>
                    <th class="text-center" style="width:20px">S No</th>
                 <th>Firma Adi</th>
                 <th>Tutari</th>
                  <th class="text-center" style="width:100px">Edit Delete</th>

               </tr>
               </thead>
               <tbody>
                 <?php $count =1; $info =cargoJoinTable(); foreach ($info as $info) { ?>
               <tr>
                 <td><?php echo $count ++; ?></td>
                 <td><?php  echo $info['title']; ?></td>
                 <td><?php  echo $info['tutar']; ?></td>
                  <td><a href="<?php echo base_url('manage/cargodesiEdit/'.$info['Id'].''); ?>" class="btn btn-info">Dəyişdir</a>
                  <a href="<?php echo base_url('manage/cargodesiDelete/'.$info['Id'].'/Id/cargodesi'); ?>" class="btn btn-warning">Sil</a> </td>

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
