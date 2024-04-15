@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Bunch') }}</div>
                    <div class="card-body">
                        <a href="{{route('bunch.index')}}"><---Back</a>
                        <h1>Edit Bunch #{{$bunch->id}}</h1>
                        <form method="post" action="{{route('bunch.update', $bunch->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Pay System</label>
                                <div class="col-sm-10">
                                    @foreach($paysystems as $paysystem)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="paysystem_id" id="paysystem_id_{{$paysystem->id}}" value="{{$paysystem->id}}" {{ $bunch->paysystem_id === $paysystem->id ? "checked" : "" }}>
                                            <label class="form-check-label" for="paysystem_id_{{$paysystem->id}}">
                                                {{$paysystem->id}} Create {{$paysystem->created_at}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">OFD Service</label>
                                <div class="col-sm-10">
                                    @foreach($ofdServices as $ofdService)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ofd_service_id" id="ofd_service_id_{{$ofdService->id}}" value="{{$ofdService->id}}" {{ $bunch->ofd_service_id === $ofdService->id ? "checked" : "" }}>
                                            <label class="form-check-label" for="ofd_service_id_{{$ofdService->id}}">
                                                {{$ofdService->id}} Create {{$ofdService->created_at}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
