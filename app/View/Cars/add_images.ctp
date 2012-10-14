<?php 
echo $this->Html->script('uploadify/jquery.uploadify-3.1', array('inline' => FALSE));
echo $this->Form->input('image', array('type' => 'file'));
$carId = $this->Session->read('car_id');
echo $this->Form->create('Car', array(
    'url' => array(
        'controller' => 'cars',
        'action' => 'add_images',
        '?' => array('session_id' => $sessionId)
    ),
    'type' => 'POST',
    'inputDefaults' => array(
        'div' => FALSE,
        'label' => FALSE
    )
));
echo $this->Html->tag('ul','', array('id' => 'thumbs'));
?>

<script type="text/javascript">
var currentImage = 1;
$(function(){
$('#image').uploadify({
	'auto' : true,
	'buttonClass' : 'add-images',
	'buttonText' : 'Add images',
	'formData' : { "location" : <?php echo $carId;?>, "current" : currentImage },
	'fileObjName' : 'images',
	'height': 30,
	'swf' : "<?php echo $this->Html->url("/uploadify/", TRUE);?>uploadify.swf",
	'uploader' : "<?php echo $this->Html->url("/uploadify/", TRUE);?>uploadify.php",
	'width': 120,
	'onUploadStart' : function(file) {
		$('#image').uploadify("settings", "formData", {"current" : currentImage++});
	},
	'onUploadSuccess' : function(file, data, response) {
		$('#thumbs').append('<li><img src="' + data + '"></li>');
		$('#thumbs').append('<input type="hidden" name="data[Image][][location]" value="' + data + '">');
		}
});
});
</script>
<?php echo $this->Form->submit('Skip step');?>
<?php echo $this->Form->end('Complete');?>


