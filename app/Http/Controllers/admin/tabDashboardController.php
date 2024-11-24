<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class tabDashboardController extends Controller
{
    public function profile()
    {
        
        $htmlSection = view('admin.partial.dashboard')->render() ;

        return response()->json([ 
            'htmlSection'=> $htmlSection,
        ]);


    }

}