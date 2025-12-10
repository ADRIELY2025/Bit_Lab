class Requests {
    static form;
    static SetForm(id) {
        const form = document.getElementById(id);
        if (!form) {
            throw new Error("Formulário não encontrado!!");
        }
        this.formData = new FormData(form);
        return this;
    }
    static async Post(url) {
        this.option = {
            method: 'POST',
            body: this.formData,
            mode: 'cors',
            cache: 'default'
        };
        const response = await fetch(url, this.option);
        return response.json();
    }
    static async Get(url) {
        if (!url) {
            throw new Error("Por favor informe o link para requisição!");
        }
        const response = await fetch(url);
        return response.json();
    }
}
export { Requests };