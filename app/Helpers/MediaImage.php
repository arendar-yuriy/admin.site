<?php namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class MediaImage{

   public static function  getImage($path,$width,$height=null,$param  = array(),$quality=100)
    {
        if(isset($param['crop']) && $param['crop']){
            $crop = self::getCropPath($path);

            if($crop != '')
                $path = $crop;
        }

        $new_img_url = self::getThumbsImage($path,$width,$height,$param,$quality);


        $attr = '';

        if(!empty($param))
            foreach($param as $name=>$value) $attr .= $name.'="'.$value.'"';

        return '<img src="'.$new_img_url.'" '.$attr.'/>';
    }

    public static function getImageUrl($image)
    {
        $defaul_path = \Config::get('app.image_path');
        if(!File::isFile($defaul_path.$image)) return '/img/placeholder.jpg';
        return \Config::get('app.image_url').$image;
    }

    public static function getThumbsImage($path,$width,$height=null,$param  = array(),$quality=100){
        if(isset($param['crop']) && $param['crop']){
            $crop = self::getCropPath($path);

            if($crop != '')
                $path = $crop;
        }

        $defaul_path = \Config::get('app.image_path');

        if(!File::isFile($defaul_path.$path) || $path == ''){
            $full_path = public_path('img/placeholder.jpg');
        }

        else
            $full_path = $defaul_path.$path;

        $directory_thuumbs = realpath(dirname($full_path)).'/thumbs/';
        $new_img = $directory_thuumbs.$width.'-'.$height.basename($full_path);



        if(!File::isFile($defaul_path.$path) || $path == '')
            $new_img_url = url('/').'/img/thumbs/'.$width.'-'.$height.basename($full_path);
        else
            $new_img_url = \Config::get('app.image_url').str_replace(\Config::get('app.image_path'),'',dirname($full_path)).'/thumbs/'.$width.'-'.$height.basename($full_path);

        if(!File::isDirectory($directory_thuumbs))
            File::makeDirectory($directory_thuumbs,0777);

        if(!File::isFile($new_img)){
            $image = Image::make($full_path);

            if($height === null){
                $ratio = $image->height()/$image->width();
                $height = intval($width * $ratio);
            }

            $image->fit($width,$height);
            $image->save($new_img);
        }

        return $new_img_url;

    }

    public static function getCropImage($path)
    {
        $url = \Config::get('admin.image_url').$path;
        $file = \Config::get('app.image_path').$path;
        $image_folder = realpath(dirname($file));

        $image_name = basename($file);

        $crop_image_name = $image_folder.'/crop_'.$image_name;

        if(\File::isFile($crop_image_name))
            return str_replace($image_name,'crop_'.$image_name,$url);

        return '';
    }

    public static function getCropPath($path)
    {
        $file = \Config::get('app.image_path').$path;

        $image_folder = realpath(dirname($file));

        $image_name = basename($file);

        $crop_image_name = $image_folder.'/crop_'.$image_name;

        if(\File::isFile($crop_image_name))
            return str_replace($image_name,'crop_'.$image_name,$path);

        return '';
    }
}