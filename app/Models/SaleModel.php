<?php 
namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model{
    protected $table      = 'sale';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'sale_id';
    protected $allowedFields = ['sale_name', 'sale_value', 'value_type', 'number_of_products'];
}