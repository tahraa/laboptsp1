@extends('layout')

@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
<div class="container">
    <div class="card mt-3">
        @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')
            <div class="card-header text-primary">
                <h2>Modifier/Echantillon</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                      <form action="{{ route('echantillons.update', $echantillon->id) }}" method="POST">
    @csrf
    @method('PUT')

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

                            <div class="form-group">
                                <label for="num_echantillon">N° Echantillon</label>
                                <input id="num_echantillon" maxlength="12" required type="text" name="num_echantillon" placeholder="Entrer N° Echantillon" class="form-control" value="{{ old('num_echantillon', $echantillon->num_echantillon) }}" />
                            </div>

                            <div class="form-group">
                                <label for="num_scelle">N° Scellé</label>
                                <input id="num_scelle" maxlength="12" type="text" name="num_scelle" placeholder="Entrer N° Scellé" class="form-control" value="{{ old('num_scelle', $echantillon->num_scelle) }}" />
                            </div>

                     

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input id="description" required type="text" name="description" placeholder="Entrer description" class="form-control" value="{{ old('description', $echantillon->description) }}" />
                            </div>

                            <div class="form-group">
                                <label for="etat">Etat</label>
                                <select id="etat" name="etat" class="form-control">
                                    <option value="conforme" {{ old('etat', $echantillon->etat) == 'conforme' ? 'selected' : '' }}>Conforme</option>
                                    <option value="nonconforme" {{ old('etat', $echantillon->etat) == 'nonconforme' ? 'selected' : '' }}>Non Conforme</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="datep">Date du prélèvement</label>
                                <input id="datep" type="date" name="datep" class="form-control" value="{{ old('datep', $echantillon->datep) }}" />
                            </div>

                            <div class="form-group">
                                <label for="periode_conservation">Période de conservation</label>
                                <input id="periode_conservation" type="text" name="periode_conservation" placeholder="Entrer période de conservation" class="form-control" value="{{ old('periode_conservation', $echantillon->periode_conservation) }}" />
                            </div>

                            <div class="form-group">
                                <label for="traite">Traité</label>
                                <select id="traite" name="traite" class="form-control">
                                    <option value="Oui" {{ old('traite', $echantillon->traite) == 'Oui' ? 'selected' : '' }}>Oui</option>
                                    <option value="Non" {{ old('traite', $echantillon->traite) == 'Non' ? 'selected' : '' }}>Non</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                Vous n'avez pas l'accès à cette page.
            </div>
            <script>
                window.location.href = "{{ url('/') }}";
            </script>
        @endif
    </div>
</div>
@endsection
