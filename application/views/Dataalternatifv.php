<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SPEK VPS</title>

    <!-- Link asset-->
    <link rel="stylesheet" type="text/css" href="asset/bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="asset/bootstrap5/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="asset/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="asset/fontawesome/css/brands.css">
    <link rel="stylesheet" type="text/css" href="asset/fontawesome/css/solid.css">
    <link rel="stylesheet" type="text/css" href="asset/bootstrap5/css/stickyfooter.css">
    <script type="text/javascript" src="asset/bootstrap5/js/bootstrap.js"></script>
    <script type="text/javascript" src="asset/bootstrap5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="asset/bootstrap5/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="asset/jquery-3.6.0.js"></script>
</head>

<!-- body-->
<body>
  <div id="app">
    <div id="content-wrapper">
    <div class="container-fluid" id="app">
          
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="Menu">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Alternatif</li>
            </ol>
         </nav>
          
        <!-- Button trigger modal tambah data -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahdata" v-on:click="resetForm()">
        Tambah
        </button>
        <!-- Button trigger modal hitung topsis -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#hitungtopsis" v-if="total_weight == 100 && !is_empty">
        Hitung TOPSIS
        </button>
        <button type="button" class="btn btn-success" v-on:click="showAlert()" v-if="total_weight != 100 || is_empty">
        Hitung TOPSIS
        </button>

        <!-- Modal tambah -->
        <div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Alternatif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="row" method="POST" action="<?php echo base_url()?>Dataalternatif/insert">
                  <div class="col-6">
                    <label class="col-form-label">Kode Alternatif</label>
                    <input type="hidden" class="form-control" name="id_alternatif" id="id_alternatif" v-bind:value="id_alternatif">
                    <input class="form-control field-alternatif" name="kd_alternatif" id="kd_alternatif" v-bind:value="kd_alternatif">
                  </div>
                  <div class="col-6">
                    <label class="col-form-label">Nama Alternatif</label>
                    <input class="form-control field-alternatif" name="nama_alternatif" id="nama_alternatif" v-bind:value="nama_alternatif">
                  </div>
                  <?php foreach($listSubKriteria as $key => $value):?>
                  <div class="col-6">
                    <label for="kodealternatif" class="col-form-label"><?= $value->nama_kriteria?></label>
                      <div class="col-auto">
                        <?php if($value->is_range == 0): ?>
                        <select class="form-control field-alternatif" name="<?= $value->id_kriteria?>" id="<?= $value->id_kriteria?>">
                          <option value="0">Pilih <?= $value->nama_kriteria?></option>
                          <?php foreach(json_decode($value->list) as $k => $v):?>
                          <option value="<?= $v->value?>"><?= $v->name?></option>
                          <?php endforeach?>
                        </select>
                        <?php else:?>
                          <input class="form-control field-alternatif" v-model="range_field" v-on:keyup="emptyField()" name="nilai_alternatif-<?= $value->id_kriteria?>" id="nilai_alternatif-<?= $value->id_kriteria?>">
                        <?php endif;?>
                    </div>
                  </div>
                  <?php endforeach?>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success btn-simpan-alternatif" v-on:click="showError()">Simpan</button>
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
              </form>
              </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal hitung topsis -->
        <div class="modal fade" id="hitungtopsis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">1. Data Matriks Keputusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- modal body -->
              <div class="modal-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Alternatif</th>
                      <?php foreach($header as $k => $v): ?>
                      <th scope="col"><?= $v->nama_kriteria?></th>
                      <?php endforeach; ?>
                    </tr>
                    <?php $no = 1; foreach($listMatrixDecision as $k => $v): ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?=$v->nama_alternatif?></td>
                      <?php foreach($header as $x => $y): ?>
                      <td><?= json_decode($v->detail)->{$y->nama_kriteria}?></td>
                      <?php endforeach?>
                    </tr>
                    <?php endforeach?>
                  </thead>
                </table>
              </div>
  
              <!-- button modal -->
                    <div class="modal-footer">
                        <!-- Button trigger modal hitung topsis -->
                       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nexttopsis">
                        Next
                        </button>
                  </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="nexttopsis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">2. Data Matriks Keputusan Ternormalisasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- modal body -->
              <div class="modal-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Alternatif</th>
                      <?php foreach($header as $k => $v): ?>
                      <th scope="col"><?= $v->nama_kriteria?></th>
                      <?php endforeach; ?>
                    </tr>
                    <?php $no = 1; foreach($listMatrixDecision as $k => $v): ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?=$v->nama_alternatif?></td>
                      <?php foreach($header as $x => $y): ?>
                      <td><?= round(json_decode($v->detail)->{$y->nama_kriteria}/$headerNormalize->{$y->nama_kriteria}, 2)?></td>
                      <?php endforeach?>
                    </tr>
                    <?php endforeach?>
                  </thead>
                </table>
              </div>
  
              <!-- button modal -->
                    <div class="modal-footer">
                        <!-- Button trigger modal hitung topsis -->
                       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nexttopsis2">
                        Next
                        </button>
                  </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="nexttopsis2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">3. Data Matriks Keputusan Ternormalisasi Terbobot</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- modal body -->
              <div class="modal-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Alternatif</th>
                      <?php foreach($header as $k => $v): ?>
                      <th scope="col" class="th-weight"><?= $v->nama_kriteria?></th>
                      <?php endforeach; ?>
                    </tr>
                    <?php $no = 1; foreach($listMatrixDecision as $k => $v): ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td class="th-alternatif"><?=$v->nama_alternatif?></td>
                      <?php foreach($header as $x => $y): ?>
                      <td class="<?= $y->nama_kriteria ?>" data-alternatif="<?= $v->nama_alternatif ?>"><?= round(json_decode($v->detail)->{$y->nama_kriteria}/$headerNormalize->{$y->nama_kriteria}, 2) * $headerWeight->{$y->nama_kriteria}?></td>
                      <?php endforeach?>
                    </tr>
                    <?php endforeach?>
                  </thead>
                </table>
              </div>
  
              <!-- button modal -->
                    <div class="modal-footer">
                        <!-- Button trigger modal hitung topsis -->
                       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nexttopsis3">
                        Next
                        </button>
                  </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="nexttopsis3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">4. Menentukan matriks solusi ideal positif dan solusi ideal negatif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- modal body -->
              <div class="modal-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Solusi Ideal</th>
                      <?php foreach($header as $k => $v): ?>
                      <th scope="col"><?= $v->nama_kriteria?></th>
                      <?php endforeach; ?>
                    </tr>
                    <tr v-for="(item, index) in listIdealSolution">
                      <td>{{index + 1}}</td>
                      <td>{{item.solution}}</td>
                      <?php foreach($header as $k => $v): ?>
                      <td>{{item["<?= $v->nama_kriteria ?>"]}}</td>
                      <?php endforeach; ?>
                    </tr>
                  </thead>
                </table>
              </div>
  
              <!-- button modal -->
                    <div class="modal-footer">
                        <!-- Button trigger modal hitung topsis -->
                       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nexttopsis4">
                        Next
                        </button>
                  </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="nexttopsis4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content" style="width: max-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">5. Menghitung jarak antara nilai alternatif dari matriks solusi ideal positif & matriks solusi ideal negatif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- modal body -->
              <div class="modal-body">
                <div class="row">
                  <div class="col">
                    <h6>Solusi Ideal Positif</h6>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama Alternatif</th>
                          <th scope="col">Jarak Alternatif</th>
                        </tr>
                        <tr v-for="(item, index) in listAlternatifPlus">
                          <td>{{index + 1}}</td>
                          <td>{{item.nama_alternatif}}</td>
                          <td>{{item.result_plus}}</td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                  <div class="col">
                    <h6>Solusi Ideal Negatif</h6>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Nama Alternatif</th>
                          <th scope="col">Jarak Alternatif</th>
                        </tr>
                        <tr v-for="(item, index) in listAlternatifMinus">
                          <td>{{index + 1}}</td>
                          <td>{{item.nama_alternatif}}</td>
                          <td>{{item.result_minus}}</td>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
  
              <!-- button modal -->
                    <div class="modal-footer">
                        <!-- Button trigger modal hitung topsis -->
                       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#lasttopsis">
                        Next
                        </button>
                  </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="lasttopsis" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">6. Menentukan nilai preferensi untuk setiap alternatif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- modal body -->
              <div class="modal-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama Alternatif</th>
                      <th scope="col">Nilai Preferensi</th>
                    </tr>
                    <tr v-for="(item, index) in listPreferences">
                      <td>{{index + 1}}</td>
                      <td>{{item.nama_alternatif}}</td>
                      <td>{{item.result}}</td>
                    </tr>
                  </thead>
                </table>
              </div>
  
              <!-- button modal -->
                    <div class="modal-footer">
                        <!-- Button trigger modal hitung topsis -->
                       <button type="button" class="btn btn-primary" v-on:click="sortAlternatif()" data-bs-toggle="modal" data-bs-target="#ranking">
                        Next
                        </button>
                  </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="ranking" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">7. Perangkingan alternatif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- modal body -->
              <div class="modal-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama Alternatif</th>
                      <th scope="col">Nilai Preferensi</th>
                    </tr>
                    <tr v-for="(item, index) in listPreferences">
                      <td>{{index + 1}}</td>
                      <td>{{item.nama_alternatif}}</td>
                      <td>{{item.result}}</td>
                    </tr>
                  </thead>
                </table>
              </div>
  
              <!-- button modal -->
                    <div class="modal-footer">
                        <!-- Button trigger modal hitung topsis -->
                       <button type="button" class="btn btn-primary" v-on:click="getResult()" data-bs-toggle="modal" data-bs-target="#result">
                        Next
                        </button>
                  </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="result" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesimpulan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- modal body -->
              <div class="modal-body row">
                <div class="col-12">
                  <span>Jadi, alternatif yang terpilih adalah {{alternatif_choosen}} dengan spesifikasi sebagai berikut.</span>
                </div>
                <div class="col-12">
                  <table class="table table-borderless">
                    <tr v-for="(item, index) in detail">
                      <th>{{index}}</th>
                      <td>{{item}}</td>
                    </tr>
                  </table>
                </div>
              </div>
  
              <!-- button modal -->
                    <div class="modal-footer">
                        <!-- Button trigger modal hitung topsis -->
                       <button type="button" class="btn btn-primary" v-on:click="reload()" data-bs-toggle="modal" data-bs-target="#ranking">
                        Selesai
                        </button>
                  </div>
            </div>
          </div>
        </div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Alternatif</th>
              <?php foreach($header as $k => $v): ?>
              <th scope="col"><?= $v->nama_kriteria?></th>
              <?php endforeach; ?>
              <th scope="col">Aksi</th>
            </tr>
            <?php $no = 1; foreach($listAlternatif as $k => $v): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?=$v->nama_alternatif?></td>
              <?php foreach($header as $x => $y): ?>
              <td class="td-nilai-alternatif"><?= isset(json_decode($v->detail)->{$y->nama_kriteria}) ? json_decode($v->detail)->{$y->nama_kriteria} : '-' ?></td>
              <?php endforeach?>
              <td><button type="button" class="btn btn-warning" v-on:click="getAlternatifDetail(<?=$v->id_alternatif?>, '<?=$v->kd_alternatif?>', '<?=$v->nama_alternatif?>')" data-bs-toggle="modal" data-bs-target="#tambahdata">Ubah</button>
              <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAlternatif" v-on:click="id_alternatif = <?=$v->id_alternatif?>; nama_alternatif = '<?=$v->nama_alternatif?>';">Hapus</button>
              </td>
            </tr>
            <?php endforeach?>
          </thead>
        </table>

        <div class="modal fade" id="deleteAlternatif" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan Alternatif</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- modal body -->
              <div class="modal-body">
              <!-- form input modal-->
                <form class="row" method="POST" action="<?php echo base_url()?>Dataalternatif/delete">
                    <span>Anda yakin ingin menghapus alternatif {{nama_alternatif}} ?</span>
                    <input type="hidden" name="id_alternatif" v-bind:value="id_alternatif">
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">YES</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                    </div>
                </form>
              </div>
                </div>
            </div>
          </div>
  </div>
  <script src="asset/vue.js"></script>
  <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
  <script type="text/javascript">
    const vue = new Vue({
      el: '#app',
      data: {
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
        listAlternatif: <?= json_encode($listAlternatif)?>,
        detail: null,
        alternatif_choosen: null
      },
      methods: {
        getAlternatifDetail: async (id_alternatif, kd_alternatif, nama_alternatif) => {
          const data = await $.ajax({url: 'Dataalternatif/getAlternatifDetail/' + id_alternatif, dataType: 'JSON'})
          for (const idx in data) {
            $(`[name="${data[idx].id_kriteria}"]`).val(data[idx].id_sub_kriteria)
            $(`[name="nilai_alternatif-${data[idx].id_kriteria}"]`).val(data[idx].nilai_alternatif)
          }
          vue.kd_alternatif = kd_alternatif
          vue.id_alternatif = id_alternatif
          vue.nama_alternatif = nama_alternatif
          console.log(data)
        },
        sortAlternatif: () => {
          vue.listPreferences.sort((a, b) =>  b.result - a.result)
        },
        reload: () => {
          location.reload()
        },
        resetForm: () => {
          $('#id_alternatif').val(0)
          $('.field-alternatif').each((idx, el) => $(el).val($(`#${$(el).attr('id')}`).html().length ? 0 : ''))
        },
        showError: () => {
          if($('.field-alternatif').toArray().map(r => $(r).val()).filter(s => !s.length).length) 
            Swal.fire({title: 'Semua Data Wajib Diisi!', icon:'error'})
          else 
            $('.btn-simpan-alternatif').attr('type', 'submit')
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
        }
      },
      async mounted() {
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

