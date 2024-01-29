$(document).ready(function () {
    $('.btn-excluir-imagem').click(function () {
        $(this).prop('disabled', true);
        let imagemOfertaId = $(this).data('imagemOfertaId');
        $.post('excluir-imagem-oferta', { id: imagemOfertaId })
            .done(function () {
                $('#oferta-form__imagem-container-' + imagemOfertaId).remove();
            })
            .fail(function () {
                $('.btn-excluir-imagem').prop('disabled', false);
                $('#oferta-form__imagem-error-message-' + imagemOfertaId).text('Erro ao excluir a imagem.')
            });
    });
});
