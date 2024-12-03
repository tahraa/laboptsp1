@extends('layout')

@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
    <ul>
        <li class="border border-primary p-4">
            <ul><span class="font-weight-bold text-primary">ENFANT</span>
                <li>
                    @if ($enfant->image == null)
                        <img src="{{ asset('/images/pas_image.png') }}" width="100px" height="100px">
                    @else
                        <img src="{{ asset('/enfant_images/'.$enfant->nni.'.jpg') }}" width="100px" height="100px">
                    @endif
                </li>
                <li>nni : {{ $enfant->nni }}</li>
                <li>nom & prénom : {{ $enfant->prenom.' '.$enfant->nom}} </li>
                <li>
                    sexe :
                    @if ($enfant->sexe == 'feminin')
                        <i class="fas fa-female"></i> {{ $enfant->sexe }}
                    @else
                        <i class="fas fa-male"></i> {{ $enfant->sexe }}
                    @endif
                </li>
                <li>n°cnam: {{ $enfant->num_cnam }}</li>
                <li>date naissance : {{ $enfant->date_naissance }}</li>
                <li>age :
                    @php
                        $age = Carbon\Carbon::parse($enfant->date_naissance)->age;
                    @endphp
                    {{ $age .' ans' }}
                </li>

                <li>
                    handicap :
                    @if ($enfant->handicap == '1')
                    <span class="text-success" style="color: white">
                        <i class="fas fa-check"></i>
                    </span>
                    @endif
                    @if ($enfant->handicap == '0')
                    <span class="text-danger" style="color: white">
                        <i class="fas fa-times"></i>                          </span>
                    @endif
                </li>
                <li>
                    <div  class="float-right font-weight-bold" >
                        statut :
                            @if ($enfant->statut == '1')
                            <span class="bg-success p-2" style="color: white">
                                <i class="fas fa-check"></i> assuré
                            </span>
                            @endif
                            @if ($enfant->statut == '0')
                            <span class="bg-danger p-2" style="color: white">
                                <i class="fas fa-times"></i> non assuré                            </span>
                            @endif
                    </div>
                </li>
                @if ($user_logged_in->profile == 'profil2' || $user_logged_in->profile == 'profil3')

                    <li>
                        scolarité :
                        @if ($enfant->scolarite == '1')
                        <span class="text-success" style="color: white">
                            <i class="fas fa-check"></i>
                        </span>
                        @endif
                        @if ($enfant->scolarite == '0')
                        <span class="text-danger" style="color: white">
                            <i class="fas fa-times"></i>  </span>
                        @endif
                    </li>
                    
                    <!-- <li>service : {{ $enfant->service }}</li> -->
                    <a class="btn btn-success btn-sm" type="button" href="{{ route('enfantsB.edit', ['enfantsB' => $enfant->id]) }}"><i class="fas fa-edit"></i></a>
                @endif
                @if ($user_logged_in->profile == 'profil3')
                    <form method="POST" action="{{ route('enfantsB.destroy', ['enfantsB' => $enfant->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Êtes-vous sûr de vouloir supprimer le(la) conjoint(e) ??')" class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button>
                    </form>
                @endif
            </ul>

        </li>

        @php $b = \App\Beneficier::find($enfant->beneficier_id) @endphp

        <li class="border border-success mt-4 p-4">
            <ul><span class="font-weight-bold text-primary">Bénéficier
                : {{ $b->matricule }}</span>
                <li>
                    <table class="table  table-inverse table-responsive">
                        <thead class="thead-inverse">
                            <tr>
                                <th>photo</th>
                                <th>matricule</th>
                                <th>nom & prénom</th>
                                <th>sexe</th>
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
                                <tr>
                                    <td><img src="{{ asset('/b_images/'. $b->matricule .'.jpg') }}" width="150px" height="150px"></td>
                                    <td><a href="{{ route('beneficier.show', ['beneficier' => $b->id]) }}">{{ $b->matricule }}</a></td>
                                    <td scope="row">{{ $b->nom .' '. $b->prenom}}</td>
                                    <td>{{ $b->sexe}}</td>
                                    <td class="@if ($b->statut == '1')assure @else nonAssure @endif">
                                        @if ($b->statut == '1')
                                            assuré
                                        @endif
                                        @if ($b->statut == '0')
                                            non assuré
                                        @endif
                                    </td>
                                  {{--   @if ($user_logged_in->profile == 'profil2')
                                    <td>
                                        <a  class="btn btn-success btn-sm" type="button" href="{{ route('bloyes.edit', ['bloye' => $b->id]) }}"><i class="fas fa-edit"></i></a>
                                    </td>
                                    @endif --}}
                                    @if ($user_logged_in->profile == 'profil3'||$user_logged_in->profile == 'profil2')
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
