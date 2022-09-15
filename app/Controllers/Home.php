<?php

namespace App\Controllers;

use App\Models\Counterbis;
use App\Models\Video;
use App\Models\Counter;
use App\Models\Category;
session_start();

date_default_timezone_set('Europe/Belgrade');


class Home extends BaseController
{

    public function index()
    {
        $this->metrics();
        $Cat = new Category();
        $catData = $Cat->getAllCat();
        $desc = [];
        foreach ($catData as $data) {
            array_push($desc, [$data->cat_name, $data->path, $data->id]);
        }
        $data = [
            'data' => $desc,
            'title' => 'Album photo et vidéo',
            'css' => '/assets/css/style.css',
            'javascript' => base_url('/assets/js/home.js')
        ];
        echo view('template/header', $data);
        echo view('index');
        echo view('template/footer', $data);
    }

    public function galery()
    {
        $this->metrics();
        $data = [
            'title' => 'Album photo',
            'css' => '/assets/css/galery.css',
            'javascript' => base_url('/assets/js/main.js')
        ];
        echo view('template/header', $data);
        echo view('galery');
        echo view('template/footer', $data);
    }

    public function video1()
    {
        $this->metrics();
        $bdd = new Video();
        $request = $bdd->getData('video');
        $data = [
            'bdd' => $request,
            'title' => 'Album vidéo',
            'css' => '/assets/css/video.css',
            'javascript' => base_url('/assets/js/video.js'),
        ];
        echo view('template/header', $data);
        echo view('video');
        echo view('template/footer', $data);
    }

    public function video2()
    {
        $bdd = new Video();
        $request = $bdd->getData('video2');
        $data = [
            'bdd' => $request,
            'title' => 'Album vidéo',
            'css' => '/assets/css/video.css',
            'javascript' => base_url('/assets/js/video.js')
        ];
        echo view('template/header', $data);
        echo view('video');
        echo view('template/footer', $data);
    }

    public function video3()
    {
        $this->metrics();
        $bdd = new Video();
        $request = $bdd->getAllData();
        $data = [
            'bdd' => $request,
            'title' => 'Toutes les vidéo',
            'css' => '/assets/css/video.css',
            'javascript' => base_url('/assets/js/video.js')
        ];
        echo view('template/header', $data);
        echo view('video');
        echo view('template/footer', $data);
    }

    public function upload1()
    {
        helper(['form', 'url']);
        $this->metrics();
        $database = \Config\Database::connect();
        $db = $database->table('video');

        $input = $this->validate([
            'file' => [
                'uploaded[file]',
                'mime_in[file,video/mp4,video/webm,video/quicktime]',
                'max_size[file,102400]',
            ],
            'img' => [
                'uploaded[img]',
                'max_size[img,8024]'
            ]
        ]);

        if (!$input) {
            $result_message = '<div class="result-error">' .
                '<p>Veuillez faire attention à l\'extension de vos fichiers</p>' .
                '<p>Tous les champs sont requis</p>' .
                '<p>Les extensions d\'images acceptées sont les suivantes:</p>' .
                '<ul>' .
                '<li>.png</li>' .
                '<li>.jpg</li>' .
                '<li>.jpeg</li>' .
                '</ul>' .
                '<p>Les extensions de vidéos acceptées sont les suivantes:</p>' .
                '<ul>' .
                '<li>.mp4</li>' .
                '<li>.MOV (vidéos iPhone et iPad)</li>' .
                '</ul>' .
                '<p>Voici un site web de conversion de fichiers vidéos: <a href="https://video-converter.com/fr/" target="_blank">https://video-converter.com/fr/</a>.' .
                ' <strong>Les formats de photos et vidéos provenant d\'iPhone sont supportés</strong>' . '</p>' .
                '</div>';
        } else {
            $vid = $this->request->getFile('file');
            $vid->move('./assets/videos');

            $img = $this->request->getFile('img');
            $img->move('./assets/img/thumbs');

            $category = $this->request->getPost('cat');
            $desc = $this->request->getPost('desc');
            $InsertData = [
                'description' => $desc,
                'path' => '/assets/videos/' . $vid->getName(),
                'page' => $category,
                'thumb' => '/assets/img/thumbs/' . $img->getName(),
                'type' => $vid->getClientMimeType()
            ];

            $save = $db->insert($InsertData);
            $result_message = '<div class="result-error result-success">' .
                '<p>Les fichiers ont été correctement téléversés</p>' .
                '<p>Vous pouvez visionner votre vidéo en vous rendant dans l\'album que vous lui avez attribuée:</p>' .
                '<a href="' . base_url('/') . '">Accueil</a>' .
                '</div>';
            $this->sendMail();
        }
        $Cat = new Category();
        $catData = $Cat->getAllCat();
        $desc = [];
        foreach ($catData as $data) {
            array_push($desc, [$data->cat_name, $data->path, $data->id]);
        }
        $data = [
            'response' => $result_message,
            'title' => 'Upload',
            'dataCat' => $desc,
            'css' => '/assets/css/upload.css',
            'javascript' => base_url('/assets/js/upload.js')
        ];
        echo view('template/header', $data);
        echo view('upload');
        echo view('template/footer', $data);
    }

