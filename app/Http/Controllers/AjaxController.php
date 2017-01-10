<?php namespace App\Http\Controllers;

use App\Helpers\FormLang;
use App\Helpers\Main;
use App\ProductGallery;
use Illuminate\Http\Request;

class AjaxController extends Controller{

    /**
     * Change language for the system
     * @param Request $request
     * @return array
     */

    public function postChangeLang(Request $request){
        if($request->has('language')){
            return FormLang::setCurrentLang($request->get('language'));
        }else{
            return messageApp(
                'Wrong parameters!',
                'Error',
                'error'
            );
        }
    }

    public function postUploadImage(Request $request)
    {
        $data = $request->all();
        switch($data['controller']){
            case 'product':

                if(!\Session::get('img_position_'.$data['controller'].$data['id_content'])){
                    $position = ProductGallery::where('product_id','=',$data['id_content'])->max('position');
                    \Session::set('img_position_'.$data['controller'].$data['id_content'],$position+1);
                }
                else
                    \Session::set('img_position_'.$data['controller'],\Session::get('img_position')+1);
                break;
        }

        $data['position'] = \Session::get('img_position_'.$data['controller'].$data['id_content']);
        if($request->has('image'))
            return view('inc.image-edit',compact('data'));
    }

}