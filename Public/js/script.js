// RQF2 2.1 - Validar o CPF para aceitar apenas números
$(document).ready(function () {
    $('#cpf').on('input', function () {
        // Remove caracteres não numéricos
        let cpf = $(this).val().replace(/\D/g, '');

        // Limita o CPF a 12 caracteres
        cpf = cpf.substring(0, 11);

        // Adiciona a máscara ao CPF
        cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');

        // Define o valor formatado no campo
        $(this).val(cpf);
    });
});

// RQF2 2.1.1/2.1.2 - Bloqueia os campos caso exista um cpf igual 
$(document).ready(function() {
    $('#cpf').on('input', function() {
        var cpfDigitado = $(this).val();

        // Envia o CPF para o servidor usando AJAX apenas se houver mais de 10 caractere
        if (cpfDigitado.length > 10) {
            $.post('/inserir', { cpf: cpfDigitado }, function(data) {
                var response = JSON.parse(data);

                // Se o CPF já existe, bloqueia todos os campos, exceto o campo de CPF
                if (response.cpfExiste) {
                    alert('CPF já existe. Os demais campos serão bloqueados.');

                    // Desabilita todos os campos do formulário, exceto o campo de CPF
                    $('input, select, button').not('#cpf').prop('disabled', true);
                } else {
                    // Se o CPF não existe, habilita todos os campos
                    $('input, select, button').prop('disabled', false);
                }
            });
        } else {
            // Se o CPF tem um ou nenhum caractere, habilita todos os campos
            $('input, select, button').prop('disabled', false);
        }
    });
});

// RQF2 2.3/ 2.8/ 2.8.1/ 2.8.2/ 2.8.3 - Criação dinâmica do input usuário
document.addEventListener("DOMContentLoaded", function () {
    var nameInput = document.getElementById("nome");
    var usernameInput = document.getElementById("usuario");

    nameInput.addEventListener("input", function () {
        // Validar e gerar o nome de usuário automaticamente
        var nameValue = nameInput.value;
        var baseUsername = nameValue.trim().toLowerCase().replace(/\s+/g, "_");
        usernameInput.value = baseUsername;
    });
});

// RQF2 2.2 / 2.2.1 / 2.7 -> Função para verificar a condição e atualizar o estado do checkbox
function atualizarCheckbox() {
    var checkboxAtivo = document.getElementById('checkboxAtivo');
    var dataRescisaoInput = document.getElementById('data_rescisao');
    var dataRescisao = dataRescisaoInput.value;

    // Verifica a condição e atualiza o estado do checkbox
    checkboxAtivo.checked = !dataRescisao || new Date(dataRescisao) < new Date();
}

// Função para ser chamada antes do envio do formulário
function verificarAntesDoEnvio(event) {
    var dataRescisaoInput = document.getElementById('data_rescisao');
    var dataRescisao = dataRescisaoInput.value;

    // Verifica se a condição é atendida
    if (!dataRescisao || new Date(dataRescisao) < new Date()) {
        // Condição atendida, permitir envio do formulário
        return true;
    } else {
        // Condição não atendida, impedir envio do formulário
        alert('Condição não atendida. Preencha corretamente a data de rescisão.');
        event.preventDefault(); // Impede o envio do formulário
        return false;
    }
}

// Função para verificar se a data de rescisão é anterior à data de admissão
function verificarDataRescisao() {
    var dataAdmissaoInput = document.getElementById('data_admissao');
    var dataRescisaoInput = document.getElementById('data_rescisao');
    var mensagemDiv = document.getElementById('mensagem');

    var dataAdmissao = new Date(dataAdmissaoInput.value);
    var dataRescisao = new Date(dataRescisaoInput.value);

    // Verifica se a data de rescisão é anterior à data de admissão
    if (dataRescisao < dataAdmissao) {
        mensagemDiv.innerHTML = 'A data de rescisão não pode ser anterior à data de admissão!!';
        dataRescisaoInput.value = ''; // Limpa o campo de data de rescisão
    } else {
        mensagemDiv.innerHTML = ''; // Limpa a mensagem se a condição for atendida
    }
}

// Adicione um ouvinte de eventos para o evento "input" no campo de data de admissão
document.getElementById('data_admissao').addEventListener('input', verificarDataRescisao);

// Adicione um ouvinte de eventos para o evento "input" no campo de data de rescisão
document.getElementById('data_rescisao').addEventListener('input', verificarDataRescisao);

// Adicione um ouvinte de eventos para o evento "input" no campo de data
document.getElementById('data_rescisao').addEventListener('input', atualizarCheckbox);

// Adicione um ouvinte de eventos para o evento "submit" do formulário
document.getElementById('colaboradorForm').addEventListener('submit', verificarAntesDoEnvio);




// IMPLEMENTAR REGISTRO DE PONTO 