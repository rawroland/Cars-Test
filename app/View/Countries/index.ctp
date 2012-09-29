<?php 
echo $this->Html->tag('h3', __('List of Categories'));
echo 'Sort by: ' . $this->Paginator->sort('name', __('Name')) . ' |  ' .
		$this->Paginator->sort('id', __('Category Id'));
?>
<ul>
	<?php 
	foreach ($countries as $key => $country) {
		$ctryName = $this->Html->link($country['Country']['name'], array(
				'controller' => 'countries',
				'action' => 'view',
				$country['Country']['id']
		));
		echo $this->Html->tag('li', $ctryName);
	}
	?>
</ul>
<?php echo $this->Paginator->numbers();?>

