// ==============================
// GRAFIK LOKASI POPULER (BAR)
// ==============================
const lokasiCtx = document.getElementById("lokasiChart");

new Chart(lokasiCtx, {
    type: "bar",
    data: {
        labels: ["Situ Bagendit", "Papandayan", "Darajat Pass", "Santolo","Cipanas"],
        datasets: [{
            label: "Jumlah Pengunjung",
            data: [1600, 2300, 2000, 1700,1800],
            backgroundColor: "rgba(0, 108, 180, 0.75)",
            borderRadius: 10
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: { color: "#666" },
                grid: { color: "#e6e6e6" }
            },
            x: {
                ticks: { color: "#333" }
            }
        }
    }
});

// ==============================
// GRAFIK TREN WISATA (LINE)
// ==============================
const trenCtx = document.getElementById("trenChart");

new Chart(trenCtx, {
    type: "line",
    data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "Mei"],
        datasets: [{
            label: "Jumlah Pengunjung",
            data: [800, 1300, 1800, 2200, 1900],
            fill: true,
            backgroundColor: "rgba(0, 122, 255, 0.15)",
            borderColor: "rgba(0, 122, 255, 1)",
            borderWidth: 3,
            tension: 0.4,
            pointRadius: 6,
            pointBackgroundColor: "white",
            pointBorderColor: "rgba(0,122,255,1)",
            pointBorderWidth: 2
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: { color: "#666" },
                grid: { color: "#e6e6e6" }
            },
            x: {
                ticks: { color: "#333" }
            }
        }
    }
});
