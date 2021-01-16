@extends('adminlte::page')

@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>

                <li>{{ Session::get('success') }}</li>
            </ul>
        </div>
    @endif
    @if (\Session::has('error'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('error') !!}</li>
            </ul>
        </div>
    @endif
<form action="{{ route('usuarios.store') }}" method="post">

  @include('pages.painel.usuarios._partials.form')

    <footer>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <div id="invalid"></div>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-success btn-lg mb-2 float-right" disabled="">Cadastrar</button>

            </div>

        </div>


    </footer>
</form>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script type="text/javascript" src="{{ asset('js/jsmask.js') }}"></script>



