<?php 
echo $this->Html->tag('h3', __('Model View'));
?>
<p>
	<?php 
	echo 'Name: ' . $model['BrandModel']['name'] . '<br>';
	echo 'Created: ' . $model['BrandModel']['created'] . '<br>';
	$edit = $this->Html->link(__('Edit'), array(
			'controller' => 'brand_models',
			'action' => 'edit',
			$model['BrandModel']['id']
	));
	$delete = $this->Html->link(__('Delete'),
			array(
					'controller' => 'brand_models',
					'action' => 'delete',
					$model['BrandModel']['id']
			),
			array(),
			'Are you sure you want to delete this brand model?'
	);
	echo $edit . ' | ' . $delete;
	?>
</p>
<?php 
echo $this->Html->tag('h4', __('Brand this model belongs to.'));
?>
<ul>
	<?php 
		$bName = $this->Html->link($model['Brand']['name'], array(
				'controller' => 'brands', 'action' => 'view', $model['Brand']['id']
		));
		
		echo $this->Html->tag('li', $bName);
	?>
</ul>
