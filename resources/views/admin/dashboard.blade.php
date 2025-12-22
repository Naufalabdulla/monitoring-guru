@extends('layouts.master')

@section('content')


    <div style="width: 100%; height: 40vh">
        <canvas id="progresChart"></canvas>
    </div>

    <table class="table shadow-sm">
        <thead>
            <tr>
                <th scope="col">Guru</th>
                <th scope="col">Mapel</th>
                <th scope="col">Kelas</th>
                <th scope="col">progres</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <tr>
                <td scope="row">john</td>
                <td>Matematika</td>
                <td>10 IPA 1</td>
                <td class="justify-center">-</td>
            </tr>
        </tbody>
    </table>


    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.1/dist/chart.umd.min.js"></script>

    <script>
        const ctx = document.getElementById('progresChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["Udin: MTK", "Siti: IPA", "Ahmad: IPA", "Saifudin: IPS", "Hermawan: Kimia", "Puspa: IPS"],

                datasets: [
                    {
                        label: 'chart per kelas',
                        data: [2, 5, 7, 5, 10, 6],

                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'chart per guru',
                        data: [2, 5, 7, 5, 10, 6],

                        backgroundColor: '#36A2EB',
                        borderColor: '#9BD0F5',
                        borderWidth: 1
                    },
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Progres'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection