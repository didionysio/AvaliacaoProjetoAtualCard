<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Lista de Especialidades</h1>
                        <a href="{{ route('especialidades.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Adicionar Especialidade
                        </a>
                    </div>
                    
                    @if ($especialidades->isNotEmpty())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($especialidades as $especialidade)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $especialidade->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $especialidade->nome }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                            <a href="{{ route('especialidades.show', $especialidade->id) }}" 
                                               class="text-blue-600 hover:text-blue-900">Ver</a>
                                            @if ($especialidade->id != 1)
                                                <a href="{{ route('especialidades.edit', $especialidade->id) }}" 
                                                   class="text-green-600 hover:text-green-900">Editar</a>
                                                <form action="{{ route('especialidades.destroy', $especialidade->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover esta especialidade?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Deletar</button>
                                                </form>
                                            @else
                                                <span class="text-gray-500 cursor-not-allowed">Editar</span>
                                                <span class="text-gray-500 cursor-not-allowed">Deletar</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">Nenhuma especialidade cadastrada no momento.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
