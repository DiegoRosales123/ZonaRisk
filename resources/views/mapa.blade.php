@extends('layouts.app')
@push('stylesheet')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
<style>
    #map {
        height: 400px;
    }

    /* Fondo de la página */
    body {
  background-image: url('img/mapas.jpeg');
  background-size: cover;
  background-repeat: no-repeat;
}
</style>

@endpush
@section('content')
{{-- <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Mapa de focos</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
      <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
        <svg class="bi">
            <use xlink:href="#calendar3" />
        </svg>
        This week
      </button>
  </div>
</div> --}}

<div class="container">
  <div class="row">
    {{-- <button onclick="mostrarPosicion()" class="btn btn-primary">Mostrar Posición</button> --}}
    <h2>🚓 Mapa de maipu</h2>
    <div class="mt-3">
      <div id="map" class="shadow"></div>
    </div>
  </div>
</div>

<!-- Button trigger modal -->
<button type="button" hidden id="btnModal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Reportar grifos
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Incidente</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('grifos.update_a') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="container">
            <div class="row">
              <div class="form-group mb-3">
                <input type="text" hidden class="form-control" @readonly(true) readonly name="id_global" id="id_global">
              </div>
              <div class="form-group mb-3">
                  <label for="estado">Estado:</label>
                  <select name="estado" id="estado" class="form-control"  required>
                      <option value="1">Normal</option>
                      <option value="2">Grave</option>
                      <option value="3">Intermedio</option>
                      <option value="4">Muy Grave</option>
                      <option value="5">Controlado</option>
                  </select>
              </div>
              <div class="mb-3">
                <label for="comentario" class="form-label">Comentario</label>
                <textarea class="form-control" name="comentario" id="comentario" rows="3"></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@include('_nav')

@endsection
@push('javascript')

<script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/heatmap.js/2.0.2/heatmap.min.js"></script>
<script>
  var data = @json($grifos_raw);

  var map = L.map('map').setView([-33.516666666667, -70.766666666667], 13);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
    maxZoom: 18,
  }).addTo(map);

  // var points = [
  //   { lat: 51.505, lng: -0.09, color: 'green' },
  //   { lat: 51.51, lng: -0.1, color: 'yellow' },
  //   { lat: 51.505, lng: -0.11, color: 'red' }
  // ];

  // for (var i = 0; i < points.length; i++) {
  //   var point = points[i];
  //   L.circleMarker([point.lat, point.lng], { color: point.color }).addTo(map);
  // }

  for (var i = 0; i < data.length; i++) {
    var point = data[i];
    var estado = '0';
    if (point.estado) {
      estado = point.estado;
    }

    var marker = L.marker([point.latitud, point.longitud], {
        pointId: point.id,
        pointStatus: estado,
        icon: L.icon({
          iconUrl: point.img,
          iconSize: [25, 25]
        })
    }).addTo(map);

    if (point.direccion) {
      marker.bindPopup("<b>ID:</b> " + point.id + "<br><b>Direccion:</b> " + point.direccion);
    } else{
      marker.bindPopup("<b>ID:</b> " + point.id + "<br><b>Estado:</b> " + point.estado);

    }

    marker.on('mouseover', function(e) {
        this.openPopup();
    });

    marker.on('mouseout', function(e) {
        this.closePopup();
    });

    marker.on('click', function(e) {
      var pointId = e.target.options.pointId;
      var pointEstado = e.target.options.pointStatus;
      // console.log("ID: " + pointId);
      reportarModal(pointId, pointEstado);
    });
  }

  function mostrarPosicion() {
    navigator.geolocation.getCurrentPosition(function(position) {
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        L.marker([lat, lng]).addTo(map);
    });
  }
  var latitude = localStorage.getItem('latitude');
  var longitude = localStorage.getItem('longitude');
  var iconPerson = L.icon({
    iconUrl: '{{ asset('img/bombero.png') }}', // Reemplaza con la ruta a tu imagen de ícono de persona
    // iconUrl: '{{ asset('img/fuego.png') }}', // Reemplaza con la ruta a tu imagen de ícono de persona
    iconSize: [32, 32], // Ajusta el tamaño según tus necesidades
    iconAnchor: [16, 32] // Ajusta el punto de anclaje según tus necesidades
  });

  var marker = L.marker([latitude, longitude], {
    icon: iconPerson
  }).addTo(map);

  marker.bindPopup("¡Aquí estoy!");

  map.setView([latitude, longitude], 12); // Centrar el mapa en la posición actual


  function reportarModal(id, estado) {
    console.log(id);
    console.log(estado);

    document.getElementById('id_global').value = id;

    var btnModal = document.getElementById('btnModal');
    btnModal.click();
  }
</script>
@endpush
