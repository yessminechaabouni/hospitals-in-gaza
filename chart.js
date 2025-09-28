// Préparer les données pour Chart.js
const hospitalNames = hospitals.map(h => h.Hospital_information);
const numberOfBeds = hospitals.map(h => h.number_of_beds);
const bedCapacities = hospitals.map(h => h.bed_capacity);

// Créer un graphique
const ctx = document.getElementById('bedsChart').getContext('2d');
const bedsChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: hospitalNames,
        datasets: [
            {
                label: 'Number of Beds',
                data: numberOfBeds,
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            {
                label: 'Bed Capacity',
                data: bedCapacities,
                backgroundColor: 'rgba(255, 159, 64, 0.7)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Number of Beds vs Bed Capacity'
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
