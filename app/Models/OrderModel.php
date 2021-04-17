<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table      = 'orders';
    protected $primaryKey = 'order_id';

    protected $allowedFields = ['customer_id', 'email', 'firstname', 'lastname', 'address', 'zip_code', 'city', 'phone', 'order_price', 'quantity', 'discount_value', 'shipping', 'order_number'];

    protected $beforeInsert = ['beforeInsert'];

    protected function beforeInsert(array $data)
    {
        $data = $this->generateOrderNumber($data);

        return $data;
    }

    private function generateOrderNumber(array $data)
    {
        /*
          Om vi har användare hämta användar id, ta användar id och lägg till ett random 7 nummer tal.
          Finns inte en användare slumpa fram ett nummer

          efter numret är genererat kolla att en order med det numret inte finns,
            finns numret ska ett nytt slumpat tal skapas

            do-while om numret redan existerar
                generera nytt nummer
        */

        $customerID = $data['data']['customer_id'] ?? mt_rand(0, 9999);
        $orderNumber = $customerID;

        do {
            $orderNumber = $customerID . mt_rand(1000000, 9999999);
        } while ($this->where('order_number', $orderNumber)->first());

        $data['data']['order_number'] = $orderNumber;

        return $data;
    }
}