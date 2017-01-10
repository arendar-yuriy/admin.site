<?php

if (!function_exists('imageField')) {
    /**
     * Get html of image input and edit field
     * @param $name - name image field in database
     * @param string $image - path to image
     * @param string $title - Title of the field
     * @param bool $is_crop - if the image is cropped
     * @return \Illuminate\View\View
     */
    function imageField($name,$image='',$title='Image',$is_crop = false)
    {
        return view('inc.image')
            ->with('name',$name)
            ->with('image',$image)
            ->with('title',$title)
            ->with('is_crop',$is_crop);
    }

}


if (!function_exists('initApplication')) {

    /**
     * function initializes base function of application
     */
    function initApplication()
    {
        if(\Session::has('message') && \Session::get('message') != ''){
            $message = \Session::pull('message');
            $onLoad = "new PNotify({";
            if(!empty($message['title']))
                $onLoad.="title:'".$message['title']."',";
            if(!empty($message['message']))
                $onLoad.="text:'".$message['message']."',";
            if(!empty($message['type']))
                $onLoad .= "type:'".$message['type']."',";
            if(!empty($message['icon']))
                $onLoad .= "icon:'".$message['icon']."',";
            if(!empty($message['class']))
                $onLoad .= "addclass:'".$message['class']."'";
            $onLoad .= "});";
            view()->share("onLoad",$onLoad);
        }
    }

}

if (!function_exists('redirectApp')) {

    /**
     * function return param to redirect.
     * array for ajax request or RedirectResponse
     * @param string $url - URL to redirect
     * @param string $status - status of redirect
     * @param string $message - message show after redirect
     * @param string $title - title of message
     * @param string $type - type: success|error|warning
     * @param string $icon - icon for a notice label
     * @param string $class - class for a notice label
     * @return array|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    function redirectApp($url='', $status = '302', $message= '', $title = '', $type = '',$icon='',$class='')
    {
        if($message != ''){
            \Session::put('message.type',$type);
            \Session::put('message.title',$title);
            \Session::put('message.message',$message);
            \Session::put('message.icon',$icon);
            \Session::put('message.class',$class);
        }

        if(\Request::ajax()){
            return array('redirect'=>$url);
        }else{
            return redirect($url,$status);
        }
    }

}

if (!function_exists('messageApp')) {

    /**
     * function return array for show message after ajax request
     * @param string $message
     * @param string $title
     * @param string $type
     * @param string $icon
     * @param string $class
     * @return array
     */
    function messageApp($message= '', $title = '', $type = '',$icon='',$class='')
    {
        return [
            'message'=>$message,
            'title'=>$title,
            'type'=>$type,
            'icon'=>$icon,
            'class'=>$class
        ];
    }

}

if (!function_exists('prepareDataToAdd')) {

    /**
     * function return array with format to add in multi language model
     * @param array $lang_attr
     * @param array $data
     * @param array $default
     * @return array
     */
    function prepareDataToAdd($lang_attr, $data,$default = ['name'=>''])
    {
        foreach(\LaravelLocalization::getSupportedLanguagesKeys() as $key){
            if($key!=$data['locale']){
                $data[$key] = $default;
            }else{
                foreach($lang_attr as $value){
                    if(isset($data[$value]))
                        $data[$key][$value] = $data[$value];
                }
            }
        }
        foreach($lang_attr as $value){
            if(isset($data[$value]))
                unset($data[$value]);
        }

        return $data;
    }

}

if (!function_exists('arrayOrderBy')) {

    /**
     * Return array sorted by $field in way $sort
     * @param $lang_attr
     * @param $data
     * @param array $default
     * @return array
     */
    function arrayOrderBy($data,$field,$sort = 'asc')
    {
        if($data){
            $tmp = array();
            foreach ($data as $key => $row){
                if(!empty($row[$field]))
                    $tmp[$key] = $row[$field];
            }
            if($tmp){
                if($sort == 'desc')
                    arsort($tmp);
                else
                    asort($tmp);

                foreach ($tmp as $key=>$value){
                    $tmp[$key] = $data[$key];
                }
                $data = array_values($tmp);
            }
        }

        return $data;
    }

}

if (!function_exists('getControllerName')) {

    /**
     * @param $data
     * @param $field
     * @param string $sort
     * @return array
     */
    function getControllerName()
    {
        $route = \Route::getCurrentRoute();
        if($route === null)
            return null;
        $controller = $route->getAction()['controller'];
        $namespace = $route->getAction()['namespace'];

        $controller = str_replace($namespace,'',$controller);

        $controller = trim($controller,"\\");
        $controller = explode('@',$controller)[0];

        return $controller;
    }

}


