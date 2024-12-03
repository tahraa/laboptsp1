@extends('layout')

@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
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
    <ul class="font-weight-bold"> 
        <li class="border border-primary p-4">
            <ul><span class="font-weight-bold text-primary">Beneficier : {{ $beneficier->matricule }}</span>
                <li><img src="{{ asset('/emp_images/'. $beneficier->matricule .'.jpg') }}" width="150px" height="150px"></li>
                <li>nni : {{ $beneficier->nni }}</li>
                <li>nom & prénom : {{ $beneficier->prenom.' '.$beneficier->nom}} </li>
                <li>
                    sexe :
                    @if ($beneficier->sexe == 'feminin')
                        <i class="fas fa-female"></i> {{ $beneficier->sexe }}
                    @else
                        <i class="fas fa-male"></i> {{ $beneficier->sexe }}
                    @endif
                </li>
                <li>n°cnam: {{ $beneficier->num_cnam }}</li>
                <li>date naissance : {{ $beneficier->date_naissance }}</li>
                <li>age :
                    @php
                        $age = Carbon\Carbon::parse($beneficier->date_naissance)->age;
                    @endphp
                    {{ $age .' ans' }}
                </li>
                <li>
                    <div  class="float-right font-weight-bold" >
                        statut :
                            @if ($beneficier->statut == '1')
                            <span class="bg-success p-2" style="color: white">
                                <i class="fas fa-check"></i> assuré
                            </span>
                            @endif
                            @if ($beneficier->statut == '0')
                            <span class="bg-danger p-2" style="color: white">
                                <i class="fas fa-times"></i> non assuré                            </span>
                            @endif
                    </div>
                </li>
                <li> établissement : 
                    {{ $beneficier->etablissement }}
                </li>
                @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')
                    <li>service : {{ $beneficier->service }}</li>
                    <li>situation civile : {{ $beneficier->situation_civile }}</li>
                    <a class="btn btn-success btn-sm" type="button" href="{{ route('beneficier.edit', ['beneficier' => $beneficier->id]) }}"><i class="fas fa-edit"></i></a>
                @endif
                @if ($user_logged_in->profile == 'profil3'|| $user_logged_in->profile == 'profil2')
                    <form method="POST" action="{{ route('beneficier.destroy', ['beneficier' => $beneficier->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer le(la) conjoint(e) ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                    </form>
                @endif
                
            </ul>

        </li>
        @if ($beneficier->couples->count() > 0)
             {{-- conjoint section --}}
            <li class="border border-success mt-4 p-4">
                <ul><span class="font-weight-bold text-primary">CONJOINT</span>
                    <li>
                        <table class="table  table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>photo</th>
                                    <th>nom & prénom</th>
                                    <th>sexe</th>
                                    <th>age</th>
                                    <th>statut</th>
                                    @if ($user_logged_in->profile == 'profil2')
                                        <th>action</th>
                                    @endif
                                    @if ($user_logged_in->profile == 'profil3')
                                        <th>action</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($beneficier->couples as $couple)
                                        <tr>
                                            <td>
                                                @if ($couple->image == null)
                                                    <img src="{{ asset('/images/pas_image.png') }}" width="100px" height="100px">
                                                @else
                                                    <img src="{{ asset('/couple_images/'.$couple->nni.'.jpg') }}" width="100px" height="100px">
                                                @endif                                            </td>
                                            <td><a href="{{ route('couplesB.show', ['couplesB' => $couple->id]) }}">{{ $couple->prenom .' '. $couple->nom}}</a></td>
                                            <td>{{ $couple->sexe}}</td>
                                            <td>
                                                @php
                                                    $age = Carbon\Carbon::parse($couple->date_naissance)->age;
                                                @endphp
                                                {{ $age .' ans' }}
                                            </td>
                                            <td class="@if ($couple->statut == '1')assure @else nonAssure @endif">
                                                @if ($couple->statut == '1')
                                                <i class="fas fa-check"></i> assuré
                                                @endif
                                                @if ($couple->statut == '0')
                                                <i class="fas fa-times"></i> non assuré
                                                @endif
                                            </td>
                                           {{--  @if ($user_logged_in->profile == 'profil2')
                                            <td>
                                                <a class="btn btn-success btn-sm" type="button" href="{{ route('couplesB.edit', ['couple' => $couple->id]) }}"><i class="fas fa-edit"></i></a>
                                            </td>
                                            @endif --}}
                                            @if ($user_logged_in->profile == 'profil3'||$user_logged_in->profile == 'profil2')
                                            <td>
                                                <a class="btn btn-success btn-sm" type="button" href="{{ route('couplesB.edit', ['couplesB' => $couple->id]) }}"><i class="fas fa-edit"></i></a>
                                                <form method="POST" action="{{ route('couplesB.destroy', ['couplesB' => $couple->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer le(la) conjoint(e) ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </li>
                </ul>
            </li>
        @else
            <div class="alert alert-info alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <strong>Pas des conjoints!</strong>
            </div>

            <script>
              $(".alert").alert();
            </script>
        @endif

        @if ($beneficier->enfants->count() > 0)
            {{-- enfant section --}}
            <li class="border border-success mt-4 p-4">
                <ul><span class="font-weight-bold text-primary">ENFANTS</span>
                    <li>
                        <table class="table  table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>photo</th>
                                    <th>nom & prénom</th>
                                    <th>sexe</th>
                                    <th>age</th>
                                    <th>numéro de cnam </th>
                                    <th>statut</th>
                                    @if ($user_logged_in->profile == 'profil2')
                                    <th>action</th>
                                    @endif
                                    @if ($user_logged_in->profile == 'profil3')
                                        <th>action</th>
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($beneficier->enfants as $enfant)
                                        <tr>
                                            <td>
                                                @if ($enfant->image == null)
                                                    <img src="{{ asset('/images/pas_image.png') }}" width="100px" height="100px">
                                                @else
                                                    <img src="{{ asset('/enfant_images/'.$enfant->nni.'.jpg') }}" width="100px" height="100px">
                                                @endif
                                            </td>
                                            <td><a href="{{ route('enfantsB.show', ['enfantsB' => $enfant->id]) }}">{{ $enfant->prenom .' '. $enfant->nom}}</a></td>
                                            <td>{{ $enfant->sexe}}</td>
                                           
                                            <td>
                                                @php
                                                    $age = Carbon\Carbon::parse($enfant->date_naissance)->age;
                                                @endphp
                                                {{ $age .' ans' }}
                                            </td>
                                            <td>{{ $enfant->num_cnam}}</td>
                                            <td class="@if ($enfant->statut == '1')assure @else nonAssure @endif">
                                                @if ($enfant->statut == '1')
                                                <i class="fas fa-check"></i> assuré
                                                @endif
                                                @if ($enfant->statut == '0')
                                                <i class="fas fa-times"></i> non assuré
                                                @endif
                                            </td>
                                            @if ($user_logged_in->profile == 'profil2')
                                        <td>
                                            <a class="btn btn-success btn-sm" type="button" href="{{ route('enfantsB.edit', ['enfantsB' => $enfant->id]) }}"><i class="fas fa-edit"></i></a>
                                        </td>
                                        @endif
                                        @if ($user_logged_in->profile == 'profil3')
                                            <td>
                                                <a class="btn btn-success btn-sm" type="button" href="{{ route('enfantsB.edit', ['enfantsB' => $enfant->id]) }}"><i class="fas fa-edit"></i></a>
                                                <form method="POST" action="{{ route('enfantsB.destroy', ['enfantsB' => $enfant->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer l\'enfant ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                        </table>
                    </li>
                </ul>
            </li>
        @else
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <strong>Pas des enfants!</strong>
            </div>

            <script>
                $(".alert").alert();
            </script>
        @endif
    </ul>
@endsection
