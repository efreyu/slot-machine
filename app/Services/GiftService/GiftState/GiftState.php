<?php


namespace App\Services\GiftService\GiftState;

use App\Gift;
use App\Item;
use App\Services\GiftService\SuccessResponse;

abstract class GiftState
{
    protected $item;
    protected $gift;

    public function setItem(Gift $gift, Item $item) {
        $this->gift = $gift;
        $this->item = $item;

        return $this->getResult();
    }

    public abstract function getResult(): SuccessResponse;
}