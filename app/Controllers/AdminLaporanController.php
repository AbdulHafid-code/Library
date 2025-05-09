<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BukuModel;
use App\Models\RatingModel;
use App\Models\FavoritModel;
use App\Models\PinjamModel;

class AdminLaporanController extends BaseController
{
    public function index()
    {

        

        return view('adminPages/adminLaporan/index');
    }
}
