<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Editar Consulta</h1>

                    <form action="{{ route('consultas.update', $consulta->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <h2 class="text-2xl font-bold mb-4">Selecione um Paciente</h2>
                        <div class="mb-6">
                            <label for="paciente_id" class="block text-sm font-medium text-gray-700">Paciente</label>
                            <input 
                                type="text" 
                                id="paciente_search" 
                                name="paciente_name" 
                                list="pacientes_list" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                placeholder="Digite o nome do paciente"
                                value="{{ $consulta->paciente->nome }}"
                                required>
                            
                            <datalist id="pacientes_list">
                                @foreach ($pacientes as $paciente)
                                    <option value="{{ $paciente->nome }}" data-id="{{ $paciente->id }}"></option>
                                @endforeach
                            </datalist>
                        
                            <input type="hidden" name="paciente_id" id="paciente_id" value="{{ $consulta->paciente_id }}" required>
                        </div>

                        <h1 class="text-2xl font-bold mb-4">Selecione um Médico</h1>
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="especialidade_id" class="block text-sm font-medium text-gray-700">Especialidade</label>
                                <select name="especialidade_id" id="especialidade_id" 
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    <option value="">Todas especialidades</option>
                                    @foreach ($especialidades as $especialidade)
                                        <option value="{{ $especialidade->id }}" {{ $consulta->medico->especialidade_id == $especialidade->id ? 'selected' : '' }}>{{ $especialidade->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="search_crm" class="block text-sm font-medium text-gray-700">Pesquisar por CRM</label>
                                <input 
                                    type="text" 
                                    id="search_crm" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                    placeholder="Digite o CRM do médico">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label for="medico_id" class="block text-sm font-medium text-gray-700">Médico</label>
                            <select name="medico_id" id="medico_id" 
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" required>
                                <option value="" disabled selected hidden>Selecione um médico</option>
                                @foreach ($medicos as $medico)
                                    <option value="{{ $medico->id }}" {{ $consulta->medico_id == $medico->id ? 'selected' : '' }}>{{ $medico->nome }} (CRM: {{ $medico->crm }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-6">
                            <label for="data_consulta" class="block text-sm font-medium text-gray-700">Data e Hora da Consulta</label>
                            <input 
                                type="datetime-local" 
                                name="data_consulta" 
                                id="data_consulta" 
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                required
                                min="{{ now()->format('Y-m-d\TH:i') }}">
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Salvar
                            </button>
                            <a href="{{ route('consultas.index') }}" 
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
