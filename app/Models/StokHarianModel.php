<?php
namespace App\Models;
use CodeIgniter\Model;

class StokHarianModel extends Model {
    protected $table = 'stok_harian';
    protected $primaryKey = 'id';
    protected $allowedFields = ['alat_berat_id', 'tanggal', 'stok'];
}
