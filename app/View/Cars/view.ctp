<?php 
echo $this->Html->script('exposure/jquery.exposure', array('inline' => FALSE));
echo $this->Html->tag('h3', __('View Car'), array());

echo $this->Html->tag('h4', $car['Brand']['name'] . ', ' . $car['BrandModel']['name'] , array());

$thumbs = Hash::extract($car, 'Image.{n}[type=/thumb/]');
$images = Hash::extract($car, 'Image.{n}[type=/image/]');

$expListElement = '';
foreach ($images as $index => $image) {
  $expThumb = $this->Html->image($thumbs[$index]['location'], array('alt' => 'Thumbnail'));
  $imgUrl = $this->Html->url('/' . IMAGES_URL .  $image['location'], FALSE);
  $expLink = $this->Html->link($expThumb, $imgUrl, array('escape' => FALSE));
  $expListElement .= $this->Html->tag('li', $expLink, array('escape' => FALSE, 'style' => 'float: left;'));
}
echo $this->Html->tag('ul', $expListElement, array('id' => 'images-exposed', 'escape' => FALSE, 'style' => 'display: inline;list-style-type: none;
    padding-right: 20px;'));
?>
<script type="text/javascript">
$(function() {
	$('#images-exposed').exposure({pageSize: 10});
});
</script>
<style type="text/css">
ul#images-exposed li {
	float: left;
}
</style>
