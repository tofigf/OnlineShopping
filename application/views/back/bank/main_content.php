
<!-- Main content -->
<section class="content">
     <div class="row">
       <div class="col-xs-12">
         <div class="box">
           <?php echo $this->session->flashdata('condition'); ?>
           <div class="box-header">
             <h3 class="box-title">Bank Listesi</h3>
             <a href="<?php echo base_url('manage/bankadd'); ?>" class="btn btn-primary pull-right" type="button"><i class="fa fa-plus"></i>Add</a>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
               <tr>
                    <th class="text-center" style="width:20px">S No</th>
                 <th>Bank</th>
                 <th>Şəkil</th>
                 <th>Flial</th>
                 <th>Iban</th>
                 <th>Hesab</th>
                 <th style="width:20px">Veziyyeti</th>
                  <th class="text-center" style="width:100px">Edit Delete</th>

               </tr>
               </thead>
               <tbody>
                 <?php $count =1; foreach ($info as $info) { ?>
               <tr>
                 <td><?php echo $count ++; ?></td>
                 <td><?php echo $info['title']; ?></td>
                 <td><img src="<?php echo base_url(); echo $info['mini']; ?>" alt="bank"> </td>
                 <td><?php echo $info['flial']; ?></td>
                 <td><?php echo $info['iban']; ?></td>
                 <td><?php echo $info['hesabno'];  ?></td>
                 <td>
                   <input class="toggle_check"
                    data-onstyle ="success"
                    data-on="Aktiv"
                    data-off ="Passiv"
                    data-offstyle ="danger"
                    type="checkbox"
                    data-toggle="toggle"
                    dataId ="<?php echo $info['Id']; ?>"
                    dataUrl ="<?php echo base_url('manage/bankset'); ?>"
                    <?php echo ($info['status']==1) ? "checked" : ""; ?>
                  </td>

                  <td><a href="<?php echo base_url('manage/bankedit/'.$info['Id'].''); ?>" class="btn btn-info">Dəyişdir</a>
                  <a href="<?php echo base_url('manage/bankdelete/'.$info['Id'].'/Id/bank'); ?>" class="btn btn-warning">Sil</a> </td>

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
