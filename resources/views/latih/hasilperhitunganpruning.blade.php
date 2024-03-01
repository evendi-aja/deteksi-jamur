@extends('layouts.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tabel Hasil Perhitungan Pruning</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Hasil Perhitungan Pruning
                        <br><br>
                        <a href="/latih/perhitunganpruning" class="btn btn-primary left">Perhitungan</a>
                        <div style="float: right">
                            <a href="/latih/hasilperhitunganawal" class="btn btn-success">Awal</a>
                            <a href="/latih/boosting" class="btn btn-success">Boosting</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>bruises</th>
                                    <th>gill-attachment</th>
                                    <th>gill-spacing</th>
                                    <th>gill-size</th>
                                    <th>stalk-shape</th>
                                    <th>veil-color</th>
                                    <th>cap-surface</th>
                                    <th>stalk-root</th>
                                    <th>stalk-surface-above-ring</th>
                                    <th>stalk-surface-below-ring</th>
                                    <th>spore-print-color</th>
                                    <th>population</th>
                                    <th>habitat</th>
                                    <th>odor</th>
                                    <th>stalk-color-above-ring</th>
                                    <th>stalk-color-below-ring</th>
                                    <th>ring-number</th>
                                    <th>cap-shape</th>
                                    <th>cap-color</th>
                                    <th>gill-color</th>
                                    <th>ring-type</th>
                                    <th>class</th>
                                    <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @php
                                        $no = 1;
                                        
                                    @endphp
                                    <?php foreach ($latih as $lth) : ?>
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $lth['bruises'] }}</td>
                                    <td>{{ $lth['gill-attachment'] }}</td>
                                    <td>{{ $lth['gill-spacing'] }}</td>
                                    <td>{{ $lth['gill-size'] }}</td>
                                    <td>{{ $lth['stalk-shape'] }}</td>
                                    <td>{{ $lth['veil-color'] }}</td>
                                    <td>{{ $lth['cap-surface'] }}</td>
                                    <td>{{ $lth['stalk-root'] }}</td>
                                    <td>{{ $lth['stalk-shape'] }}</td>
                                    <td>{{ $lth['stalk-surface-above-ring'] }}</td>
                                    <td>{{ $lth['stalk-surface-below-ring'] }}</td>
                                    <td>{{ $lth['spore-print-color'] }}</td>
                                    <td>{{ $lth['population'] }}</td>
                                    <td>{{ $lth['habitat'] }}</td>
                                    <td>{{ $lth['odor'] }}</td>
                                    <td>{{ $lth['stalk-color-above-ring'] }}</td>
                                    <td>{{ $lth['stalk-color-below-ring'] }}</td>
                                    <td>{{ $lth['ring-number'] }}</td>
                                    <td>{{ $lth['cap-shape'] }}</td>
                                    <td>{{ $lth['gill-color'] }}</td>
                                    <td>{{ $lth['ring-type'] }}</td>
                                    <td>{{ $lth['class'] }}</td>
                                    <td>{{ $lth['hasil'] }}</td>
                                    <td></td>
                                </tr>
                                @php
                                    $no++;
                                @endphp
                                <?php endforeach; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
