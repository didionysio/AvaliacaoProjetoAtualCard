<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Editar Médico</h1>
                    <form action="{{ route('medicos.update', $medico->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                            <input type="text" name="nome" id="nome" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                   value="{{ old('nome', $medico->nome) }}" required>
                            @error('nome')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="crm" class="block text-sm font-medium text-gray-700">CRM</label>
                            <input type="text" name="crm" id="crm" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 sm:text-sm" 
                                   value="{{ $medico->crm }}" readonly>
                            <small class="text-gray-500">O CRM não pode ser editado.</small>
                        </div>
                        <div class="mb-4">
                            <label for="especialidade_id" class="block text-sm font-medium text-gray-700">Especialidade</label>
                            <select name="especialidade_id" id="especialidade_id" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                                <option value="">Selecione uma especialidade</option>
                                @foreach ($especialidades as $especialidade)
                                    <option value="{{ $especialidade->id }}" 
                                            {{ old('especialidade_id', $medico->especialidade_id) == $especialidade->id ? 'selected' : '' }}>
                                        {{ $especialidade->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('especialidade_id')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex justify-end space-x-2 mt-6">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Salvar Alterações
                            </button>
                            <a href="{{ route('medicos.index') }}" 
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
