@extends('layouts.app')

@section('title', 'Ajukan Mitra')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow rounded-lg p-8 mt-6">
    <!-- Step Indicator & Progress Bar -->
    <div class="flex items-center justify-between mb-6">
        <button id="step1Btn" type="button" class="inline-block px-3 py-1 text-sm font-semibold rounded bg-green-600 text-white">Informasi Lahan</button>
        <div class="w-2/3 mx-4">
            <div class="w-full bg-gray-200 rounded-full h-2.5">
                <div id="progressBar" class="bg-green-500 h-2.5 rounded-full transition-all duration-300" style="width: 50%"></div>
                                </div>
                            </div>
        <button id="step2Btn" type="button" class="inline-block px-3 py-1 text-sm font-semibold rounded bg-gray-200 text-gray-500">Upload Dokumen</button>
                        </div>

    <!-- Step 1: Informasi Lahan -->
    <form id="form-step-1" action="#" method="POST">
        @csrf
        <div class="space-y-4">
                                <div>
                <label class="block text-sm font-medium text-gray-700">Nama Pemilik Lahan</label>
                <input type="text" name="nama_pemilik" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                                </div>
                                <div>
                <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input type="text" name="no_telepon" placeholder="Masukkan No.Telepon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                                </div>
                                <div>
                <label class="block text-sm font-medium text-gray-700">Luas Lahan (m²)</label>
                <input type="number" name="luas_lahan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                                            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Apakah memiliki pohon alpukat?</label>
                <select name="punya_alpukat" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                    <option value="tidak">Tidak</option>
                    <option value="ya">Ya</option>
                </select>
                            </div>
                                    <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap</label>
                <div class="grid grid-cols-2 gap-4 mb-2">
                    <select name="provinsi" id="provinsi" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                    <select name="kabupaten" id="kabupaten" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" disabled>
                        <option value="">Pilih Kabupaten</option>
                                        </select>
                                    </div>
                <div class="grid grid-cols-2 gap-4 mb-2">
                    <select name="kecamatan" id="kecamatan" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" disabled>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                    <select name="desa" id="desa" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500" disabled>
                        <option value="">Pilih Desa</option>
                                        </select>
                                    </div>
                <input type="text" name="detail_alamat" placeholder="Detail Alamat (RT/RW, patokan, dll)" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500">
                                </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Lokasi di Peta</label>
                <div class="mb-2 flex space-x-2">
                    <div id="geocoder" class="geocoder flex-1"></div>
                    <button type="button" id="useCurrentLocation" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            Lokasi Saya
                                        </button>
                                    </div>
                <div class="rounded-md overflow-hidden border border-gray-300">
                    <div id="map" class="w-full h-64"></div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-2">
                                        <div>
                        <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                        <input type="text" id="latitude" name="latitude" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-50 focus:ring-green-500 focus:border-green-500">
                                        </div>
                                        <div>
                        <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                        <input type="text" id="longitude" name="longitude" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-50 focus:ring-green-500 focus:border-green-500">
                                        </div>
                                    </div>
                <p class="text-sm text-red-500 mt-2">Silakan klik peta untuk memilih lokasi.</p>
                                </div>
                            </div>
        <div class="flex justify-end mt-6">
            <button type="button" id="toStep2" class="bg-green-600 text-white px-6 py-2 rounded shadow hover:bg-green-700">Lanjut</button>
        </div>
    </form>

    <!-- Step 2: Upload Dokumen (hidden by default, tampilkan dengan JS) -->
    <form id="form-step-2" action="#" method="POST" enctype="multipart/form-data" style="display:none;">
        @csrf
        <div class="space-y-4">
                                    <div>
                <label class="block text-sm font-medium text-gray-700">Upload Foto/Video Lahan</label>
                <input type="file" name="foto_lahan" class="mt-1 block w-full">
                                                </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Upload Surat Tanah</label>
                <input type="file" name="surat_tanah" class="mt-1 block w-full">
                                            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Baca Kontrak Kemitraan</label>
                <div class="border rounded bg-gray-50 p-2">
                    <iframe src="/path/to/kontrak.pdf" class="w-full h-48" frameborder="0"></iframe>
                    <div class="flex justify-end mt-2">
                        <a href="/path/to/kontrak.pdf" download class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">Download</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                <label class="block text-sm font-medium text-gray-700">Upload Kontrak Bertanda Tangan</label>
                <input type="file" name="kontrak_ttd" class="mt-1 block w-full">
                                            </div>
                                        </div>
        <div class="flex justify-between mt-6">
            <button type="button" id="toStep1" class="bg-gray-400 text-white px-6 py-2 rounded shadow hover:bg-gray-500">Kembali</button>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded shadow hover:bg-green-700">Ajukan</button>
                            </div>
                    </form>
    </div>

