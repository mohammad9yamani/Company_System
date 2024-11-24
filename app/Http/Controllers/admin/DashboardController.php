<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Company;
use App\Models\User;
use App\Models\TransferOfOwnershipDocs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   


    public function view()
    {
        
        return view('admin.adminPage');
    }
    public function profile()
    {
        $htmlSection = view('admin.partial.profile')->render() ;

        return response()->json([ 
            'htmlSection'=> $htmlSection,
        ]);


    }
    public function dashboard()
    {
        $compaines = Company::count();
        $clients = User::count();

        $vehicles =TransferOfOwnershipDocs::count();

        $status1 = TransferOfOwnershipDocs::where('status', 'appending')->count();
        $status2 = TransferOfOwnershipDocs::where('status', 'printed')->count();
        $status3 = TransferOfOwnershipDocs::where('status', 'done')->count();

        $htmlSection = view('admin.partial.dashboard' ,['compaines'=>$compaines,'clients'=>$clients,'vehicles'=>$vehicles,'status1'=>$status1,'status2'=>$status2,'status3'=>$status3])->render() ;

        return response()->json([ 
            'htmlSection'=> $htmlSection,
        ]);


    }

    public function history()
    {
        $companies = Company::all();
        // $users = User::all();
        // $transferDocs = TransferOfOwnershipDocs::all();

        $htmlSection = view('admin.partial.history',['companies' => $companies] )->render() ;// html to text

        return response()->json([ 
            'htmlSection'=> $htmlSection,
        ]);
       

    }
    public function companiesContent()
    {
        $companies = Company::all();
        $htmlSection = view('admin.partial.tables.companies' ,['companies'=> $companies] )->render() ;// html to text


        return response()->json([ 
            'htmlSection'=> $htmlSection,
        ]);

    }

    public function clientsContent()
    {
        $clients = User::all();
        $htmlSection = view('admin.partial.tables.clients' ,['clients'=> $clients] )->render() ;// html to text


        return response()->json([ 
            'htmlSection'=> $htmlSection,
        ]);

    }

   

    public function companyDocsModel(Request $request)
    {
        $company = Company::where('id',$request->id)->first();
        $companyDocs = $company->transfardocs;
        $htmlSection = view('admin.partial.popup.companyDocsModel' ,['companyDocs'=> $companyDocs] )->render() ;// html to text


        return response()->json([ 
            'htmlSection'=> $htmlSection,
        ]);

    }

//     public function clientContent(Request $request)
//     {
// //$users = $user->;
//         $htmlSection = view('admin.partial.tables.clients' ,['companyDocs'=> $companyDocs] )->render() ;// html to text


//         return response()->json([ 
//             'htmlSection'=> $htmlSection,
//         ]);

//     }
    

// transfer filter search 
public function transferFilterContent(Request $request)
{
    $companies = Company::all();
    $htmlSection = view('admin.partial.filters.transferDocsFilters' ,['companies'=> $companies] )->render() ;// html to text


    return response()->json([ 
        'htmlSection'=> $htmlSection,
    ]);

}

public function transferTable(Request $request) {
    $query = TransferOfOwnershipDocs::query();
    //dd($request->company_name);

    if ($request->filled('company_name')) {
        $query->whereHas('company', function($q) use ($request) {
            $q->where('name', $request->company_name);
        });
    }

    if ($request->filled('client_search')) {
        $query->where(function($q) use ($request) {
            $q->where('buyer_national_id', $request->client_search)
              ->orWhere('seller_national_id', $request->client_search)
              ->orWhere('buyer_national_id', 'LIKE', "%{$request->client_search}%")
             ->orWhere('seller_national_id', 'LIKE', "%{$request->client_search}%");
        });
    } 

    if ($request->filled('vehicle_search')) {
        $query->where('vehicles_num', 'LIKE', "%{$request->vehicle_search}%");
    }

    $transferDocs = $query->get();
   

    $htmlSectionTable = view('admin.partial.tables.transferDocs' , ['transferDocs'=> $transferDocs])->render() ;
    return response()->json([ 
        'htmlSectionTable'=> $htmlSectionTable 
    ]);
} 

public function showTransferContract($id) {
    $transfer = TransferOfOwnershipDocs::findOrFail($id);
    return view('admin.partial.tables.transferDocs', compact('transfer'));
}




}
