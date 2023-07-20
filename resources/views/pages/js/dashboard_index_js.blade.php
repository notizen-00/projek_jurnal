
<script>
$(document).ready(function() {
   
   
    var ctx = document.getElementById('salesChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
            label: 'Produk Terjual',
            data: [],
            backgroundColor: 'white',
            borderColor: 'white',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                precision: 0,
                grid: {
                    color: 'rgba(255, 255, 255, 0.1)', // Set the color of the y-axis grid lines to white
                    borderColor: 'white', // Set the border color of the y-axis grid lines to white
                },
                ticks: {
                    color: 'white' // Set the color of the y-axis tick labels to white
                }
            },
            x: {
                ticks: {
                    color: 'white' // Set the color of the x-axis tick labels to white
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    font: {
                        color: 'white'
                    }
                }
            }
        }
    }
});


    // Event change filter
    $('#filterType').on('change', function() {
        var filterType = $(this).val();
        fetchData(filterType);
    });

    // Fetch data from AJAX endpoint
    function fetchData(filterType) {
    var url = "{{ route('chart.product')  }}";

    $.ajax({
        url: url,
        method: 'GET',
        data: { filter: filterType },
        success: function(response) {
            var labels = [];
            var data = [];
            var backgroundColors = [];
            var borderColors = [];

            // Populate labels, data, and colors from response
            for (var i = 0; i < response.length; i++) {
                labels.push(response[i].nama_produk);
                data.push(response[i].total_qty);
                // Add white color for each data point
                backgroundColors.push('white');
                borderColors.push('white');
            }

            // Update chart data and colors
            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.data.datasets[0].backgroundColor = backgroundColors;
            chart.data.datasets[0].borderColor = borderColors;
            chart.update();
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });
}


    // Fetch initial data with default filter
    fetchData('yearly');
});

</script>