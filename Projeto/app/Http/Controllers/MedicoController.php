<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Especialidade;

class MedicoController extends Controller
{
    /**
     * Exibe uma lista de médicos.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $medicos = Medico::paginate(10);
        return view('medicos.index', compact('medicos'));
    }

    /**
     * Exibe o formulário para criar um novo médico.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $especialidades = Especialidade::all();
        return view('medicos.create',compact('especialidades'));
    }

    /**
     * Armazena um novo médico no banco de dados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'crm' => [
                'required',
                'string',
                'regex:/^CRM-[A-Z]{2} \d{1,6}$/',
                'unique:medicos,crm',
            ],
            'especialidade_id' => 'required|exists:especialidades,id',
        ]);

        Medico::create($request->all());

        return redirect()->route('medicos.index')->with('success', 'Médico cadastrado com sucesso.');
    }

    /**
     * Exibe os detalhes de um médico específico.
     *
     * @param  int|string $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $medico = Medico::findOrFail($id);
        return view('medicos.show', compact('medico'));
    }

    /**
     * Exibe o formulário para editar um médico específico.
     *
     * @param  int|string $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $medico = Medico::findOrFail($id);
        $especialidades = Especialidade::all();
    
        return view('medicos.edit', compact('medico', 'especialidades'));
    }

    /**
     * Atualiza os dados de um médico específico.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int|string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $medico = Medico::findOrFail($id);
    
        $request->validate([
            'nome' => 'required|string|max:255',
            'especialidade_id' => 'required|exists:especialidades,id',
        ]);
    
        $medico->update($request->only('nome', 'especialidade_id'));
    
        return redirect()->route('medicos.index')->with('success', 'Médico atualizado com sucesso.');
    }

    /**
     * Remove um médico do banco de dados.
     *
     * @param  int|string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();

        return redirect()->route('medicos.index')->with('success', 'Médico removido com sucesso.');
    }
}
