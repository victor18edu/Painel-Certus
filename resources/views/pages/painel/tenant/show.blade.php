@extends('adminlte::page')
@section('css')
    <style>
        .btn-editar{
            background-color: #e6be88 ;
            border-color: #e6be88 ;
        }
        .btn-editar:hover{
            background-color: #b17625 ;
            border-color: #b17625 ;
        }
        .btn-desabilitar{
            background-color: #e63c4d  ;
            border-color: #e63c4d  ;
        }
        .btn-desabilitar:hover{
            background-color: #c01829 ;
            border-color: #c01829 ;
        }
        .btn-historico{
            background-color: #909090 ;
            border-color: #909090 ;
        }
        .btn-historico:hover{
            background-color: #7c7c7c ;
            border-color: #7c7c7c ;
        }

    </style>
@endsection
@section('content')
    <h2>Usuário da empresa {{ $tenant->name }}</h2>
    <div class="row">

        <div class="col-12 col-lg-6 col-md-6">
            <div class="input-group">
                <input type="text" class="form-control rounded" placeholder="Nome, Email ou Telefone" aria-label="Text input with dropdown button">
                <div class="input-group-append">
                    <button class="btn btn-secondary rounded-0" type="button">Buscar</button> &nbsp
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 col-md-6">
            <button class="btn btn-info rounded-0 float-right" data-toggle="modal" data-target="#modalCadastrar" disabled type="button">Cadastrar</button>

        </div>
        <div class="col-12 col-lg-6 col-md-6">
            <div>
                @if(session('mensagem'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{session('mensagem')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <br><!-- Modal -->
    <div class="modal fade" id="modalCadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('usuarios.store') }}" method="post">

              {{--          @include('pages.painel.usuarios._partials.form')--}}
                    </form>
                    <div class="clearfix confimacao" hidden="">
                        <label>Aguarde, estou notificando o destinatário</label>
                        <div class="spinner-grow text-primary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Ações</th>
            <th scope="col">Upload</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tenant_users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                 <td>{{ $user->email }}</td>
                <td>
                    <div class="btn-group btn-group-sm" role="group" aria-label="...">
                        <a href="{{ route('usuarios.edit', [$user->id]) }}" >
                            <button type="button" class="btn btn-editar rounded-0 text-white"> Editar</button>
                        </a>
                        <form action="{{ route('usuarios.destroy', [$user->id]) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-desabilitar rounded-0 text-white">Desabilitar </button>
                        </form>
                        <a href="{{ route('usuarios.historic', [$user->id]) }}">
                            <button type="button" class="btn btn-historico rounded-0 text-white">Histórico</button>
                        </a>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button type="button" class="btn btn-success rounded-0 text-white" data-toggle="modal" data-target="#exampleModal{{ $user->id }}">Enviar Arquivo</button>
                        </div>
                    </div>
                </td>
            </tr>


            <!-- Modal -->
            <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">ENVIAR ARQUIVO</h5>
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
                            <form action="{{ route('usuarios.upload') }}" class="form_upload" method="post" enctype="multipart/form-data">
                                @csrf


                                <div class="form-group">

                                    <label for="exampleInputPassword1">Nome do cliente</label>

                                    <input type="text" name="client_name" value="{{ $user->name }}" class="form-control" readonly>
                                    <input type="text" name="user_id" value="{{ $user->id }}" hidden="" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Assunto</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="far fa-edit"></i></div>
                                        </div>
                                        <input type="text"  required="" class="form-control" name="assunt" id="assunto{{ $user->id}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Arquivo</label>
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa fa-cloud-upload-alt"></i></div>
                                        </div>
                                        <input type="file" class="form-control" name="arquivos[]" id="arquivo{{ $user->id}}" multiple required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Anotações</label>
                                    <textarea class="form-control" name="notes" id="notes{{ $user->id}}" rows="5"></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary cancelar rounded-0" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success evniar rounded-0" >Enviar</button>
                                </div>


                            </form>
                        </div>

                    </div>
                    <!-- Modal -->

        @endforeach
        </tbody>
    </table>

    {{--{{ $users->links() }}--}}

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function(){

            $(".form_upload").submit(function(e){

                $(".confimacao").removeAttr('hidden')

            })
        })
    </script>

@endsection
