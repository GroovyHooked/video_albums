<?php
namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'cat_name',
        'path',
        'date',
        'ip',
        'cookie',
        'date_sup'
    ];

    public function insertCategory($cat, $date, $ip)
    {
        $data = [
            'cat_name' => $cat,
            'date' => $date,
            'ip' => $ip
        ];
        $this->insert($data);
    }
    public function getAllCat()
    {
        return $this->get()
                    ->getResult();
    }
    public function getCatWithId($id)
    {
        return $this->where('id', $id)
                    ->get()
                    ->getResult();
    }

    public function deleteCat($id)
    {
        $category = $this->select('cat_name')
                        ->where('id', $id)
                        ->get()
                        ->getResult();

         $this->where('id', $id)
              ->delete();

         return $category;
    }

    public function lastEntry()
    {
        return $this->select('id')
                        ->limit(1)
                        ->orderBy('id', 'DESC')
                        ->get()
                        ->getResult();

    }

}