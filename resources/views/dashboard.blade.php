<x-app-layout>
    <div class="container mx-auto px-4 pt-24 min-h-[90vh] flex flex-col-reverse md:flex-row justify-between py-16 gap-10">
        <div class="w-full md:w-1/2 flex flex-col justify-center">
            <h1 class="text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
                Level up with the largest AI & ML community
            </h1>
            <p class="text-lg md:text-xl text-gray-600 mb-8">
                Join over <span class="font-semibold text-gray-900">24M+</span> machine learners to share, stress test, and stay up-to-date on all the latest ML techniques and technologies. Discover a huge repository of community-published models, data & code for your next project.
            </p>
        </div>

        <div class="w-full md:w-1/2 flex justify-center">
            <img src="{{ asset('images/dash.png') }}" alt="Dashboard Illustration" class="max-w-[750px] w-full h-auto rounded-lg shadow-lg">
        </div>
    </div>
<div class="container mx-auto mt-10 px-4 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-tr from-blue-500 to-blue-300 text-white p-6 rounded-xl shadow-lg flex flex-col items-center">
            <span class="text-5xl font-extrabold mb-2">{{ $totalOngoing }}</span>
            <span class="text-lg font-semibold">Ongoing Competitions</span>
        </div>
        <div class="bg-gradient-to-tr from-green-500 to-green-300 text-white p-6 rounded-xl shadow-lg flex flex-col items-center">
            <span class="text-5xl font-extrabold mb-2">{{ number_format($averageTeams, 2) }}</span>
            <span class="text-lg font-semibold">Average Teams/Competition</span>
        </div>
        <div class="bg-gradient-to-tr from-purple-500 to-purple-300 text-white p-6 rounded-xl shadow-lg flex flex-col items-center">
            <span class="text-3xl font-extrabold mb-1">{{ $topHost->name ?? 'N/A' }}</span>
            <span class="text-lg font-semibold mb-2">Top Host</span>
            <span class="text-md">{{ $topHost->total_hosted ?? 0 }} Competitions</span>
        </div>
    </div>
    
    <div class="container mx-auto mt-10 px-4 space-y-12">
        {{-- Chart 1: Top 10 Datasets by Downloads --}}
        <section>
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Top 10 Datasets by Downloads</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <canvas id="topDownloadsChart" width="400" height="250"></canvas>
            </div>
        </section>

        {{-- Chart 2: Top 10 Datasets by Voting --}}
        <section>
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Top 10 Datasets with Highest Voting</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <canvas id="topVotingChart" width="400" height="250"></canvas>
            </div>
        </section>

        {{-- Chart 3: Dataset with Highest Usability Rating --}}
        <section>
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Datasets with Highest Usability Rating</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <canvas id="topUsabilityChart" width="400" height="250"></canvas>
            </div>
        </section>

        {{-- Chart 4: Top 10 Datasets by Average Vote --}}
        <section>
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Top 10 Datasets by Average Vote</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <canvas id="topAvgVoteChart" width="400" height="250"></canvas>
            </div>
        </section>
    </div>

    

    <footer class="bg-gray-900 text-gray-300 py-8 mt-20">
        <div class="container mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <h3 class="text-lg font-semibold">Kaggle</h3>
                <p class="text-sm">© 2025 Kelompok 1 - Kom B. All rights reserved.</p>
            </div>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-white transition">About</a>
                <a href="#" class="hover:text-white transition">Contact</a>
                <a href="#" class="hover:text-white transition">Privacy Policy</a>
                <a href="#" class="hover:text-white transition">Terms of Service</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Fungsi untuk membuat gradient biru yang sama untuk semua chart
        function createBlueGradient(ctx) {
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(54, 162, 235, 0.8)');
            gradient.addColorStop(1, 'rgba(54, 162, 235, 0.3)');
            return gradient;
        }

        // Chart 1: Top Downloads
        const ctxDownloads = document.getElementById('topDownloadsChart').getContext('2d');
        const gradientDownloads = createBlueGradient(ctxDownloads);
        new Chart(ctxDownloads, {
            type: 'bar',
            data: {
                labels: {!! json_encode($topDatasets->pluck('dataset_name')) !!},
                datasets: [{
                    label: 'Total Downloads',
                    data: {!! json_encode($topDatasets->pluck('total_downloads')) !!},
                    backgroundColor: gradientDownloads,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    borderRadius: 6,
                    hoverBackgroundColor: 'rgba(54, 162, 235, 0.9)',
                    maxBarThickness: 40,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { labels: { font: { size: 16, weight: 'bold' }, color: '#1e293b' } },
                    tooltip: { backgroundColor: 'rgba(0,0,0,0.8)', titleFont: { size: 16, weight: 'bold' }, bodyFont: { size: 14 }, cornerRadius: 6, padding: 10 }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0, font: { size: 14, weight: '600' }, color: '#475569' }, grid: { color: '#e2e8f0' } },
                    x: { ticks: { font: { size: 14, weight: '600' }, color: '#475569' }, grid: { display: false } }
                }
            }
        });
    
        const ctxVoting = document.getElementById('topVotingChart').getContext('2d');
        const gradientVoting = createBlueGradient(ctxVoting);
        new Chart(ctxVoting, {
            type: 'bar',
            data: {
                labels: {!! json_encode($topVotes->pluck('dataset_name')) !!},
                datasets: [{
                    label: 'Total Votes',
                    data: {!! json_encode($topVotes->pluck('total_votes')) !!},
                    backgroundColor: gradientVoting,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    borderRadius: 6,
                    hoverBackgroundColor: 'rgba(54, 162, 235, 0.9)',
                    maxBarThickness: 40,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { labels: { font: { size: 16, weight: 'bold' }, color: '#1e293b' } },
                    tooltip: { backgroundColor: 'rgba(0,0,0,0.8)', titleFont: { size: 16, weight: 'bold' }, bodyFont: { size: 14 }, cornerRadius: 6, padding: 10 }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { precision: 0, font: { size: 14, weight: '600' }, color: '#475569' }, grid: { color: '#e2e8f0' } },
                    x: { ticks: { font: { size: 14, weight: '600' }, color: '#475569' }, grid: { display: false } }
                }
            }
        });

        const ctxUsability = document.getElementById('topUsabilityChart').getContext('2d');
        const gradientUsability = createBlueGradient(ctxUsability);
        new Chart(ctxUsability, {
            type: 'radar',
            data: {
                labels: {!! json_encode($topUsability->pluck('dataset_name')) !!},
                datasets: [{
                    label: 'Usability Rating',
                    data: {!! json_encode($topUsability->pluck('usability_rating')) !!},
                    backgroundColor: gradientUsability,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    borderRadius: 6,
                    hoverBackgroundColor: 'rgba(54, 162, 235, 0.9)',
                    maxBarThickness: 40,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { labels: { font: { size: 16, weight: 'bold' }, color: '#1e293b' } },
                    tooltip: { backgroundColor: 'rgba(0,0,0,0.8)', titleFont: { size: 16, weight: 'bold' }, bodyFont: { size: 14 }, cornerRadius: 6, padding: 10 }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { font: { size: 14, weight: '600' }, color: '#475569' }, grid: { color: '#e2e8f0' } },
                    x: { ticks: { font: { size: 14, weight: '600' }, color: '#475569' }, grid: { display: false } }
                }
            }
        });

        const ctxAvgVote = document.getElementById('topAvgVoteChart').getContext('2d');
const gradientAvgVote = createBlueGradient(ctxAvgVote);
new Chart(ctxAvgVote, {
    type: 'bar',
    data: {
        labels: {!! json_encode($topAvgVotes->pluck('dataset_name')) !!},
        datasets: [{
            label: 'Average Vote',
            data: {!! json_encode($topAvgVotes->pluck('total_votes')) !!},
            backgroundColor: gradientAvgVote,
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 2,
            borderRadius: 6,
            hoverBackgroundColor: 'rgba(54, 162, 235, 0.9)',
            maxBarThickness: 40,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { labels: { font: { size: 16, weight: 'bold' }, color: '#1e293b' } },
            tooltip: { backgroundColor: 'rgba(0,0,0,0.8)', titleFont: { size: 16, weight: 'bold' }, bodyFont: { size: 14 }, cornerRadius: 6, padding: 10 }
        },
        scales: {
            y: { beginAtZero: true, ticks: { font: { size: 14, weight: '600' }, color: '#475569' }, grid: { color: '#e2e8f0' } },
            x: { ticks: { font: { size: 14, weight: '600' }, color: '#475569' }, grid: { display: false } }
        }
    }
});

    </script>


</x-app-layout>
