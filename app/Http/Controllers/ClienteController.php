<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Endereco;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('enderecos')->get();

        if ($clientes->isEmpty()) {
            return response()->json(['message' => 'Nenhum cliente encontrado.'], 404);
        }

        return response()->json($clientes, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cnpj' => 'required|unique:clientes',
            'razao_social' => 'required',
            'nome_contato' => 'required',
            'telefone' => 'required',
            'enderecos.*.logradouro' => 'required',
            'enderecos.*.numero' => 'required',
            'enderecos.*.bairro' => 'required',
            'enderecos.*.cidade' => 'required',
            'enderecos.*.estado' => 'required',
            'enderecos.*.cep' => 'required',
        ]);

        $cliente = Cliente::where('cnpj', $request->input('cnpj'))->first();

        if ($cliente) {
            return response()->json(['error' => 'O CNPJ já está cadastrado'], 400);
        }

        $cliente = Cliente::create($request->all());
        $cliente->enderecos()->createMany($request->input('enderecos'));

        return response()->json(['message' => 'Cliente criado com sucesso'], 201);
    }


    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);

        return response()->json($cliente);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'cnpj' => 'required',
            'razao_social' => 'required',
            'nome_contato' => 'required',
            'telefone' => 'required',
            'enderecos.*.logradouro' => 'required',
            'enderecos.*.numero' => 'required',
            'enderecos.*.bairro' => 'required',
            'enderecos.*.cidade' => 'required',
            'enderecos.*.estado' => 'required',
            'enderecos.*.cep' => 'required',
        ]);

        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        $cliente->enderecos()->delete();
        $cliente->enderecos()->createMany($request->input('enderecos'));

        return response()->json(['message' => 'Cliente atualizado com sucesso.', 'cliente' => $cliente]);
    }


    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->enderecos()->delete();
        $cliente->delete();

        return response()->json(['message' => 'Cliente excluído com sucesso.'], 204);
    }

    public function listarEnderecos($id)
    {
        $cliente = Cliente::findOrFail($id);
        $enderecos = $cliente->enderecos;

        return response()->json($enderecos);
    }

    public function adicionarEndereco(Request $request, $id)
    {
        $request->validate([
            'logradouro' => 'required',
            'numero' => 'required',
            'complemento' => 'nullable',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'cep' => 'required',
        ]);

        $cliente = Cliente::findOrFail($id);

        $endereco = new Endereco($request->all());
        $endereco->cliente_id = $cliente->id;
        $endereco->latitude = 0.0;
        $endereco->longitude = 0.0;
        $endereco->save();

        return response()->json([
            'message' => 'Endereço adicionado com sucesso!',
            'endereco' => $endereco
        ], 201);
    }


    public function atualizarEndereco(Request $request, $cliente_id, $endereco_id)
    {
        $request->validate([
            'logradouro' => 'required',
            'numero' => 'required',
            'complemento' => 'nullable',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required',
            'cep' => 'required',
        ]);

        $endereco = Endereco::where('cliente_id', $cliente_id)->findOrFail($endereco_id);
        $endereco->update($request->all());

        return response()->json(['message' => 'Endereço atualizado com sucesso!', 'endereco' => $endereco]);
    }

    public function removerEndereco($cliente_id, $endereco_id)
    {
        $endereco = Endereco::where('cliente_id', $cliente_id)->findOrFail($endereco_id);
        $endereco->delete();

        return response()->json(['message' => 'Endereço removido com sucesso'], 204);
    }
}
