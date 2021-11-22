<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="asset/sbadmin/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">SPK VIKOR</a>
            <!-- Sidebar Toggle-->
            <!-- <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> -->
            <!-- Navbar Search-->
            <!-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form> -->
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4" style="margin-left: 80% !important;">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!-- <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li> -->
                        <li><a class="dropdown-item" href="login">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_content" style="padding-left: 0">
                <main>
                    <div class="container-fluid px-4">
                        <div class="row mt-4">
                            <div class="col-xl-6 col-md-6" v-on:click="tipe = 'kriteria'">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Data Kriteria</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6" v-on:click="tipe = 'alternatif'">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Data Alternatif</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4" v-if="tipe == 'kriteria'">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Kriteria
                                <button class="btn btn-sm btn-success" style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal" v-on:click="
                                    id_kriteria = null;
                                    kd_kriteria = '';
                                    nama_kriteria = '';
                                    bobot_kriteria = '';
                                    is_range = false;
                                ">Tambah</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Kriteria</th>
                                            <th scope="col">Nama Kriteria</th>
                                            <th scope="col">Bobot Kriteria</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in listKriteria">
                                          <td>{{index + 1}}</td>
                                          <td>{{item.kd_kriteria}}</td>
                                          <td>{{item.nama_kriteria}}</td>
                                          <td>{{item.bobot_kriteria}}</td>
                                          <td>
                                            <button type="button" class="btn btn-success btn-sm" v-on:click="
                                                id_kriteria = item.id_kriteria; 
                                                nama_kriteria = item.nama_kriteria; 
                                                is_range = item.is_range == 1 ? true : false;
                                                getListSubKriteria()" data-bs-toggle="modal" data-bs-target="#modalSubKriteria">Sub Kriteria</button>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" v-on:click="
                                                id_kriteria = item.id_kriteria; 
                                                kd_kriteria = item.kd_kriteria; 
                                                nama_kriteria = item.nama_kriteria; 
                                                bobot_kriteria = item.bobot_kriteria;
                                                is_range = item.is_range == 1 ? true : false;"
                                            >Ubah</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-target="#deleteKriteria" data-bs-toggle="modal" v-on:click="
                                                id_kriteria = item.id_kriteria; 
                                                nama_kriteria = item.nama_kriteria"
                                            >Hapus</button>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" align="center"><strong>TOTAL</strong></td>
                                          <td colspan="2">{{total_weight}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mb-4" v-if="tipe == 'alternatif'">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Alternatif
                                <button class="btn btn-sm btn-warning" style="float: right; margin-left: 0.5%;" data-bs-target="#step1" data-bs-toggle="modal" v-on:click="getListMatrixDecision()">Hitung VIKOR</button>
                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#saveAlternatif" style="float: right;" v-on:click="resetForm()">Tambah</button>
                            </div>
                            <div class="card-body">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Kode Alternatif</th>
                                            <th scope="col">Nama Alternatif</th>
                                            <th scope="col" v-for="item in listKriteria">{{item.nama_kriteria}}</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in listAlternatif">
                                            <td>{{index + 1}}</td>
                                            <td>{{item.kd_alternatif}}</td>
                                            <td>{{item.nama_alternatif}}</td>
                                            <td class="td-nilai-alternatif" v-for="header in listKriteria">{{item.detail[header.nama_kriteria]}}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" v-on:click="getAlternatifDetail(item.id_alternatif, item.kd_alternatif, item.nama_alternatif)" data-bs-toggle="modal" data-bs-target="#saveAlternatif">Ubah</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAlternatif" v-on:click="id_alternatif = item.id_alternatif; nama_alternatif = item.nama_alternatif;">Hapus</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div class="modal fade" role="dialog" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{id_kriteria ? 'Ubah' : 'Tambah'}} Kriteria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row">
                                <div class="col-12">
                                  <label for="kodekriteria" class="col-form-label">Kode Kriteria</label>
                                    <div class="col-auto">
                                    <input type="hidden" class="form-control" name="id_kriteria" v-bind:value="id_kriteria">
                                    <input type="text" class="form-control form-control-sm field-kriteria" name="kd_kriteria" v-model="kd_kriteria">
                                  </div>
                                </div>
                                <div class="col-12">
                                  <label for="namakriteria" class="col-form-label">Nama Kriteria</label>
                                    <div class="col-auto">
                                      <input type="text" class="form-control form-control-sm field-kriteria" name="nama_kriteria" v-model="nama_kriteria">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                  <label for="bobotkriteria" class="col-form-label">Bobot Kriteria</label>
                                    <div class="col-auto">
                                      <input type="text" class="form-control form-control-sm field-kriteria" name="bobot_kriteria" v-model="bobot_kriteria">
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-check">
                                      <input class="form-check-input" type="checkbox" id="is_range" name="is_range" v-model="is_range">
                                      <label class="form-check-label" for="is_range">
                                        Range
                                      </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-success btn-sm btn-simpan-kriteria" v-on:click="saveKriteria()" data-bs-dismiss="modal">Simpan</button>
                                  <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteKriteria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan Kriteria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span>Anda yakin ingin menghapus kriteria {{nama_kriteria}} ?</span>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" v-on:click="deleteKriteria()" data-bs-dismiss="modal">YES</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalSubKriteria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Sub Kriteria {{nama_kriteria}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-12">
                                <button class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalAddSubKriteria" v-on:click="
                                    id_subkriteria = 0;
                                    nama_subkriteria = '';
                                    nilai_rating = ''
                                    min_value = ''
                                    max_value = ''">
                                    Tambah
                                </button>
                            </div>
                            <div class="col-12">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Sub Kriteria</th>
                                            <th v-if="is_range">Range</th>
                                            <th>Nilai Rating</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in listSubKriteria">
                                            <td>{{index + 1}}</td>
                                            <td>{{item.nama_subkriteria}}</td>
                                            <td v-if="is_range">{{item.min_value}} - {{item.max_value}}</td>
                                            <td>{{item.nilai_rating}}</td>
                                            <td>
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-target="#modalAddSubKriteria" data-bs-toggle="modal" v-on:click="id_subkriteria = item.id_subkriteria; nama_subkriteria = item.nama_subkriteria; nilai_rating = item.nilai_rating; min_value = item.min_value; max_value = item.max_value;">Ubah</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-target="#deleteSubKriteria" data-bs-toggle="modal" v-on:click="id_subkriteria = item.id_subkriteria; nama_subkriteria = item.nama_subkriteria;">Hapus</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteSubKriteria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan Sub Kriteria Kriteria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span>Anda yakin ingin menghapus sub kriteria {{nama_subkriteria}} ?</span>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal" v-on:click="deleteSubKriteria()">YES</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalAddSubKriteria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{id_subkriteria ? 'Ubah' : 'Tambah'}} Sub Kriteria</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12">
                                <label for="namakriteria" class="col-form-label">Nama Sub Kriteria</label>
                                <div class="col-auto">
                                    <input type="hidden" class="form-control" name="id_kriteria" v-bind:value="id_kriteria">
                                    <input type="hidden" class="form-control" name="id_subkriteria" id="id_subkriteria" v-bind:value="id_subkriteria">
                                    <input type="text" class="form-control form-control-sm field-subkriteria" name="nama_subkriteria" v-model="nama_subkriteria">
                                </div>
                            </div>
                            <div class="col-12" v-if="is_range">
                                <label for="bobotkriteria" class="col-form-label">Nilai Rating</label>
                                <div class="col-auto">
                                  <input type="number" class="form-control form-control-sm field-subkriteria" name="nilai_rating" v-model="nilai_rating">
                                </div>
                            </div>
                            <div class="col-12 mb-3" v-if="!is_range">
                                <label for="bobotkriteria" class="col-form-label">Nilai Rating</label>
                                <div class="col-auto">
                                  <input type="number" class="form-control form-control-sm field-subkriteria" name="nilai_rating" v-model="nilai_rating">
                                </div>
                            </div>
                            <div class="col-12" v-if="is_range">
                                <label for="bobotkriteria" class="col-form-label">Range Minimum</label>
                                <div class="col-auto">
                                  <input type="number" class="form-control form-control-sm field-subkriteria" name="min_value" v-model="min_value">
                                </div>
                            </div>
                            <div class="col-12 mb-3" v-if="is_range">
                                <label for="bobotkriteria" class="col-form-label">Range Maksimum</label>
                                <div class="col-auto">
                                  <input type="number" class="form-control form-control-sm field-subkriteria" name="max_value" v-model="max_value">
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" v-on:click="saveSubKriteria()" data-bs-dismiss="modal" class="btn btn-success btn-simpan-subkriteria btn-sm">Simpan</button>
                              <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="saveAlternatif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Alternatif</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body row">
                            <div class="col-6">
                                <label class="col-form-label">Kode Alternatif</label>
                                <input type="hidden" class="form-control" name="id_alternatif" id="id_alternatif" v-model="obj_alternatif.id_alternatif">
                                <input class="form-control field-alternatif" name="kd_alternatif" id="kd_alternatif" v-model="obj_alternatif.kd_alternatif">
                            </div>
                            <div class="col-6">
                                <label class="col-form-label">Nama Alternatif</label>
                                <input class="form-control field-alternatif" name="nama_alternatif" id="nama_alternatif" v-model="obj_alternatif.nama_alternatif">
                            </div>
                            <div class="col-6" v-for="item in optionSubKriteria">
                                <label for="kodealternatif" class="col-form-label">{{item.nama_kriteria}}</label>
                                <template v-if="item.is_range == 1">
                                    <div class="col-auto">
                                        <input class="form-control form-control-sm" v-model="obj_alternatif['nilai_alternatif-' + item.id_kriteria ]" v-on:keyup="setValueKriteria(item.id_kriteria)">
                                        <select class="form-control form-control-sm field-alternatif" v-bind:name="item.id_kriteria" v-model="obj_alternatif[item.id_kriteria]" v-bind:id="item.id_kriteria" disabled>
                                            <option value="0">Kategori {{item.nama_kriteria}}</option>
                                            <option v-for="option in item.list" v-bind:value="option.value">{{option.name}}</option>
                                        </select>
                                    </div>
                                </template>
                                <template v-if="item.is_range == 0">
                                    <div class="col-auto">
                                        <select class="form-control form-control-sm field-alternatif" v-bind:name="item.id_kriteria" v-model="obj_alternatif[item.id_kriteria]" v-bind:id="item.id_kriteria">
                                            <option value="0">Pilih {{item.nama_kriteria}}</option>
                                            <option v-for="option in item.list" v-bind:value="option.value">{{option.name}}</option>
                                        </select>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success btn-sm btn-simpan-alternatif" v-on:click="saveAlternatif()" data-bs-dismiss="modal">Simpan</button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deleteAlternatif" tabindex="-1" aria-labelledby="deleteAlternatif" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan Alternatif</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span>Anda yakin ingin menghapus alternatif {{nama_alternatif}} ?</span>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success btn-sm" v-on:click="deleteAlternatif()" data-bs-dismiss="modal">YES</button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">NO</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="step1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="max-width: 910px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">1. Data Matriks Keputusan</h5>
                            <button type="button" class="btn-close step" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Alternatif</th>
                                        <th scope="col" v-for="item in listKriteria">{{item.nama_kriteria}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in listMatrixDecision">
                                      <td>{{index + 1}}</td>
                                      <td>{{item.nama_alternatif}}</td>
                                      <td v-for="header in listKriteria" v-bind:class="header.nama_kriteria">{{item.detail[header.nama_kriteria]}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#step2" v-on:click="getListMatrixNormalize()">Next</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="step2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="max-width: 910px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">2. Data Matriks Normalisasi</h5>
                            <button type="button" class="btn-close step" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Alternatif</th>
                                        <th scope="col" v-for="item in listKriteria">{{item.nama_kriteria}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in listMatrixDecision">
                                      <td>{{index + 1}}</td>
                                      <td>{{item.nama_alternatif}}</td>
                                      <td v-for="header in listKriteria" v-bind:class="header.nama_kriteria">{{item.detail[header.nama_kriteria]}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#step3" v-on:click="getListMatrixNormalizedWeight()">Next</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="step3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="max-width: 910px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">3. Data Matriks Normalisasi Bobot</h5>
                            <button type="button" class="btn-close step" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Alternatif</th>
                                        <th scope="col" v-for="item in listKriteria">{{item.nama_kriteria}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in listMatrixDecision">
                                      <td>{{index + 1}}</td>
                                      <td>{{item.nama_alternatif}}</td>
                                      <td v-for="header in listKriteria" v-bind:class="item.nama_alternatif">{{item.detail[header.nama_kriteria]}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#step4" v-on:click="getUtilityMeasures()">Next</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="step4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="max-width: 910px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">4. Menghitung Utility Measures (S) dan Regret Measures (R)</h5>
                            <button type="button" class="btn-close step" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Alternatif</th>
                                        <th scope="col">S</th>
                                        <th scope="col">R</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in listUtility">
                                      <td>{{index + 1}}</td>
                                      <td>{{item.nama_alternatif}}</td>
                                      <td v-bind:class="item.nama_alternatif + '-utility'">{{item.utility}}</td>
                                      <td v-bind:class="item.nama_alternatif + '-regret'">{{item.regret}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#step5" v-on:click="getIndexVikor()">Next</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="step5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="max-width: 910px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">5. Menghitung Indeks VIKOR (Q)</h5>
                            <button type="button" class="btn-close step" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Alternatif</th>
                                        <th scope="col">Q</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in listIndexVikor">
                                      <td>{{index + 1}}</td>
                                      <td>{{item.nama_alternatif}}</td>
                                      <td>{{item.index_vikor}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#step6" v-on:click="getResultRankingAlternatif()">Next</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="step6" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" style="max-width: 910px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">6. Hasil Perankingan Alternatif</h5>
                            <button type="button" class="btn-close step" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Alternatif</th>
                                        <th scope="col">Q</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in listIndexVikor">
                                      <td>{{index + 1}}</td>
                                      <td>{{item.nama_alternatif}}</td>
                                      <td>{{item.index_vikor}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#step5">Next</button> -->
                            <button type="button" class="btn btn-danger btn-sm" v-on:click="closeModal()">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="asset/sbadmin/js/scripts.js"></script>
        <script src="asset/jquery-3.6.0.js"></script>
        <script src="asset/vue.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script type="text/javascript">
            const vue = new Vue({
              el: '#layoutSidenav',
              data: {
                tipe: null,
                listIdealSolution: null,
                listAlternatifPlus: null,
                listAlternatifMinus: null,
                listPreferences: null,
                listRanking: null,
                id_alternatif: null,
                kd_alternatif: null,
                nama_alternatif: null,
                detail: null,
                listRank: null,
                alternatifData: {},
                emptyInputList: [],
                total_weight: localStorage.total_weight,
                is_empty: $('.td-nilai-alternatif').toArray().map(r => $(r).text()).filter(s => s == '-').length,
                range_field: null,
                detail: null,
                alternatif_choosen: null,
                listSubKriteria: null,
                nama_kriteria: '',
                id_kriteria: 0,
                nama_subkriteria: '',
                id_subkriteria: 0,
                kd_kriteria: '',
                bobot_kriteria: '',
                is_range: false,
                nilai_rating: '',
                min_value: null,
                max_value: null,
                listKriteria: null,
                optionSubKriteria: null,
                obj_alternatif: {},
                listAlternatif: null,
                listMatrixDecision: null,
                listUtility: null,
                listIndexVikor: null
              },
              methods: {
                getAlternatifDetail: async (id_alternatif, kd_alternatif, nama_alternatif) => {
                  const data = await $.ajax({url: 'Dataalternatif/getAlternatifDetail/' + id_alternatif, dataType: 'JSON'})
                  for (const idx in data) {
                    vue.obj_alternatif[data[idx].id_kriteria] = data[idx].id_sub_kriteria
                    vue.obj_alternatif['nilai_alternatif-' + data[idx].id_kriteria] = data[idx].nilai_alternatif
                    /*$(`[name="${data[idx].id_kriteria}"]`).val(data[idx].id_sub_kriteria)
                    $(`[name="nilai_alternatif-${data[idx].id_kriteria}"]`).val(data[idx].nilai_alternatif)*/
                  }
                  // $(`[name="id_alternatif"]`).val(id_alternatif)
                  // $(`[name="kd_alternatif"]`).val(kd_alternatif)
                  // $(`[name="nama_alternatif"]`).val(nama_alternatif)
                  vue.obj_alternatif.kd_alternatif = kd_alternatif
                  vue.obj_alternatif.id_alternatif = id_alternatif
                  vue.obj_alternatif.nama_alternatif = nama_alternatif
                  console.log(data)
                },
                getListSubKriteria: async () => {
                    const data = await $.ajax({
                      url: `Datakriteria/getListSubKriteria/${vue.id_kriteria}`,
                      dataType: 'JSON',
                    })
                    vue.listSubKriteria = data
                },
                sortAlternatif: () => {
                  vue.listPreferences.sort((a, b) =>  b.result - a.result)
                },
                reload: () => {
                  location.reload()
                },
                saveKriteria: () => {
                    const obj = {
                        kd_kriteria: vue.kd_kriteria,
                        nama_kriteria: vue.nama_kriteria,
                        bobot_kriteria: vue.bobot_kriteria,
                        is_range: vue.is_range ? 1 : 0
                    }
                    if (vue.id_kriteria) obj.id_kriteria = vue.id_kriteria
                    if (!vue.kd_kriteria.length || !vue.nama_kriteria.length || !vue.bobot_kriteria.length) 
                        Swal.fire({title: 'Semua Data Wajib Diisi!', icon:'error'})
                    else $.ajax({
                        url: "<?php echo base_url()?>Datakriteria/insert",
                        type: 'POST',
                        data: obj,
                        success: () => vue.getListKriteria()
                    })
                },
                saveAlternatif: () => {
                    /*const obj = {
                        kd_kriteria: vue.kd_kriteria,
                        nama_kriteria: vue.nama_kriteria,
                        bobot_kriteria: vue.bobot_kriteria
                    }
                    if (vue.id_kriteria) obj.id_kriteria = vue.id_kriteria*/
                    $.ajax({
                        url: "<?php echo base_url()?>Dataalternatif/insert",
                        type: 'POST',
                        data: vue.obj_alternatif,
                        success: () => vue.getListAlternatif()
                    })
                },
                deleteKriteria: () => {
                    $.ajax({
                        url:"<?php echo base_url()?>Datakriteria/delete",
                        type: 'POST',
                        data: {id_kriteria: vue.id_kriteria},
                        success: () => vue.getListKriteria()
                    })
                },
                deleteAlternatif: () => {
                    $.ajax({
                        url:"<?php echo base_url()?>Dataalternatif/delete",
                        type: 'POST',
                        data: {id_alternatif: vue.id_alternatif},
                        success: () => vue.getListAlternatif()
                    })
                },
                saveSubKriteria: () => {
                    const obj = {
                        id_kriteria: vue.id_kriteria,
                        nama_subkriteria: vue.nama_subkriteria,
                        nilai_rating: vue.nilai_rating,
                        min_value: vue.min_value,
                        max_value: vue.max_value,
                        id_subkriteria: vue.id_subkriteria
                    }
                    // if (vue.id_subkriteria) obj.id_subkriteria = vue.id_subkriteria
                    $.ajax({
                        url: "<?php echo base_url()?>Datakriteria/insertSub",
                        type: 'POST',
                        data: obj,
                        success: () => vue.getListSubKriteria()
                    })
                },
                setValueKriteria: id_kriteria => {
                    console.log(vue.optionSubKriteria.filter(
                            r => r.id_kriteria == id_kriteria
                        ).map(m => m.list.filter(
                            f => vue.inRange(vue.obj_alternatif['nilai_alternatif-' + id_kriteria ], f.max, f.min)
                        )
                    ))
                    const value = vue.optionSubKriteria.filter(
                            r => r.id_kriteria == id_kriteria
                        ).map(m => m.list.filter(
                            f => vue.inRange(vue.obj_alternatif['nilai_alternatif-' + id_kriteria ], f.max, f.min)
                        )
                    )[0]
                    if (value.length) {
                        vue.obj_alternatif[id_kriteria] = value[0].value
                        $('#' + id_kriteria).val(vue.obj_alternatif[id_kriteria])
                        console.log(vue.obj_alternatif[id_kriteria])
                        console.log(vue.obj_alternatif)
                    }
                },
                deleteSubKriteria: () => {
                    $.ajax({
                        url:"<?php echo base_url()?>Datakriteria/deleteSub",
                        type: 'POST',
                        data: {id_subkriteria: vue.id_subkriteria},
                        success: () => vue.getListSubKriteria()
                    })
                },
                showError: () => {
                  if($('.field-alternatif').toArray().map(r => $(r).val()).filter(s => !s.length).length) 
                    Swal.fire({title: 'Semua Data Wajib Diisi!', icon:'error'})
                  // else 
                  //   $('.btn-simpan-alternatif').attr('type', 'submit')
                },
                showAlert: () => {
                  Swal.fire({
                    icon:'error',
                    title: 'Kesalahan',
                    text: vue.total_weight != 100 ? 'Menurut aturan metode TOPSIS, total bobotnya harus sama dengan 100!' : vue.is_empty ? 'Semua alternatif wajib diberi nilai kriteria!' : ''
                  })
                },
                emptyField: () => {
                  vue.range_field = isNaN(vue.range_field) ? '' : vue.range_field
                },
                getResult: () => {
                  console.log(vue.listAlternatif.filter(r => r.nama_alternatif == vue.listPreferences[0].nama_alternatif))
                  const alternatif = vue.listAlternatif.filter(r => r.nama_alternatif == vue.listPreferences[0].nama_alternatif)[0]
                  vue.alternatif_choosen = alternatif.nama_alternatif
                  vue.detail = JSON.parse(alternatif.detail)
                },
                getListKriteria: async () => {
                    const data = await $.ajax({
                        url:"<?php echo base_url()?>Datakriteria/getList?>",
                        dataType: 'JSON'
                    })
                    vue.listKriteria = data
                    vue.total_weight = data.map(r => eval(r.bobot_kriteria)).reduce((a, b) => a + b)
                },
                getOptionSubKriteria: async () => {
                    const data = await $.ajax({
                        url:"<?php echo base_url()?>Datakriteria/getOptionSubKriteria?>",
                        dataType: 'JSON'
                    })
                    for (const idx in data) data[idx].list = JSON.parse(data[idx].list)
                    vue.optionSubKriteria = data
                    // vue.total_weight = data.map(r => eval(r.bobot_kriteria)).reduce((a, b) => a + b)
                },
                getListAlternatif: async () => {
                    const data = await $.ajax({
                        url:"<?php echo base_url()?>Dataalternatif/getListAlternatif?>",
                        dataType: 'JSON'
                    })
                    for (const idx in data) data[idx].detail = JSON.parse(data[idx].detail)
                    vue.listAlternatif = data
                    // vue.total_weight = data.map(r => eval(r.bobot_kriteria)).reduce((a, b) => a + b)
                },
                inRange: (x, min, max) => {
                    return ((x-min)*(x-max) <= 0);
                },
                getListMatrixDecision: async () => {
                    const data = await $.ajax({
                        url:"<?php echo base_url()?>Dataalternatif/getListMatrixDecision?>",
                        dataType: 'JSON'
                    })
                    for (const idx in data) data[idx].detail = JSON.parse(data[idx].detail)
                    vue.listMatrixDecision = data
                    // vue.total_weight = data.map(r => eval(r.bobot_kriteria)).reduce((a, b) => a + b)
                },
                getListMatrixNormalize: async () => {
                    const obj = {}
                    for (const idx in vue.listKriteria) {
                        obj[vue.listKriteria[idx].nama_kriteria + '_max'] = Math.max(...$('.' + vue.listKriteria[idx].nama_kriteria.replaceAll(' ', '.')).toArray().map(e => eval($(e).text())))
                        obj[vue.listKriteria[idx].nama_kriteria + '_min'] = Math.min(...$('.' + vue.listKriteria[idx].nama_kriteria.replaceAll(' ', '.')).toArray().map(e => eval($(e).text())))
                    }
                    for (const idx in vue.listMatrixDecision) 
                        for (const item in vue.listKriteria) {
                            const nama_kriteria = vue.listKriteria[item].nama_kriteria
                            const nilai = vue.listMatrixDecision[idx].detail[nama_kriteria]
                            vue.listMatrixDecision[idx].detail[nama_kriteria] = (((obj[nama_kriteria + '_max'] - nilai)/(obj[nama_kriteria + '_max'] - obj[nama_kriteria + '_min'])) || 0).toFixed(2)
                        }
                },
                getListMatrixNormalizedWeight: async () => {
                    for (const idx in vue.listMatrixDecision) 
                        for (const item in vue.listKriteria) {
                            const nama_kriteria = vue.listKriteria[item].nama_kriteria
                            const nilai = vue.listMatrixDecision[idx].detail[nama_kriteria]
                            vue.listMatrixDecision[idx].detail[nama_kriteria] = (nilai*eval(vue.listKriteria[item].bobot_kriteria) || 0).toFixed(4)
                        }
                },
                getUtilityMeasures: async () => {
                    vue.listUtility = []
                    for (const item in vue.listAlternatif) vue.listUtility.push({
                        nama_alternatif: vue.listAlternatif[item].nama_alternatif,
                        utility: $('.' + vue.listAlternatif[item].nama_alternatif.replaceAll(' ', '.')).toArray().map(e => eval($(e).text())).reduce((a,b) => a + b).toFixed(4),
                        regret: Math.max(...$('.' + vue.listAlternatif[item].nama_alternatif.replaceAll(' ', '.')).toArray().map(e => eval($(e).text()))).toFixed(4)
                    })
                },
                getIndexVikor: async () => {
                    vue.listIndexVikor = []
                    const utilityMin = Math.min(...vue.listUtility.map(r => r.utility))
                    const utilityMax = Math.max(...vue.listUtility.map(r => r.utility))
                    const regretMin = Math.min(...vue.listUtility.map(r => r.regret))
                    const regretMax = Math.max(...vue.listUtility.map(r => r.regret))
                    for (const item in vue.listAlternatif) {
                        const utilityAlternatif = eval($('.' + vue.listAlternatif[item].nama_alternatif.replaceAll(' ', '.') + '-utility').text())
                        const regretAlternatif = eval($('.' + vue.listAlternatif[item].nama_alternatif.replaceAll(' ', '.') + '-regret').text())
                        vue.listIndexVikor.push({
                            nama_alternatif: vue.listAlternatif[item].nama_alternatif,
                            utility_min: utilityMin,
                            utility_max: utilityMax,
                            regret_min: regretMin,
                            regret_max: regretMax,
                            utility_alternatif: utilityAlternatif,
                            regret_alternatif: regretAlternatif,
                            diff_utilityAlternatif_utilityMin: utilityAlternatif - utilityMin,
                            diff_utilityMax_utilityMin: utilityMax - utilityMin,
                            diff_regretAlternatif_regretMin: regretAlternatif - regretMin,
                            diff_regretMax_regretMin: regretMax - regretMin,
                            index_vikor: ((0.5 * ((utilityAlternatif - utilityMin)/(utilityMax - utilityMin))) + ((1 - 0.5) * ((regretAlternatif - regretMin)/(regretMax - regretMin)))).toFixed(4)
                        })
                    }
                },
                getResultRankingAlternatif: async () => {
                    vue.listIndexVikor.sort((a, b) => a.index_vikor - b.index_vikor)
                },
                closeModal: async() => $('.btn-close.step').click(),
                resetForm: async () => {
                    setTimeout(() => {
                        vue.obj_alternatif = {
                            kd_alternatif: '',
                            nama_alternatif: ''
                        }
                        for (const idx in vue.listKriteria) vue.obj_alternatif[vue.listKriteria[idx].id_kriteria] = 0
                    }, 500)
                }
              },
              async mounted() {
                this.getOptionSubKriteria()
                this.getListKriteria()
                this.getListAlternatif()
                this.resetForm()
                const list = []
                const listAlternatifPlus = []
                const listAlternatifMinus = []
                const objPlus = {}
                const objMinus = {}
                const criteria = $('.th-weight').toArray().map(el => $(el).text())
                const alternatif = $('.th-alternatif').toArray().map(el => $(el).text())
                objPlus.solution = 'Solusi Ideal Positif (+)'
                objMinus.solution = 'Solusi Ideal Negatif (-)'
                for (const idx in criteria) objPlus[criteria[idx]] = Math.max(...$('.' + criteria[idx].replace(' ', '.')).toArray().map(e => eval($(e).text())))
                list.push(objPlus)
                for (const idx in criteria) objMinus[criteria[idx]] = Math.min(...$('.' + criteria[idx].replace(' ', '.')).toArray().map(e => eval($(e).text())))
                list.push(objMinus)
                this.listIdealSolution = list
                for (const idx in alternatif) {
                  const objDetailPlus = {}
                  const objDetailMinus = {}
                  const objPreference = {}
                  const listPlus = []
                  const listMinus = []
                  const testPlus = []
                  const testMinus = []
                  objDetailPlus.nama_alternatif = alternatif[idx]
                  objDetailMinus.nama_alternatif = alternatif[idx]
                  for (const x in criteria) 
                    listPlus.push((eval($(`.${criteria[x].replace(' ', '.')}[data-alternatif="${alternatif[idx]}"]`).text()) - objPlus[criteria[x]])**2)
                  for (const x in criteria) listMinus.push((eval($(`.${criteria[x].replace(' ', '.')}[data-alternatif="${alternatif[idx]}"]`).text()) - objMinus[criteria[x]])**2)
                  objDetailPlus.result_plus = Math.sqrt(listPlus.reduce((a, b) => a + b)).toFixed(2)
                  objDetailMinus.result_minus = Math.sqrt(listMinus.reduce((a, b) => a + b)).toFixed(2)
                  listAlternatifPlus.push(objDetailPlus)
                  listAlternatifMinus.push(objDetailMinus)
                } 
                this.listAlternatifPlus = listAlternatifPlus
                this.listAlternatifMinus = listAlternatifMinus
                this.listPreferences = this.listAlternatifPlus.map((item, i) => Object.assign({}, item, this.listAlternatifMinus[i]))
                for (const idx in this.listPreferences) this.listPreferences[idx].result = (
                  eval(this.listPreferences[idx].result_minus)/(eval(this.listPreferences[idx].result_minus) + eval(this.listPreferences[idx].result_plus))
                ).toFixed(2)
              },
              /*watch: {
                emptyInputList: function (val) {
                  // this.emptyInputList = val
                  console.log('WKWKWKWKWKWKWKWK')
                }
              }*/
            })
            // vue.emptyInputList = $('.field-alternatif').toArray().map(r => $(r).val()).filter(s => !s.length).length
        </script>
    </body>
</html>
