@extends('adminlte::page')
@section('css')
<style>
.btn-editar {
    background-color: #e6be88;
    border-color: #e6be88;
}

.btn-editar:hover {
    background-color: #b17625;
    border-color: #b17625;
}

.btn-desabilitar {
    background-color: #e63c4d;
    border-color: #e63c4d;
}

.btn-desabilitar:hover {
    background-color: #c01829;
    border-color: #c01829;
}

.btn-historico {
    background-color: #909090;
    border-color: #909090;
}

.btn-historico:hover {
    background-color: #7c7c7c;
    border-color: #7c7c7c;
}
</style>

@endsection

@section('script')
    <script language="Javascript">
        function confirmacao(id) {
             var resposta = confirm("Deseja remover esse registro?");
             if (resposta == true) {
                  window.location.href = "remover.php?id="+id;
             }
        }
    </script>
@endsection
@section('content')

<div class="row">
    <div class="col-12 col-lg-12 col-md-12">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
            @if(session('error'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-6 col-md-6">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Nome, Email, CPF/CNPJ ou Telefone"
                aria-label="Text input with dropdown button">
            <div class="input-group-append">
                <button class="btn btn-secondary rounded-0" type="button">Buscar</button>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-6 col-md-6">
        <button class="btn btn-info rounded-0 float-right" data-toggle="modal" data-target="#modalCadastrar"
            type="button">Cadastrar</button>
    </div>

</div>
<br>
<div class="modal fade bd-example-modal-lg" id="modalCadastrar" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastrar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="clearfix confimacao" hidden="">
                    <label>Aguarde, estou notificando o destinatário</label>
                    <div class="spinner-grow text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>

                </div>
                <form action="{{ route('empresas.store') }}" class="form_upload" method="post"
                    enctype="multipart/form-data">
                    <!-- ******* AQUI DEVE FICAR O INCLUDE ********** -->
                    @include('pages.painel.tenant._partials.form')
                </form>
            </div>
        </div>
    </div>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">CPF/CNPJ</th>
            <th scope="col">Telefone</th>
            <th scope="col ">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tenants as $tenant)
        <tr>

            <td>{{ $tenant->name }}</td>
            <td>{{ $tenant->email }}</td>
            <td>{{ $tenant->cnpj_cpf }}</td>
            <td>{{ $tenant->phone }}</td>
            <td>

                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                    <a href="{{ Route('empresas.edit', $tenant->id) }}">
                        <button type="button" class="btn btn-editar rounded-0 text-white"> Editar</button>
                    </a>
                    <form action="{{ route('empresas.destroy', $tenant->id) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-desabilitar rounded-0 text-white">Excluir </button>
                    </form>
                    <a href="{{ route('empresas.show', $tenant->id) }}">
                        <button type="button" class="btn btn-historico rounded-0 text-white">Usuários</button>
                    </a>

                </div>
            </td>


        </tr>

        @endforeach
    </tbody>
</table>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- Optional: include a polyfill for ES6 Promises for IE11 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


@endsection
