import Chart from 'chart.js/auto';

const userId = document.getElementById("userId").value

const ctx = document.getElementById('myChart');
const baseData = {
    labels: [],
    datasets: [{
        label: 'numero di visite',
        data: [],
        borderWidth: 1
    }]
};

let results = [];

getVisits();

const myTimeout = setTimeout(cardOff, 2000);

function getVisits() {

    axios
    .get(`http://127.0.0.1:8000/api/user-apartments/${userId}`)
    .then(response => {
        console.log(response);
        results = response.data.apartments;

        results.forEach(apartment => {
            baseData.labels.push(apartment.name)
            baseData.datasets[0].data.push(apartment.visits.length)
        });
            
        const myChart = new Chart(ctx, {
            type: 'polarArea',
            data: baseData ,
            options: {},
        });
    })
    .catch(error => {
        console.error(error);
    })
}

function cardOff() {
    const cardEl = document.getElementById("card_off_interval");
    cardEl.classList.add("card_off");
}
