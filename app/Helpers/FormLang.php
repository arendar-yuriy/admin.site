<?php namespace App\Helpers;



class FormLang{

    private static $currentLocal='';

    public static function getCurrentLang(){
        $lang = \Session::get('current_admin_form_locale');
        if(!$lang && self::$currentLocal !=''){
            return self::$currentLocal;
        }elseif(!$lang && self::$currentLocal ==''){

            $lang = \LaravelLocalization::getDefaultLocale();
            \Session::set('current_admin_form_locale',$lang);
            self::$currentLocal = $lang;
            return $lang;
        }elseif(self::$currentLocal !=''){
            return self::$currentLocal;
        }elseif($lang!=''){
            return $lang;
        }else{
            return \Session::get('current_admin_form_locale');
        }
    }

    public static function setCurrentLang($lang){
        \Session::set('current_admin_form_locale',$lang);
        self::$currentLocal = $lang;
        return redirectApp('');
    }

}