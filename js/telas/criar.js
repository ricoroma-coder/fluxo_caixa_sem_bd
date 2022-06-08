function trigarCheckboxCriar(objeto) {
    let inputs = $('form input:not([type=checkbox]), form select')

    if (objeto.checked) {
        inputs.attr('disabled', true)
    } else {
        inputs.removeAttr('disabled')
    }
}