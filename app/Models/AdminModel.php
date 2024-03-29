<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class AdminModel
{
    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }
        
    /**
     * Räkna antalet poster i en tabell
     *
     * @param  string $table Vilken tabell som ska räknas
     * @return int
     */
    public function countFromTable(string $table) : int
    {
      $builder = $this->db->table($table);

      return $builder->countAll();
    }
        
    /**
     * Räkna ut de totala intäkterna
     *
     * @return int
     */
    public function getTotalRevenue() : int
    {
      $builder = $this->db->table('orders');

      $array = $builder->selectSum('order_price')
                       ->selectSum('shipping')
                       ->get()
                       ->getResultArray();

      return $array[0]['order_price'];
    }
    
    /**
     * Hämta senaste inläggen från en tabell
     *
     * @param  string $table Från vilken tabell
     * @return void
     */
    public function getLatest(string $table)
    {
      $builder = $this->db->table($table);

      return $builder->orderBy('created_at', 'DESC')
                     ->get(3)
                     ->getResultArray();
    }
    
    /**
     * Hämta produkterna som är med i en kampanj
     *
     * @param  int $saleID Id för kampanjen
     * @return array Produkterna
     */
    public function getProductsOnSale(int $saleID)
    {
      $builder = $this->db->table('products_on_sale');

      return $builder->where('sale_id', $saleID)
                     ->join('products', 'products.product_id = products_on_sale.product_id')
                     ->join('productcategories', "category_id = type")
                     ->get()
                     ->getResultArray();
    }
}