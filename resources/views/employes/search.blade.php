@extends('layout')
@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (Session::has('success'))
        <div class="alert alert-success text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('success') }}</p>
        </div>
    @endif
    @if (Session::has('denied'))
        <div class="alert alert-danger text-center">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <p>{{ Session::get('denied') }}</p>
        </div>
    @endif
    <form action="{{ route('getSearch') }}" method="POST" class="form-inline">
         @csrf
        <div class="form-group mb-2">
            <label for="field" class="sr-only">Champ de selection</label>
            <select class="form-control-plaintext" name="field" id="field">
                <option value="matricule">matricule</option>
            </select>
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="q" class="sr-only">keyword</label>
            {{-- <input name="q" type="text" class="form-control" id="q" placeholder="keyword..."/> --}}
            <select name="q" style="width: 125px" required="required" id="q"  class="form-control selectemp">
                <option value="vide">-------</option>
                @forelse ($employes as $employe)
                    <option  value="{{$employe->matricule}}">
                        {{$employe->matricule}}
                    </option>
                @empty

                @endforelse
            </select>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Chercher</button>
    </form>
</div>
@endsection
    