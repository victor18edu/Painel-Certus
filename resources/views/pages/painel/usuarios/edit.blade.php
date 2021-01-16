@extends('adminlte::page')

@section('content')
<form action="{{ route('usuarios.update', $user->id) }}" method="post">

    @method('put')
    @include('pages.painel.usuarios._partials.form')
    @can('adm')

        <div class="form-check" id="level">
            @if($user->nivel == 1)
                <input type="checkbox" class="form-check-input" id="nivel" name="nivel" checked>
            @else
                <input type="checkbox" class="form-check-input" id="nivel" name="nivel">
            @endif
                <label class="form-check-label" for="exampleCheck1" >Este usuário é um administrador</label>
        </div>
        <div class="form-check" id="file">
            @if($user->sendFile == 1)
                <input type="checkbox" class="form-check-input" id="sendFile" name="sendFile">
            @else
                <input type="checkbox" class="form-check-input" id="sendFile" name="sendFile">
            @endif

                <label class="form-check-label" for="exampleCheck1" >Este cliente pode enviar arquivo</label>
        </div>
    @endcan
    <footer>
        <div class="row">
            <div class="col-6"></div>
            <div class="col-4">
                <div id="invalid"></div>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-success btn-lg btn-block">ATUALIZAR</button>
            </div>
        </div>

    </footer>

</form>
@endsection


<script type="text/javascript" src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jsmask.js') }}"></script>

<script type="text/javascript">

    $(document).ready(function(){

        $("#confirm_passowrd").focusout(function(){
            if($("#confirm_passowrd").val() != $("#password_cliente").val()){
                $("button").attr('disabled', 'disabled')
                $("#invalid").addClass('alert alert-danger')
                $("#invalid").text('Senhas não conferem')
            }

        })

    })
</script>
