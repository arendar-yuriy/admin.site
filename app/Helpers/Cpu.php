<?php namespace App\Helpers;
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 07.03.16
 * Time: 16:42
 */

class Cpu{

    public static function getRussianAlias($string)
    {

        $string = mb_strtolower($string);
        $string = trim($string);
        $string = str_replace(" ", "-", $string);
        $string = str_replace("_", "-", $string);
        $string = preg_replace('/(\s{2,})/', ' ', $string);
        $string = preg_replace('/(-{2,})/', '-', $string);
        $string = preg_replace("/[^a-zа-яіїєґ0-9-]/u", "", $string);

        return $string;
    }

    public static function generate($string,$model)
    {
        $ru = mb_strtolower($string);
        $ru = trim($ru);
        $ru = str_replace(" ", "-", $ru);
        $ru = str_replace("_", "-", $ru);
        $ru = preg_replace('/(\s{2,})/', ' ', $ru);
        $ru = preg_replace('/(-{2,})/', '-', $ru);
        $ru = preg_replace("/[^a-zа-яіїєґ0-9-]/u", "", $ru);

        $en = \URLify::filter($string);
        $check = $model->where('alias_ru','=',$ru)
            ->orWhere('alias_ru','=',$ru)
            ->orWhere('alias_en','=',$ru)
            ->orWhere('alias_customer','=',$ru)
            ->get()
            ->toArray();

        if($check){
            $data = $model->orderby('id', 'desc')->first();
            $ru .= '-'.(++$data->id);
        }

        $check = $model->where('alias_ru','=',$en)
            ->orWhere('alias_ru','=',$en)
            ->orWhere('alias_en','=',$en)
            ->orWhere('alias_customer','=',$en)
            ->get()
            ->toArray();

        if($check){
            $data = $model->orderby('id', 'desc')->first();
            $en .= '-'.(++$data->id);
        }

        return [
            'ru'=>$ru,
            'en'=>$en
        ];

    }

    public static function getAlias($struct)
    {

        if(!$struct) return '';
        if(is_array($struct)){
            switch($struct['alias_priority']){
                case 1:
                    return $struct['alias_customer'];
                case 2:
                    return $struct['alias_en'];
                case 3:
                    return $struct['alias_ru'];
            }
        }else{
            switch($struct->alias_priority){
                case 1:
                    return $struct->alias_customer;
                case 2:
                    return $struct->alias_en;
                case 3:
                    return $struct->alias_ru;
            }
        }

    }

    public static function getGalleryUrl($gallery)
    {
        if($gallery->structure_id !== null){
            return route('content',['structure_id'=>self::getAlias(Structure::find($gallery->structure_id))]);
        }else{
            return route('gallery',['id'=>self::getAlias($gallery)]);
        }
    }

}