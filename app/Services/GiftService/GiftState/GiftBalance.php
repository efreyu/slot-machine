<?php


namespace App\Services\GiftService\GiftState;

use App\Services\ConvertService;
use App\Services\GiftService\SuccessResponse;

class GiftBalance extends GiftState
{
    public function getResult(): SuccessResponse {
        $value = rand($this->gift->min_count, $this->gift->max_count);
        if (ConvertService::updateBalance($value)) {
            $result = "{$this->gift->comment} {$value}";
            return new SuccessResponse(true, $result);
        }

        return new SuccessResponse(false);
    }
}