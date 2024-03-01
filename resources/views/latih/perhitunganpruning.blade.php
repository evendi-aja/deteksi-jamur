@extends('layouts.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tabel Perhitungan Pruning</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Perhitungan Pruning <br><br>
                        <a href="/latih/hasilperhitunganpruning" class="btn btn-primary left">Hasil</a>
                        <div style="float: right">
                            <a href="/latih/hasilperhitunganawal" class="btn btn-success">Awal</a>
                            <a href="/latih/boosting" class="btn btn-success">Boosting</a>
                        </div>
                    </div>
                    <?php
                // var_dump($data);
                // return;
                $number = 1;
                foreach ($data as $key => $nilai) : ?>
                    <br>
                    <div class="d-grid gap-2 col-3 mx-auto">
                        <button type="button" class="btn btn-outline-primary" disabled>Node Ke-<?= $number ?></button>
                    </div>
                    <?php $number++; ?>
                    <div class="card-body">
                        <div style="overflow-x:auto;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">Atribut</th>
                                        <!-- <th>Nilai</th> -->
                                        <th>Jumlah Data</th>
                                        <th>Poisonous</th>
                                        <th>Edible</th>
                                        <th>Entropy</th>
                                        <th>Entropy Total</th>
                                        <th>Gain</th>
                                        <th>Split Information</th>
                                        <th>Gain Ratio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($isi['attribute'] as $attr => $item) {
                                        if ($attr == 'class') {
                                            continue;
                                        }
                                        $length = sizeof($item);
                                        $i = 1;
                                        // var_dump($item);
                                        // return;
                                        $entropyTotal = $nilai['entropyTotals'][$attr] ?? 'null';
                                        $informationGain = $nilai['informationGains'][$attr] ?? null;
                                        $splitInfo = $nilai['splitInfos'][$attr] ?? null;
                                        $gainRatios = $nilai['gainRatio'][$attr] ?? null;
                                        // var_dump($nilai['entropyTotals']);
                                        // return;
                                        if ($attr != $nilai['attrNilaiMaxGain']) {
                                            echo "<tr>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <td rowspan='${length}'>${attr}</td>";
                                            foreach ($item as $key => $value) {
                                                $total = isset($nilai['procesedDataLatih'][$attr][$key]['total']) ? $nilai['procesedDataLatih'][$attr][$key]['total'] : 0;
                                                $entropy = isset($nilai['procesedDataLatih'][$attr][$key]['entropy']) ? $nilai['procesedDataLatih'][$attr][$key]['entropy'] : 0;
                                                $edible = isset($nilai['procesedDataLatih'][$attr][$key]['Edible']) ? $nilai['procesedDataLatih'][$attr][$key]['Edible'] : 0;
                                                $poisonous = isset($nilai['procesedDataLatih'][$attr][$key]['Poisonous']) ? $nilai['procesedDataLatih'][$attr][$key]['Poisonous'] : 0;
                                                // var_dump($value['procesedDataLatih']);
                                                // return;
                                                if ($i == 1) {
                                                    echo "<td>${key}</td><td>${total}</td><td>${poisonous}</td><td>${edible}</td><td>${entropy}</td><td rowspan='${length}'>${entropyTotal}</td><td rowspan='${length}'>${informationGain}</td><td rowspan='${length}'>${splitInfo}</td><td rowspan='${length}'>${gainRatios}</td></tr>";
                                                } else {
                                                    echo "<tr><td>${key}</td><td>${total}</td><td>${poisonous}</td><td>${edible}</td><td>${entropy}</td></tr>";
                                                }
                                                $i++;
                                            }
                                        } else {
                                            echo "<tr class='table-info'>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <td rowspan='${length}'>${attr}</td>";
                                            foreach ($item as $key => $value) {
                                                // var_dump($data);
                                                // return;
                                                $total = isset($nilai['procesedDataLatih'][$attr][$key]['total']) ? $nilai['procesedDataLatih'][$attr][$key]['total'] : 0;
                                                $entropy = isset($nilai['procesedDataLatih'][$attr][$key]['entropy']) ? $nilai['procesedDataLatih'][$attr][$key]['entropy'] : 0;
                                                $edible = isset($nilai['procesedDataLatih'][$attr][$key]['Edible']) ? $nilai['procesedDataLatih'][$attr][$key]['Edible'] : 0;
                                                $poisonous = isset($nilai['procesedDataLatih'][$attr][$key]['Poisonous']) ? $nilai['procesedDataLatih'][$attr][$key]['Poisonous'] : 0;
                                                // var_dump($value['procesedDataLatih']);
                                                // return;
                                                if ($i == 1) {
                                                    echo "<td>${key}</td><td>${total}</td><td>${poisonous}</td><td>${edible}</td><td>${entropy}</td><td rowspan='${length}'>${entropyTotal}</td><td rowspan='${length}'>${informationGain}</td><td rowspan='${length}'>${splitInfo}</td><td rowspan='${length}'>${gainRatios}</td></tr>";
                                                } else {
                                                    echo "<tr class='table-info'><td>${key}</td><td>${total}</td><td>${poisonous}</td><td>${edible}</td><td>${entropy}</td></tr>";
                                                }
                                                $i++;
                                            }
                                        }
                                    }
                                    ?>
                                    <!-- <tr>
                                                                                                                                                                                                            <td rowspan="2">Bruises</td><td>Bruises</td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                            <td>No Bruises</td>
                                                                                                                                                                                                        </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                endforeach;
                ?>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2021</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
