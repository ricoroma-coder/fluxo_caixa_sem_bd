function gatilhoDetalhe(gatilho) {
    gatilho = $(gatilho)

    console.log(gatilho)

    if (gatilho.hasClass('active'))
        gatilho.removeClass('active')
    else
        gatilho.addClass('active')
}
