
var planes = [];

var info = $("#map").data("datos");
info.forEach(function(data, index) {
    planes.push(['',data.latitud, data.longitud]);
});

var map = L.map('map').setView([info[0].latitud, info[0].longitud], 8);
mapLink =
    '<a href="http://openstreetmap.org">OpenStreetMap</a>';
L.tileLayer(
    'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; ' + mapLink + ' Contributors',
        maxZoom: 20,
    }).addTo(map);

for (var i = 0; i < planes.length; i++) {
    marker = new L.marker([planes[i][1],planes[i][2]])
        .bindPopup(planes[i][0])
        .addTo(map);
}

