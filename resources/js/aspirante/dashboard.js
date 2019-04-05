
var planes = [];

var info = $("#map").data("datos");

info.forEach(function(data, index) {
    planes.push(['<b>'+data.referencia+'</b><br>'+data.plantel_desc,data.latitud, data.longitud]);
});

var map = L.map('map').setView([info[0].latitud, info[0].longitud], 13);
mapLink ='<a href="https://qroo.gob.mx/seq">SEQ</a>';
L.tileLayer(
    'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Servicios Educativos de Quintana Roo - ' + mapLink,
        maxZoom: 20,
    }).addTo(map);

for (var i = 0; i < planes.length; i++) {
    marker = new L.marker([planes[i][1],planes[i][2]])
        .bindPopup(planes[i][0])
        .addTo(map);
}

