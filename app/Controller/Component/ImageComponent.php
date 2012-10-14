<?php

/**
 * Component for image resizing
 */
class ImageComponent extends Component {

  /**
   * 
   * @param Array $imageArray TTemporary upload array
   * @param int $position Position in the images array
   * @return string The extension of the image
   * @todo Change extension function
   */
  function resizeImage($imageArray, $position, $saveTo) {
    //Get image extension
    $ext = end(explode('.', $imageArray['name']));
    switch ($ext) {
      case 'JPG':
      case 'jpeg':
      case 'jpg':
        $oldImg = imagecreatefromjpeg($imageArray['tmp_name']);
        break;
      case 'png':
        $oldImg = imagecreatefrompng($imageArray['tmp_name']);
        break;
      default:
    }
    $width = imagesx($oldImg);
    $height = imagesy($oldImg);
    $newWidth = 400;
    $newHeight = 300;
    if ($width > $newWidth) {
      $newHeight = floor($height * ( $newWidth / $width));
    } else {
      $newWidth = $width;
      $newHeight = $height;
    }

    $newImg = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($newImg, $oldImg, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    $newThumbWidth = 120;
    $newThumbHeight = floor($newHeight * ( $newThumbWidth / $newWidth));
    $newThumb = imagecreatetruecolor($newThumbWidth, $newThumbHeight);
    imagecopyresampled($newThumb, $oldImg, 0, 0, 0, 0, $newThumbWidth, $newThumbHeight, $width, $height);

    switch ($ext) {
      case 'JPG':
      case 'jpeg':
      case 'jpg':
        imagejpeg($newImg, $saveTo . '/images/car_' . $position . '.' . $ext, 70);
        imagejpeg($newThumb, $saveTo . '/thumbs/car_' . $position . '.' . $ext, 70);
        break;
      case 'png':
        imagepng($newImg, $saveTo . '/images/car_' . $position . '.' . $ext, 9);
        imagepng($newThumb, $saveTo . '/thumbs/car_' . $position . '.' . $ext, 9);
        break;
      default:
    }

    return $ext;
  }

}

?>
