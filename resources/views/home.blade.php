@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>
                        @lang('home.balance', ['balance' => Options::getBalance()])
                    </p>
                    <p>
                        @lang('home.your_balance', ['balance' => $balance])
                    </p>
                    <p>
                        @lang('home.your_bonuses', ['bonuses' => $bonuses])
                    </p>
                    @if($bonuses)
                        <form action="{{ route('convert') }}" method="POST">
                            @csrf
                            <button>@lang('home.convert')</button>
                        </form>
                    @endif
                    @if(!Options::getBalance())
                        <p class="alert alert-info">@lang('home.balance_low')</p>
                    @endif

                    <form action="{{ route('play') }}" method="POST">
                        @csrf
                        <button>@lang('home.play_button')</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
