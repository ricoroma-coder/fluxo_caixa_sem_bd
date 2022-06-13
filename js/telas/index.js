function ativarListaArquivos(objeto) {
    let tabela = objeto.siblings('table')
    
    if (tabela.hasClass('active'))
        tabela.removeClass('active')
    else
        tabela.addClass('active')
}

function redirecionar(objeto) {
    window.location.href = objeto.attr('target')
}