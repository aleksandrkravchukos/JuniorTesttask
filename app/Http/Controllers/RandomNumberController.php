<?php

namespace App\Http\Controllers;

use App\Models\RandomNumber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RandomNumberController extends Controller
{
    public function generate(Request $request): JsonResponse
    {
        $randomNumber = rand(1, 1000);

        RandomNumber::query()->create([
                                 'number' => $randomNumber,
                             ]);

        return response()->json([
                                    'number' => $randomNumber,
                                ], 201);
    }

    public function retrieve($id): JsonResponse
    {
        $randomNumber = RandomNumber::query()->where('id', $id)->first();

        if ($randomNumber) {
            return response()->json([
                                        'number' => $randomNumber->number,
                                    ]);
        }

        return response()->json(['message' => 'Not Found'], 404);
    }
}