@extends('layouts.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Proses Identifikasi</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Identifikasi Jamur Beracun
                    </div>
                    <div class="card-body">
                        @if (isset($hasil))
                            <center>
                                <h2>Hasil Identifikas : {{ $hasil == 'Edible' ? 'Edible' : 'Poisonous' }}
                                </h2>
                            </center>
                        @else
                            <form method="post" action="identifikasi">
                                @csrf
                                <?php
                            foreach ($isi['attribute'] as $attr => $item) :
                          ?>
                                <div class="mb-3">
                                    @if ($attr != 'class')
                                        <label for="bruises" class="form-label"><?= $attr ?></label>
                                        <select class="form-select" name="{{ $attr }}">
                                            @foreach ($item as $bagian => $nilai)
                                                <option value="{{ $bagian }}">{{ $bagian }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <?php
                            endforeach;
                          ?>
                                <button type="submit" class="btn btn-primary">Identifikasi</button>
                            </form>
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
