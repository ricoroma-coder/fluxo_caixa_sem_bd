function trigarCheckboxCriar(objeto) {
    let inputs = $('form input:not([type=checkbox]), form select')

    if (objeto.checked) {
        inputs.attr('disabled', true)
    } else {
        inputs.removeAttr('disabled')
    }
}

function ativarCampo(nomeCampo, valor) {
    let parent = $('input[name='+ nomeCampo +']').parent('div').parent('div')
    if(valor == 1)
        parent.attr('style', 'display:block;')
    else
        parent.attr('style', 'display:none;')
}