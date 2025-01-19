<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-12">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex justify-between items-center">
                        <h1 class="text-2xl font-bold">Lista de Pacientes</h1>
                        <a href="{{ route('pacientes.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Adicionar Paciente
                        </a>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        @if ($pacientes->isNotEmpty())
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Nome
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            CPF
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Ações
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($pacientes as $paciente)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->nome }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->cpf }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $paciente->email }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('pacientes.show', $paciente->id) }}" 
                                                class="text-blue-600 hover:text-blue-900">Ver</a>
                                                <a href="{{ route('pacientes.edit', $paciente->id) }}" 
                                                class="ml-2 text-green-600 hover:text-green-900">Editar</a>
                                                <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Deletar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $pacientes->links() }}
                            </div>
                        @else
                            <div class="p-6 text-gray-500">
                                Nenhum paciente encontrado.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>        
</x-app-layout>
