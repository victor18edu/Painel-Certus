<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\Controller;
use App\Models\Arquivo;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;



class   DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {

        if(Gate::any(['super_adm', 'adm_sistema'])){

            $notes = Note::orderByDesc('id')->with('user')->paginate(5);
            $users = User::listUser()->orderByDesc('name')->get();
            $arquivos = Arquivo::get();

            // conta total de arquivos que nao foram baixados
            $arquivos_enviados_nao_baixados = 0;
            $arquivos_recebidos_nao_baixados = 0;
            $arquivos_enviados = 0;
            $arquivos_recebidos = 0;
            foreach ($arquivos as $arquivo){
                if($arquivo['direction'] == '0'){
                    $arquivos_enviados += 1;
                }
                if($arquivo['direction'] == '1'){
                    $arquivos_recebidos += 1;
                }
                if($arquivo['status'] == '0' && $arquivo['direction'] == '0'){
                    $arquivos_enviados_nao_baixados += 1;
                }
                if($arquivo['status'] == '0' && $arquivo['direction'] == '1'){
                    $arquivos_recebidos_nao_baixados += 1;
                }
            }

            //FIM conta total de arquivos que nao foram baixados


            return view('pages.painel.dashboard.index', [
               'notes' => $notes,
                'users' => $users,
                'arquivos_enviados_nao_baixados'=> $arquivos_enviados_nao_baixados,
                'arquivos_enviados' => $arquivos_enviados,
                'arquivos_recebidos_nao_baixados' => $arquivos_recebidos_nao_baixados,
                'arquivos_recebidos' => $arquivos_recebidos
            ]);
        }

        if(Gate::any(['cliente_empresa', 'adm_empresa'])){

            $notes = Note::where('user_id', Auth::user()->id)->orWhere('postador_id', Auth::user()->id)->orderByDesc('id')->with('user')->get();

            $users = User::where('level_id','>', '2')->orderByDesc('name')->get();

            $arquivos = Arquivo::where('user_id', Auth::user()->id)->get();

            // conta total de arquivos que nao foram baixados
            $arquivos_enviados_nao_baixados = 0;
            $arquivos_recebidos_nao_baixados = 0;
            $arquivos_enviados = 0;
            $arquivos_recebidos = 0;
            foreach ($arquivos as $arquivo){
                if($arquivo['direction'] == '1'){
                    $arquivos_enviados += 1;
                }
                if($arquivo['direction'] == '0'){
                    $arquivos_recebidos += 1;
                }
                if($arquivo['status'] == '0' && $arquivo['direction'] == '1'){
                    $arquivos_enviados_nao_baixados += 1;
                }
                if($arquivo['status'] == '0' && $arquivo['direction'] == '0 '){
                    $arquivos_recebidos_nao_baixados += 1;
                }
            }

            //FIM conta total de arquivos que nao foram baixados


            return view('pages.painel.dashboard.index', [
                'notes' => $notes,
                'users' => $users,
                'arquivos_enviados_nao_baixados'=> $arquivos_enviados_nao_baixados,
                'arquivos_enviados' => $arquivos_enviados,
                'arquivos_recebidos_nao_baixados' => $arquivos_recebidos_nao_baixados,
                'arquivos_recebidos' => $arquivos_recebidos
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        /*$notes = new Note;
        $notes->user_id = $request->user_id;
        $notes->assunto = $request->assunto;
        $notes->text = $request->text;
        if($notes->save()){
            return redirect()->back();
        }*/

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
