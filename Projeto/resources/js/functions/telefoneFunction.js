document.addEventListener('DOMContentLoaded', () => {

    const bodyClass = document.body.className;

    if (bodyClass.includes('pacientes-create') || bodyClass.includes('pacientes-edit')) {
        const telefoneContainer = document.getElementById('telefone-container');
        const addTelefoneButton = document.getElementById('add-telefone');

        // Função para adicionar novo campo de telefone
        addTelefoneButton.addEventListener('click', async () => {
            try {
                // Faz a solicitação para buscar o componente renderizado
                const response = await fetch('/telefones/render');
                if (!response.ok) throw new Error('Erro ao carregar o componente de telefone.');

                const newTelefoneInput = await response.text(); // Obtém o HTML renderizado
                telefoneContainer.insertAdjacentHTML('beforeend', newTelefoneInput);
            } catch (error) {
                console.error('Erro ao adicionar novo telefone:', error);
            }
        });

        // Função para remover campos de telefone
        telefoneContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-telefone')) {
                event.target.closest('.telefone-item').remove();
            }
        });

        window.validarCampoTelefone = function(input) {
            const regexTelefone = /^\(?[0-9]{2}\)?[- ]?[0-9]{4,5}-[0-9]{4}$/;
            const erroSpan = input.nextElementSibling;

            if (regexTelefone.test(input.value)) {
                input.classList.remove('border-red-500');
                input.classList.add('border-green-500');
                erroSpan.style.display = 'none';
            } else {
                input.classList.remove('border-green-500');
                input.classList.add('border-red-500');
                erroSpan.style.display = 'block';
                erroSpan.innerText = 'Número de telefone inválido. Use o formato (XX) XXXXX-XXXX.';
            }
        };
    }
});
