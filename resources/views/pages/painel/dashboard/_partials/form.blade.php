@csrf
<div class="form-group">
    <label for="inputUsuario">Usuário</label>
    <select class="form-control" name="user_id" id="inputUsuario">
        @foreach($users as $user)
            {{$user}}
        <option value="{{$user->id}}">{{ $user->name }} - {{ isset($user->tenant->name) ? $user->tenant->name : "" }} </option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="inputAssunto">Assunto</label>
    <input type="text" class="form-control" name="assunto" id="inputAssunto">
</div>
<div class="form-group">
    <label for="inputNota">Aviso</label>
    <textarea class="form-control" id="inputNota" name="text" rows="3"></textarea>
</div>
<input type="submit" class="btn btn-success float-right" value="Enviar">
