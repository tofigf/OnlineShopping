<div class="box category info">
<div class="box-heading">
<h3><i class="flaticon-show5"></i>Kategoriler</h3>
</div>
<div class="box-content">
<div class="box-category">
<ul class="menu">
  <?php $categories =categoriCheck(); foreach ($categories as $category) { ?>
  <li><a href="#"><i class="fa fa-chevron-right"></i> <?php echo $category['type']; ?></a></li>

<?php } ?>

</ul>
</div>
</div>
</div>
