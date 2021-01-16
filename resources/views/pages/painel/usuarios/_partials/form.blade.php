@csrf
<!-- <div class="alert alert-warning">
    <h4> PADRONIZAR FORMULÁRIO</h4>
    <p>
        1 - padronizar o form que ta dentro do _partial
    </p>
</div> -->
<div class="form-group">

    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <label for="exampleInputEmail1">Nível:</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-level-up-alt"></i></div>
                 </div>
                <select name="level_id" class="form-control" id="level">
                        <option value="">Informe o nível de privilégio deste usuário</option>
                    @foreach($levels as $level)
                        <option value="{{ $level->id  }}">{{ $level->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6" hidden id="tenants">
            <label for="exampleInputEmail1">Empresa:</label>
            <select name="tenant_id" class="form-control" id="level">
                <option value="">Informe a empresa deste usuário</option>

                @foreach($tenants as $tenant)
                    <option value="{{ $tenant->id  }}">{{ $tenant->name }}</option>
                @endforeach
            </select>
        </div>

</div>
</div>
 <div class="form-group">

    <div class="row">
    	<div class="col-12 col-md-6 col-lg-6">
    		<label for="exampleInputEmail1">Nome:</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-user"></i></div>
                 </div>
    		    <input type="text" class="form-control" id="nome_cliente" name="name" aria-describedby="emailHelp" placeholder="Informe o nome" value=" {{ $user->name ?? old('name') }}" required="">
    	    </div>
        </div>
    	<div class="col-12 col-md-6 col-lg-6">
    		<label for="exampleInputEmail1">Email:</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-at"></i></div>
                </div>
    		    <input type="email" class="form-control" id="email_cliente" name="email" aria-describedby="emailHelp" placeholder="Informe o email "  value="{{ $user->email ?? old('email') }}" required="">
    	    </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <label for="exampleInputEmail1">WhatsApp:</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fab fa-whatsapp fa-lg"></i></div>
                </div>
                <input type="text" class="form-control" id="telefone_cliente" name="whatsapp" aria-describedby="emailHelp" placeholder="informe o whatsApp" value="{{ $user->whatsapp ?? old('whatsapp') }}" required="">
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <label for="exampleInputEmail1">Telefone Fixo:</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-phone-alt "></i></div>
                </div>
                <input type="text" class="form-control" id="telefone_fixo" aria-describedby="emailHelp" placeholder="Informe um telefone fixo" name="phone_fixo" value="{{ $user->phone_fixo ?? old('telefone') }}">
            </div>
        </div>

    </div>

  </div>

<div class="form-group">
    <div class="row">
    	<div class="col-12 col-md-6 col-lg-6">
    		<label for="exampleInputEmail1">Senha</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-key"></i></div>
                </div>
    		    <input type="text" class="form-control" id="password_cliente" name="password" aria-describedby="emailHelp" placeholder="Informe uma senha">
    	    </div>
        </div>
    	<div class="col-12 col-md-6 col-lg-6">
    		<label for="exampleInputEmail1">Confirme a senha</label>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-key"></i></div>
                </div>
    		<input type="text" class="form-control" id="confirm_passowrd" aria-describedby="emailHelp" placeholder="Informe uma senha">
    	    </div>
        </div>
   </div>
</div>
@canany(['super_adm', 'adm_sistema'])
        <div class="form-check" id="file">
            <input type="checkbox" class="form-check-input" id="sendFile" name="sendFile" disabled>

            <label class="form-check-label" for="exampleCheck1" >Este cliente pode enviar arquivo</label>
        </div>
@endcan




<script src="{{ url('https://code.jquery.com/jquery-3.5.1.js')  }}"></script>
<script src="{{ url('https://cdn.jsdelivr.net/npm/sweetalert2@10')  }}"></script>
{{--<script src="https://code.jquery.com/jquery-3.5.1.js"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>--}}
<script>
    $(document).ready(function (){
        $("#level").change(function (){


            if($(this).val() === '3' || $(this).val() === '4'){
                Swal.fire(
                    'ATENÇÃO - Você está dando acesso de ADM ou SUPER ADM a este usuário',
                    'Ele terá acesso a informacões e funções privilegiadas',
                    'question'
                )

            }
            if($(this).val() === '1' || $(this).val() === '2'){

                $("#sendFile").removeAttr('disabled');
                $("#tenants").removeAttr('hidden');
            }else{

                $("#sendFile").attr('disabled', 'disabled');
                $("#tenants").attr('hidden', 'hidden');

            }


        })

    })
    $(document).ready(function(){

        $("#confirm_passowrd").focusout(function(){
            if($("#confirm_passowrd").val() != $("#password_cliente").val()){
                $("#invalid").addClass('alert alert-danger')
                $("#invalid").text('Senhas não conferem')


            }else{
                $("button").removeAttr('disabled')
                $("#invalid").remove()
            }

        })


    })
</script>




