<div class="container">
<div class="row">
<div class="col-sm-3">
<div id="menu-gadget" class="menu-gadget">
<div id="menu-icon">Kategoriler</div>
<ul class="menu">
  <?php $categories =categoriCheck(); foreach ($categories as $category) { ?>
  <li><a href="#"><i class="fa fa-chevron-right"></i> <?php echo $category['type']; ?></a></li>

<?php } ?>
</ul>
</div>
</div>
</div>
</div>
