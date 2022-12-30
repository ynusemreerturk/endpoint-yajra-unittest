<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Validator;

class Yajra extends Controller
{
    public function register(Request $request)
    {
        $rules = Validator::make($request->all(),
            [
                'name' => 'required  | min:3 | regex:/^[a-zA-Z şŞıİçÇöÖüÜĞğ]+$/',
                'email' => 'required | email | unique:users,email',
                'password' => ['required' , 'min:6' , 'confirmed' , 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z şŞıİçÇöÖüÜĞğ])(?=.*[0-9])(?=.*[\d\x])(?=.*[.,;₺!$#%]).*$/'],
            ]);
        if ($rules->fails()) {
            return redirect()->back()->withErrors($rules)->withInput();
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect()->route('yajra');
    }
    public function usersFetch(Request $request){
        $user = User::all();
        return DataTAbles::of($user)
            ->make(true);
    }
}
