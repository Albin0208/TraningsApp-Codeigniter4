<?php 
namespace App\Models;

use CodeIgniter\Model;

class CategoriesModel extends Model{
    protected $table      = 'productcategories';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'catogery_id';
}