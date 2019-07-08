<?php

namespace App\Services\GiftService;

use App\Facades\Options;
use App\Gift;
use App\Item;
use Illuminate\Support\Facades\Session;

class GiftService {

    public function getRandom(): bool
    {
        $coefficient = Options::getCoefficient();

        return rand(1, $coefficient) == $coefficient;
    }

    public function getGift(): void {
        if (!$this->getRandom()) {
            $this->callResult(__('home.loose'));
        } else {
            $gift = Gift::inRandomOrder()->first();
            $item = $gift->items()->inRandomOrder()->first();

            $factory = GiftFactory::factory($item->type);
            $factory->setItem($gift, $item);

            $resultResponse = $factory->getResult();

            if ($resultResponse->is_success) {
                $this->callResult(__('home.won', ['message' => $resultResponse->type]));
            } else {
                $this->callResult(__('home.loose'));
            }
        }
    }

    private function callResult($result): void {
        Session::put('status', $result);
    }
}