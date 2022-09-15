<?php
namespace App\Models;

use CodeIgniter\Model;

class Counterbis extends Model
{
    protected $table = 'statsbis';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields = [
        'ip',
        'date_visite',
        'pages_vues',
        'last_visit',
        'port',
        'user_agent',
        'cookie'
    ];

    public function doesIpExists($ip): bool
    {
        $query = $this->getWhere(['ip' => $ip], 1)
            ->getResult();
        if(empty($query)) {
            return false;
        }
        return true;
    }

    public function doesCookieExists($cookie): bool
    {
        $query =  $this->select('cookie')
                       ->where('cookie', $cookie)
                        ->get()
                       ->getResult();
        if(empty($query)) {
            return false;
        }
        return true;
    }

    public function getViews($ip): int
    {
        $query = $this->select('pages_vues')
            ->where('ip', $ip)
            ->get()
            ->getFirstRow();
        return $query->pages_vues;
    }

    public function getViewsWq($cookie): int
    {
        $query = $this->select('pages_vues')
            ->where('cookie', $cookie)
            ->get()
            ->getFirstRow();
        return $query->pages_vues;
    }
    public function insertInCounter(string $ip, string $date, int $views, int $port, string $userAgent): bool
    {
        $data = [
            'ip' => $ip,
            'date_visite' => $date,
            'pages_vues' => $views,
            'port' => $port,
            'user_agent' => $userAgent
        ];
        if($this->insert($data)) return true;
        return false;
    }

    public function insertInCounterBis(string $ip, string $date, int $views, int $port, string $userAgent, string $cookie): bool
    {
        $data = [
            'ip' => $ip,
            'date_visite' => $date,
            'pages_vues' => $views,
            'port' => $port,
            'user_agent' => $userAgent,
            'cookie' => $cookie
        ];
        if($this->insert($data)) return true;
        return false;
    }

    public function incrementViews( string $ip, int $value, string $date)
    {
        return $this->set('pages_vues', $value + 1)
            ->set('last_visit', $date)
            ->where('ip', $ip)
            ->update();
    }

    public function incrementViewsWq( string $cookie, int $value, string $date)
    {
        return $this->set('pages_vues', $value + 1)
            ->set('last_visit', $date)
            ->where('cookie', $cookie)
            ->update();
    }

    public function insertCookie(int $ip, string $cookie): bool
    {
        return $this->set('cookie', $cookie)
            ->where('ip', $ip)
            ->update();

    }
}