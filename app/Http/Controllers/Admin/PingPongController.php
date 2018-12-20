<?php
/**
 * Created by PhpStorm.
 * User: Sanzhar Danybayev
 * Date: 3/13/2018
 * Time: 2:45 AM
 */

namespace App\Http\Controllers\Admin;
use \Pingpong\Admin\Controllers\SiteController;

class PingPongController extends SiteController
{
    public function index(){
        return $this->view('admin.pages.index');
    }
}