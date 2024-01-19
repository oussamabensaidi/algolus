<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Role;
use App\Models\Specialiter;

class dashController extends Controller
{


public function index(){

return view("dash.index");

}
public function login(){

return view("dash.login");

}

public function register(){
    $service= Service::all();
    $role= Role::all();   
    $specialiter= Specialiter::all();
return view("dash.register",['service'=>$service ,'role'=> $role ,'specialiter'=>$specialiter]);

}






}
