<?php 
echo $this->Html->tag('h3', __('Town View'));
?>
<p>
	<?php 
	echo 'Name: ' . $town['Town']['name'] . '<br>';
	echo 'Created: ' . $town['Town']['created'] . '<br>';
	$edit = $this->Html->link(__('Edit'), array(
			'controller' => 'towns',
			'action' => 'edit',
			$town['Town']['id']
	));
	$delete = $this->Html->link(__('Delete'),
			array(
					'controller' => 'towns',
					'action' => 'delete',
					$town['Town']['id']
			),
			array(),
			'Are you sure you want to delete this town?'
	);
	echo $edit . ' | ' . $delete;
	?>
</p>
<?php 
echo $this->Html->tag('h4', __('Region this town is located in.'));
?>
<ul>
	<?php 
		$bName = $this->Html->link($town['Region']['name'], array(
				'controller' => 'regions', 'action' => 'view', $town['Region']['id']
		));
		
		echo $this->Html->tag('li', $bName);
	?>
</ul>
