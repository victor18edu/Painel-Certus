@extends('adminlte::page')

@section('content')
<form action="{{ route('empresas.update', $tenant->id) }}" method="post">

        @method('put')
        @include('pages.painel.tenant._partials.form')
</form>

@endsection
