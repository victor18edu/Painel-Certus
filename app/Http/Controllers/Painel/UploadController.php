<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Mail\newFileMail;
use App\Models\Arquivo;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Gate::any(['super_adm', 'adm_sistema'])) {
            $usu = User::find($request->user_id);
            $tenant = Tenant::find($usu->tenant_id);
            $user = $request->all();

        }
        if(Gate::any(['cliente_empresa', 'adm_empresa'])){
            $usu = Auth::user();
            $tenant = Tenant::find($usu->tenant_id);
            $user = $request->all();

        }

        for ($i=0; $i <count($user['arquivos']) ; $i++) {
            if(Gate::any(['super_adm', 'adm_sistema'])){
                $pastas_arquivos = Str::slug($user['client_name'], '_');
                $user['direction'] = "0";// aqui informa que em deirecao ao cliente

            };
            if(Gate::any(['cliente_empresa', 'adm_empresa'])){

                $pastas_arquivos = Str::slug(auth()->user()->name, '_');
                $user['user_id'] =  auth()->user()->id;
                $user['direction'] = "1" ;// aqui informa que em deirecao ao cliente
            };

            $arquivo = $request->allFiles()['arquivos'][$i];

            if($user['path'] =  $arquivo->store(Str::slug($tenant->name, '_')."/".$pastas_arquivos)){

                Arquivo::create($user);

                //return new newFileMail($user['user_id'], $user['assunt']);
                Mail::send(new newFileMail($user['user_id'], $user['assunt']));
                return redirect()->back();
            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
