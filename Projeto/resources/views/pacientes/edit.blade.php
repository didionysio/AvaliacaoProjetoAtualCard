<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Editar Paciente</h1>

                    <form action="{{ route('pacientes.update', $paciente->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="nome" id="nome" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                   value="{{ old('nome', $paciente->nome) }}" required>
                            @error('nome')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                            <input type="text" name="cpf" id="cpf" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 cursor-not-allowed sm:text-sm" 
                                   value="{{ $paciente->cpf }}" readonly>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                            <input type="email" name="email" id="email" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                   value="{{ old('email', $paciente->email) }}" required>
                            @error('email')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                            <input 
                                type="date" 
                                name="data_nascimento" 
                                id="data_nascimento" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                value="{{ old('data_nascimento', $paciente->data_nascimento ?? '') }}" 
                                max="{{ date('Y-m-d') }}" 
                                required>
                            @error('data_nascimento')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4" id="cpf_responsavel_wrapper" style="{{ old('cpf_responsavel', $paciente->cpf_responsavel ?? '') ? '' : 'display: none;' }}">
                            <label for="cpf_responsavel" class="block text-sm font-medium text-gray-700">CPF do Responsável</label>
                            <input 
                                type="text" 
                                name="cpf_responsavel" 
                                id="cpf_responsavel" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                value="{{ old('cpf_responsavel', $paciente->cpf_responsavel ?? '') }}">
                            @error('cpf_responsavel')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <h2 class="mb-4 text-lg font-bold text-gray-800">Telefones</h2>
                        <div id="telefone-container">
                            @foreach ($paciente->telefones as $index => $telefone)
                                <x-telefone-input :value="$telefone->numero" :index="$index" />
                            @endforeach
                        </div>
                        <button type="button" id="add-telefone" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">
                            Adicionar Telefone
                        </button>
                        <div class="mb-4">
                            <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                            <input type="text" name="cep" id="cep" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                   value="{{ old('cep', $paciente->cep) }}" required>
                            @error('cep')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
                            <input type="text" name="bairro" id="bairro" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                   value="{{ old('bairro', $paciente->bairro) }}" required>
                            @error('bairro')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                            <input type="text" name="cidade" id="cidade" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                   value="{{ old('cidade', $paciente->cidade) }}" required>
                            @error('cidade')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                            <input type="text" name="estado" id="estado" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                   value="{{ old('estado', $paciente->estado) }}" required>
                            @error('estado')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
                            <input type="text" name="endereco" id="endereco" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                   value="{{ old('endereco', $paciente->endereco) }}" required>
                            @error('endereco')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="numero" class="block text-sm font-medium text-gray-700">Número</label>
                            <input type="text" name="numero" id="numero" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                   value="{{ old('numero', $paciente->numero) }}" required>
                            @error('numero')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex justify-end space-x-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Salvar Alterações
                            </button>
                            <a href="{{ route('pacientes.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
