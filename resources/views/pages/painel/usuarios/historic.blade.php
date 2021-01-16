@extends('adminlte::page')

@section('content')
<!--
<section>
  <button type="button" class="btn btn-info btn-lg my-3" data-toggle="modal" data-target="#ArquivoModal">ENVIAR ARQUIVO</button>
</section> -->
<table class="table table-striped text-center">

  <thead>
    <tr>
       <th scope="col">Asssunto</th>
      <th scope="col">Data de envio</th>
      <th scope="col">Download</th>
      <th scope="col">Visualizado</th>
      <th scope="col">Açao</th>
      <th>Notas</th>
    </tr>
  </thead>
  <tbody>
      @foreach ($files as $file)
        <tr>
          <td>{{ $file->assunt }}</td>
            <td>{{ date_format($file->created_at ,"d-m-Y H:i") }}</td>
            <td>
                @if($file->status == '0')
            <a href="{{ route('arquivo.download', [$file->id]) }}" type="button" class="btn btn-danger" id="{{ $file->id }}">
                    <i class="fa fa-thumbs-down" aria-hidden="true"  ></i>
                </a>

                @else
                 <a href="{{ route('arquivo.download', [$file->id]) }}" type="button" class="btn btn-success">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                </a>
                 <br>
                 @if($file->status== '1' )
                <small>
                  {{ date_format($file->updated_at ,"d-m-Y H:i") }}
                </small>
                @endif
                @endif
            </td>
            <td>
                @if($file->visibility == '0')
                <div type="button" class="btn btn-danger">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </div>
                @else
                 <div type="button" class="btn btn-success">
                    <i class="fa fa-eye" aria-hidden="true"></i>
                </div>
                <br>
                 @if($file->status==0 )
                <small>
                  {{ date_format($file->updated_at ,"d-m-Y H:i") }}
                </small>
                @endif
                @endif
            </td>
            <td>

              @if($file->direction == '1')
                <div type="button" class="btn btn-info">
                   <i class="fa fa-download" aria-hidden="true"></i>
                </div>
                <br>
                 <small>
                  {{ date_format($file->created_at ,"d-m-Y H:i") }}
                </small>
                @else
                 <div type="button" class="btn btn-success">
                    <i class="fa fa-upload" aria-hidden="true"></i>
                </div>
                <br>
                <small>
                  {{ date_format($file->created_at ,"d-m-Y H:i") }}
                </small>
                @endif

            </td>
             <td>
	      	<div class="btn btn-info btn-block bnt-sm notas " data-toggle="modal" data-target="#exampleModal{{ $file->id }}" id="{{ $file->id }}">NOTAS</div>
	      </td>
        </tr>
              <!-- Modal notas -->
<div class="modal fade" id="exampleModal{{ $file->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ $file->notes }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm " data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
      @endforeach

   </tbody>

</table>

<!-- Modal arquivo -->
<div class="modal fade" id="ArquivoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Enviar arquivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{ route('upload.index') }}" method="post" enctype="multipart/form-data">
         @csrf

            <div class="form-group">
              <label for="exampleInputPassword1">Assunto</label>
              <input type="text" class="form-control" name="assunt" id="assunto">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Arquivo</label>
              <input type="file" class="form-control" name="arquivos[]" id="arquivo" multiple>
            </div>
              <div class="form-group">
              <label for="exampleInputPassword1">Anotações</label>
              <textarea class="form-control" name="notes" id="notes" rows="5"></textarea>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success" id="enviar" >ENVIAR</button>
          </div>


        </form>
      </div>

    </div>
  </div>
</div>
@endsection

