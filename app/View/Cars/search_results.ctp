<?php 
echo $this->Html->tag('h3', __('Search Result'), array());

echo 'Sort by: ' . $this->Paginator->sort('produced', __('Produced')) . ' |  ' .
		$this->Paginator->sort('created', __('Added')) . ' |  ' .
		$this->Paginator->sort('price', __('Price'));
?>
<ul>
	<?php 
	foreach ($cars as $key => $car) {
		$carImg = $this->Html->image($car['Image'][0]['location']);
		$name = $car['Brand']['name'] . '--' . $car['BrandModel']['name'] . '<br>'; 
		echo $this->Html->tag('li', $name . $carImg);
	}
	?>
</ul>
<?php echo $this->Paginator->numbers();?>