{{-- Mapbox & Wilayah Script --}}
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css' rel='stylesheet' />
        <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
        <style>
    #map { width: 100%; height: 260px; z-index: 1; position: relative; }
    .mapboxgl-ctrl-top-right { z-index: 1000; }
    .geocoder { position: relative; z-index: 1000; }
        </style>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js'></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <script>
// Multi Step Logic
const formStep1 = document.getElementById('form-step-1');
const formStep2 = document.getElementById('form-step-2');
const toStep2 = document.getElementById('toStep2');
const toStep1 = document.getElementById('toStep1');
const progressBar = document.getElementById('progressBar');
const step1Btn = document.getElementById('step1Btn');
const step2Btn = document.getElementById('step2Btn');

toStep2.addEventListener('click', function() {
    formStep1.style.display = 'none';
    formStep2.style.display = 'block';
    progressBar.style.width = '100%';
    step1Btn.classList.remove('bg-green-600', 'text-white');
    step1Btn.classList.add('bg-gray-200', 'text-gray-500');
    step2Btn.classList.remove('bg-gray-200', 'text-gray-500');
    step2Btn.classList.add('bg-green-600', 'text-white');
});
toStep1.addEventListener('click', function() {
    formStep2.style.display = 'none';
    formStep1.style.display = 'block';
    progressBar.style.width = '50%';
    step2Btn.classList.remove('bg-green-600', 'text-white');
    step2Btn.classList.add('bg-gray-200', 'text-gray-500');
    step1Btn.classList.remove('bg-gray-200', 'text-gray-500');
    step1Btn.classList.add('bg-green-600', 'text-white');
});
step1Btn.addEventListener('click', function() {
    toStep1.click();
});
step2Btn.addEventListener('click', function() {
    toStep2.click();
});

// Mapbox & Wilayah (sama seperti owner)
    let map = null;
    let marker = null;
