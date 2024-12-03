@extends('layout')
@section('content')
@php
    $user_id = auth()->user()->id;
    $log_logged_in = \App\User::where(['id' => $user_id])->first();
@endphp
        <div class="card">
            <img class="card-img-top" src="holder.js/100x180/" alt="">
            <div class="card-body">
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

                <h4 class="card-title">Liste des logs</h4>

            <p class="card-text text-success font-weight-bold">Total : {{ $count_logs }}</p>
                    <div class="table-responsive">
                {{ $logs->links() }}
                <table
                    class="table"
                    data-toggle="table"
                    data-pagination="false"
                    data-search="true"
                    data-locale='fr-FR'

                        >
                    <thead class="thead-inverse">
                        <tr>
                            <th data-field="nni">user</th>
                            <th data-field="nom">email</th>
                            <th data-field="date_creation">date_création</th>
                           <th data-field="entites">Matricule Concerné</th>
                            <th data-field="description">description</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($logs as $log)
                                <tr>
                                    <td><a href="{{ route('logs.show', ['log' => $log->id]) }}">{{ $log->user }}</a></td>
                                    <td>{{ $log->email }}</td>
                                    <td>
                                        {{ $log->created_at }}
                                    </td>
                                  <td>
                                        {{ $log->entite }}
                                    </td>
                                    <td>
                                        {{substr($log->action, 0, 20)}}...
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Pas des logs</td>
                                </tr>
                            @endforelse
                        </tbody>
                </table>
            </div>
                {{-- {{ $logs->links() }} --}}
            </div>
        </div>
@endsection
