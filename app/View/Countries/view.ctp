<?php 
echo $this->Html->tag('h3', __('Country View'));
?>
<p>
	<?php 
	echo 'Name: ' . $country['Country']['name'] . '<br>';
	echo 'Created: ' . $country['Country']['created'] . '<br>';
	$edit = $this->Html->link(__('Edit'), array(
			'controller' => 'countries',
			'action' => 'edit',
			$country['Country']['id']
	));
	$delete = $this->Html->link(__('Delete'),
			array(
					'controller' => 'countries',
					'action' => 'delete',
					$country['Country']['id']
			),
			array(),
			'Are you sure you want to delete this country?'
	);
	echo $edit . ' | ' . $delete;
	?>
</p>