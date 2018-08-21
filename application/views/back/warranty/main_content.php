

<!-- Main content -->
<section class="content">
     <div class="row">
       <div class="col-xs-12">
         <div class="box">
           <?php echo $this->session->flashdata('condition'); ?>
           <div class="box-header">
             <h3 class="box-title">Zəmanət və geri qaytarılma</h3>
             <a href="<?php echo base_url('manage/warrantyadd'); ?>" class="btn btn-primary pull-right" type="button"><i class="fa fa-plus"></i>Add</a>

           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
               <tr>
                    <th>S No</th>
                 <th>Başlıq</th>
                 <th>Açıqlama</th>
               </tr>
               </thead>
               <tbody>
                 <?php $count =1; foreach ($info as $info) { ?>
               <tr>
                 <td><?php echo $count ++; ?></td>
                 <td><?php echo word_limiter($info['title'],5); ?></td>
                 <td><?php echo word_limiter($info['description'],10); ?></td>
                  <td>
                    <a href="<?php echo base_url('manage/warrantyedit/'.$info['Id'].''); ?>" class="btn btn-primary">Düzəlt</a>
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
