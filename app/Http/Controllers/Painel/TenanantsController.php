<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Models\Level;
use App\Models\Tenant;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TenanantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {


        if(Gate::any(['adm_sistema','super_adm'])){
            $tenants = Tenant::ativos()->get();

            return view('pages.painel.tenant.index', [
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
        if(Gate::any(['adm_sistema','super_adm'])) {
            return view('pages.painel.tenant.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        if(Gate::any(['adm_sistema','super_adm'])) {
            $tenant = new Tenant;
            $tenant->name = $request->name;
            $tenant->cnpj_cpf = $request->cnpj_cpf;
            $tenant->email = $request->email;
            $tenant->phone = $request->phone;
            if($tenant->save()){
                return redirect()->back()->with('success','Empresa cadastrada com sucesso');
            }else{
                return redirect()->back()->with('error','Erro ao cadastrar');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        if(Gate::any(['adm_sistema','super_adm'])) {
            $tenant = Tenant::with('users')->find($id);
           // dd($tenant);
            $tenant_users = $tenant->users;
            // lista usuarios de nivel usuário para cadastro em emprsa especifica
            $levels = Level::listLevelUser()->get();
            if ($tenant){
                return view('pages.painel.tenant.show',[
                    'tenant' => $tenant,
                    'tenant_users' => $tenant_users,
                    'levels' => $levels
                ]);
            }else{
                return redirect()->back();
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tenant = Tenant::find($id);

        if(Gate::any(['adm_sistema','super_adm'])) {
            return view('pages.painel.tenant.edit',[
                'tenant' => $tenant
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if(Gate::any(['adm_sistema','super_adm'])) {
            if($tenant = Tenant::find($id)){
                $tenant->name = $request->name;
                $tenant->cnpj_cpf = $request->cnpj_cpf;
                $tenant->phone = $request->phone;
                $tenant->email= $request->email;
                $tenant->update();
            }else{
                return redirect()->back();
            }

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::any(['adm_sistema','super_adm'])) {
            if ($tenant = Tenant::find($id)) {

                if ($tenant->delete()) {
                    return redirect()->back()->with('mensagem', 'Empresa dasativada com sucesso');
                }
            }
        }
    }
}
