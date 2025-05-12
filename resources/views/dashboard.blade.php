<x-app-layout>
    <div class="py-12 pt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-stone-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="bg-stone-50 dark:bg-stone-50 p-3 rounded-lg">
                        <canvas id="myChart" class="w-full max-h-[450px]"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    const ctx = document.getElementById('myChart');
    const monthlySubmissions = JSON.parse('{!! $resultJson !!}');

    const labels = monthlySubmissions.map(item => item.month);
    const dataValues = monthlySubmissions.map(item => item.count);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Monthly Form Submission Data Analytics',
                data: dataValues,
                borderWidth: 1,
                maxBarThickness: 20
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#333333'
                    },
                    position: 'bottom'
                }
            }
        }
    });
</script>
