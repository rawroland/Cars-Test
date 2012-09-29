<?php 
echo $this->Html->tag('h3', __('List of Models'));
echo 'Sort by: ' . $this->Paginator->sort('name', __('Name')) . ' |  ' .
		$this->Paginator->sort('id', __('Model Id'));
?>
<ul>
	<?php foreach ($models as $key => $model) :?>
	<?php 
	$mName = $this->Html->link($model['BrandModel']['name'], array(
			'controller' => 'brand_models',
			'action' => 'view',
			$model['BrandModel']['id']
	));
	echo $this->Html->tag('li', $mName);
	?>
	<ul>
		<?php 
		$bName = $this->Html->link($model['Brand']['name'], array(
				'controller' => 'brands',
				'action' => 'view',
				$model['Brand']['id']
		));
		echo $this->Html->tag('li', $bName);
		?>

	</ul>
	<?php endforeach;?>
</ul>
<?php echo $this->Paginator->numbers();?>

