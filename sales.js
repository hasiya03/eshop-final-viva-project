fetch('fetchsalesdataprocess.php')
    .then(response => {
        if (!response.ok) {
            return response.json().then(error => { throw new Error(error.error); });
        }
        return response.json();
    })
    .then(data => {
        // Log the fetched data to the console
        console.log('Fetched data:', data);

        // Display total sales amount
        document.getElementById('total-sales').textContent = data.totalAmount.toFixed(2);

        // Display total number of orders
        document.getElementById('total-orders').textContent = data.totalOrders;

        // Prepare chart data
        const labels = data.chartData.map(entry => entry.date);
        const amounts = data.chartData.map(entry => entry.amount);

        // Log the prepared labels and amounts
        console.log('Chart labels:', labels);
        console.log('Chart amounts:', amounts);

        // Create the chart
        const ctx = document.getElementById('sales-chart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Sales Amount ($)',
                    data: amounts,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            },
            options: {
                scales: {
                    x: {
                        type: 'time',
                        time: {
                            unit: 'day'
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    })
    .catch(error => {
        console.error('Error fetching sales data:', error);
        document.getElementById('error-message').textContent = 'Error fetching sales data: ' + error.message;
    });
