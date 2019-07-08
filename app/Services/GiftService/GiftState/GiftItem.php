<?php


namespace App\Services\GiftService\GiftState;


use App\Services\GiftService\SuccessResponse;

class GiftItem extends GiftState
{
    public function getResult(): SuccessResponse {
        //TODO добавить пользователю подарок товара
        $result = "{$this->gift->comment} {$this->item->name}";
//        dd($this->gift, $this->item, 'GiftItem');
        return new SuccessResponse(true, $result);
    }
}