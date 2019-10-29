<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditUserRolesController extends Controller
{
    public function add()
    {
        return response()->json(['success'=>'Got Simple Ajax Request.']);
    }
}
