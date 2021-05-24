<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CostCenter;
use Illuminate\Support\Facades\Auth;

class CostCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $employee = User::with('isManager')->where('id', $user->id)->get();

        $emp_cost_centers = User::with(['costCenter'=>function($query){
            $query->with('manager')->where('delete_flag',0);
        }]);

        if ($user->role === User::ROLE_USER) { // check if employee is admin or (manager or just employee) and display
            $emp_cost_centers = $emp_cost_centers->where('id', $user->id)->orWhere('manager_id', $user->id);
        }

        $emp_cost_centers = $emp_cost_centers->paginate(5); // get employee with costCenters

        //dd($emp_cost_centers);

        return view('cost-center.index',
                    [
                        'employee_cost_centers' => $emp_cost_centers
                    ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $error = '';
        $request->validate([
            'name' => 'required',
        ]);
        $cost_center = CostCenter::find($id);
        if($cost_center){
            $cost_center->name = $request->name;
            $cost_center->save();
        }else{
            $error = 'error';
        }

        return response()->json(['error' => '']);
    }

   /**
     * @param  Request  $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $error = '';
        $success = '';
        $costCenter = CostCenter::where('id', $id)->first();

        $costCenter->delete_flag = 1;

        $costCenter->save();

            $success = 'Deleted';
         // dd($costCenter);

        return response()->json(['error' => $error, 'success' => $success]);
    }
}
