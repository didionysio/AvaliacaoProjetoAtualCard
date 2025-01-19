<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Detalhes do Paciente</h1>
                    
                    <div class="mb-4">
                        <strong>Nome:</strong>
                        <span>{{ $paciente->nome }}</span>
                    </div>

                    <div class="mb-4">
                        <strong>CPF:</strong>
                        <span>{{ $paciente->cpf }}</span>
                    </div>

                    <div class="mb-4">
                        <strong>E-mail:</strong>
                        <span>{{ $paciente->email }}</span>
                    </div>

                    <div class="mb-4">
                        <strong>CEP:</strong>
                        <span>{{ $paciente->cep }}</span>
                    </div>

                    <div class="mb-4">
                        <strong>Endereço:</strong>
                        <span>{{ $paciente->endereco }}</span>
                    </div>

                    <div class="mb-4">
                        <strong>Número:</strong>
                        <span>{{ $paciente->numero }}</span>
                    </div>

                    <div class="mb-4">
                        <strong>Data de Cadastro:</strong>
                        <span>{{ $paciente->created_at->format('d/m/Y H:i') }}</span>
                    </div>

                    <div class="mb-4">
                        <strong>Telefones:</strong>
                        <ul>
                            @forelse ($paciente->telefones as $telefone)
                                <li>{{ $telefone->numero }}</li>
                            @empty
                                <li>Nenhum telefone cadastrado.</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="flex justify-end mt-6">
                        <a href="{{ route('pacientes.index') }}" 
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Voltar
                        </a>
                        <a href="{{ route('pacientes.edit', $paciente->id) }}" 
                           class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Editar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
