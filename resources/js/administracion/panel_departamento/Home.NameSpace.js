let Ofertas = Ofertas || {};

Ofertas.index = {
    desactivar: function (callback) {
        $.ajax({
            url: "/administracion/panelAdministracion/cancelarOferta/",
            type: "post",
            dataType: "json"
        })
            .done(function (response) {
                callback.call(this, response.meta);
            })
            .fail(function (response) {
                callback.call(this, response.responseJSON.meta);
            });
        
    }
};

module.exports = Ofertas;