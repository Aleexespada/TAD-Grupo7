
import Chart from 'chart.js/auto';

const config = {
    type: 'line',
    data: JSON.parse(document.getElementById('ordersPerDayChart').getAttribute('data-chart-data')),
    options: {
        elements: {
            line: {
                tension: 0.5
            }
        },
        scales: {
            x: {
                grid: {
                    display: false,
                },

            },
            y: {
                ticks: {
                    stepSize: 1
                }
            }
        },
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            }
        }
    }
};

console.log(config);

new Chart(
    document.getElementById('ordersPerDayChart'),
    config
);