<?php

namespace App\Http\Controllers;

use App\Models\RandomNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RandomNumberController extends Controller
{
    public function generate(Request $request): \Illuminate\Http\JsonResponse
    {
        $randomNumber = mt_rand(1, 1000);
        $uuid = Str::uuid();

        RandomNumber::create([
                                 'number' => $randomNumber,
                                 'uuid' => $uuid,
                             ]);

        return response()->json([
                                    'uuid' => $uuid,
                                    'number' => $randomNumber,
                                ], 201);
    }

    public function retrieve($uuid)
    {
        $randomNumber = RandomNumber::where('uuid', $uuid)->first();

        if ($randomNumber) {
            return response()->json([
                                        'uuid' => $randomNumber->uuid,
                                        'number' => $randomNumber->number,
                                    ]);
        }

        return response()->json(['message' => 'Not Found'], 404);
    }
}