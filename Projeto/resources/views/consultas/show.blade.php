<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Detalhes da Consulta</h1>

                    <div class="mb-4">
                        <strong>Paciente:</strong>
                        <span>{{ $consulta->paciente->nome }}</span>
                    </div>

                    <div class="mb-4">
                        <strong>Médico:</strong>
                        <span>{{ $consulta->medico->nome }} (CRM: {{ $consulta->medico->crm }})</span>
                    </div>

                    <div class="mb-4">
                        <strong>Especialidade:</strong>
                        <span>{{ $consulta->medico->especialidade->nome }}</span>
                    </div>

                    <div class="mb-4">
                        <strong>Data da Consulta:</strong>
                        <span>{{ $consulta->data_consulta->format('d/m/Y H:i') }}</span>
                    </div>

                    <div class="mb-4">
                        <strong>Data do Agendamento:</strong>
                        <span>{{ $consulta->data_agendamento->format('d/m/Y H:i') }}</span>
                    </div>

                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('consultas.edit', $consulta->id) }}" 
                           class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                            Editar
                        </a>
                        <form action="{{ route('consultas.destroy', $consulta->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta consulta?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Excluir
                            </button>
                        </form>
                        <a href="{{ route('consultas.index') }}" 
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>