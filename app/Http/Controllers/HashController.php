<?php

namespace App\Http\Controllers;

use App\Services\HashingService;
use App\Services\Hashing\BcryptHashingStrategy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HashController extends Controller
{
    public function __construct(private HashingService $hashingService)
    {
    }

    public function index()
    {
        $encrypted_data = null;
        return view('hashView', compact('encrypted_data'));
    }

    public function encrypt(Request $request)
    {
        $raw_data = $request->encrypt;
        $encrypted_data = $this->hashingService->hash($raw_data);

        Log::info('Encrypted data; ', ['data' => $encrypted_data]);
        return response()->json(['encrypted_data' => $encrypted_data]);
    }

    public function decrypt(Request $request)
    {
        $data = $request->all();
        $value = $data['value'];
        $hashValue = $data['hashValue'];

        $isValid = $this->hashingService->verify($value, $hashValue);

        return response()->json(['isValid' => $isValid]);
    }
}
