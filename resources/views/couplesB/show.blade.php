@extends('layout')

@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
    <ul>
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
        <li class="border border-primary p-4">
            <ul><span class="font-weight-bold text-primary">CONJOINT</span>
                <li>
                    @if ($couple->image == null)
                        <img src="{{ asset('/images/pas_image.png') }}" width="100px" height="100px">
                    @else
                        <img src="{{ asset('/couple_images/'.$couple->nni.'.jpg') }}" width="100px" height="100px">
                    @endif
                </li>
                <li>nni : {{ $couple->nni }}</li>
                <li>nom & prénom : {{ $couple->prenom.' '.$couple->nom}} </li>
                <li>
                    sexe :
                    @if ($couple->sexe == 'feminin')
                        <i class="fas fa-female"></i> {{ $couple->sexe }}
                    @else
                        <i class="fas fa-male"></i> {{ $couple->sexe }}
                    @endif
                </li>
                <li>date naissance : {{ $couple->date_naissance }}</li>
                <li>
                <li>age :
                    @php
                        $age = Carbon\Carbon::parse($couple->date_naissance)->age;
                        @endphp
                    {{ $age .' ans' }}
                </li>
                </li>
                <li>Numéro de cnam : {{ $couple->num_cnam }}</li>
                <li>
                    <div  class="float-right font-weight-bold" >
                        statut :
                            @if ($couple->statut == '1')
                            <span class="bg-success p-2" style="color: white">
                                <i class="fas fa-check"></i> assuré
                            </span>
                            @endif
                            @if ($couple->statut == '0')
                            <span class="bg-danger p-2" style="color: white">
                                <i class="fas fa-times"></i> non assuré </span>
                            @endif
                    </div>
                </li>
                @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')
                    <li>date mariage : {{ $couple->date_mariage }}</li>
                    <li>service : {{ $couple->service }}</li>
                    <li>situation civile : {{ $couple->situation_civile }}</li>
                    <a class="btn btn-success btn-sm" type="button" href="{{ route('couplesB.edit', ['couplesB' => $couple->id]) }}"><i class="fas fa-edit"></i></a>
                @endif
                @if ($user_logged_in->profile == 'profil3'||$user_logged_in->profile == 'profil2')
                    <form method="POST" action="{{ route('couplesB.destroy', ['couplesB' => $couple->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer le(la) conjoint(e) ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                    </form>
                @endif
            </ul>

        </li>

        @php $b = \App\Beneficier::find($couple->beneficier_id) @endphp

        <li class="border border-success mt-4 p-4">
            <ul><span class="font-weight-bold text-primary">Bénéficier hors SNIM : {{ $b->matricule }}</span>
                <li>
                    <table class="table  table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>photo</th>
                                <th>matricule</th>
                                <th>nom & prénom</th>
                                <th>sexe</th>
                                <th>statut</th>
                                <th>n °cnam</th>
                                @if ($user_logged_in->profile == 'profil2')
                                <th>action</th>
                                @endif
                                @if ($user_logged_in->profile == 'profil3')
                                    <th>action</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="{{ asset('/emp_images/'. $b->matricule .'.jpg') }}" width="150px" height="150px"></td>
                                    <td><a href="{{ route('beneficier.show', ['beneficier' => $b->id]) }}">{{ $b->matricule }}</a></td>
                                    <td scope="row">{{ $b->nom .' '. $b->prenom}}</td>
                                    <td>{{ $b->sexe}}</td>
                                    <td>{{ $b->num_cnam}}</td>
                                    <td class="@if ($b->statut == '1')assure @else nonAssure @endif">
                                        @if ($b->statut == '1')
                                            assuré
                                        @endif
                                        @if ($b->statut == '0')
                                            non assuré
                                        @endif
                                    </td>
                                 {{--    @if ($user_logged_in->profile == 'profil2')
                                    <td>
                                        <a  class="btn btn-success btn-sm" type="button" href="{{ route('beneficiers.edit', ['employe' => $b->id]) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                    @endif --}}
                                    @if ($user_logged_in->profile == 'profil3'|| $user_logged_in->profile == 'profil2')
                                    <td>
                                        <a  class="btn btn-success btn-sm" type="button" href="{{ route('beneficier.edit', ['beneficier' => $b->id]) }}"><i class="fas fa-edit"></i></a>
                                        <form method="POST" action="{{ route('beneficier.destroy', ['beneficier' => $b->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette carnet ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            </tbody>
                    </table>
                </li>
            </ul>
        </li>
    </ul>
@endsection
