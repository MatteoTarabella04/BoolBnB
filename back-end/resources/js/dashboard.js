import Chart from 'chart.js/auto'; 

const ctx = document.getElementById('myChart');

const myChart = new Chart(ctx, {
    type: 'polarArea',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: 'number of ad',
            data: [12, 19, 3, 5, 2, 3],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const myTimeout = setTimeout(cardOff, 2000);

function cardOff() {
    const cardEl = document.getElementById("card_off_interval");
    cardEl.classList.add("card_off");
}