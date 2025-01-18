<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Detalhes do Médico</h1>
                    <div class="mb-4">
                        <strong>Nome:</strong>
                        <span>{{ $medico->nome }}</span>
                    </div>
                    <div class="mb-4">
                        <strong>CRM:</strong>
                        <span>{{ $medico->crm }}</span>
                    </div>
                    <div class="mb-4">
                        <strong>Especialidade:</strong>
                        <span>{{ $medico->especialidade->nome }}</span>
                    </div>
                    <div class="flex justify-end space-x-2 mt-6">
                        <a href="{{ route('medicos.index') }}" 
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Voltar
                        </a>
                        <a href="{{ route('medicos.edit', $medico->id) }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Editar
                        </a>
                        <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este médico?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Deletar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
