<div class="row about-page">
<div class="col-sm-12">
<h3>Sık Sorulan Sorular</h3>
<?php $no =1; $info=question(); foreach ($info as $info) {?>

<span class="dropcap"><?php echo $no++;  ?></span>
<div class="extra-wrap">
<h4><?php echo $info['title']; ?></h4>
<p><?php  echo $info['description']; ?></p>
</div>
<div class="clear"></div>
<?php } ?>
</div>
</div>
