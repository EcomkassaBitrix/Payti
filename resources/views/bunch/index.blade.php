@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All Bunches') }}</div>

                    <div class="card-body">
                        <a href="{{route('home')}}"><---Back</a><br>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID Pay System</th>
                                <th scope="col">ID OFD</th>
                                <th scope="col">Date Create</th>
                                <th scope="col">Date Update</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bunches as $bunch)
                                <tr>
                                    <th scope="row">{{$bunch->id}}</th>
                                    <td>{{$bunch->paysystem_id}}</td>
                                    <td>{{$bunch->ofd_service_id}}</td>
                                    <td>{{$bunch->created_at}}</td>
                                    <td>{{$bunch->updated_at}}</td>
                                    <td><a href="{{route('bunch.edit', $bunch->id)}}">Edit</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="{{route('bunch.create')}}">Add Bunch</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection