<?php

namespace App\Http\Controllers;

use App\Backend\Services\Contracts\MidtransServiceInterface;
use Illuminate\Http\Request;

class MidtransCallbackController extends Controller
{
    public function __construct(
        private MidtransServiceInterface $midtransService
    ) {}

    /**
     * Handle Midtrans callback/webhook
     */
    public function callback(Request $request)
    {
        $result = $this->midtransService->handleCallback($request);

        if ($result) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }
}
