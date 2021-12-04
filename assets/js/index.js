function adicionar() {
    document.location.href='crud_view.php';
}

function alterar(clienteEscolhido) {
    document.location.href='crud_view.php?id='+clienteEscolhido;
}

function deleteSet(dados) {
    var register = dados.split("#");
    document.getElementById('nomeClienteExcluido').innerHTML = register[1].toUpperCase();
    document.getElementById('codigoClienteExcluido').value = register[0];
}

function deleteSubmit() {
    var form = document.getElementById("enviarFormDelete");

    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "codigo";
    input.value = document.getElementById('codigoClienteExcluido').value;

    form.appendChild(input);
    form.submit();
}

function searchSet(dados) {
    var register = dados.split("#");
    document.getElementById('nome').value = register[0];
    document.getElementById('endereco').value = register[1];
    document.getElementById('numero').value = register[2];
    document.getElementById('complemento').value = register[3];
    document.getElementById('cep').value = register[4];
    document.getElementById('uf').value = register[5];
}