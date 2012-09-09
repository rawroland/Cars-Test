<?php 
echo $this->Html->tag('h3', __('Brand View'));
?>
<p>
	<?php 
	echo 'Name: ' . $brand['Brand']['name'] . '<br>';
	echo 'Created: ' . $brand['Brand']['created'] . '<br>';
	$edit = $this->Html->link(__('Edit'), array(
			'controller' => 'brands',
			'action' => 'edit',
			$brand['Brand']['id']
	));
	$delete = $this->Html->link(__('Delete'),
			array(
					'controller' => 'brands',
					'action' => 'delete',
					$brand['Brand']['id']
			),
			array(),
			'Are you sure you want to delete this brand?'
	);
	echo $edit . ' | ' . $delete;
	?>
</p>
<?php 
echo $this->Html->tag('h4', __('Models from this brand'));
?>
<ul>
	<?php 
	foreach ($brand['BrandModel'] as $index => $model) {
		$mName = $this->Html->link($model['name'], array(
				'controller' => 'brand_models', 'action' => 'view', $model['id']
		));
		
		echo $this->Html->tag('li', $mName);
	}
	?>
</ul>
