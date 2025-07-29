<link rel="stylesheet" href="{{ asset('adminlte/plugins/chart.js/Chart.min.css') }}">
<script src="{{ asset('adminlte/plugins/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>

<div class="card-header">
    <h3 class="card-title">
        @if(isset($tglawal) && isset($tglakhir))
            Tanggal {{ $tglawal }} s/d {{ $tglakhir }}
        @elseif(isset($bulan) && isset($tahun))
            @php
            $namabulan = ["01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"];
            @endphp
            {{ $namabulan[$bulan] }} {{ $tahun }}
        @endif
    </h3>
</div>
<div class="card-body bg-white">
    @if(empty($grafik))
        <p>Data tidak ada.</p>
    @else
        <canvas id="weddingChart" width="500%" height="500%"></canvas>
    @endif
</div>

@if(!empty($grafik))
    @php
    $namaPaket = "";
    $jumlahOrder = "";

    foreach ($grafik as $row) {
        $nama = $row->judul_buku;
        $jumlah_order = $row->jumlah_buku;

        $namaPaket .= "'" . $nama . "',";
        $jumlahOrder .= $jumlah_order . ",";
    }
    @endphp

    <script>
        var ctx = document.getElementById('weddingChart').getContext('2d');
        var weddingChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [{!! $namaPaket !!}],
                datasets: [{
                    label: 'Jumlah Order',
                    data: [{!! $jumlahOrder !!}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        function updateChart(data) {
            weddingChart.data.labels = data.labels;
            weddingChart.data.datasets.forEach((dataset) => {
                dataset.data = data.data;
            });
            weddingChart.update();
        }
    </script>
@endif