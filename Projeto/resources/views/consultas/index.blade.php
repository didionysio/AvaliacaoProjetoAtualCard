<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">Lista de Consultas</h1>
                        <a href="{{ route('consultas.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            + Cadastrar Consulta
                        </a>
                    </div>

                    @if ($consultas->isNotEmpty())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paciente</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Médico</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CRM</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data da Consulta</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($consultas as $consulta)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->paciente->nome }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->medico->nome }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $consulta->medico->crm }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($consulta->data_consulta)->format('d/m/Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap flex space-x-2">
                                            <a href="{{ route('consultas.show', $consulta->id) }}" 
                                               class="text-blue-600 hover:text-blue-900">Ver</a>
                                            <a href="{{ route('consultas.edit', $consulta->id) }}" 
                                               class="text-green-600 hover:text-green-900">Editar</a>
                                            <form action="{{ route('consultas.destroy', $consulta->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta consulta?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-4">
                            {{ $consultas->links() }}
                        </div>
                    @else
                        <p class="text-gray-500">Nenhuma consulta encontrada.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>