if (!function_exists('ukDate')) {

    /**
     * return date for ukraine language
     * function calling was a same as default date() function php
     * @return string
     */
    function ukDate()
    {
        $translate = array(
            "am" => "дп",
            "pm" => "пп",
            "AM" => "ДП",
            "PM" => "ПП",
            "Monday" => "Понеділок",
            "Mon" => "Пн",
            "Tuesday" => "Вівторок",
            "Tue" => "Вт",
            "Wednesday" => "Середа",
            "Wed" => "Ср",
            "Thursday" => "Четвер",
            "Thu" => "Чт",
            "Friday" => "П’ятниця",
            "Fri" => "Пт",
            "Saturday" => "Субота",
            "Sat" => "Сб",
            "Sunday" => "Неділя",
            "Sun" => "Нд",
            "January" => "Січень",
            "Jan" => "Січ",
            "February" => "Лютий",
            "Feb" => "Лют",
            "March" => "Березень",
            "Mar" => "Бер",
            "April" => "Квітень",
            "Apr" => "Кв",
            "May" => "Травень",
            "May" => "Тр",
            "June" => "Червень",
            "Jun" => "Черв",
            "July" => "Липень",
            "Jul" => "Лип",
            "August" => "Серпень",
            "Aug" => "Сер",
            "September" => "Вересень",
            "Sep" => "Вер",
            "October" => "Жовтень",
            "Oct" => "Жовт",
            "November" => "Листопад",
            "Nov" => "Лист",
            "December" => "Грудень",
            "Dec" => "Гр",
            "st" => "те",
            "nd" => "те",
            "rd" => "е",
            "th" => "те"
        );
        // если передали дату, то переводим ее
        if (func_num_args() > 1) {
            $timestamp = func_get_arg(1);
            return strtr(date(func_get_arg(0), $timestamp), $translate);
        } else {
            // иначе текущую дату
            return strtr(date(func_get_arg(0)), $translate);
        }
    }

}

if (!function_exists('ruDate')) {

    /**
     * return date for russian language
     * function calling was a same as default date() function php
     * @return string
     */
    function ruDate()
    {
        $translate = array(
            "am" => "дп",
            "pm" => "пп",
            "AM" => "ДП",
            "PM" => "ПП",
            "Monday" => "Понедельник",
            "Mon" => "Пн",
            "Tuesday" => "Вторник",
            "Tue" => "Вт",
            "Wednesday" => "Среда",
            "Wed" => "Ср",
            "Thursday" => "Четверг",
            "Thu" => "Чт",
            "Friday" => "Пятница",
            "Fri" => "Пт",
            "Saturday" => "Суббота",
            "Sat" => "Сб",
            "Sunday" => "Воскресенье",
            "Sun" => "Вс",
            "January" => "Января",
            "Jan" => "Янв",
            "February" => "Февраля",
            "Feb" => "Фев",
            "March" => "Марта",
            "Mar" => "Мар",
            "April" => "Апреля",
            "Apr" => "Апр",
            "May" => "Мая",
            "May" => "Мая",
            "June" => "Июня",
            "Jun" => "Июн",
            "July" => "Июля",
            "Jul" => "Июл",
            "August" => "Августа",
            "Aug" => "Авг",
            "September" => "Сентября",
            "Sep" => "Сен",
            "October" => "Октября",
            "Oct" => "Окт",
            "November" => "Ноября",
            "Nov" => "Ноя",
            "December" => "Декабря",
            "Dec" => "Дек",
            "st" => "ое",
            "nd" => "ое",
            "rd" => "е",
            "th" => "ое"
        );
        // если передали дату, то переводим ее
        if (func_num_args() > 1) {
            $timestamp = func_get_arg(1);
            return strtr(date(func_get_arg(0), $timestamp), $translate);
        } else {
            // иначе текущую дату
            return strtr(date(func_get_arg(0)), $translate);
        }
    }

}

if (!function_exists('dateLocale')) {

    /**
     * return date in current Language
     * @param $format
     * @param null $timestamp
     * @param string $locale
     * @return string
     */
    function dateLocale($format,$timestamp = null,$locale = 'en')
    {
        if($locale == 'en')
            return date($format,$timestamp);
        elseif(function_exists($locale.'Date') && $timestamp !== null)
            return call_user_func_array($locale.'Date',[$format,$timestamp]);
        else
            return date($format,$timestamp);
    }

}

if (!function_exists('cutText')) {

    /**
     * cut the text up to a length of $length
     * @param $value
     * @param $length
     * @param bool $dots
     * @return string
     */
    function cutText($value, $length,$dots = true)
    {
        $text = implode(array_slice(explode('<br>',wordwrap($value,$length,'<br>',false)),0,1));
        if($text!=$value &&  $dots) $text=$text.'...';
        return $text;
    }

}

