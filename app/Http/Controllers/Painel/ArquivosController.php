<?php

namespace App\Http\Controllers\Painel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arquivo;

use Illuminate\Support\Facades\Gate;

class ArquivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     //* @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if(Gate::any(['cliente_empresa', 'adm_empresa'])){
            $arquivos = Arquivo::where('user_id', auth()->user()->id)->orderByDesc('id')->paginate();

             foreach ($arquivos->all() as $arq) {
                if($arq->visibility == "0" && $arq->direction == "0"){
                    $arq['visibility'] = "1";
                    $arq->update();
                }

            }
            return view('pages.painel.arquivo.index', [
                'arquivos' => $arquivos,

            ]);

        }
        if(Gate::any(['super_adm', 'adm_sistema'])){
            $arquivos = Arquivo::orderByDesc('id')->paginate();

            foreach ($arquivos->all() as $arq) {
                if($arq->visibility == "0" && $arq->direction == "1"){
                    $arq['visibility'] = "1";
                    $arq->update();
                }

            }
            return view('pages.painel.arquivo.adm.index', [
                'arquivos' => $arquivos,

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        dd($id);
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

   public function download($id)
   {

        $arqui = Arquivo::find($id);
        if(Gate::any(['adm_sistema', 'super_adm'])){
            if($arqui['status'] == '0' && $arqui['direction'] == 1){
                $arqui['status'] = '1';
                $arqui->save();
            }
        }
        if(Gate::any(['adm_empresa', 'cliente_empresa'])){

            if($arqui['status'] == '0' && $arqui['direction'] == 0){
                $arqui['status'] = '1';
                $arqui->save();
            }

        }
        return Storage::download($arqui->path);
    }


}
