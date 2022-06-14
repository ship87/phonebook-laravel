<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardRequest;
use App\Models\Card;
use App\Services\CardService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Exception;

class CardController extends Controller
{
    /**
     * @return Collection
     */
    public function get(): Collection
    {
        return Card::all();
    }

    /**
     * @param Request $request
     * @param CardService $cardService
     * @return array|bool[]
     */
    public function create(Request $request, CardService $cardService): array
    {
        try {
            $cardRequest = (new CardRequest);
            $data = $request->all();
            $validator = Validator::make($data, $cardRequest->rules(), $cardRequest->messages());
            if ($validator->fails()) {
                return [
                    'success' => false,
                    'errors' => $validator->messages()->all(),
                ];
            }

            $cardService->store($data);
        } catch (Exception $exception) {
            return [
                'success' => false,
                'errors' => $exception->getMessage(),
            ];
        }

        return [
            'success' => true,
        ];
    }
}
