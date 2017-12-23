<?php namespace App;
class Image
{

    /**
     * 压缩图片
     * @param $file
     * @param $newPath
     * @param $newWidth
     * @param $newHeight
     * @return mixed
     */
    function compress($file,$newPath,$newWidth,$newHeight)
    {
        $type = pathinfo($file)['extension'];
//        $type= strrchr($file,'.'); //获取图片扩展名
            switch($type)
            {
                case 'png' :
                    header('Content-Type:images/png');
                    $image = imagecreatefrompng($file);
                    $width = imagesx($image);
                    $height = imagesy($image);
                    if(( $width  > $newWidth) || ($height > $newHeight)) { //判断上传图片的像素与想压缩的像素大小
                        $widthratio = $newWidth / $width;
                        $heightratio = $newHeight / $height;

                        if ($widthratio < $heightratio) {
                            $ratio = $widthratio;
                        } else {
                            $ratio = $heightratio;
                        }
                        $newWidth = $width * $ratio;
                        $newHeight = $height * $ratio;
                        $img = imagecreatetruecolor($newWidth, $newHeight);
                        $alpha = imagecolorallocatealpha($img, 0, 0, 0, 127);
                        imagefill($img, 0, 0, $alpha);

//将源图拷贝到新图上，并设置在保存 PNG 图像时保存完整的 alpha 通道信息
                        imagecopyresampled($img, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        imagesavealpha($img, true);
                        imagepng($img,$newPath,9);
                        imagedestroy($img);
                    }
                    else
                    {

                    $img = imagecreatetruecolor($width,$height);
                    $alpha = imagecolorallocatealpha($img, 0, 0, 0, 127);
                    imagefill($img, 0, 0, $alpha);

//将源图拷贝到新图上，并设置在保存 PNG 图像时保存完整的 alpha 通道信息
                    imagecopyresampled($img, $image, 0, 0, 0, 0, $width, $height, $width, $height);
                    imagesavealpha($img, true);
                    imagepng($img,$newPath,9);
                    }
                break;
                case 'jpeg':
                case 'jpg' :
                    header("Content-type: images/jpeg");
                    $image = imagecreatefromjpeg($file);
                    $width = imagesx($image);
                    $height = imagesy($image);
                    if(( $width  > $newWidth) || ($height > $newHeight)) { //判断上传图片的像素与想压缩的像素大小
                        $widthratio = $newWidth / $width;
                        $heightratio = $newHeight / $height;

                        if ($widthratio < $heightratio) {
                            $ratio = $widthratio;
                        } else {
                            $ratio = $heightratio;
                        }
                        $newWidth = $width * $ratio;
                        $newHeight = $height * $ratio;
                        $img = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($img, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        imagejpeg($img, $newPath, 75);
                        imagedestroy($img);
                    }
                    else{
                        $img = imagecreatetruecolor($width,$height);
                        imagecopyresampled($img, $image, 0, 0, 0, 0, $width, $height, $width, $height);
                        imagejpeg($img,$newPath,75);
                    }
                break;
                default :
                    header("Content-type: images/jpeg");
                    $image = imagecreatefromjpeg($file);
                    $width = imagesx($image);
                    $height = imagesy($image);
                    if(( $width  > $newWidth) || ($height > $newHeight)) { //判断上传图片的像素与想压缩的像素大小
                        $widthratio = $newWidth / $width;
                        $heightratio = $newHeight / $height;

                        if ($widthratio < $heightratio) {
                            $ratio = $widthratio;
                        } else {
                            $ratio = $heightratio;
                        }
                        $newWidth = $width * $ratio;
                        $newHeight = $height * $ratio;
                        $img = imagecreatetruecolor($newWidth, $newHeight);
                        imagecopyresampled($img, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                        imagejpeg($img, $newPath, 75);
                        imagedestroy($img);
                    }
                    else{
                        $img = imagecreatetruecolor($width,$height);
                        imagecopyresampled($img, $image, 0, 0, 0, 0, $width, $height, $width, $height);
                        imagejpeg($img,$newPath,75);
                    }
            }
        return $file;
    }

}