<?php


namespace App\Services\GiftService;


class SuccessResponse
{
    /**
     * @var $is_success bool
     */
    public $is_success;
    /**
     * @var $type string
     */
    public $type;

    /**
     * @param bool $is_exec
     * @param string $type
     */
    public function __construct(bool $is_success, string $type = '') {
        $this->is_success = $is_success;
        $this->type = $type;
    }
}