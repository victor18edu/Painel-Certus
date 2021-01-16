@csrf

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="inputNome">Nome</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-user"></i></div>
            </div>
            <input type="text" class="form-control" name="name" id="inputNome" placeholder="Nome"
                value="{{ $tenant->name ?? old('name') }}">
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="inputCpfCnpj">CPF/CNPJ</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-info-circle"></i></div>
            </div>
            <input type="text" class="form-control " name="cnpj_cpf" data-mask-for-cpf-cnpj id="inputCpfCnpj"
                placeholder="CPF / CNPJ apenas números" value="{{ $tenant->cnpj_cpf ?? old('cnpj_cpf') }}">
        </div>
    </div>
</div>
<div class="form-row">

    <div class="form-group col-md-6">
        <label for="inputEmail">E-mail</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-at"></i></div>
            </div>
            <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Endereço de Email"
                value="{{ $tenant->email ?? old('email') }}">
        </div>
    </div>
    <div class="form-group col-md-6">
        <label for="inputSenha">Telefone</label>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fa fa-key"></i></div>
            </div>
            <input type="text" name="phone" class="form-control" id="telefone_fixo" placeholder="Informe o telefone"
                value="{{ $tenant->phone ?? old('Telefone') }}">
        </div>
    </div>
</div>

<button type="submit" class="btn btn-success float-right">Enviar</button>
