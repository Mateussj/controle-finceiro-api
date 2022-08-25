<?php

namespace App\Http\Controllers;

use App\Models\Operacao;
use Illuminate\Http\Request;

class OperacoesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request = json_decode($request->getContent(), true);

        if ($this->validateOperacao($request)) {
            return response('Invalid data', 202);
        }

        return response(
            json_encode(Operacao::create([
                'titulo' => $request['titulo'],
                'valor' => $request['valor'],
                'data_da_operacao' => $request['data_da_operacao'],
                'categoria_id' => $request['categoria_id'],
            ])),
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Opercao = Operacao::find($id);
        return response(
            json_encode($Opercao),
            200
        );
    }

    /**
     * Display the specified resource.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $Opercao = new Operacao();
        return response(
            json_encode($Opercao->get()),
            200
        );
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
        $request = json_decode($request->getContent(), true);

        if (!$id) {
            return response(
                'Invalid ID',
                400
            );
        }

        if ($this->validateOperacao($request)) {

            return response('Invalid data', 202);
        }

        Operacao::where('id', $id)->update(
            [
                'titulo' => $request['titulo'],
                'valor' => $request['valor'],
                'data_da_operacao' => $request['data_da_operacao'],
                'categoria_id' => $request['categoria_id'],
            ]
        );
        return response(Operacao::where('id', $id)->first(), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Opercao = Operacao::find($id);
        if ($Opercao) {
            $Opercao->delete();
            return response()->json($Opercao->delete(), 200);
        }
        return response()->json(["message" => "Registro não encontrado"], 200);
    }

    public function validateOperacao($request)
    {
        if (
            (!isset($request['titulo']) or $request['titulo'] == '')
            or (!isset($request['valor']) or $request['valor'] <= 0)
            or (!isset($request['data_da_operacao']) or $request['data_da_operacao'] <= 0)
            or (!isset($request['categoria_id']) or $request['categoria_id'] == '')
        ) {
            return true;
        }
    }
}
