<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Rules\ValidaCpf;

class PacienteController extends Controller
{
    /**
     * Exibi uma listagem dos Pacientes.
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return view('pacientes.index', compact('pacientes'));
    }

    /**
     * Exibe formulário para cadastro de paciente
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Armazena paciente no banco, validando cpf e cep
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => ['required', 'unique:pacientes,cpf', new ValidaCpf],
            'email' => 'required|email|unique:pacientes,email',
            'cep' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
        ]);
    
        Paciente::create($request->all());
    
        return redirect()->route('pacientes.index')
                         ->with('success', 'Paciente criado com sucesso.');
    }

    /**
     * Exibe os detalhes de um paciente específico.
     *
     * @param string $id O ID do paciente a ser exibido.
     * @return \Illuminate\View\View A view com os detalhes do paciente.
     */
    public function show(string $id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.show', compact('paciente'));
    }

    /**
     * Exibe o formulário para edição de um paciente específico.
     *
     * @param int|string $id O ID do paciente a ser editado.
     * @return \Illuminate\View\View A view com o formulário de edição do paciente.
     *
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * Atualiza os dados de um paciente específico.
     *
     * @param \Illuminate\Http\Request $request Os dados enviados pelo formulário.
     * @param int|string $id O ID do paciente a ser atualizado.
     * @return \Illuminate\Http\RedirectResponse Redireciona para a lista de pacientes com mensagem de sucesso.
     *
     */
    public function update(Request $request, string $id)
    {
        $paciente = Paciente::findOrFail($id);

        // Valida os campos (CPF não pode ser alterado)
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:pacientes,email,' . $paciente->id,
            'cep' => 'required',
            'endereco' => 'required',
            'numero' => 'required',
        ]);

        $paciente->update($request->except('cpf'));

        return redirect()->route('pacientes.index')
                        ->with('success', 'Paciente atualizado com sucesso.');
    }

    /**
     * Remove um paciente específico do banco de dados.
     *
     * @param int|string $id O ID do paciente a ser removido.
     * @return \Illuminate\Http\RedirectResponse Redireciona para a lista de pacientes com mensagem de sucesso.
     */
    public function destroy($id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();

        return redirect()->route('pacientes.index')
                        ->with('success', 'Paciente removido com sucesso.');
    }
}
