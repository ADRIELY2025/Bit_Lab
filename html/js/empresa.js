import { Validate } from "./validate.js";
import { Requests } from "./Requests.js";
const Salvar = document.getElementById('insert');

$('#cpf_cnpj').inputmask({ "mask": ["999.999.999-99", "99.999.999/9999-99"] });


Salvar.addEventListener('click', async () => {
    Validate.SetForm('form').Validate();
    const response = await Requests.SetForm('form').Post('/empresa/insert');
    console.log(response);
});