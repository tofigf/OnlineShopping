
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
                    <th class="text-center" style="width:20px">S No</th>
                 <th>Sekili</th>
                 <th>Firma</th>
                 <th>Veziyyeti</th>
                  <th class="text-center" style="width:100px">Edit Delete</th>

               </tr>
               </thead>
               <tbody>
                 <?php $count =1; foreach ($info as $info) { ?>
               <tr>
                 <td><?php echo $count ++; ?></td>
                 <td>  <img src="<?php echo base_url(); echo $info['mini']; ?>" alt=""> </td>
                 <td><?php  echo $info['title']; ?></td>
                 <td>
                   <input class="toggle_check"
                    data-onstyle ="success"
                    data-on="Aktiv"
                    data-off ="Passiv"
                    data-offstyle ="danger"
                    type="checkbox"
                    data-toggle="toggle"
                    dataId ="<?php echo $info['Id']; ?>"
                    dataUrl ="<?php echo base_url('manage/cargoset'); ?>"
                    <?php echo ($info['status']==1) ? "checked" : ""; ?>
                  </td>

                  <td><a href="<?php echo base_url('manage/cargoEdit/'.$info['Id'].''); ?>" class="btn btn-info">Dəyişdir</a>
                  <a href="<?php echo base_url('manage/cargoDelete/'.$info['Id'].'/Id/cargo'); ?>" class="btn btn-warning">Sil</a> </td>

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
