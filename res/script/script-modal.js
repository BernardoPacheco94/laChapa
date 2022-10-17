function adcProduto() {
    let modal = document.querySelector('div#modal-body')
    let item = document.createElement('div')

    item.innerHTML = `<div class="card text-center">
    <h5 class="card-title">XIS COMPLETO
    <button class="btn btn-warning" type="submit">Excluir</button>
    </h5>
    <div class="card-body">
        <div class="btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary active" id="btn-check-ingredientes">
                <input type="checkbox" checked autocomplete="off"> Ingrediente
            </label>
            <label class="btn btn-secondary active" id="btn-check-ingredientes">
                <input type="checkbox" checked autocomplete="off"> Ingrediente
            </label>
            <label class="btn btn-secondary active" id="btn-check-ingredientes">
                <input type="checkbox" checked autocomplete="off"> Ingrediente
            </label>
            <label class="btn btn-secondary active" id="btn-check-ingredientes">
                <input type="checkbox" checked autocomplete="off"> Ingrediente
            </label>
            <label class="btn btn-secondary active" id="btn-check-ingredientes">
                <input type="checkbox" checked autocomplete="off"> Ingrediente
            </label>
            <label class="btn btn-secondary active" id="btn-check-ingredientes">
                <input type="checkbox" checked autocomplete="off"> Ingrediente
            </label>
            <label class="btn btn-secondary active" id="btn-check-ingredientes">
                <input type="checkbox" checked autocomplete="off"> Ingrediente
            </label>
            <label class="btn btn-secondary active" id="btn-check-ingredientes">
                <input type="checkbox" checked autocomplete="off"> Ingrediente
            </label>

        </div>
    </div>

</div>`

    modal.appendChild(item)
}



function geraComanda() {

}

function adcMesa() {
    let card_deck = document.querySelector('div#card-deck')
    let card = document.createElement('div')
    card.setAttribute('class', 'col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4 mt-2 p-2')

    card.innerHTML = `<div>
  <div class="card h-100">
      <div class="card-header">
          <h5 class="card-title">MESA N#</h5>
      </div>
      <div class="card-body">
          <!-- Comandas da mesa / accordion -->
          <div class="accordion m-2" id="accordionExample">
              <div class="accordion-item">
                  <h2 class="accordion-header" id="comanda_i">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                          Comanda Nº 1
                      </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show"
                      aria-labelledby="comanda_i" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="table">
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>Produto</th>
                                          <th>Valor</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>Xis Completo</td>
                                          <td>R$ 18,00</td>
                                      </tr>
                                      <tr>
                                          <td>Cachorro Simples</td>
                                          <td>R$ 15,00</td>
                                      </tr>
                                      <tr>
                                          <td>Coca-cola</td>
                                          <td>R$ 6,00</td>
                                      </tr>
                                  </tbody>
                                  <tfoot class="bg-light">
                                      <tr>
                                          <th>Total</th>
                                          <td>R$ 39,00</td>
                                      </tr>
                                  </tfoot>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Comanda Nº 2
                      </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                      data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="table">
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>Produto</th>
                                          <th>Valor</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>Xis Completo</td>
                                          <td>R$ 18,00</td>
                                      </tr>
                                      <tr>
                                          <td>Cachorro Simples</td>
                                          <td>R$ 15,00</td>
                                      </tr>
                                      <tr>
                                          <td>Coca-cola</td>
                                          <td>R$ 6,00</td>
                                      </tr>
                                  </tbody>
                                  <tfoot class="bg-light">
                                      <tr>
                                          <th>Total</th>
                                          <td>R$ 39,00</td>
                                      </tr>
                                  </tfoot>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                          data-bs-target="#collapseThree" aria-expanded="false"
                          aria-controls="collapseThree">
                          Comanda Nº 3
                      </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse"
                      aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                          <div class="table">
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>Produto</th>
                                          <th>Valor</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>Xis Completo</td>
                                          <td>R$ 18,00</td>
                                      </tr>
                                      <tr>
                                          <td>Cachorro Simples</td>
                                          <td>R$ 15,00</td>
                                      </tr>
                                      <tr>
                                          <td>Coca-cola</td>
                                          <td>R$ 6,00</td>
                                      </tr>
                                  </tbody>
                                  <tfoot class="bg-light">
                                      <tr>
                                          <th>Total</th>
                                          <td>R$ 39,00</td>
                                      </tr>
                                  </tfoot>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <button type="button" class="btn btn-dark" id="btn-adc-comanda" data-bs-toggle="modal"
              data-bs-target="#modal_lanca_comanda">
              Nova Comanda
          </button>

      </div>
  </div>
</div>`

    card_deck.appendChild(card)

}