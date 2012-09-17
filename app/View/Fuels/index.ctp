<?php 
echo $this->Html->tag('h3', __('List of Fuels'));
echo 'Sort by: ' . $this->Paginator->sort('name', __('Name')) . ' |  ' .
		$this->Paginator->sort('id', __('Fuel Id'));
?>
<ul>
	<?php 
	foreach ($fuels as $key => $fuel) {
		$fName = $this->Html->link($fuel['Fuel']['name'], array(
				'controller' => 'fuels',
				'action' => 'view',
				$fuel['Fuel']['id']
		));
		echo $this->Html->tag('li', $fName);
	}
	?>
</ul>
<?php echo $this->Paginator->numbers();?>

