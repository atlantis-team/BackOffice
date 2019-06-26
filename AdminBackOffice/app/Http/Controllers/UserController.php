<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function dataAjax(Request $request)
    {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = User::select("ID", "FirstName", "LastName")->where('FirstName', 'LIKE', "%$search%")->get();
        }

        return response()->json($data);
    }
}
