@extends('adminlte::page')
@section('content')
    @if(session('success'))
        <div class="alert alert-success">

            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
<div class="row">

    <div class="col-md-6">
        <div class="card bg-success">
            <div class="card-body">
                <h4 class="text-white-50">Arquivos enviados <i class="far fa-file-pdf fa-2x text-white-50 float-right"></i></h4>
                <h4>Total de arquivos enviados: <b> {{ $arquivos_enviados }}</b></h4>
                <h4>Aguardando download:<b> {{ $arquivos_enviados_nao_baixados }}</b></h4>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!--  -->
    <div class="col-md-6">
        <div class="card bg-danger">
            <div class="card-body">
                <h4 class="text-white-50">Arquivos Recebidos <i class="far fa-file-pdf fa-2x text-white-50 float-right"></i>
                </h4>
                <h4>Total de arquivos recebidos: <b> {{ $arquivos_recebidos }}</b></h4>
                <h4>Aguardando download:<b> {{ $arquivos_recebidos_nao_baixados }}</b></h4>
            </div>

        </div>
        <!-- /.card -->
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card bg-light">
            <div class="card-header">
                <h3 class="card-title"><b>Cadastrar Aviso</b></h3>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" action=" {{ route('notas.store') }}">
                @include('pages.painel.dashboard._partials.form')

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-light">
            <div class="card-header">
                <h3 class="card-title"><b>Painel de Avisos</b></h3>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Assunto</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Data</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notes as $note)
                        <tr>
                            <td>{{ $note->assunto }}</td>

                                <td>{{ $note->postador_name }}</td>

                            <td>{{ \Carbon\Carbon::parse($note->created_at)->format('d/m/y H:i')}}</td>
                            <!-- Parametro de link para ID -->
                            <td><a type="button" class="btn btn-success" href="{{route('notas.show', $note->id)}}">Ver</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

</div>


@endsection

