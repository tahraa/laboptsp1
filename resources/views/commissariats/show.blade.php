@extends('layout')

@section('content')
@php
    $user_id = auth()->user()->id;
    $user_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
    <ul class="font-weight-bold">
        <li class="border border-primary p-4">
         

                <li><span class="font-weight-bold text-primary">  Nom :</span> {{ $emp->nom }}</li>
                <li><span class="font-weight-bold text-primary">Direction regionnale de la sûreté : </span>{{ $emp->region}} </li>
                <li><span class="font-weight-bold text-primary">Contact :</span> {{ $emp->contact}}</li>
         

            @if ($emp->affaires->count() > 0)
       
            <li class="border border-success mt-4 p-4">
                <ul><span class="font-weight-bold text-primary">Affaire(S)</span>
                    <li>
                        <table class="table  table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                      <th data-sortable="true">N°affaire</th>
                            <th data-sortable="true">Type</th>
                            <th data-field="date" data-sortable="true">Date</th>



                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($employe->affaires as $couple)
                                        <tr>
                                           
                                            
                                    <td>{{ $couple->num_affaire  }}</td>


                                    <td>{{ $couple->type  }}</td>
                                    <td>{{ $couple->date }}</td>

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
              <strong>Pas des affaires!</strong>
            </div>

            <script>
              $(".alert").alert();
            </script>
        @endif

       


 </ul>
@endsection
