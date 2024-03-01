@extends('layouts.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Selamat Datang</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Perhitungan Data Testing
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                Benar Edible = <?= $benarEdible ?> <br>
                                Benar Poisonous = {{ $benarPoisonous }} <br>
                                Salah Edible = {{ $salahEdible }} <br>
                                Salah Poisonous = {{ $salahPoisonous }}

                            </div>
                            <div class="col">
                                Accuracy =
                                {{ (($benarEdible + $benarPoisonous) / ($benarEdible + $benarPoisonous + $salahEdible + $salahPoisonous)) * 100 }}
                                % <br>
                                Precision =
                                {{ ($benarEdible / ($benarEdible + $salahEdible)) * 100 }}%
                                <br>
                                Recall =
                                {{ ($benarEdible / ($benarEdible + $salahPoisonous)) * 100 }}%
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Perhitungan Data Testing B
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                Benar Edible = <?= $dataDua['benarEdible'] ?> <br>
                                Benar Poisonous = {{ $dataDua }} <br>
                                Salah Edible = {{ $dataDua['salahEdible'] }} <br>
                                Salah Poisonous = {{ $dataDua['salahPoisonous'] }}

                            </div>
                            <div class="col">
                                Accuracy =
                                {{ (($dataDua['benarEdible'] + $dataDua['benarPoisonous']) / ($dataDua['benarEdible'] + $dataDua['benarPoisonous'] + $dataDua['salahEdible'] + $dataDua['salahPoisonous'])) * 100 }}
                                % <br>
                                Precision =
                                {{ ($dataDua['benarEdible'] / ($dataDua['benarEdible'] + $dataDua['salahEdible'])) * 100 }}%
                                <br>
                                Recall =
                                {{ ($dataDua['benarEdible'] / ($dataDua['benarEdible'] + $dataDua['salahPoisonous'])) * 100 }}%
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Perhitungan Data Testing C
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                Benar Edible = <?= $dataTiga['benarEdible'] ?> <br>
                                Benar Poisonous = {{ $dataTiga['benarPoisonous'] }} <br>
                                Salah Edible = {{ $dataTiga['salahEdible'] }} <br>
                                Salah Poisonous = {{ $dataTiga['salahPoisonous'] }}

                            </div>
                            <div class="col">
                                Accuracy =
                                {{ (($dataTiga['benarEdible'] + $dataTiga['benarPoisonous']) / ($dataTiga['benarEdible'] + $dataTiga['benarPoisonous'] + $dataTiga['salahEdible'] + $dataTiga['salahPoisonous'])) * 100 }}
                                % <br>
                                Precision =
                                {{ ($dataTiga['benarEdible'] / ($dataTiga['benarEdible'] + $dataTiga['salahEdible'])) * 100 }}%
                                <br>
                                Recall =
                                {{ ($dataTiga['benarEdible'] / ($dataTiga['benarEdible'] + $dataTiga['salahPoisonous'])) * 100 }}%
                            </div>
                        </div>
                    </div>
                </div> --}}
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
