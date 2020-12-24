<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends ParentAdminController
{
    public function index(){
        return view('admin.adminhome');
    }

    public function doctor(){

        $doctors = User::where('user_level', 2)
                        ->orderBy('name', 'desc')
                        ->get();

        return view('admin.doctors') -> with('doctors',$doctors);
    }

    public function addDoctorPage(){
        return view('admin.addDoctor');
    }

    public function addDoctorDB(Request $request){
        $user = new User();

        $user -> name = request('name');
        $user -> email = request('email');
        $user -> user_level = request('user_level');
        $user -> password = Hash::make(request('password'));
        $user -> firstname = request('firstname');
        $user -> lastname = request('lastname');
        $user -> birthdate = request('birthdate');
        $user -> gender = request('gender');
        $user -> address = request('address');
        $user -> spec = request('spec');
        $user -> city = request('city');
        $user -> postal_code = request('postal_code');
        $user -> phone = request('phone');
        $user -> bio = request('bio');
        $user -> status = request('status');

        if ($request -> hasFile('user_image')) {
            $file = $request -> file('user_image');
            $extension = $file -> getClientOriginalExtension(); //getting image extension
            $filename = time().'.'.$extension;
            $file -> move('uploads/doctorsProfile', $filename);
            $user -> user_image = $filename;
        }
        else{
            $user -> user_image = '';
        }

//        dd($user);

        $user->save();

        return redirect('/ehr/admin/addDoctor') -> with('msg','Data inserted successfully');
    }
}