    public function uploaded()
    {
        $this->metrics();
        $bdd = new Video();
        $request = $bdd->uploaded();
        $data = [
            'bdd' => $request,
            'title' => 'Toutes les vidéos uploadées',
            'css' => '/assets/css/video.css',
            'javascript' => base_url('/assets/js/video.js')
        ];
        echo view('template/header', $data);
        echo view('video');
        echo view('template/footer', $data);
    }

   public function category()
   {

       helper(['form', 'url']);
       $this->metrics();
       $Cat = new Category();
       $catData = $Cat->getAllCat();
       $database = \Config\Database::connect();
       $db = $database->table('categorie');
       $input = $this->validate([
           'img' => [
               'uploaded[img]',
               'max_size[img,8024]'
           ]
       ]);

       if (!$input) {
           $result_message = '<div class="result-error">' .
               '<strong>Vous pouvez créer votre propre album vidéo dans lequel vous pourrez y déposer vos court-métrages. Il vous sera également possible de le supprimer lorsque vous le désirerez.</strong>' .
               '<p>Veuillez faire attention à l\'extension de vos fichiers</p>' .
               '<p>Tous les champs sont requis</p>' .
               '<p>Les extensions d\'images acceptées sont les suivantes:</p>' .
               '<ul>' .
               '<li>.png</li>' .
               '<li>.jpg</li>' .
               '<li>.jpeg</li>' .
               '</ul>' .
               '</div>';
       } else {

           $ip = $_SERVER['REMOTE_ADDR'];
           $date = date('Y-m-d H:i:s');

           $img = $this->request->getFile('img');
           $img->move('./assets/img/cat');

           $desc = $this->request->getPost('desc');
           //$newDesc = str_replace(' ', '-', $desc);
           $InsertData = [
               'cat_name' => $desc,
               'path' => '/assets/img/cat/' . $img->getName(),
               'date' => $date,
               'ip' => $ip
           ];
           $save = $db->insert($InsertData);
           $CatId = new Category();
           $id = $CatId->lastEntry();
           if (isset($id)){
               $pathId = $id[0]->id;
           }
           $result_message = '<div class="result-error result-success">' .
               '<p>La nouvelle catégorie à été correctement créée</p>' .
               '<p>Vous la verrez apparaître sur la page d\'accueil.</p>' .
               '<a href="' . base_url('/cat'). '/'.$pathId .'">Nouvel Album</a>' .
               '</div>';
       }

       $data = [
           'cat' => $catData,
           'response' => $result_message,
           'title' => 'Création de catégorie',
           'css' => '/assets/css/category.css',
           'javascript' => base_url('/assets/js/category.js')
       ];
       echo view('template/header', $data);
       echo view('addCategory');
       echo view('template/footer', $data);
   }

