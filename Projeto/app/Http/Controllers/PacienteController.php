<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rules\ValidaCpf;
use Carbon\Carbon;

class PacienteController extends Controller
{
    /**
     * Exibi uma listagem dos Pacientes.
     */
    public function index()
    {
        $pacientes = Paciente::paginate(10);
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
            'cpf' => ['required', 'string', 'unique:pacientes,cpf', new ValidaCpf()],
            'email' => 'required|email|unique:pacientes,email',
            'cep' => 'required|string|max:9',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'data_nascimento' => 'required|date|before_or_equal:today',
            'telefones.*' => 'required|string|regex:/^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/',
            'cpf_responsavel' => [
                'nullable',
                'string',
                new ValidaCpf(),
                'different:cpf',
            ],
        ]);
        
    
        DB::beginTransaction();

        try {
            $paciente = Paciente::create($request->except('telefones'));
    
            // Salva os telefones
            if ($request->has('telefones')) {
                foreach ($request->telefones as $numero) {
                    if ($numero) {
                        $paciente->telefones()->create(['numero' => $numero]);
                    }
                }
            }
    
            DB::commit();
    
            return redirect()->route('pacientes.index')
                             ->with('success', 'Paciente criado com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()->route('pacientes.create')
                             ->with('error', 'Ocorreu um erro ao cadastrar o paciente: ' . $e->getMessage());
        }
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
        $paciente = Paciente::with('telefones')->findOrFail($id);
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
            'data_nascimento' => 'required|date|before_or_equal:today',
            'cpf_responsavel' => [
                'nullable',
                'string',
                new ValidaCpf(),
                'different:cpf',
            ],
            'telefones.*' => 'required|string|regex:/^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/',
        ]);
    
        DB::beginTransaction();
    
        try {
            $paciente->update($request->except(['telefones', 'cpf']));
    
            // Atualiza os telefones
            if ($request->has('telefones')) {
                // Remove os telefones existentes antes de adicionar os novos
                $paciente->telefones()->delete();
    
                foreach ($request->telefones as $numero) {
                    if ($numero) {
                        $paciente->telefones()->create(['numero' => $numero]);
                    }
                }
            }
    
            // Confirma a transação
            DB::commit();
    
            return redirect()->route('pacientes.index')
                             ->with('success', 'Paciente atualizado com sucesso.');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()->route('pacientes.edit', $id)
                             ->with('error', 'Ocorreu um erro ao atualizar o paciente: ' . $e->getMessage());
        }
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
    
        // Verifica se o paciente está vinculado a consultas
        if ($paciente->consultas()->exists()) {
            return redirect()->route('pacientes.index')
                             ->with('error', 'Não é possível excluir o paciente, pois ele está vinculado a uma ou mais consultas.');
        }
    
        $paciente->delete();
    
        return redirect()->route('pacientes.index')
                         ->with('success', 'Paciente removido com sucesso.');
    }

    /**
     * Retorna a idade de um paciente com base na data de nascimento.
     *
     * @param int $id O ID do paciente.
     * @return \Illuminate\Http\JsonResponse
     */
    public function idade($id)
    {
        $paciente = Paciente::findOrFail($id);

        if (!$paciente->data_nascimento) {
            return response()->json(['erro' => 'Data de nascimento não encontrada para o paciente.'], 400);
        }

        $idade = abs(now()->diffInYears(Carbon::parse($paciente->data_nascimento)));
        return response()->json(['idade' => $idade]);
    }

}
