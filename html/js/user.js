import { Validate } from "./validate.js";
import { Requests } from "./Requests.js";

const Salvar = document.getElementById('insert');

// Máscaras nos IDs corretos
$('#cpf').inputmask("999.999.999-99");
$('#celular').inputmask("(99) 99999-9999");

Salvar.addEventListener('click', async () => {

    // Valida o formulário
    const valido = Validate.SetForm('form').Validate();

    if (!valido) {
        console.warn("Formulário inválido!");
        return;
    }

    // Envia para a rota correta
    const response = await Requests
        .SetForm('form')
        .Post('/usuario/insert');

    console.log(response);
});
