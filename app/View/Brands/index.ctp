<?php 
echo $this->Html->tag('h3', __('List of Brands'));
echo 'Sort by: ' . $this->Paginator->sort('name', __('Name')) . ' |  ' .
		$this->Paginator->sort('id', __('Brand Id'));
?>
<ul>
	<?php foreach ($brands as $key => $brand) :?>
	<?php 
	$bName = $this->Html->link($brand['Brand']['name'], array(
			'controller' => 'brands',
			'action' => 'view',
			$brand['Brand']['id']
	));
	echo $this->Html->tag('li', $bName);
	?>
	<ul>
		<?php foreach ($brand['BrandModel'] as $key => $model) :?>
		<?php 
		$mName = $this->Html->link($model['name'], array(
				'controller' => 'brand_models',
				'action' => 'view',
				$model['id']
		));
		echo $this->Html->tag('li', $mName);
		?>

		<?php endforeach;?>
	</ul>
	<?php endforeach;?>
</ul>
<?php echo $this->Paginator->numbers();?>

