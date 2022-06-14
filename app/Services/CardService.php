<?php

namespace App\Services;

use App\Helpers\TextHelper;
use App\Models\Card;
use Illuminate\Http\UploadedFile;

class CardService
{
    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        $card = new Card();
        $card->name = $data['name'];
        $card->short_description = $data['short_description'];
        if (!empty($data['image'])) {
            $card->image = $this->storeImage($data['image']);
        }
        $card->phone = TextHelper::prepareFormatPhone($data['phone']);
        $card->save();
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    private function storeImage(UploadedFile $file): string
    {
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/cards', $fileName);

        return $fileName;
    }
}
