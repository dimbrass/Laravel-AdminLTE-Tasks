<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EditUserRolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request)
    {
        $user_id = $request->user_id;
        $role    = $request->role;

        $result = DB::table('userroles')->where('user_id', $user_id)->update([$role => '1']);

        return response()->json(['success'=> $result, 'error'=>'error', 'role'=>$role, 'user_id'=>$user_id]);
    }

    public function del(Request $request)
    {
        $user_id = $request->user_id;
        $role    = $request->role;

        $result = DB::table('userroles')->where('user_id', $user_id)->update([$role => '0']);

        return $role.'-'.$user_id;        // response()->json(['success'=> $result, 'error'=>'error', 'role'=>$role, 'user_id'=>$user_id]);
    }
}
