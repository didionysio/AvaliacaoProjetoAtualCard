document.addEventListener('DOMContentLoaded', function () {
    const especialidadeSelect = document.getElementById('especialidade_id');
    const searchCrmInput = document.getElementById('search_crm');
    const medicoSelect = document.getElementById('medico_id');
    const pacienteSearch = document.getElementById('paciente_search');
    const pacienteIdInput = document.getElementById('paciente_id');
    const baseUrl = "{{ url('/') }}/";

    // Função para buscar médicos
    function fetchMedicos(especialidadeId = '', searchCrm = '', forPediatrics = false) {
        if (forPediatrics) {
            especialidadeId = 1;
        }
    
        const url = `http://127.0.0.1:8000/medicos/search?especialidade_id=${especialidadeId}&crm=${searchCrm}`;
        
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro ao buscar médicos');
                }
                return response.json();
            })
            .then(data => {
                medicoSelect.innerHTML = '<option value="" disabled selected hidden>Selecione um médico</option>';
                data.forEach(medico => {
                    const option = document.createElement('option');
                    option.value = medico.id;
                    option.textContent = `${medico.nome} (CRM: ${medico.crm})`;
                    medicoSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao buscar médicos. Tente novamente.');
            });
    }
    

    // Monitora a seleção do paciente e verifica idade
    pacienteSearch.addEventListener('blur', function () {
        const selectedPaciente = [...pacienteSearch.list.options].find(option => option.value === pacienteSearch.value);
        
        if (selectedPaciente) {
            const pacienteId = selectedPaciente.dataset.id;
            pacienteIdInput.value = pacienteId;

            fetch(`http://127.0.0.1:8000/pacientes/${pacienteId}/idade`)
                .then(response => response.json())
                .then(data => {
                    if (data.idade < 12) {
                        especialidadeSelect.value = 1;
                        especialidadeSelect.disabled = true;
                        fetchMedicos(1);
                    } else {
                        especialidadeSelect.disabled = false;
                        fetchMedicos();
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar idade do paciente:', error);
                });
        }
    });

    // Atualiza médicos ao mudar especialidade ou CRM
    if (especialidadeSelect) {
        especialidadeSelect.addEventListener('change', () => {
            fetchMedicos(especialidadeSelect.value, searchCrmInput.value);
        });
    }

    if (searchCrmInput) {
        searchCrmInput.addEventListener('input', () => {
            fetchMedicos(especialidadeSelect.value, searchCrmInput.value);
        });
    }
});
