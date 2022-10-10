function novoTipo(){
    //Criar um input no card para criar o tipo
    let btn_novo_tipo = document.querySelector('button#btn-adc-tipo')
    let modal = document.getElementById('div-novo-tipo')
    let item = document.createElement('div')

    item.innerHTML = `<input type="text" name="input-produto" id="input-produto" class="form-control"
    placeholder="Novo Tipo">`

    modal.appendChild(item)
    btn_novo_tipo.setAttribute('onclick','')    
}