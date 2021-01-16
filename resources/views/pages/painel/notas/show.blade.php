@extends('adminlte::page')
@section('css')
<style>
/*Definido cor das linhas pares*/
.card-comment:nth-child(even) {
    background: #FFF
}

/*Definindo cor das Linhas impáres*/
.card-comment:nth-child(odd) {
    background: #EEE
}
</style>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <!-- Box Comment -->
        <div class="card card-widget">
            <div class="card-header">
                <div class="user-block">
                    <span class="username">
                        <h4><b>Assunto: {{$nota->assunto}}</b></h4>
                    </span>
                    <span class="username">Autor: {{$nota->postador_name}}</span>
                    <span class="description">{{$nota->created_at}} </span>

                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                    <div class="row">
                        <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Mark as read">
                            <i class="far fa-circle"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                        <form method="post" action="{{ route('notas.destroy', $nota->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-tool"><i class="fas fa-2x fa fa-window-close text-danger "></i>
                            </button>
                        </form>
                    </div>



                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <p>{{$nota->text}}</p>

                <span class="float-right text-muted"> {{ count($comments) }} comentários</span>
            </div>
            <!-- /.card-body -->
            <div class="card-footer card-comments">
                <h4><b>Comentários</b></h4><br />
                @if(count($comments)>'0')
                @foreach($comments as $comment)
                @if(auth()->user()->id == $comment->use_id)
                <div class="card-comment">
                    <!-- User image -->
                    <div class="comment-text">
                        <span class="username">
                        @if($comment->user->id == $nota->user->id)
                           <b>Autor - </b> <b>Você</b> {{$comment->user->name}}
                        @else
                            <b>Você</b> {{$comment->user->name}}
                        @endif
                            <span class="text-muted float-right">{{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i')}}</span>
                        </span><!-- /.username -->
                        {{ $comment }}
                    </div>
                    <!-- /.comment-text -->
                </div>
                @else
                <div class="card-comment">
                    <!-- User image -->
                    <div class="comment-text">
                        <span class="username">
                        @if($comment->user->id == $nota->user->id)
                           <b>Autor- </b> {{$comment->user->name}}
                           @else
                           {{$comment->user->name}}
                        @endif
                        <span class="text-muted float-right">{{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y H:i')}}</span>
                        </span><!-- /.username -->
                        {{ $comment->content }}

                    </div>
                    <!-- /.comment-text -->
                </div>
                @endif

                @endforeach

                @else
                <h3>Ainda não existem comentários para este aviso</h3>
                @endif

            </div>
            <!-- /.card-footer -->
            <div class="card-footer">
                <form action="{{ route('comentarios.store') }}" method="post">
                    @csrf
                    <!-- .img-push is used to add margin to elements next to floating images -->
                    <div class="img-push input-group">
                        <input type="hidden" name="nota_id" value={{ $nota->id }}>
                        <input type="text-area" name="comentario" required placeholder="Escreva seu comentário ..."
                            class="form-control form-control-sm">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-success btn-sm rounded-0">Enviar</button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- /.card-footer -->
        </div>
        <!-- /.card -->
    </div>
</div>


@endsection
