<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\AssetUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $employee = User::where('id','<>',$user->id )->where('cost_center_id', $user->cost_center_id)->select('id', 'name')->get();

        $asset_users = AssetUser::with('employee')->with('asset', function($query){
            $query->with('costCenter');
        })->where('owner', 1);

        if ($user->role === User::ROLE_USER) {
            $asset_users = $asset_users->where('employee_id',$user->id);
        }

        $asset_users = $asset_users->orderBy('end_of_life', 'ASC')->paginate(3);

        return view('asset.index',[
            'asset_users' => $asset_users,
            'employee' => $employee
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $error = '';
        $validated = $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'input_date' => 'required|date',
            'from' => 'required',
            'input_to' => 'required',
        ]);

         if($validated){
            $asset = new Asset();
            $asset->name = $request->name;
            $asset->description = $request->description;
            $asset->input_date = $request->input_date;
            $asset->cost_center_id = Auth::user()->cost_center_id;

            $asset->save();

            $asset_id = $asset->id;

            $asset_employee = new AssetUser();

            $asset_employee->asset_id = $asset_id;
            $asset_employee->employee_id =  Auth::user()->id;
            $asset_employee->from = $request->from;
            $asset_employee->to = $request->input_to;
            $asset_employee->owner = 1;

            $asset_employee->save();
         }else{
               $error = 'Please complete the form.';
         }


        return response()->json(['error' => $error], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($asset_id, $employee_id)
    {
        $user = Auth::user();

        $asset_users = AssetUser::with('employee')->with('asset', function($query){
            $query->with('costCenter');
        })->where('end_of_life',false)->where('owner', true);

        $asset_users = $asset_users->where('asset_id',$asset_id)->where('employee_id', $employee_id);

        $asset_users = $asset_users->get();

        $asset_owners =  AssetUser::select('asset_id')->where('asset_id', $asset_id)->groupBy('asset_id')->count();

        $list_old_owners = AssetUser::with('employee')->where('asset_id',$asset_id)->orderBy('created_at', 'DESC')->get();

        return view('asset.show',[
            'asset_user' => $asset_users[0],
            'asset_owners' => $asset_owners,
            'list_old_owners' =>$list_old_owners
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $error = '';
        $validated = $this->validate($request,[
            'asset_id' =>'required',
            'employee_id' => 'required',
            'name' => 'required',
            'description' => 'required',
            'input_date' => 'required|date',
            'from' => 'required',
            'input_to' => 'required',
        ]);
         if($request->owner_id && !isset($request->test) ){
            $previousAsset_employee = AssetUser::where('asset_id', $request->asset_id)->where('employee_id', $request->employee_id)->first();
            $previousAsset_employee->owner = false;
            $previousAsset_employee->save();

            $currentAsset_employee = new AssetUser();
            $currentAsset_employee->asset_id = $request->asset_id;
            $currentAsset_employee->employee_id =$request->owner_id;
            $currentAsset_employee->from = $request->from;
            $currentAsset_employee->to = $request->input_to;
            $currentAsset_employee->owner = true;
            $currentAsset_employee->save();

         }else{
            $asset = Asset::where('id', $request->asset_id)->first();
            $asset_employee = AssetUser::where('asset_id', $request->asset_id)->where('employee_id', $request->employee_id)->first();
            $employee = User::where('id', $request->employee_id)->first();
            if($validated && $asset && $asset_employee && $employee){
                $asset->name = $request->name;
                $asset->description = $request->description;
                $asset->input_date = $request->input_date;
                $asset->save();

                $asset_employee->from = $request->from;
                $asset_employee->to = $request->input_to;

                if($request->end_of_life)
                   $asset_employee->end_of_life = true;

                $asset_employee->save();
            }else{
                $error = 'Please try again';
            }
        }
         return response()->json(['error' => $error], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $error = '';
        $validated = $this->validate($request,[
            'asset_id' =>'required',
            'employee_id' => 'required'
        ]);

         $asset_employee = AssetUser::where('asset_id', $request->asset_id)->where('employee_id', $request->employee_id)->first();

         $asset_employee->end_of_life = true;

         $asset_employee->save();

         //return $asset_employee;

        return response()->json(['error' => $error], 200);
    }
}
