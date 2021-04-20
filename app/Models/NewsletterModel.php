<?php 
namespace App\Models;

use CodeIgniter\Model;

class NewsletterModel extends Model{
    protected $table      = 'newsletter';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'newsletter_id';
    protected $allowedFields = ['email', 'delete_key'];
}