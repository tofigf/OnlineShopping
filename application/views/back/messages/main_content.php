

<!-- Main content -->
<section class="content">
     <div class="row">
       <div class="col-xs-12">
         <div class="box">
           <?php echo $this->session->flashdata('condition'); ?>
           <div class="box-header">
             <h3 class="box-title"> Gizlilik sözdəşməsi listi</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
               <tr>
                    <th>S No</th>
                    <th>Göndərən</th>
                    <th>E-poçtu</th>
                    <th>Mövzu</th>
                    <th>Status</th>
                    <th>CRUD</th>
               </tr>
               </thead>
               <tbody>
                 <?php $count =1; foreach ($info as $info) { ?>
               <tr>
                 <td><?php echo $count ++; ?></td>
                 <td><?php echo $info['name']; ?></td>
                    <td><?php echo $info['email']; ?></td>
                 <td><?php echo word_limiter($info['topic'],10); ?></td>
                 <td>
                   <?php if ($info['status'] == 1) { ?>
                   <a href="#" class="btn btn-info">Mesaj Oxunub</a>
                 <?php }else{ ?>
                  <a href="#" class="btn btn-danger">Mesaj Oxunmayib</a>
                 <?php } ?>
                 </td>
                  <td>
                    <a href="<?php echo base_url('manage/messageedit/'.$info['Id'].''); ?>" class="btn btn-primary">Oxu</a>
                    <a href="<?php echo base_url('manage/messagedel/'.$info['Id'].'/Id/messages'); ?>" class="btn btn-warning">Sil</a>
                   </td>
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
