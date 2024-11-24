<?php 
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class profileController extends Controller{

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8',
        ]);


        return redirect()->route('admin.index')->with('success', 'Admin created successfully!');
    }

    public function view()
    {
        
        return view('admin.adminPage',);
    }

    public function edit(Request $request)
    {
        return view('admin.edit');
    }

    



    public function updateName(Request $request){
        $user=admin::find(Auth::guard('admin')->user()->id);
        if ($user){
            $user->name=$request->newName;
            $user ->save();
            return response()->json([
                'success' => 200 ,
                'message'=> 'sucssfuly update'
                ]);
    }else{
        return response()->json([ 
            'status'=> 404,
            'message'=> ' error '
            ]);
        }
    }

    public function updateEmail(Request $request){
        $user=admin::find(Auth::guard('admin')->user()->id);
        if ($user){
            $user->email=$request->newEmail;
            $user ->save();
            return response()->json([
                'success' => 200 ,
                'message'=> 'sucssfuly update'
                ]);
    }else{
        return response()->json([ 
            'status'=> 404,
            'message'=> ' error '
            ]);
        }
    }


 
public function changePasswordUpdate(Request $request){
$user=admin::find(Auth::user()->id);
if (trim($request->input('new_password')) == trim($request->input('confirm_password'))){
    if (trim($request->input('old_password')) == trim($user->password)){

        $user->password =$request->input('new_password');
        $user->save();
        return  response()->json(['success'=>'password successfuly change']);
    }else{ 
        return response()->json(['error'=>'invalde password ']);
     }
}
   else{
        return  response()->json(['error'=>'password  No confarim ']);
    }
}
}
