@extends('layouts.admin')

@section('content')
    @if(Auth::user()->role_as == 1)
    <div class="card">
        <div class="card-body">
            <h1>Dashboard Admin</h1>
        </div>
    </div>
    @elseif(Auth::user()->role_as == 0)
    <div class="card">
        <div class="card-body">
            <h1>Dashboard User</h1>
        </div>
    </div>
    @endif
@endsection