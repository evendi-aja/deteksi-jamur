@extends('layouts.main')


@section('container')

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tabel Data Latih</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Latih
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>class</th>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($testing as $test) : ?>
                                <tr>
                                    <td>{{ $test->{"class"} }}</td>
                                    <td>{{ $test->{"bruises"} }}</td>
                                    <td>{{ $test->{"gill-attachment"} }}</td>
                                    <td>{{ $test->{"gill-spacing"} }}</td>
                                    <td>{{ $test->{"gill-size"} }}</td>
                                    <td>{{ $test->{"stalk-shape"} }}</td>
                                    <td>{{ $test->{"veil-color"} }}</td>
                                    <td>{{ $test->{"cap-surface"} }}</td>
                                    <td>{{ $test->{"stalk-root"} }}</td>
                                    <td>{{ $test->{"stalk-shape"} }}</td>
                                    <td>{{ $test->{"stalk-surface-above-ring"} }}</td>
                                    <td>{{ $test->{"stalk-surface-below-ring"} }}</td>
                                    <td>{{ $test->{"spore-print-color"} }}</td>
                                    <td>{{ $test->{"population"} }}</td>
                                    <td>{{ $test->{"habitat"} }}</td>
                                    <td>{{ $test->{"odor"} }}</td>
                                    <td>{{ $test->{"stalk-color-above-ring"} }}</td>
                                    <td>{{ $test->{"stalk-color-below-ring"} }}</td>
                                    <td>{{ $test->{"ring-number"} }}</td>
                                    <td>{{ $test->{"cap-shape"} }}</td>
                                    <td>{{ $test->{"gill-color"} }}</td>
                                    <td>{{ $test->{"ring-type"} }}</td>
                                </tr>
                                <?php endforeach; ?>
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