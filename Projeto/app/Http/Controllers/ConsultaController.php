<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Especialidade;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Exibe uma lista de consultas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $consultas = Consulta::with(['paciente', 'medico'])->paginate(10);
        return view('consultas.index', compact('consultas'));
    }

    /**
     * Exibe o formulário para criar uma nova consulta.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $pacientes = Paciente::all();
        $medicos = Medico::all();
        $especialidades = Especialidade::all();
        return view('consultas.create', compact('pacientes', 'medicos','especialidades'));
    }

    /**
     * Armazena uma nova consulta no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {    
   
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'data_consulta' => 'required|date|after_or_equal:today',
        ]);
    
        Consulta::create($request->all());
    
        return redirect()->route('consultas.index')->with('success', 'Consulta cadastrada com sucesso!');
    }
    

    /**
     * Exibe os detalhes de uma consulta específica.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $consulta = Consulta::with(['paciente', 'medico'])->findOrFail($id);
        return view('consultas.show', compact('consulta'));
    }

    /**
     * Exibe o formulário de edição para uma consulta específica.
     *
     * @param int|string $id O ID da consulta a ser editada.
     * @return \Illuminate\View\View A view do formulário de edição da consulta.
     */
    public function edit($id)
    {
        // Busca a consulta pelo ID
        $consulta = Consulta::findOrFail($id);

        // Carrega os dados necessários para o formulário
        $pacientes = Paciente::all();
        $especialidades = Especialidade::all();
        $medicos = Medico::where('especialidade_id', $consulta->medico->especialidade_id)->get();

        // Retorna a view de edição com os dados
        return view('consultas.edit', compact('consulta','pacientes','especialidades','medicos'));
    }

    /**
     * Atualiza uma consulta existente no banco de dados.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Busca a consulta pelo ID
        $consulta = Consulta::findOrFail($id);
    
        // Valida os dados enviados
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'data_consulta' => 'required|date|after_or_equal:today',
        ]);
    
        // Atualiza os dados da consulta
        $consulta->update([
            'paciente_id' => $request->input('paciente_id'),
            'medico_id' => $request->input('medico_id'),
            'data_consulta' => $request->input('data_consulta')        ]);
    
        // Redireciona para a lista de consultas com mensagem de sucesso
        return redirect()->route('consultas.index')
                         ->with('success', 'Consulta atualizada com sucesso.');
    }

    /**
     * Remove uma consulta do banco de dados.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $consulta = Consulta::findOrFail($id);
        $consulta->delete();

        return redirect()->route('consultas.index')->with('success', 'Consulta excluída com sucesso.');
    }
}
