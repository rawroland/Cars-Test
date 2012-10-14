<?php 
class ImageComponent{
  private $thumb = array('width' => 120, 'height' => 90);
  private $image = array('width' => 400, 'height' => 300);

  function __construct($thumb = NULL, $image = NULL) {
    if(!empty($thumb) && !empty($image)) {
      $this->thumb = $thumb;
      $this->image = $image;
    }
  }

  public function resizeImage($uploaded, $type = 'thumb') {
    $dimensions = $this->thumb;
    if ($type == 'image') {
      $dimensions = $this->image;
    }
    list($imgWidth, $imgHeight) = getimagesize($uploaded['tmp_name']);
    $scale = min( $dimensions['width'] / $imgWidth,  $dimensions['height'] / $imgHeight);
    $imgExtension = $this->getExtension($uploaded);
    switch ($imgExtension) {
      case 'JPG':
      case 'jpeg':
      case 'jpg':
        $srcImg = imagecreatefromjpeg($uploaded['tmp_name']);
        break;
      case 'png':
        $srcImg = imagecreatefrompng($uploaded['tmp_name']);
        break;
      default:
    }
    $newWidth = $imgWidth * $scale;
    $newHeight = $imgHeight * $scale;
    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    $status = imagecopyresampled($newImage, $srcImg, 0, 0, 0, 0, $newWidth, $newHeight, $imgWidth, $imgHeight);
    //Free up resources, image not deleted.
    imagedestroy($srcImg);
    return array('image' => $newImage, 'extension' => $imgExtension);
  }

  public function getExtension($image) {
    $fileParts = pathinfo($image['name']);
    return $fileParts['extension'];
  }

  public function saveImage($image = array(), $type = 'thumbs', $folder = "/files", $current = 1) {
    $success = FALSE;
    $file =  '..'. DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $type . DIRECTORY_SEPARATOR . 'car' . $current . '.' . $image['extension'];
    if ($image['image']) {
      switch ($image['extension']) {
        case 'JPG':
        case 'jpeg':
        case 'jpg':
          $success = imagejpeg($image['image'], $file, 75);
          break;
        case 'png':
          $success = imagepng($image['image'], $file, 5);
          break;
        default:
          $success = FALSE;
      }
      //Free up resources, image not deleted.
      imagedestroy($image['image']);
    }
    if ($success) {
      $success = $file;
    }
    return $success;
  }
}
?>
<?php
/*
 Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php>
*/

// Define a destination. Relative to the root 
$targetFolder = 'img' . DIRECTORY_SEPARATOR . 'cars' . DIRECTORY_SEPARATOR . $_POST['location'];
$current = $_POST['current'];
// Validate the file type
$fileTypes = array('JPG', 'jpg','jpeg','png'); // File extensions
$imager = new ImageComponent();

if (!empty($_FILES)) {

  $extension = $imager->getExtension($_FILES['images']);
  if (in_array($extension,$fileTypes)) {
    $tempFile = $_FILES['images']['tmp_name'];
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . $targetFolder;
    $targetFile = rtrim($targetPath,'/') . DIRECTORY_SEPARATOR . $_FILES['images']['name'];
    $thumbnail = $imager->resizeImage($_FILES['images']);
    $image = $imager->resizeImage($_FILES['images'], 'image');
    $success = $imager->saveImage($thumbnail, 'thumbs', $targetFolder, $current);
    $imager->saveImage($image, 'images', $targetFolder, $current);
    //move_uploaded_file($tempFile,$targetFile);
    $search = array('..', DIRECTORY_SEPARATOR);
    $replace = array('', '/');
    echo is_bool($success) ? (int) $success : str_replace($search, $replace, $success);
  } else {
    echo 'Invalid file type.';
  }
}

?>