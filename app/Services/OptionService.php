<?php

namespace App\Services;

use App\Option;

class OptionService {

    private $base_ratio = 'base_ratio';
    private $service_balance = 'service_balance';
    private $winning_coefficient = 'winning_coefficient';

    /**
     * Get ratio for convert bonus to money.
     * @return mixed
     */
    public function getRatio() {
        return $this->getValue($this->base_ratio);
    }

    /**
     * Get the coefficient for the probability of winning.
     * @return mixed
     */
    public function getCoefficient() {
        return $this->getValue($this->winning_coefficient);
    }

    /**
     * @param $value
     * @return bool
     */
    public function calculateBalance($value) {
        $balance = $this->getValue($this->service_balance);
        return $balance - $value >= 0;
    }

    /**
     * @return mixed
     */
    public function getBalance() {
        return $this->getValue($this->service_balance) ?: 0;
    }

    /**
     * @param $key
     * @return mixed
     */
    private function getValue($key) {
        $option = Option::where('name', $key)->first();
        return $option ? $option->value : false;
    }

    /**
     * @return string
     */
    public function getServiceBalance(): string
    {
        return $this->service_balance;
    }
}