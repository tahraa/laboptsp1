@extends('layouts.menu')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="card">
                <div class="card-header text-primary font-weight-bold"><i class="fas fa-users-cog"></i> {{ __('Panneau d\'administration') }}</div>
                <div class="jumbotron text-center">
                    {{-- <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i>Accueil</a></li></ol>  --}}
                    <img  src="{{ asset('images/livret.jpg') }}" alt="" width="500px" height="240px">
                    {{-- <img src="{{ asset('images/logo.png') }}" width="100px" height="100px" alt="" style="margin-top: -67px;
                    "> --}}
                    <h4 class="text-primary font-weight-bold">Application de gestion de livrets familiaux</h4>
                    <p class="text-primary">Société nationale industrielle et minière</p>
                    <h4 class="text-primary font-weight-bold"><span  style="direction:rtl; margin-left:5px; font-family: 'Tajawal', sans-serif; font-size: 22px"> نظام ادارة دفتر القيد الأسري   </span></h4>
                    <p class="text-primary" style="direction:rtl; margin-left:5px; font-family: 'Tajawal', sans-serif; font-size: 22px">الشركة الوطنية للصناعة و المناجم سنيم</p>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <span class="text-primary font-weight-bold">
                            <i class="fa fa-check" aria-hidden="true"></i> {{ __('Vous êtes connecté!') }}
                        </span>
                </div>
            </div>

    </div>
</div>
@endsection
