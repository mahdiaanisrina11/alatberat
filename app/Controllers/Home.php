<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $user = session('user');

        $pesananModel = new \App\Models\PesananModel();
        $menungguPembayaran = [];
    
        if ($user) {
            $menungguPembayaran = $pesananModel
                ->where('user_id', $user['id'])
                ->where('status_pembayaran', 'menunggu pembayaran')
                ->findAll();
        }
    
        return view('index', [
            'menungguPembayaran' => $menungguPembayaran
        ]);
    
        return view('index');
    }

}
