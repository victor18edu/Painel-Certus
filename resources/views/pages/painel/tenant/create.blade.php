@extends('adminlte::page')

@section('content')

    <h2>Cadastrar </h2>
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
    <form method="post" action="{{ route('empresas.store')  }}">
        @include('pages.painel.tenant._partials.form')
    </form>
    <a href="{{route('empresas.index')}}"><button type="button" class="btn btn-info">Listar</button></a>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jsmask.js') }}"></script>

        <!-- <p>
            Este furmulário encontra-se na pasta _partial. Isso é feito pq o mesmo form de cadatro é
            o de edição, então para reaproveitamento de código é feito dessa maneira
        </p> -->
    </div>



@endsection
