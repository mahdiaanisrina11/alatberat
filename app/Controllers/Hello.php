<?php
namespace App\Controllers;
use App\Models\HelloModel;

class Hello extends BaseController
{
    public function index()
    {
        $model = new HelloModel();
        $data = $model->first(); // ambil baris pertama

        return view('hello_view', ['msg' => $data['message']]);
    }
}
