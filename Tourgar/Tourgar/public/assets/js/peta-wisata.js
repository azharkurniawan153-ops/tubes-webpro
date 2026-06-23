// Inisialisasi map di area Garut
var map = L.map('map').setView([-7.227906, 107.908699], 11);

// Tambahkan peta dasar
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18,
    attribution: '© OpenStreetMap'
}).addTo(map);

// ===== ICON CUSTOM UNTUK MARKER =====
const customIcon = L.icon({
    iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png', 
    iconSize: [38, 38],
    iconAnchor: [19, 38],
    popupAnchor: [0, -32]
});

// ===== DATA LOKASI WISATA GARUT =====
const lokasiWisata = [
    {
        nama: "Kolam Renang Cipanas",
        koordinat: [-7.309215, 107.848701],
        deskripsi: "Pemandian air panas alami dengan fasilitas keluarga."
    },
    {
        nama: "Situ Bagendit",
        koordinat: [-7.127880, 107.953568],
        deskripsi: "Danau wisata populer dengan rakit dan perahu."
    },
    {
        nama: "Pantai Santolo",
        koordinat: [-7.706804, 107.679504],
        deskripsi: "Pantai pasir putih dengan jembatan ikonik."
    },
    {
        nama: "Gunung Cikuray",
        koordinat: [-7.330604, 107.891090],
        deskripsi: "Gunung favorit pendaki dengan sunrise terkenal."
    },
    {
        nama: "Kawah Kamojang",
        koordinat: [-7.142220, 107.775884],
        deskripsi: "Kawah geothermal aktif dengan spot kabut."
    },
    {
        nama: "Gunung Papandayan",
        koordinat: [-7.321944, 107.731667],
        deskripsi: "Gunung dengan kawah aktif & hutan mati."
    },
    {
        nama: "Kolam Renang Darajat Pass",
        koordinat: [-7.178043, 107.865280],
        deskripsi: "Waterboom & kolam air panas di pegunungan."
    },
    {
        nama: "Talaga Bodas",
        koordinat: [-7.22532, 108.06144],
        deskripsi: "Danau kawah dengan air putih kehijauan."
    }
];

// ===== MASUKAN MARKER + POPUP DETAIL + LINK GOOGLE MAPS =====
lokasiWisata.forEach(wisata => {

    // URL Google Maps
    const gmapsLink =
        `https://www.google.com/maps?q=${wisata.koordinat[0]},${wisata.koordinat[1]}`;

    const popupHTML = `
        <div style="font-size: 16px; font-weight: bold; margin-bottom: 5px;">
            ${wisata.nama}
        </div>
        <div style="font-size: 14px; color: #444; margin-bottom: 8px;">
            ${wisata.deskripsi}
        </div>

        <a href="${gmapsLink}" target="_blank" class="btn-gmaps">
            Buka di Google Maps
        </a>
    `;

    L.marker(wisata.koordinat, { icon: customIcon })
        .addTo(map)
        .bindPopup(popupHTML);
});