   public function cat($id)
   {
       $this->metrics();
       $Cat = new Category();
       $category = $Cat->getCatWithId($id);
       $desc = [];
       $i = 0;
       foreach ($category as $data) {
           $desc['ip'] = $data->id;
           $desc['cat_name'] = $data->cat_name;
           $desc['path'] = $data->path;
       }
       $Vid = new Video();
       $result = $Vid->getData($desc['cat_name']);
       $data = [
           'bdd' => $result,
           'title' => '',
           'css' => '/assets/css/video.css',
           'javascript' => base_url('/assets/js/video.js')
       ];
       echo view('template/header', $data);
       echo view('video');
       echo view('template/footer');
   }
    public function deleteCat()
    {
        $Cat = new Category();
        $id = $this->request->getPost('catid');
        $del = $Cat->deleteCat($id);
        $category = $del[0]->cat_name;
        $Vid = new Video();
        $Vid->deleteVids($category);
        return redirect()->to('/');
        /*$data = [
            'bdd' => $foo,
            'title' => '',
            'css' => '',
            'javascript' => ''
        ];

        echo view('template/header', $data);
        echo view('dev/test2');
        echo view('template/footer');*/
    }

    public function test()
    {
        $data = [
            'bdd' => '$request',
            'title' => 'Toutes les vidéos uploadées',
            'css' => '',
            'javascript' => base_url('')
        ];
        echo view('template/header', $data);
        echo view('dev/video2');
        echo view('template/footer');
    }

    function sendMail()
    {
        $email = \Config\Services::email();
        $config = [
            'mailType' => 'html'
        ];
        $email->initialize($config);
        $email->setFrom('album.video@gmail.com', 'Album Video');
        $email->setTo('dafrenchie2002@yahoo.fr');
        $email->setSubject('Album Vidéo');
        $email->setMessage('<h1 style="color: red">Vidéo uploadée</h1> ');
        //$email->attach('https://www.orimi.com/pdf-test.pdf');
        $email->send();
    }

    function metrics()
    {
            $bdd = new Counter();
            $ip = $_SERVER['REMOTE_ADDR'];
            $port = $_SERVER['REMOTE_PORT'];
            $date = date('Y-m-d H:i:s');
            if (empty($_SERVER['HTTP_USER_AGENT'])) {
                $userAgent = 'Inconnu';
            } else {
                $userAgent = $_SERVER['HTTP_USER_AGENT'];
            }
            $boolIp = $bdd->doesIpExists($ip);
            if ($boolIp === false) {
                $bdd->insertInCounter($ip, $date, 1, $port, $userAgent);
            } else {
                $views = $bdd->getViews($ip);
                $bdd->incrementViews($ip, $views, $date);
            }
    }

    public function other()
    {

        //$ccokie = $this->metrics2();

        $data = [
            'cookie' => '$ccokie',
            'title' => 'Toutes les vidéos uploadées',
            'css' => '/assets/css/video_bis.css',
            'javascript' => base_url('/assets/js/video_bis.js')
        ];
        echo view('dev/test_header', $data);
        echo view('dev/test2');
        echo view('template/footer', $data);
    }
    function metrics2()
    {
        $bdd = new Counterbis();
        $cookie = $_COOKIE['pictures_met_id'];
        $boolIp = $bdd->doesCookieExists($cookie);
        $date = date('Y-m-d H:i:s');
        if ($boolIp) {
            $views = $bdd->getViewsWq($cookie);
            $bdd->incrementViewsWq($cookie, $views, $date);
        } else {
            $uniqId = uniqid();
            setcookie('pictures_met_id', $uniqId, 31536000, '/');
            $cookie = $uniqId;
            $bdd = new Counterbis();
            $ip = $_SERVER['REMOTE_ADDR'];
            $port = $_SERVER['REMOTE_PORT'];
            $date = date('Y-m-d H:i:s');
            if (empty($_SERVER['HTTP_USER_AGENT'])) {
                $userAgent = 'Inconnu';
            } else {
                $userAgent = $_SERVER['HTTP_USER_AGENT'];
            }
            $bdd->insertInCounterBis($ip, $date, 1, $port, $userAgent, $cookie);
        }

        return $cookie;

    }
}
