@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('aqui va una imagen storage/cAioF5G2t75lruqbIHLM1H7czVFsp6rvEqva4cgR.jpg') }}

                        <td><img src="'/storage/logo.png') }}" width="200" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
