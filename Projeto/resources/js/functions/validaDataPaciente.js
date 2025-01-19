document.addEventListener('DOMContentLoaded', () => {
    const bodyClass = document.body.className;

    // Executa o script apenas nas páginas de create ou edit de pacientes
    if (bodyClass.includes('pacientes-create') || bodyClass.includes('pacientes-edit')) {
        const dataNascimentoInput = document.getElementById('data_nascimento');
        const cpfResponsavelWrapper = document.getElementById('cpf_responsavel_wrapper');

        function verificarIdade() {
            const dataNascimento = dataNascimentoInput.value;
            if (!dataNascimento) return;

            const hoje = new Date();
            const nascimento = new Date(dataNascimento);
            let idade = hoje.getFullYear() - nascimento.getFullYear();
            const mes = hoje.getMonth() - nascimento.getMonth();

            if (mes < 0 || (mes === 0 && hoje.getDate() < nascimento.getDate())) {
                idade--;
            }

            // Mostra ou esconde o campo de CPF do Responsável
            if (idade < 12) {
                cpfResponsavelWrapper.style.display = '';
            } else {
                cpfResponsavelWrapper.style.display = 'none';
            }
        }

        // Verifica ao carregar a página
        verificarIdade();

        // Verifica ao alterar a data de nascimento
        dataNascimentoInput.addEventListener('change', verificarIdade);
    }
});
