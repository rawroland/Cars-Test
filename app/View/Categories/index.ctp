<?php 
echo $this->Html->tag('h3', __('List of Categories'));
echo 'Sort by: ' . $this->Paginator->sort('name', __('Name')) . ' |  ' .
		$this->Paginator->sort('id', __('Category Id'));
?>
<ul>
	<?php 
	foreach ($categories as $key => $category) {
		$cName = $this->Html->link($category['Category']['name'], array(
				'controller' => 'categories',
				'action' => 'view',
				$category['Category']['id']
		));
		echo $this->Html->tag('li', $cName);
	}
	?>
</ul>
<?php echo $this->Paginator->numbers();?>

