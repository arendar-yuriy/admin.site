<?php namespace App\Helpers;

use Intervention\Image\Facades\Image;

class Crop{

    public static function doCrop($path, $data=[])
    {
        if(is_string($data)) $data = json_decode($data,true);

        $image_full_path = \Config::get('app.image_path').$path;

        $image_crop_path = self::getCropPath($path);

        $image = \Image::make($image_full_path);

        if(isset($data['rotate'])){
            $image->rotate(-intval($data['rotate']));
        }

        $image->crop(intval($data['width']),intval($data['height']),intval($data['x']),intval($data['y']));

        $image->save($image_crop_path);

        if(isset($data['scaleX']) && $data['scaleX'] != 1){
            $image1 = \Image::make($image_crop_path);
            $image1->flip('h');
            $image1->save($image_crop_path);
        }

        if(isset($data['scaleY']) && $data['scaleY'] != 1){
            $image2 = \Image::make($image_crop_path);
            $image2->flip('v');
            $image2->save($image_crop_path);
        }

    }

    public static function getCropPath($path)
    {
        $image_full_path = \Config::get('app.image_path').$path;

        $image_folder = realpath(dirname($image_full_path));

        $image_name = basename($image_full_path);

        return $image_folder.'/crop_'.$image_name;
    }


    public static function clearCropThumbs($path)
    {
        $image_full_path = \Config::get('app.image_path').$path;

        $image_folder = realpath(dirname($image_full_path));

        $image_name = basename($image_full_path);

        $cropList = glob($image_folder.'/thumbs/*crop_'.$image_name);

        foreach($cropList as $file)
            unlink($file);
    }

}