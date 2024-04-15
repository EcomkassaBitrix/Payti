@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All OFDS') }}</div>

                    <div class="card-body">
                        <a href="{{route('home')}}"><---Back</a><br>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Kassa Id</th>
                                <th scope="col">Date Create</th>
                                <th scope="col">Date Update</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ofdServices as $ofdService)
                                <tr>
                                    <th scope="row">{{$ofdService->id}}</th>
                                    <td>{{$ofdService->name}}</td>
                                    <td>{{$ofdService->shop_id}}</td>
                                    <td>{{$ofdService->created_at}}</td>
                                    <td>{{$ofdService->updated_at}}</td>
                                    <td><a href="{{route('ofdService.edit', $ofdService->id)}}">Edit</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="{{route('ofdService.create')}}">Add OFD Service ( Ecomkassa )</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection