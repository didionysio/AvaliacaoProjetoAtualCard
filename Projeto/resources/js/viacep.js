document.addEventListener('DOMContentLoaded', () => {
    const cepInput = document.getElementById('cep');

    if (cepInput) {
        cepInput.addEventListener('blur', function () {
            let cep = this.value.replace(/\D/g, ''); // Remove caracteres não numéricos
            if (cep.length === 8) { // Verifica se o CEP possui 8 dígitos
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Erro ao buscar o CEP.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.erro) {
                            alert('CEP não encontrado.');
                            return;
                        }

                        // Preenche os campos de endereço com a resposta da API
                        document.getElementById('endereco').value = data.logradouro || '';
                        document.getElementById('bairro').value = data.bairro || '';
                        document.getElementById('cidade').value = data.localidade || '';
                        document.getElementById('estado').value = data.uf || '';
                    })
                    .catch(error => {
                        console.error('Erro:', error);
                        alert('Erro ao buscar o CEP.');
                    });
            } else {
                alert('CEP inválido. Verifique e tente novamente.');
            }
        });
    }
});
