// import Chart from 'chart.js/auto';

// getVisits();

// const ctx = document.getElementById('myChart');
// const baseData = {
//     labels: [],
//     datasets: [{
//         label: 'numero di visite',
//         data: [],
//         borderWidth: 1
//     }]
// };

// let results = []

// function getVisits() {

//     axios
//     .get(`http://127.0.0.1:8000/api/apartments`).then(response => {
//         results = response.data.apartments;

//         results.forEach(apartment => {
//             baseData.labels.push(apartment.name)
//             baseData.datasets[0].data.push(apartment.visits.length)
//         });
            
//         const myChart = new Chart(ctx, {
//             type: 'bar',
//             data: baseData ,
//             options: {
//               scales: {
//                 y: {
//                   beginAtZero: true
//                 }
//               }
//             },
//         });
//     })
//     .catch(error => {
//         console.error(error.message);
//     })
// }

// const myTimeout = setTimeout(cardOff, 2000);

// function cardOff() {
//     const cardEl = document.getElementById("card_off_interval");
//     cardEl.classList.add("card_off");
// }
