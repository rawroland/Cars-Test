<?php 
echo $this->Html->tag('h3', __('Region View'));
?>
<p>
	<?php 
	echo 'Name: ' . $region['Region']['name'] . '<br>';
	echo 'Created: ' . $region['Region']['created'] . '<br>';
	$edit = $this->Html->link(__('Edit'), array(
			'controller' => 'regions',
			'action' => 'edit',
			$region['Region']['id']
	));
	$delete = $this->Html->link(__('Delete'),
			array(
					'controller' => 'regions',
					'action' => 'delete',
					$region['Region']['id']
			),
			array(),
			'Are you sure you want to delete this region?'
	);
	echo $edit . ' | ' . $delete;
	?>
</p>
<?php 
echo $this->Html->tag('h4', __('Country this region is located in.'));
?>
<ul>
	<?php 
		$bName = $this->Html->link($region['Country']['name'], array(
				'controller' => 'countries', 'action' => 'view', $region['Country']['id']
		));
		
		echo $this->Html->tag('li', $bName);
	?>
</ul>
