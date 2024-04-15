@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Ofd') }}</div>

                    <div class="card-body">
                        <a href="{{route('ofdService.index')}}"><---Back</a>
                        <h1>Edit OFD #{{$ofdService->id}}</h1>
                        <form method="post" action="{{route('ofdService.update', $ofdService->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">UserName</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="login" id="inputEmail3" value="{{$ofdService['login']}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password" id="inputPassword3" value="{{$ofdService['password']}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputKassaId" class="col-sm-2 col-form-label">Kassa ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="shop_id" id="inputKassaId" value="{{$ofdService['shop_id']}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="company_email" class="col-sm-2 col-form-label">Company email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company_email" id="company_email" value="{{$ofdService['company_email']}}">
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="company_inn" class="col-sm-2 col-form-label">Company Inn</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company_inn" id="company_inn" value="{{$ofdService['company_inn']}}">
                                </div>
                            </div>


                            <div class="row mb-3">
                                <label for="company_payment_address" class="col-sm-2 col-form-label">Company Payment Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="company_payment_address" id="company_payment_address" value="{{$ofdService['company_payment_address']}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="company_payment_address" class="col-sm-2 col-form-label">client_email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="client_email" id="client_email" value="{{$ofdService['client_email']}}">
                                </div>
                            </div>


                            <div class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">payment_method</legend>
                                <div class="col-sm-10">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_method" id="full_prepayment" value="full_prepayment" {{ $ofdService->payment_method === 'full_prepayment' ? "checked" : "" }}><label class="form-check-label" for="full_prepayment">full_prepayment</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_method" id="prepayment" value="prepayment" {{ $ofdService->payment_method === 'prepayment' ? "checked" : "" }}><label class="form-check-label" for="prepayment">prepayment</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_method" id="advance" value="advance" {{ $ofdService->payment_method === 'advance' ? "checked" : "" }}><label class="form-check-label" for="advance">advance</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_method" id="full_payment" value="full_payment" {{ $ofdService->payment_method === 'full_payment' ? "checked" : "" }}><label class="form-check-label" for="full_payment">full_payment</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_method" id="partial_payment" value="partial_payment" {{ $ofdService->payment_method === 'partial_payment' ? "checked" : "" }}><label class="form-check-label" for="partial_payment">partial_payment</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_method" id="credit" value="credit" {{ $ofdService->payment_method === 'credit' ? "checked" : "" }}><label class="form-check-label" for="credit">credit</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_method" id="credit_payment" value="credit_payment" {{ $ofdService->payment_method === 'credit_payment' ? "checked" : "" }}><label class="form-check-label" for="credit_payment">credit_payment</label></div>

                                </div>
                            </div>


                            <div class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">payment_object</legend>
                                <div class="col-sm-10">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_object" id="commodity" value="commodity" {{ $ofdService->payment_object === 'commodity' ? "checked" : "" }}><label class="form-check-label" for="commodity">commodity</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_object" id="excise" value="excise" {{ $ofdService->payment_object === 'excise' ? "checked" : "" }}><label class="form-check-label" for="excise">excise</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_object" id="job" value="job" {{ $ofdService->payment_object === 'job' ? "checked" : "" }}><label class="form-check-label" for="job">job</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_object" id="gambling_bet" value="gambling_bet" {{ $ofdService->payment_object === 'gambling_bet' ? "checked" : "" }}><label class="form-check-label" for="gambling_bet">gambling_bet</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_object" id="lottery" value="lottery" {{ $ofdService->payment_object === 'lottery' ? "checked" : "" }}><label class="form-check-label" for="lottery">lottery</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_object" id="lottery_prize" value="lottery_prize" {{ $ofdService->payment_object === 'lottery_prize' ? "checked" : "" }}><label class="form-check-label" for="lottery_prize">lottery_prize</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_object" id="intellectual_activity" value="intellectual_activity" {{ $ofdService->payment_object === 'intellectual_activity' ? "checked" : "" }}><label class="form-check-label" for="intellectual_activity">intellectual_activity</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_object" id="payment" value="payment" {{ $ofdService->payment_object === 'payment' ? "checked" : "" }}><label class="form-check-label" for="payment">payment</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_object" id="agent_commission" value="agent_commission" {{ $ofdService->payment_object === 'agent_commission' ? "checked" : "" }}><label class="form-check-label" for="agent_commission">agent_commission</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_object" id="composite" value="composite" {{ $ofdService->payment_object === 'composite' ? "checked" : "" }}><label class="form-check-label" for="composite">composite</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="payment_object" id="another" value="another" {{ $ofdService->payment_object === 'another' ? "checked" : "" }}><label class="form-check-label" for="another">another</label></div>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">vat</legend>
                                <div class="col-sm-10">
                                    <div class="form-check"><input class="form-check-input" type="radio" name="vat" id="none" value="none" {{ $ofdService->vat === 'none' ? "checked" : "" }}><label class="form-check-label" for="none">none</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="vat" id="10" value="10" {{ $ofdService->vat === '10' ? "checked" : "" }}><label class="form-check-label" for="10">10</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="vat" id="18" value="18" {{ $ofdService->vat === '18' ? "checked" : "" }}><label class="form-check-label" for="18">18</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="vat" id="20" value="20" {{ $ofdService->vat === '20' ? "checked" : "" }}><label class="form-check-label" for="20">20</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="vat" id="110" value="110" {{ $ofdService->vat === '110' ? "checked" : "" }}><label class="form-check-label" for="110">110</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="vat" id="118" value="118" {{ $ofdService->vat === '118' ? "checked" : "" }}><label class="form-check-label" for="118">118</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="vat" id="120" value="120" {{ $ofdService->vat === '120' ? "checked" : "" }}><label class="form-check-label" for="120">120</label></div>
                                    <div class="form-check"><input class="form-check-input" type="radio" name="vat" id="0" value="0" {{ $ofdService->vat === '0' ? "checked" : "" }}><label class="form-check-label" for="0">0</label></div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">Company sno</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="company_sno" id="osn" value="osn" {{ $ofdService->company_sno === 'osn' ? "checked" : "" }}>
                                        <label class="form-check-label" for="osn">OSN</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="company_sno" id="usn_income" value="usn_income" {{ $ofdService->company_sno === 'usn_income' ? "checked" : "" }}>
                                        <label class="form-check-label" for="usn_income">usn_income</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="company_sno" id="usn_income_outcome" value="usn_income_outcome" {{ $ofdService->company_sno === 'usn_income_outcome' ? "checked" : "" }}>
                                        <label class="form-check-label" for="usn_income_outcome">usn_income_outcome</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="company_sno" id="envd" value="envd" {{ $ofdService->company_sno === 'envd' ? "checked" : "" }}>
                                        <label class="form-check-label" for="envd">envd</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="company_sno" id="esn" value="esn" {{ $ofdService->company_sno === 'esn' ? "checked" : "" }}>
                                        <label class="form-check-label" for="esn">esn</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="company_sno" id="patent" value="patent" {{ $ofdService->company_sno === 'patent' ? "checked" : "" }}>
                                        <label class="form-check-label" for="patent">patent</label>
                                    </div>
                                </div>
                            </div>



                            <div class="row mb-3">
                                <legend class="col-form-label col-sm-2 pt-0">OFD Service</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="name" id="gridRadios1" value="ecomkassa" checked>
                                        <label class="form-check-label" for="gridRadios1">
                                            Ecomkassa
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
