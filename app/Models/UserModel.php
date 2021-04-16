<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
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
    
    /**
     * Hämta adressinformationen från databasen
     *
     * @param  string $table Tabellen från vilken datan ska hämtas från
     * @param  int $id Användarens id
     * @return Object Datan
     */
    public function getAddressDetails(string $table, int $id)
    {
        $builder = $this->builder();
        
        if ($table == 'billing')
            $builder->select('firstname, lastname, address, city, zip_code, email, phone');

        $builder->from($table, true)
                ->where('customer_id', $id);

        return $builder->get();
    }
    
    /**
     * Uppdatera en av adress databaserna
     *
     * @param  string $table Tabellen som ska uppdateras
     * @param  int $id Användarens id
     * @param  Array Den nya datan
     * @return Bool Lyckad uppdatering eller inte
     */
    public function updateAddress(string $table, int $id, array $data)
    {
        $builder = $this->builder();
        $builder = $this->db->table($table);

        if ($builder->where('customer_id', $id)->countAllResults() != 0)
            return $builder->update($data, "customer_id = {$id}");
        
        $data['customer_id'] = $id;
        return $builder->insert($data);
    }
}