let defaultLocation = [112.768845, -7.250445];
    function initMap() {
            mapboxgl.accessToken = 'pk.eyJ1IjoiZGl2b3RhaHRhIiwiYSI6ImNtYThkcWo1bzBxcDIyaW9hbWpoZnJycXIifQ.e2G1z1pWPNbjv5fMwulRcg';
            map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v12',
                center: defaultLocation,
                zoom: 13,
                attributionControl: false
            });
            map.on('load', () => {
                map.addControl(new mapboxgl.NavigationControl(), 'top-right');
                const geocoder = new MapboxGeocoder({
                    accessToken: mapboxgl.accessToken,
                    mapboxgl: mapboxgl,
                    placeholder: 'Cari lokasi...',
                    marker: false,
                    countries: 'id',
                    language: 'id',
            bbox: [95.0, -11.0, 141.0, 6.0],
                    types: 'place,locality,neighborhood,address',
                    minLength: 3,
                    limit: 5,
            flyTo: { speed: 1.5 }
                });
                const geocoderContainer = document.getElementById('geocoder');
                if (geocoderContainer) {
                    geocoderContainer.appendChild(geocoder.onAdd(map));
                }
        marker = new mapboxgl.Marker({ draggable: true, color: '#10B981' })
                .setLngLat(defaultLocation)
                .addTo(map);
                marker.on('dragend', () => {
                    const position = marker.getLngLat();
                    updateCoordinates([position.lat, position.lng]);
                });
                map.on('click', (e) => {
                    marker.setLngLat(e.lngLat);
                    updateCoordinates([e.lngLat.lat, e.lngLat.lng]);
                });
                geocoder.on('result', (e) => {
                    const coordinates = e.result.center;
                    marker.setLngLat(coordinates);
                    updateCoordinates([coordinates[1], coordinates[0]]);
            map.flyTo({ center: coordinates, zoom: 15, essential: true });
                });
                updateCoordinates([defaultLocation[1], defaultLocation[0]]);
            });
            const useCurrentLocationBtn = document.getElementById('useCurrentLocation');
            if (useCurrentLocationBtn) {
                useCurrentLocationBtn.addEventListener('click', () => {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(
                            (position) => {
                                const pos = [position.coords.longitude, position.coords.latitude];
                                marker.setLngLat(pos);
                        map.flyTo({ center: pos, zoom: 15, essential: true });
                                updateCoordinates([position.coords.latitude, position.coords.longitude]);
                            },
                    (error) => { alert('Tidak dapat mengakses lokasi Anda.'); },
                    { enableHighAccuracy: true, timeout: 5000, maximumAge: 0 }
                        );
                    } else {
                alert('Browser Anda tidak mendukung geolokasi.');
                    }
                });
        }
    }
    function updateCoordinates(latLng) {
            const latitudeInput = document.getElementById('latitude');
            const longitudeInput = document.getElementById('longitude');
            if (latitudeInput && longitudeInput) {
                latitudeInput.value = latLng[0].toFixed(8);
                longitudeInput.value = latLng[1].toFixed(8);
            }
}
document.addEventListener('DOMContentLoaded', () => { setTimeout(initMap, 100); });
// Dropdown wilayah
        const provinsiSelect = document.getElementById('provinsi');
        const kabupatenSelect = document.getElementById('kabupaten');
        const kecamatanSelect = document.getElementById('kecamatan');
        const desaSelect = document.getElementById('desa');
if (provinsiSelect && kabupatenSelect && kecamatanSelect && desaSelect) {
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
        .then(response => response.json())
            .then(data => {
                data.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.id;
                    option.textContent = province.name;
                    provinsiSelect.appendChild(option);
            });
        });
        provinsiSelect.addEventListener('change', function() {
        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
        kabupatenSelect.disabled = true;
            kecamatanSelect.disabled = true;
            desaSelect.disabled = true;
        if (this.value) {
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${this.value}.json`)
                .then(response => response.json())
                    .then(data => {
                    kabupatenSelect.disabled = false;
                    data.forEach(kab => {
                            const option = document.createElement('option');
                        option.value = kab.id;
                        option.textContent = kab.name;
                            kabupatenSelect.appendChild(option);
                        });
                    });
            }
        });
        kabupatenSelect.addEventListener('change', function() {
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
        kecamatanSelect.disabled = true;
            desaSelect.disabled = true;
        if (this.value) {
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/districts/${this.value}.json`)
                .then(response => response.json())
                    .then(data => {
                    kecamatanSelect.disabled = false;
                    data.forEach(kec => {
                            const option = document.createElement('option');
                        option.value = kec.id;
                        option.textContent = kec.name;
                            kecamatanSelect.appendChild(option);
                        });
                    });
            }
        });
        kecamatanSelect.addEventListener('change', function() {
        desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
        desaSelect.disabled = true;
        if (this.value) {
            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${this.value}.json`)
                .then(response => response.json())
                    .then(data => {
                    desaSelect.disabled = false;
                    data.forEach(des => {
                            const option = document.createElement('option');
                        option.value = des.id;
                        option.textContent = des.name;
                            desaSelect.appendChild(option);
                        });
                    });
            }
        });
}
    </script>
@endsection
