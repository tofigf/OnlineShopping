<h2>Əlaqə Formu</h2>
<?php echo $this->session->flashdata('xeta'); ?>
<div class="row">
<div class="col-sm-12">
  <form   action="<?php echo base_url('main/messagesending'); ?>"   method="post" class="form-horizontal" >
    <div class="form-group ">
      <label  class="col-sm-2 control-label"  for="exampleFormControlInput1">Ad Soyad</label>
      <div class="col-sm-10">
        <input type="text" required name="name" class="form-control"  placeholder="Ad Soyad">

      </div>
    </div>
    <div class="form-group ">
      <label  class="col-sm-2 control-label"   for="exampleFormControlInput1">E-poct</label>
      <div class="col-sm-10">
        <input type="email" required name="email" class="form-control"  placeholder="name@example.com">
        <input type="hidden" name="ip" value="<?php echo GetIP(); ?>">
      </div>

    </div>
    <div class="form-group required">
      <label  class="col-sm-2 control-label"  for="exampleFormControlInput1">Mövzu</label>
      <div class="col-sm-10">
        <input type="text" name="topic" required class="form-control"   placeholder="mövzu">

      </div>
    </div>
    <div class="form-group ">
      <label class="col-sm-2 control-label" for="input-enquiry">Mesajınız</label>
      <div class="col-sm-10">
        <textarea name="message" required class="form-control"  rows="10"></textarea>

      </div>
    </div>

    <button type="submit" class="btn btn-primary" name="button">Göndər</button>
  </form>
</div>
</div>
<hr>
