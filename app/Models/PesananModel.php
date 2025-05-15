<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'id';
    
    protected $allowedFields = [
        'alat_berat_id', 
        'alat_nama', 
        'tanggal', 
        'durasi',
        'satuan_waktu',        
        'jumlah', 
        'harga_satuan', 
        'total_harga', 
        'nama', 
        'telepon', 
        'email',         
        'va',            
        'created_at',
        'user_id', 
        'nik',          
        'alamat',       
        'status_pembayaran', 
        'status_sewa',
        'bukti_pembayaran'
    ];
}
