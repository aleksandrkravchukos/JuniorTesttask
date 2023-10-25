<?php

namespace App\Http\Controllers;

use App\Models\RandomNumber;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RandomNumberController extends Controller
{
    public function generate(Request $request): string
    {
        $randomNumber = rand(1, 1000);

        try {
            $randomRow = RandomNumber::query()->create([
                                                           'number' => $randomNumber,
                                                       ]);

            return response()->json([
                                        'randomNumber' => $randomNumber,
                                        'uniqueId' => $randomRow->id,
                                    ]);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function retrieve($id): JsonResponse
    {
        $randomNumber = RandomNumber::query()->where('id', $id)->first();

        if ($randomNumber) {
            return response()->json([
                                        'randomNumber' => $randomNumber->number,
                                        'uniqueId' => $randomNumber->id,
                                    ]);
        }

        return response()->json(['message' => 'Not Found'], 404);
    }
}