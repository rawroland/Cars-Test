<?php 
echo $this->Html->tag('h3', __('List of Towns'));
echo 'Sort by: ' . $this->Paginator->sort('name', __('Name')) . ' |  ' .
		$this->Paginator->sort('id', __('Town Id'));
?>
<ul>
	<?php foreach ($towns as $key => $town) :?>
	<?php 
	$tName = $this->Html->link($town['Town']['name'], array(
			'controller' => 'towns',
			'action' => 'view',
			$town['Town']['id']
	));
	echo $this->Html->tag('li', $tName);
	?>
	<ul>
		<?php 
		$rName = $this->Html->link($town['Region']['name'], array(
				'controller' => 'regions',
				'action' => 'view',
				$town['Region']['id']
		));
		echo $this->Html->tag('li', $rName);
		?>

	</ul>
	<?php endforeach;?>
</ul>
<?php echo $this->Paginator->numbers();?>

