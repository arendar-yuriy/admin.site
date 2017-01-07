<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\UploadImage;

class DropzoneController extends Controller
{
    /**
     * Upload image methods
     *
     * @var UploadRepository
     */
    protected $uploadRepository;

    public function __construct(UploadImage $uploadRepository)
    {
        $this->uploadRepository =  $uploadRepository;
    }

    /**
     * Receive post requests from Dropzone
     *
     * @return mixed
     */
    public function postUpload(Request $request,$type)
    {
        $input = $request->all();
        $response = $this->uploadRepository->upload($input,$type);
        return $response;
    }

    public function postDelete(Request $request,$type,$id)
    {
        $response = $this->uploadRepository->delete($request->input('id'),$type,$id);
        return $response;
    }

    public function postUploadImage(Request $request)
    {
        $data = $request->all();


        $data['position'] = \Session::get('img_position_'.$data['controller'].$data['id_content']);
        $data['path'] = \Config::get('admin.image_url').$data['controller'].'/'.$data['id_content'].'/'.$data['image'];
        if($request->has('image'))
            return view('inc.image-edit',compact('data'));
    }




}