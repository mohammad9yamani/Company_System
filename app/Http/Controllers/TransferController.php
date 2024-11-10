<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\OTPService;
use App\Models\TransferOfOwnershipDocs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class TransferController extends Controller
{
    protected $otpService;

    public function __construct(OTPService $otpService)
    {
        $this->otpService = $otpService;
    }

    public function showTransferPage()
    {

        return view('main');
    }

    
    public function fetchData(Request $request)
    {

        $this->saveSessionData($request);

        $moveToNextStep = $request->input('MoveToNextStep');



        $buyerData = [
            'name' => 'Buyer Name',
            'phone' => '+962790963251',
            'national_id' => $request->input('buyer_national_id'),
        ];

        $sellerData = [
            'name' => 'Seller Name',
            'phone' => '+962790963251',
            'national_id' => $request->input('seller_national_id'),
        ];

        $vehicleData = [
            'vehicle_number' => $request->input('vehicles_num'),
            'make' => 'Toyota',
            'model' => 'Corolla',
            'year' => '2020',
        ];

        if($moveToNextStep === 'true') Session::put('transfer_step', 2);

        return response()->json(compact('buyerData', 'sellerData', 'vehicleData'));
    }

    public function sendOTP(Request $request)
    {

        $phone = '+962790963251';
        $otp = $this->otpService->sendOTP($phone, Auth::id());

        // Save OTP in session with step update
        Session::put("otp_{$request->type}", $otp);
        Session::put("otp_sent_{$request->type}", true);

        return response()->json(['message' => 'OTP sent']);
    }

    public function verifyOTP(Request $request)
    {
        $type = $request->input('type');
        $otp = $request->input('otp');

        $storedOtp = Session::get("otp_{$type}");

        if ($otp == $storedOtp) {
            Session::put("{$type}_verified", true);
            $this->checkVerificationCompletion();
            return response()->json(['success' => true, 'message' => "{$type} OTP verified"]);
        } else {
            return response()->json(['success' => false, 'message' => 'OTP verification failed'], 422);
        }
    }

    public function checkVerificationCompletion()
    {

        $buyerVerified = Session::get('buyer_verified', false);
        $sellerVerified = Session::get('seller_verified', false);
    

        if ($buyerVerified && $sellerVerified) {
            Session::put('transfer_step', 3);
            return response()->json(['buyerVerified' => true, 'sellerVerified' => true, 'step' => 3]);
        } else {
            
            return response()->json([
                'buyerVerified' => $buyerVerified,
                'sellerVerified' => $sellerVerified,
                'step' => Session::get('transfer_step', 2)
            ]);
        }
    }


    public function createTransferRecord(Request $request)
    {

        $buyerVerified = Session::get('buyer_verified', false);
        $sellerVerified = Session::get('seller_verified', false);

        if (!$buyerVerified || !$sellerVerified) {
            return response()->json(['success' => false, 'message' => 'Both buyer and seller must be verified before creating the transfer record.'], 403);
        }


        $company = Auth::user();

        if (!$company) {
            return response()->json(['success' => false, 'message' => 'Authenticated company not found.'], 422);
        }


        $transferId = Session::get('transfer_id');

        if ($transferId) {

            $transfer = TransferOfOwnershipDocs::find($transferId);

            if ($transfer) {
                return response()->json(['success' => true, 'message' => 'Transfer record already exists.', 'transfer_id' => $transferId]);
            }
        }


        $existingTransfer = TransferOfOwnershipDocs::where([
            ['company_id', $company->id],
            ['buyer_national_id', Session::get('buyer_national_id')],
            ['seller_national_id', Session::get('seller_national_id')],
            ['vehicles_num', Session::get('vehicles_num')],
            ['status', '!=', 'done'],
        ])->first();

        if ($existingTransfer) {

            Session::put('transfer_id', $existingTransfer->id);
            return response()->json(['success' => true, 'message' => 'Transfer record already exists.', 'transfer_id' => $existingTransfer->id]);
        }


        $transfer = TransferOfOwnershipDocs::create([
            'company_id' => $company->id,
            'buyer_national_id' => Session::get('buyer_national_id'),
            'seller_national_id' => Session::get('seller_national_id'),
            'vehicles_num' => Session::get('vehicles_num'),
            'buyer_phone' => '+962790963251',
            'seller_phone' => '+962790963251',
            'cost' => Session::get('vehicle_cost'),
            'status' => 'appending',
        ]);


        Session::put('transfer_id', $transfer->id);

        return response()->json(['success' => true, 'message' => 'Transfer record created successfully.', 'transfer_id' => $transfer->id]);
    }


    public function updateStatus(Request $request)
    {
        $status = $request->input('status');
        $transferId = Session::get('transfer_id');

        if (!$transferId) {
            return response()->json(['success' => false, 'message' => 'Transfer record not found.'], 404);
        }

        $transfer = TransferOfOwnershipDocs::find($transferId);

        if (!$transfer) {
            return response()->json(['success' => false, 'message' => 'Transfer record not found.'], 404);
        }

        $transfer->status = $status;
        $transfer->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }

    

    public function loadSession(Request $request)
    {
        log::info('step: ' . Session::get('transfer_step'));

        return response()->json([
            'step' => Session::get('transfer_step', 1),
            'buyer_national_id' => Session::get('buyer_national_id'),
            'seller_national_id' => Session::get('seller_national_id'),
            'vehicles_num' => Session::get('vehicles_num'),
            'vehicle_cost' => Session::get('vehicle_cost'),
            'buyerVerified' => Session::get('buyer_verified', false),
            'sellerVerified' => Session::get('seller_verified', false),
        ]);
    }

    public function saveSessionData(Request $request)
    {

        Session::put('buyer_national_id', $request->input('buyer_national_id'));
        Session::put('seller_national_id', $request->input('seller_national_id'));
        Session::put('vehicles_num', $request->input('vehicles_num'));
        Session::put('vehicle_cost', $request->input('vehicle_cost'));
    }

    public function completeTransfer(Request $request)
    {

        $company = Auth::user();

        if (!$company) {
            return response()->json(['error' => 'Authenticated company not found.'], 422);
        }

        $transferId = Session::get('transfer_id');

        if (!$transferId) {
            return response()->json(['error' => 'Transfer record not found.'], 404);
        }

        $transfer = TransferOfOwnershipDocs::find($transferId);

        if (!$transfer) {
            return response()->json(['error' => 'Transfer record not found.'], 404);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $directoryPath = 'files/' . $company->name;
            $fileName = 'contract_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs($directoryPath, $fileName, 'public');


            $transfer->contract_file_path = $filePath;
        } else {
            return response()->json(['error' => 'Contract file is required.'], 422);
        }


        $transfer->status = 'done';
        $transfer->save();


        Session::forget([
            'buyer_national_id',
            'seller_national_id',
            'vehicles_num',
            'vehicle_cost',
            'buyer_verified',
            'seller_verified',
            'transfer_step',
            'transfer_id',
        ]);


        

        return response()->json(['message' => 'Transfer completed successfully.']);
    }

    public function resumeTransfer($id)
    {
        $transfer = TransferOfOwnershipDocs::findOrFail($id);


        session([
            'buyer_national_id' => $transfer->buyer_national_id,
            'seller_national_id' => $transfer->seller_national_id,
            'vehicles_num' => $transfer->vehicles_num,
            'vehicle_cost' => $transfer->cost,
            'transfer_step' => $transfer->status === 'appending' ? 2 : 3,
        ]);

        return response()->json(['success' => true]);
    }


}
