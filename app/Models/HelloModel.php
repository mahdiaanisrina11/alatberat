<?php
namespace App\Models;
use CodeIgniter\Model;

class HelloModel extends Model
{
    protected $table = 'hello';
    protected $allowedFields = ['message'];
}
