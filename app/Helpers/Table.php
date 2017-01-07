<?php namespace App\Helpers;
/**
 * Created by PhpStorm.
 * User: yura
 * Date: 08.03.16
 * Time: 14:02
 */

class Table {

    public $dataModel;

    public $isMultiLang = false;

    public $columns = [];

    public $controller = '';

    public $by_position = false;

    public $actionGroupDelete = true;

    public $actionGroupActive = true;

    public $actionGroupDeselect = true;

    public $actionGroupRecovery = false;

    public $imageTable = false;

    public function getView($data = null)
    {


        if($data === null)
            $data = $this->getData();

        $data['header'] = $this->columns;
        $data['by_position'] = $this->by_position;
        $data['active'] = $this->actionGroupActive;
        $data['de_active'] = $this->actionGroupDeselect;
        $data['delete'] = $this->actionGroupDelete;
        $data['recovery'] = $this->actionGroupRecovery;
        $data['isImage'] = $this->imageTable;


        return view('inc.table.index')->with(['data'=>$data,'controller'=>$this->controller]);
    }

    private function getData()
    {
        if($this->isMultiLang){
            $tempo_locale = \App::getLocale();
            \App::setLocale(FormLang::getCurrentLang());
            if($this->by_position)
                $data['data'] = $this->dataModel->orderBy('position', 'asc')->get()->toArray();
            else
                $data['data'] = $this->dataModel->orderBy('created_at', 'desc')->get()->toArray();
            \App::setLocale($tempo_locale);
        }else{
            $data['data'] = $this->dataModel->all()->toArray();
        }

        $data['header'] = $this->columns;
        $data['by_position'] = $this->by_position;
        $data['active'] = $this->actionGroupActive;
        $data['de_active'] = $this->actionGroupDeselect;
        $data['delete'] = $this->actionGroupDelete;
        $data['recovery'] = $this->actionGroupRecovery;
        $data['isImage'] = $this->imageTable;

        return $data;
    }

}