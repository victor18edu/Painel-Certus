<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Arquivo;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Mail\newFileMail;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {

        // scopo super adm
        if (Gate::allows('super_adm'))
        {
            $users = User::listUser()->with('tenant')->paginate(25);
            $levels = Level::where('id', "<=", auth()->user()->level_id)->get();
            $tenants = Tenant::ativos()->get();

            if($users)
            {
                return view("pages.painel.usuarios.index", [
                    'users' => $users,
                    'levels' => $levels,
                    'tenants' => $tenants
                ]);
            }
        }
            //Scopo Adm
        if(Gate::allows('adm_sistema')){
            $users = User::listUser()->with('tenant')->get();
            $levels = Level::where('id', "<", auth()->user()->level_id)->get();
            $tenants = Tenant::ativos()->get();

            return view('pages.painel.usuarios.index', [
                'users' => $users,
                'levels' => $levels,
                'tenants' => $tenants
            ]);

        }
        if(Gate::allows('adm_empresa')){
            $users = User::where('tenant_id', Auth::user()->tenant_id)->with('tenant')->get();
            $levels = Level::where('id', "<", auth()->user()->level_id)->get();
            $tenants = Tenant::where('id', Auth::user()->tenant_id)->get();

            return view('pages.painel.usuarios.index', [
                'users' => $users,
                'levels' => $levels,
                'tenants' => $tenants
            ]);

        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {

        if(Gate::allows('adm_empresa')){

            $tenants = Tenant::where('id', Auth::user()->tenant_id)->get();


            $levels = Level::where('id', "<", auth()->user()->level_id)->get();

            return view('pages.painel.usuarios.create',[
                'tenants' => $tenants,
                'levels' => $levels
            ]);
        }
        if(Gate::allows('adm_sistema')){

            $tenants = Tenant::ativos()->get();

            $levels = Level::where('id', '<', auth()->user()->level_id)->get();

            return view('pages.painel.usuarios.create',[
                'tenants' => $tenants,
                'levels' => $levels
            ]);
        }
        if(Gate::allows('super_adm')){
            $tenants = Tenant::ativos()->get();

            $levels = Level::where('id', "<=", auth()->user()->level_id)->get();

            return view('pages.painel.usuarios.create',[
                'tenants' => $tenants,
                'levels' => $levels
            ]);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if(Gate::denies(['cliente_empresa'])){

            $cadastro = new User;
            $cadastro->name = $request->name;
            $cadastro->email = $request->email;
            $cadastro->tenant_id = $request->tenant_id;
            $cadastro->password = bcrypt($request->password);
            $cadastro->phone_fixo = $request->phone_fixo;
            $cadastro->whatsapp = $request->whatsapp;
            $cadastro->level_id = $request->level_id;
            if(isset($request->sendFile)){
                $cadastro->sendFile = 1;
            }else{
                $cadastro->sendFile = 0;
            }


            if($cadastro->save()){
                return redirect()->back()->with('success', 'Usuário cadastrado com sucesso');
            }else{
                return redirect()->back()->with('error', 'Erro ao cadastrar usuário, verifique os dados e envie novamente');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function config()
    {

        if(Gate::authorize('adm')){
            $user = User::find(auth()->user()->id);
            return view('pages.painel.adm.client.edit', [
                'user' => $user
            ]);
        }

    }

    public function edit($id)
    {
        if(Gate::ann('cliente_empresa')){
            $user = User::find($id);
            $tenants = Tenant::ativos()->get();
            $levels = Level::where('id', "<=", auth()->user()->level_id)->get();
            return view('pages.painel.usuarios.edit', [
                'user' => $user,
                'levels' => $levels,
                'tenants' => $tenants
            ]);
        }
    }

      public function update(Request $request, $id)
    {

       if(Gate::denies('cliente_empresa')){
           if(isset($request->sendFile)){

               $request['sendFile'] = 1;
           }else{

               $request['sendFile']= 0;
           }


           if($cliente = User::find($id)){

                $cliente->name = $request->name;
                $cliente->email = $request->email;
                $cliente->whatsapp = $request->whatsapp;
                $cliente->phone_fixo = $request->phone_fixo;
                if(!empty($request->password) || $request->password != null){
                    $cliente->password = bcrypt($request->password);
                }
               $cliente->sendFile = $request->sendFile;
                $cliente->update();
                return redirect()->back();

            }else{
                return redirect()->back();
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::any(['adm_sistema', 'super_adm'])){
            $cliente = User::find($id);
            if($cliente->delete()){
                return redirect()->back();
            }
        }
    }



    public function historic(Arquivo $arquivo, $id)
    {

        if(Gate::denies('cliente_empresa')){
             $files = $arquivo->where('user_id', $id)->with('user')->orderByDesc('id')->paginate(10);


                if(!empty($files->all())){
                    foreach ($files->all() as $arq) {
                        if($arq->visibility == "0" && $arq->direction == "1"){
                            $arq['visibility'] = "1";
                            $arq->update();
                        }
                    }

                     $user = $files[0]->user->name;
                    return view('pages.painel.usuarios.historic', [
                    'files' =>$files,
                    'user'=>$user
                    ]);
                }
              }
        }


}
