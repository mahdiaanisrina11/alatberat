<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama', 'email', 'password', 'role'];

    protected $useTimestamps = false;

    protected $skipValidation = false; // Wajib biar validasi jalan
    protected $validationRules = [
        'nama' => 'required|min_length[3]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
    ];
}
