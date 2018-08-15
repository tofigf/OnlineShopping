<section class="content-header">
  <h1>
    Data Tables
    <small>advanced tables</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Tables</a></li>
    <li class="active">Data tables</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
     <div class="row">
       <div class="col-xs-12">
         <div class="box">
           <?php echo $this->session->flashdata('condition'); ?>
           <div class="box-header">
             <h3 class="box-title"> Site Umumi Ayarlarin siyahisi</h3>
           </div>
           <!-- /.box-header -->
           <div class="box-body">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
               <tr>
                    <th>S No</th>
                 <th>Site Title</th>
                 <th>Site Url</th>
                 <th>Site Phone</th>
                 <th>Site Adress</th>
                  <th>Edit Delete</th>

               </tr>
               </thead>
               <tbody>
                 <?php $count =1; foreach ($info as $info) { ?>
               <tr>
                 <td><?php echo $count ++; ?></td>
                 <td><?php echo $info['siteTitle']; ?></td>
                 <td><?php echo $info['siteUrl']; ?></td>
                 <td><?php echo $info['sitePhone']; ?></td>
                  <td><?php echo $info['siteAdress']; ?></td>
                  <td><a href="<?php echo base_url('manage/rowEdit/'.$info['Id'].''); ?>" class="btn btn-primary">Edit</a> </td>

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
