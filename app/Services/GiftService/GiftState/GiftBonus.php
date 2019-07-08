<?php


namespace App\Services\GiftService\GiftState;

use App\Services\ConvertService;
use App\Services\GiftService\SuccessResponse;

class GiftBonus extends GiftState
{
    public function getResult(): SuccessResponse {
        $value = rand($this->gift->min_count, $this->gift->max_count);
        $result = "{$this->gift->comment} {$value}";
        ConvertService::updateProfile($value);
        return new SuccessResponse(true, $result);
    }
}