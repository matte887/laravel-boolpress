@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Ciao {{ $user->name }}, sono la pagina controller dell'admin</h1>
        {{-- @if ($userInfo)
            <p>{{ $userInfo->address }}</p>
        @endif --}}

    </div>
@endsection
