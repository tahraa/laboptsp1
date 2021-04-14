@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Panneau d\'administration') }}</div>
                <div class="jumbotron">
                    <img  src="{{ asset('images/cover.png') }}" alt="">
                    {{-- <img src="{{ asset('images/logo.png') }}" width="100px" height="100px" alt="" style="margin-top: -67px;
                    "> --}}
                    <h4>Application de gestion des carnets familliaux</h4>
                    <p>Société nationale industrielle et minière</p>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Vous êtes connecté!') }}
                </div>
            </div>
        
    </div>
</div>
@endsection
