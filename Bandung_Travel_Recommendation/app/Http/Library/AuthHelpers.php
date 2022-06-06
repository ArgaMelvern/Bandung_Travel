<?php
namespace App\Http\Library;

use Session;

trait AuthHelpers{
  protected function onUnauthorized()
  {
    if(!Session::has('user')){
      abort(403, 'Unauthorized action.');
    }else if(Session::get('user')->role != "admin"){
      abort(403, 'Unauthorized action.');
    }
  }
}
