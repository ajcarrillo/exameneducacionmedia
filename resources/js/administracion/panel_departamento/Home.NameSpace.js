let Ofertas = Ofertas || {};

Ofertas.index = {
    desactivar: function (callback, fail) {
        $.ajax({
            url: "/administracion/panelAdministracion/cancelarOferta",
            type: "POST"
        })
            .done(function (response) {
                callback.call(this, response);
            })
            .fail(function (response) {
                fail.call(this, response);
            });

    }
};

module.exports = Ofertas;
