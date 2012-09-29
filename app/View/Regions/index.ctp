<?php 
echo $this->Html->tag('h3', __('List of Regions'));
echo 'Sort by: ' . $this->Paginator->sort('name', __('Name')) . ' |  ' .
		$this->Paginator->sort('id', __('Region Id'));
?>
<ul>
	<?php foreach ($regions as $key => $region) :?>
	<?php 
	$rName = $this->Html->link($region['Region']['name'], array(
			'controller' => 'regions',
			'action' => 'view',
			$region['Region']['id']
	));
	echo $this->Html->tag('li', $rName);
	?>
	<ul>
		<?php 
		$cName = $this->Html->link($region['Country']['name'], array(
				'controller' => 'countries',
				'action' => 'view',
				$region['Country']['id']
		));
		echo $this->Html->tag('li', $cName);
		?>

	</ul>
	<?php endforeach;?>
</ul>
<?php echo $this->Paginator->numbers();?>

