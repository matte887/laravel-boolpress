@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Ciao {{ $user->name }}, sono la pagina controller dell'admin</h1>
        {{-- <p>{{ $userInfo->address }}</p> --}}
        
    </div>
@endsection
