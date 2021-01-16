@extends('adminlte::page')

@section('content')

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Assunto</th>
            <th scope="col">Usuário</th>
            <th>Data / Hora</th>

            <th scope="col">Ver</th>
        </tr>
        </thead>
        <tbody>
        @foreach($notas as $nota)
        <tr>
            <th scope="row">{{ $nota->assunto }}</th>
            <td>{{ $nota->user->name }}</td>
            <td>{{ \Carbon\Carbon::parse($nota->created_at)->format('d/m/Y H:i')}}</td>

            <td>
                <a href="{{ route('notas.show', $nota->id) }}">VER</a>
            </td>
        </tr>
       @endforeach
        </tbody>
    </table>

{{--    @foreach($notas as $nota)--}}
{{--        @foreach($nota->comments as $comment)--}}
{{--            {{ $comment->content  }}--}}
{{--        @endforeach--}}
{{--    @endforeach--}}


@endsection


