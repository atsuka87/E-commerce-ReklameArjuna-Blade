<?php

namespace App\Http\Controllers;

use App\Services\MidtransService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function midtransCallback(Request $request)
    {
        $midtransService = new MidtransService();
        
        $notification = $request->all();
        
        if ($midtransService->handleNotification($notification)) {
            return response('OK', 200);
        }
        
        return response('Failed', 400);
    }
}
