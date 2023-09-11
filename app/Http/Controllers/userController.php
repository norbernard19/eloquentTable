<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function indexPage(){
        
        return view('layout.index');
    }

    public function listPage(){
        
        return view('page.tableList');
    }

}
