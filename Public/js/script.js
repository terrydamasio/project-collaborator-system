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



// 2.10 >> Validar quadro de horários

// Adicione ouvintes de eventos para os campos de entrada
var entradas = document.querySelectorAll('input[name$="_entrada"]');
var saidas = document.querySelectorAll('input[name$="_saida"]');

entradas.forEach(function(entrada) {
    entrada.addEventListener('input', validarHorarios);
});

saidas.forEach(function(saida) {
    saida.addEventListener('input', validarHorarios);
});

// Função para validar os horários
function validarHorarios() {
    var tabela = document.getElementById('tabelaHorarios');
    var mensagemDiv = document.getElementById('mensagem');

    // Lógica de validação aqui...
    var entradas = tabela.querySelectorAll('input[name$="_entrada"]');
    var saidas = tabela.querySelectorAll('input[name$="_saida"]');

    var saidas = tabela.querySelectorAll('input[name$="_saida"]');

    for (var i = 0; i < entradas.length; i++) {
        var entrada = new Date('2000-01-01 ' + entradas[i].value);
        var saida = new Date('2000-01-01 ' + saidas[i].value);

        if (entrada >= saida) {
            mensagemDiv.innerHTML = 'Erro: A entrada não pode ser maior ou igual à saída. ';
            return false; // Se houver erro, interrompa o processo
        }
    }

    // Limpe as mensagens se não houver erros
    mensagemDiv.innerHTML = '';
    return true; // Não há erros
}









// REGISTRO DE PONTO -> Atualizar data e hora

// Atualizar a data
const dataAtualFormatada = new Date().toLocaleDateString();
document.getElementById('data').textContent = dataAtualFormatada;

// Preencher a data atual no campo de data
const dataAtualISO = new Date().toISOString().split('T')[0];
document.getElementById('data').value = dataAtualISO;

// Preencher a hora atual no campo de hora
function preencherHora() {
    const dataAtual = new Date();
    const horaAtual = String(dataAtual.getHours()).padStart(2, '0');
    const minutosAtual = String(dataAtual.getMinutes()).padStart(2, '0');

    document.getElementById('hora').value = `${horaAtual}:${minutosAtual}`;
}

// Chamar a função uma vez para preencher inicialmente
preencherHora();

// Atualizar a hora a cada segundo
setInterval(preencherHora, 1000);

// Registrar ponto
function registrarPonto() {
    const formulario = document.getElementById('formulario-registro');
    const nome = formulario.elements.nome.value;
    const matricula = formulario.elements.matricula.value;
    const entrada = formulario.elements.entrada.value;
    const saida = formulario.elements.saida.value;

    // Aqui você pode enviar os dados para o servidor (usando AJAX ou algo similar) para o registro no banco de dados
    // Por enquanto, apenas exibimos os dados no console
    console.log(`Nome: ${nome}, Matrícula: ${matricula}, Entrada: ${entrada}, Saída: ${saida}`);
}

