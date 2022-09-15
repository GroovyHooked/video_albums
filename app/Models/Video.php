<?php
namespace App\Models;

use CodeIgniter\Model;

class Video extends Model
{
    protected $table = 'video';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'description',
        'path',
        'page',
        'thumb',
        'type'
    ];

    public function getData($page)
    {
        $query = $this->where('page', $page)
            ->get()
            ->getResult();
        $result = json_encode($query);
        return json_decode($result);
    }

    public function getAllData()
    {
        return $this
            ->orderBy('id', 'DESC')
            ->get()
            ->getResult();
    }
    public function uploaded()
    {
        return $this->where('page', 'upload')
            ->orderBy('id', 'DESC')
            ->get()
            ->getResult();
    }
    public function deleteVids($category)
    {
        $this->where('page', $category)
              ->delete();
    }
}
