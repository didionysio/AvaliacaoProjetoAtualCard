<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especialidade;

class EspecialidadeController extends Controller
{
    /**
     * Exibe uma lista de especialidades.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $especialidades = Especialidade::paginate(10);
        return view('especialidades.index', compact('especialidades'));
    }

    /**
     * Exibe o formulário para criar uma nova especialidade.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('especialidades.create');
    }

    /**
     * Armazena uma nova especialidade no banco de dados.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:especialidades,nome',
        ]);

        Especialidade::create($request->all());

        return redirect()->route('especialidades.index')
                         ->with('success', 'Especialidade criada com sucesso.');
    }

    /**
     * Exibe os detalhes de uma especialidade específica.
     *
     * @param  int|string $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $especialidade = Especialidade::findOrFail($id);
        return view('especialidades.show', compact('especialidade'));
    }

    /**
     * Exibe o formulário para editar uma especialidade específica.
     *
     * @param  int|string $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $especialidade = Especialidade::findOrFail($id);
        return view('especialidades.edit', compact('especialidade'));
    }

    /**
     * Atualiza uma especialidade específica no banco de dados.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int|string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $especialidade = Especialidade::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255|unique:especialidades,nome,' . $especialidade->id,
        ]);

        $especialidade->update($request->all());

        return redirect()->route('especialidades.index')
                         ->with('success', 'Especialidade atualizada com sucesso.');
    }

    /**
     * Remove uma especialidade do banco de dados. Não permite excluir id = 1 pois é necessário haver pediatria
     *
     * @param  int|string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Impede a exclusão da especialidade pediatria
        if ($id == 1) {
            return redirect()->route('especialidades.index')
                             ->with('error', 'A especialidade "Pediatria" não pode ser excluída, pois é obrigatória.');
        }
    
        $especialidade = Especialidade::findOrFail($id);
    
        // Verifica se a especialidade está vinculada a algum médico
        if ($especialidade->medicos()->exists()) {
            return redirect()->route('especialidades.index')
                             ->with('error', 'Não é possível excluir a especialidade, pois está vinculada a um ou mais médicos.');
        }
    
        $especialidade->delete();
    
        return redirect()->route('especialidades.index')
                         ->with('success', 'Especialidade removida com sucesso.');
    }
    
}
