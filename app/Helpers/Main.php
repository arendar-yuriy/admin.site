<?php namespace App\Helpers;

use App\Constants;
use Carbon\Carbon;

class Main{

    public static function init()
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

    public static function redirect($url='', $status = '302', $message= '', $title = '', $type = '',$icon='',$class='')
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
            \Redirect::to($url,$status);
        }
    }

    public static function message($message= '', $title = '', $type = '',$icon='',$class='')
    {
        return [
            'message'=>$message,
            'title'=>$title,
            'type'=>$type,
            'icon'=>$icon,
            'class'=>$class
        ];
    }

    public static function getDateFromPicker($date)
    {
        return Carbon::createFromTimestamp(strtotime($date));
    }

    public static function getImageField($name,$image='',$title='Image',$is_crop = false)
    {
        return view('inc.image')
            ->with('name',$name)
            ->with('image',$image)
            ->with('title',$title)
            ->with('is_crop',$is_crop);
    }

    public static function prepareDataToAdd($lang_attr, $data,$default = ['name'=>''])
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

    /**
     * Сортировка массива по значениям ключей
     *
     * @param array $data
     * @param string $field
     * @param string $sort
     * @return multitype:
     */
    public  static  function array_orderby($data,$field,$sort = 'asc')
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

    public static function getControllerName()
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

   public static function ru_date() {
    // Перевод
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


    public static function uk_date() {
        // Перевод
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

    public static function DateLocale($format,$timestamp = null,$locale = 'en')
    {
        if($locale == 'en')
            return date($format,$timestamp);
        elseif(method_exists(Main::class,$locale.'_date') && $timestamp !== null)
            return call_user_func_array([Main::class,$locale.'_date'],[$format,$timestamp]);
        else
            return date($format,$timestamp);

    }

    public static function cut_text($value, $length)
    {
        $text = implode(array_slice(explode('<br>',wordwrap($value,$length,'<br>',false)),0,1));
        if($text!=$value)$text=$text.'...';
        return $text;
    }

    public static function constant($name)
    {
        $constant =  Constants::where('name',$name)->first();

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