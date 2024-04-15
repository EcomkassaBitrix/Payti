@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Pay System') }}</div>

                    <div class="card-body">
                        <a href="{{route('paysystem.index')}}"><---Back</a>
                        <h1>Edit PaySystem #{{$paysystem->id}}</h1>
                        <form method="post" action="{{route('paysystem.update', $paysystem->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">UserName</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="login" id="inputEmail3" value="{{$paysystem['login']}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="token" class="col-sm-2 col-form-label">Url CallBack</label>
                                <div class="col-sm-10">
                                    https://nect1999.fvds.ru/api/sberbank/{{$paysystem['token_notification']}}
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" id="inputPassword3">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">PaySystem</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="name" id="gridRadios1" value="sberbank" checked>
                                        <label class="form-check-label" for="gridRadios1">
                                            Sberbank
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
