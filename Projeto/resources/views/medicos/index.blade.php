<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Lista de Médicos</h1>
                        <a href="{{ route('medicos.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Adicionar Médico
                        </a>
                    </div>
                    
                    @if ($medicos->isNotEmpty())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CRM</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Especialidade</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($medicos as $medico)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $medico->nome }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $medico->crm }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $medico->especialidade->nome }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                            <a href="{{ route('medicos.show', $medico->id) }}" 
                                               class="text-blue-600 hover:text-blue-900">Ver</a>
                                            <a href="{{ route('medicos.edit', $medico->id) }}" 
                                               class="text-green-600 hover:text-green-900">Editar</a>
                                            <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover este médico?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <!-- Adicione os links de paginação -->
                        <div class="mt-4">
                            {{ $medicos->links() }}
                        </div>
                    @else
                        <p class="text-gray-500">Nenhum médico cadastrado no momento.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
