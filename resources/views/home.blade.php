@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a href="{{route('paysystem.index')}}">PaySystem--></a><br>
                        <a href="{{route('ofdservice.index')}}">OFD Service--></a><br>
                        <a href="{{route('bunch.index')}}">Bunches--></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection