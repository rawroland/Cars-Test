<?php 
echo $this->Html->tag('h3', __('Category View'));
?>
<p>
	<?php 
	echo 'Name: ' . $category['Category']['name'] . '<br>';
	echo 'Created: ' . $category['Category']['created'] . '<br>';
	$edit = $this->Html->link(__('Edit'), array(
			'controller' => 'categories',
			'action' => 'edit',
			$category['Category']['id']
	));
	$delete = $this->Html->link(__('Delete'),
			array(
					'controller' => 'categories',
					'action' => 'delete',
					$category['Category']['id']
			),
			array(),
			'Are you sure you want to delete this category?'
	);
	echo $edit . ' | ' . $delete;
	?>
</p>