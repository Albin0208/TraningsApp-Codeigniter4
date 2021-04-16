<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class UserModel
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }

    public function test()
    {
      $builder = $this->db->table('mytable');
    }
}