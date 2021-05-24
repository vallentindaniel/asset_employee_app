<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CostCenter;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(){
        if(Auth::user()->manager_id != null){
            $emp = User::with('manager','costCenter')->find(Auth::user()->id);
        }else{
            if(Auth::user()->cost_center_id != null)
                $emp = User::with('costCenter')->find(Auth::user()->id);
            else
                $emp = User::find(Auth::user()->id);
        }


        //dd($emp);
        return view('dashboard.account.profile', ['employee' => $emp ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProfile( Request $request)
    {
        $cost_centers = CostCenter::all();
        $emp = Auth::user();
        if ($request->isMethod('post')) {
           if(is_null(Auth::user()->cost_center_id)){
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                    'cost_center' => 'required'
                ]);
           }else{
                $request->validate([
                    'name' => 'required',
                    'email' => 'required|email'
                ]);
           }

            $employee = User::find( $emp->id);

            $employee->name = $request->name;
            $employee->email = $request->email;

            if(is_null( $emp->cost_center_id)){
                $employee->cost_center_id = $request->cost_center;
            }

            $employee->save();
            $error = 'Success';

            return view('dashboard.account.editProfile', ['error' => $error,'cost_centers' =>$cost_centers, 'employee' => $employee]);

        }
        return view('dashboard.account.editProfile', ['cost_centers' =>$cost_centers, 'employee' => $emp]);
    }



}
