<?php
namespace App\Models;
use CodeIgniter\Model;

class AlatBeratModel extends Model {
    protected $table = 'alat_berat';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'stok_default', 'harga_jaman', 'harga_harian', 'harga_mingguan', 'harga_bulanan', 'deskripsi', 'gambar', 'created_at'];
    protected $useTimestamps = false;
}
