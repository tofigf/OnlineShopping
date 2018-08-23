
<!-- Main content -->
<section class="content">
     <div class="row">
       <div class="col-xs-12">
         <div class="box">
           <?php echo $this->session->flashdata('condition'); ?>
           <div class="box-header">
             <h3 class="box-title">Məhsullar Listesi</h3>
             <a href="<?php echo base_url('manage/productadd'); ?>" class="btn btn-primary pull-right" type="button"><i class="fa fa-plus"></i>Add</a>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
               <tr>
                    <th class="text-center" style="width:20px">S No</th>
                 <th>Məhsul Adı</th>
                 <th>Kateqoriyası</th>
                 <th>Məlumat</th>
                  <th>Qiymət</th>
                 <th style="width:20px">Vəziyyəti</th>
                  <th class="text-center" style="width:100px">İşləmlər</th>
               </tr>
               </thead>
               <tbody>
                 <?php $count =1; $info =productsJoinCategories(); foreach ($info as $info) { ?>
               <tr>
                 <td><?php echo $count ++; ?></td>
                 <td><?php echo $info['title']; ?></td>
                 <td><?php echo $info['type']; ?></td>
                 <td><?php echo word_limiter($info['info'],5); ?></td>
                 <td><?php echo $info['price'] ?>Azn</td>
                 <!-- <td>  <img src="<?php echo base_url(); echo $info['mini1']; ?>" alt=""> </td> -->
                 <td>
                   <input class="toggle_check"
                    data-onstyle ="success"
                    data-on="Aktiv"
                    data-off ="Passiv"
                    data-offstyle ="danger"
                    type="checkbox"
                    data-toggle="toggle"
                    dataId ="<?php echo $info['Id']; ?>"
                    dataUrl ="<?php echo base_url('manage/productset'); ?>"
                    <?php echo ($info['status']==1) ? "checked" : ""; ?>
                  </td>

                  <td><a href="<?php echo base_url('manage/productedit/'.$info['Id'].''); ?>" class="btn btn-info">Dəyişdir</a>
                  <a href="<?php echo base_url('manage/productdelete/'.$info['Id'].'/Id/products'); ?>" class="btn btn-warning">Sil</a> </td>

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
