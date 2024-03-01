@extends('layouts.main')

@section('container')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Selamat Datang</h1>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Dashboard
                    </div>
                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="text-center">
                                <img src="{{ asset('template') }}/assets/img/logo.png" class="card-img-top"
                                    style="width: 250px">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-center">Sistem Identifikasi Jamur Beracun menggunakan Algoritma
                                    C5.0</h5>
                                <p class="card-text text-center">Nama : Evendi</p>
                                <p class="card-text text-center">NPM : 1634010035</p>
                                <p class="card-text text-center">Jurusan : Informatika</p>
                                <p class="card-text text-center">Fakultas : Fakultas Ilmu Komputer</p>
                                <p class="card-text text-center">2021/2022</p>
                                {{-- <div id="tree-container">
                                    <div id="q-container">

                                        <ul id="tree">

                                            <li><input name="lvl1" type="radio" style="font-style:italic">Odor
                                                <ul>
                                                    <li><input name="lvl2" type="radio">Almond
                                                        <ul>
                                                            <li>Edible</li>
                                                        </ul>
                                                    </li>
                                                    <li><input name="lvl2" type="radio">Anise
                                                        <ul>
                                                            <li>Edible</li>
                                                        </ul>
                                                    </li>
                                                    <li><input name="lvl2" type="radio">Anise
                                                        <ul>
                                                            <li>Edible</li>
                                                        </ul>
                                                    </li>
                                                    <li><input name="lvl2" type="radio">None
                                                        <ul>
                                                            <li><input name="lvl1" type="radio">veil-color
                                                                <ul>
                                                                    <li><input name="lvl2" type="radio">Yellow
                                                                        <ul>
                                                                            <li>Edible</li>
                                                                        </ul>
                                                                    </li>
                                                                    <li><input name="lvl2" type="radio">White
                                                                        <ul>
                                                                            <li><input name="lvl1"
                                                                                    type="radio">ring-number
                                                                                <ul>
                                                                                    <li><input name="lvl2"
                                                                                            type="radio">One
                                                                                        <ul>
                                                                                            <li><input name="lvl1"
                                                                                                    type="radio">gill-size
                                                                                                <ul>
                                                                                                    <li><input
                                                                                                            name="lvl2"
                                                                                                            type="radio">Broad
                                                                                                        <ul>
                                                                                                            <li>Edible</li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                    <li><input
                                                                                                            name="lvl2"
                                                                                                            type="radio">Narrow
                                                                                                        <ul>
                                                                                                            <li><input
                                                                                                                    name="lvl1"
                                                                                                                    type="radio">Bruises
                                                                                                                <ul>
                                                                                                                    <li><input
                                                                                                                            name="lvl2"
                                                                                                                            type="radio">Bruises
                                                                                                                        <ul>
                                                                                                                            <li>Poisonous
                                                                                                                            </li>
                                                                                                                        </ul>
                                                                                                                    </li>
                                                                                                                    <li><input
                                                                                                                            name="lvl2"
                                                                                                                            type="radio">No
                                                                                                                        Bruises
                                                                                                                        <ul>
                                                                                                                            <li>Edible
                                                                                                                            </li>
                                                                                                                        </ul>
                                                                                                                    </li>
                                                                                                                </ul>
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </li>
                                                                                    <li><input name="lvl2"
                                                                                            type="radio">Two
                                                                                        <ul>
                                                                                            <li><input name="lvl1"
                                                                                                    type="radio">spore-print-color
                                                                                                <ul>
                                                                                                    <li><input
                                                                                                            name="lvl2"
                                                                                                            type="radio">Green
                                                                                                        <ul>
                                                                                                            <li>Poisonous
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                    <li><input
                                                                                                            name="lvl2"
                                                                                                            type="radio">White
                                                                                                        <ul>
                                                                                                            <li>Edible</li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <li><input name="lvl2" type="radio">Anise
                                                        <ul>
                                                            <li>Edible</li>
                                                        </ul>
                                                    </li>
                                                    <li><input name="lvl2" type="radio">Anise
                                                        <ul>
                                                            <li>Edible</li>
                                                        </ul>
                                                    </li>
                                                    <li><input name="lvl2" type="radio">Anise
                                                        <ul>
                                                            <li>Edible</li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>

                                    </div>
                                </div> --}}
                            </div>
                        </div>
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
