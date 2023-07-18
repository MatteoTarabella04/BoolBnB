import Chart from 'chart.js/auto';

const ctx = document.getElementById('myChart');
const baseData = {
    labels: [
      "Gennaio",
      "Febbraio",
      "Marzo",
      "Aprile",
      "Maggio",
      "Giugno",
      "Luglio",
      "Agosto",
      "Settembre",
      "Ottobre",
      "Novembre",
      "Dicembre"
    ],
    datasets: [{
        label: 'Numero di visite mensili',
        data: [],
        backgroundColor: '#f1bdaaa0',
        borderColor: '#ff895d',
        borderWidth: 1
    }]
};

let results = [];

getVisits();

function getVisits() {
    const slug = document.getElementById("slug").value;

    axios
    .get(`http://127.0.0.1:8000/api/apartments/${slug}`)
    .then(response => {
        results = response.data.apartment;
        const currentYearVisits = [];
        results.visits.forEach(visit => {
            if(visit.visit_date.slice(0, 4) == new Date().getFullYear()) {
              currentYearVisits.push(visit.visit_date);
            }
        })
        const monthlyVisits = [
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
        ]
        currentYearVisits.forEach(visit => {
            if(visit.slice(5, 7) == "01") {
                monthlyVisits[0].push(visit);
            } else if(visit.slice(5, 7) == "02") {
              monthlyVisits[1].push(visit);
            } else if(visit.slice(5, 7) == "03") {
              monthlyVisits[2].push(visit);
            } else if(visit.slice(5, 7) == "04") {
              monthlyVisits[3].push(visit);
            } else if(visit.slice(5, 7) == "05") {
              monthlyVisits[4].push(visit);
            } else if(visit.slice(5, 7) == "06") {
              monthlyVisits[5].push(visit);
            } else if(visit.slice(5, 7) == "07") {
              monthlyVisits[6].push(visit);
            } else if(visit.slice(5, 7) == "08") {
              monthlyVisits[7].push(visit);
            } else if(visit.slice(5, 7) == "09") {
              monthlyVisits[8].push(visit);
            } else if(visit.slice(5, 7) == "10") {
              monthlyVisits[9].push(visit);
            } else if(visit.slice(5, 7) == "11") {
              monthlyVisits[10].push(visit);
            } else {
              monthlyVisits[11].push(visit);
            }
        });
        monthlyVisits.forEach(visits => {
            baseData.datasets[0].data.push(visits.length)
        });
            
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: baseData ,
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            },
        });
    })
    .catch(error => {
        console.error(error.message);
    })
}
