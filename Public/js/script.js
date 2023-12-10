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
                    $('input, select').not('#cpf').prop('disabled', true);
                } else {
                    // Se o CPF não existe, habilita todos os campos
                    $('input, select').prop('disabled', false);
                }
            });
        } else {
            // Se o CPF tem um ou nenhum caractere, habilita todos os campos
            $('input, select').prop('disabled', false);
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

