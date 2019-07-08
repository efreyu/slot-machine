<?php

namespace App\Http\Controllers;

use App\Services\ConvertService;
use App\Services\GiftService\GiftService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    protected $variable;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return $this->renderSection('home');
    }

    public function play() {
        (new GiftService)->getGift();

        return $this->renderSection('home');
    }

    public function convertBonuses() {
        ConvertService::convertBonuses();
        return redirect(route('home'));
    }

    public function renderSection($view) {
        $this->getUserData();
        return view($view)->with($this->variable);
    }

    public function getUserData(): void {
        $this->variable['balance'] = auth()->user()->balance;
        $this->variable['bonuses'] = auth()->user()->bonuses;
    }
}
