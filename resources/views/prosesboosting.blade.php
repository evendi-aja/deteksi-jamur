@extends('layouts.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tabel Hasil Boosting</h1>
                <div class="card">
                    <div class="card-header text-center">
                        Hasil Proses Boosting
                    </div>
                    <div class="card-footer text-center">
                        <form action="{{ url('prosesboosting') }}" method="post">
                            @csrf
                            <input type="hidden" name="boosting" value="update">
                            <button type="submit" class="btn btn-primary">Boosting</button>
                        </form>
                    </div>
                </div>
                @if (is_null($boost))
                    <div class="card-footer text-center">
                        <h5 class="card-title">Belum Ada Proses Boosting Yang Dijalankan</h5>
                    </div>
                @else
                    <div class="card-body">
                        <div class="row">
                            @php
                                $akurasiTertinggi = max($data['semuaAkurasi']);
                            @endphp
                            <ol>
                                <?php foreach ($data['semuaAkurasi'] as $item) : ?>
                                {{-- @php
                                $no++;
                            @endphp --}}
                                {{-- @if ($item == $akurasiTertinggi)
                                    <td style="color: brown">Akurasi {{ $no }} = {{ $item }}</td> <br>
                                @endif --}}
                                <li class="{{ $akurasiTertinggi == $item ? 'bg-success' : 'text-gray-900' }}">
                                    {{ $item }}</li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Grafik Perbandingan Nilai Boosting
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                            </div>
                        </div>
                    </div>
                @endif
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

@push('js')
    <script>
        var data = {!! json_encode($data) !!}
        if (typeof(data.labels) || typeof(data.data)) {
            var labels = data.labels
            var data = data.data
        }
    </script>
@endpush
