<?php 
echo $this->Html->tag('h3', __('Fuel View'));
?>
<p>
	<?php 
	echo 'Name: ' . $fuel['Fuel']['name'] . '<br>';
	echo 'Created: ' . $fuel['Fuel']['created'] . '<br>';
	$edit = $this->Html->link(__('Edit'), array(
			'controller' => 'fuels',
			'action' => 'edit',
			$fuel['Fuel']['id']
	));
	$delete = $this->Html->link(__('Delete'),
			array(
					'controller' => 'fuels',
					'action' => 'delete',
					$fuel['Fuel']['id']
			),
			array(),
			'Are you sure you want to delete this fuel type?'
	);
	echo $edit . ' | ' . $delete;
	?>
</p>