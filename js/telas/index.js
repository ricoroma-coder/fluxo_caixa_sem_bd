function ativarListaArquivos(objeto) {
    let table = objeto.siblings('table')
    
    if (table.hasClass('active'))
        table.removeClass('active')
    else
        table.addClass('active')
}