if (!function_exists('constantApp')) {

    /**
     * return constant from database
     * @param $name
     * @return array|bool|mixed
     */
    function constantApp($name)
    {
        $constant =  \App\Constants::where('name',$name)->first();

        if($constant === null || $constant->published == '0') return false;

        if($constant->type == 'array'){
            return json_decode($constant->value,true);
        }elseif($constant->type =='multiplicity'){
            return explode(',',$constant->value);
        }elseif($constant->type == 'boolean'){
            return $constant->value == "1";
        }elseif($constant->type == 'file'){
            return $constant->value;
        }
        else{
            return $constant->value;
        }
    }

}

if (!function_exists('getRussianAlias')) {

    /**
     * function return russian slug for value $string
     * @param $string
     * @return string
     */
    function getRussianAlias($string)
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

}

if (!function_exists('generateAlias')) {


    /**
     * Function return array with generated alias for latin and default slug
     * @param $string
     * @param $model
     * @return array
     */
    function generateAlias($string,$model)
    {
        $ru = getRussianAlias($string);

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

}


if (!function_exists('getAlias')) {

    /**
     * Function return active alias for input structure
     * @param $struct
     * @return mixed|string
     */
    function getAlias($struct)
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

}

if (!function_exists('getGalleryUrl')) {

    function getGalleryUrl($gallery)
    {
        if($gallery->structure_id !== null){
            return route('content',['structure_id'=>getAlias(\App\Structure::find($gallery->structure_id))]);
        }else{
            return route('gallery',['id'=>getAlias($gallery)]);
        }
    }

}

if (!function_exists('doCrop')) {

    /**
     * image cropping function
     * @param $path
     * @param array $data
     */
    function doCrop($path, $data=[])
    {
        if(is_string($data)) $data = json_decode($data,true);

        $image_full_path = \Config::get('app.image_path').$path;

        $image_crop_path = getCropPath($path);

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

}

if (!function_exists('getCropRealPath')) {

    /**
     * get crop image by original
     * @param $path
     * @return string
     */
    function getCropRealPath($path)
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

if (!function_exists('getCropPath')) {

    /**
     * get crop image by original
     * @param $path
     * @return string
     */
    function getCropPath($path)
    {
        $image_full_path = \Config::get('app.image_path').$path;

        $image_folder = realpath(dirname($image_full_path));

        $image_name = basename($image_full_path);

        return $image_folder.'/crop_'.$image_name;
    }

}

if (!function_exists('clearCropThumbs')) {

    /**
     * Clearing old cropping thumbs
     * @param $path
     */
    function clearCropThumbs($path)
    {
        $image_full_path = \Config::get('app.image_path').$path;

        $image_folder = realpath(dirname($image_full_path));

        $image_name = basename($image_full_path);

        $cropList = glob($image_folder.'/thumbs/*crop_'.$image_name);

        foreach($cropList as $file)
            unlink($file);
    }

}

if (!function_exists('getImage')) {

    /**
     * get HTML for input image path with parameters and generate thumbs with $width and $height
     * @param $path
     * @param $width
     * @param null $height
     * @param array $param
     * @param int $quality
     * @return string
     */
    function getImage($path,$width,$height=null,$param  = array(),$quality=100)
    {
        if(isset($param['crop']) && $param['crop']){
            $crop = getCropRealPath($path);

            if($crop != '')
                $path = $crop;
        }

        $new_img_url = getThumbsImage($path,$width,$height,$param,$quality);


        $attr = '';

        if(!empty($param))
            foreach($param as $name=>$value) $attr .= $name.'="'.$value.'"';

        return '<img src="'.$new_img_url.'" '.$attr.'/>';
    }

}

if (!function_exists('getImageUrl')) {


    /**
     * get full url from database field image
     * @param string $image
     * @return string
     */
    function getImageUrl($image)
    {
        $defaul_path = \Config::get('app.image_path');
        if(!File::isFile($defaul_path.$image)) return '/img/placeholder.jpg';
        return \Config::get('app.image_url').$image;
    }

}

if (!function_exists('getThumbsImage')) {


    /**
     * get path to thumbs image with input height and width
     * generate thumbs with $width and $height
     * @param $path
     * @param $width
     * @param null $height
     * @param array $param
     * @param int $quality
     * @return string
     */
    function getThumbsImage($path,$width,$height=null,$param  = array(),$quality=100)
    {
        if(isset($param['crop']) && $param['crop']){
            $crop = getCropRealPath($path);

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

}


if (!function_exists('getCropImage')) {

    /**
     * get a crop image name by image from database
     * @param string $path
     * @return string
     */
    function getCropImage($path)
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

}