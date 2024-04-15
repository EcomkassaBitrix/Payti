@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('All Pay System') }}</div>

                    <div class="card-body">
                        <a href="{{route('home')}}"><---Back</a><br>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date Create</th>
                                <th scope="col">Date Update</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paysystems as $paysystem)
                                <tr>
                                    <th scope="row">{{$paysystem->id}}</th>
                                    <td>{{$paysystem->name}}</td>
                                    <td>{{$paysystem->created_at}}</td>
                                    <td>{{$paysystem->updated_at}}</td>
                                    <td><a href="{{route('paysystem.edit', $paysystem->id)}}">Edit</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="{{route('paysystem.create')}}">Add PaySystem ( Sber )</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection