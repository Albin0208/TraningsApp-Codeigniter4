<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'customers';
    protected $primaryKey = 'customer_id';
    protected $allowedFields = ['firstname', 'lastname', 'username', 'password', 'phone', 'email', 'address', 'city', 'zip_code', 'updated_at'];
    protected $useTimestamps = true;

    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        $data = $this->passwordHash($data);

        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data = $this->passwordHash($data);

        return $data;
    }

    protected function passwordHash(array $data)
    {
        if (!isset($data['data']['password']))
            return $data;

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }

    public function getUser($search)
    {
        if (is_numeric($search))
            return $this->find($search);

        return $this->where('email', $search, true)->first();
    }
}
