
import Chart from 'chart.js/auto';

const config = {
    type: 'doughnut',
    data: JSON.parse(document.getElementById('ordersPerCategoryChart').getAttribute('data-chart-data')),
    options: {
        responsive: true,
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
    document.getElementById('ordersPerCategoryChart'),
    config
);