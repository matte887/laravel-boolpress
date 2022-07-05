@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ciao {{ $user->name }}, sono la pagina controller dell'admin</h1>
    </div>
@endsection
