<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SPEK VPS</title>

    <!-- Link asset
    <link rel="stylesheet" type="text/css" href="asset/bootstrap5/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="asset/bootstrap5/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="asset/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" type="text/css" href="asset/fontawesome/css/brands.css">
    <link rel="stylesheet" type="text/css" href="asset/fontawesome/css/solid.css">
    <link rel="stylesheet" type="text/css" href="asset/bootstrap5/css/stickyfooter.css">
   CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
<script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <!--<script type="text/javascript" src="asset/bootstrap5/js/bootstrap.js"></script>
    <script type="text/javascript" src="asset/bootstrap5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="asset/bootstrap5/js/bootstrap.bundle.min.js"></script>-->
</head>

<!-- body-->
<body>
  <div id="app">
  <div id="content-wrapper">
    <div class="container-fluid">
          
        <!-- Breadcrumbs -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="Menu">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Kriteria</li>
            </ol>
         </nav>
          
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" v-on:click="id_kriteria = 0; resetForm('kriteria')">
        Tambah
        </button>

        <!-- Modal -->
        <div class="modal fade" role="dialog" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{id_kriteria ? 'Ubah' : 'Tambah'}} Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- modal body -->
              <div class="modal-body">
              <!-- form input modal-->
                <form class="row" method="POST" action="<?php echo base_url()?>Datakriteria/insert">
                    <div class="col-12">
                      <label for="kodekriteria" class="col-sm-2 col-form-label">Kode Kriteria</label>
                        <div class="col-auto">
                        <input type="hidden" class="form-control" name="id_kriteria" v-bind:value="id_kriteria">
                        <input type="text" class="form-control field-kriteria" name="kd_kriteria" v-model="kd_kriteria">
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="namakriteria" class="col-sm-2 col-form-label">Nama Kriteria</label>
                        <div class="col-auto">
                          <input type="text" class="form-control field-kriteria" name="nama_kriteria" v-model="nama_kriteria">
                        </div>
                    </div>
                    <div class="col-12">
                      <label for="bobotkriteria" class="col-sm-2 col-form-label">Bobot Kriteria</label>
                        <div class="col-auto">
                          <input type="text" class="form-control field-kriteria" name="bobot_kriteria" v-model="bobot_kriteria">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button v-bind:type="!kd_kriteria.length || !nama_kriteria.length || !bobot_kriteria.length ? 'button' : 'submit'" class="btn btn-success btn-simpan-kriteria" v-on:click="showError('kriteria')">Simpan</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
              </div>

              <!-- <div class="container-lg">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Tambah Data SubKriteria
                </button> -->

                <!--table modal--> 
                  <!-- <table class="table table-striped">
                      <thead>
                        <tr>
                            <th scope="col">No</th>
                              <th scope="col">Nama SubKriteria</th>
                              <th scope="col">Nilai Rating</th>
                            <th scope="col">Aksi</th>
                          </tr>
                            <tr>
                              <th scope="row"></th>
                              <td></td>
                              <td></td>
                              <td>
                                <button type="button" class="btn btn-info">Tambah</button>
                              </td>
                            </tr>
                        </thead>
                    </table> -->

              <!-- button modal -->
                </div>
            </div>
          </div>

          <div class="modal fade" id="deleteKriteria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- modal body -->
              <div class="modal-body">
              <!-- form input modal-->
                <form class="row" method="POST" action="<?php echo base_url()?>Datakriteria/delete">
                    <span>Anda yakin ingin menghapus kriteria {{nama_kriteria}} ?</span>
                    <input type="hidden" name="id_kriteria" v-bind:value="id_kriteria">
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">YES</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                    </div>
                </form>
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

              <!-- modal body -->
              <div class="modal-body row">
              <!-- form input modal-->
              <div class="col-12">
                <button class="btn btn-sm btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalAddSubKriteria" v-on:click="id_subkriteria = 0; resetForm('subkriteria')">
                  Tambah
                </button>
              </div>
              <div class="col-12">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Sub Kriteria</th>
                        <th>Nilai Rating</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in listSubKriteria">
                        <td>{{index + 1}}</td>
                        <td>{{item.nama_subkriteria}}</td>
                        <td>{{item.nilai_rating}}</td>
                        <td>
                          <button type="button" class="btn btn-warning" data-bs-target="#modalAddSubKriteria" data-bs-toggle="modal" v-on:click="id_subkriteria = item.id_subkriteria; nama_subkriteria = item.nama_subkriteria; nilai_rating = item.nilai_rating">Ubah</button>
                          <button type="button" class="btn btn-danger" data-bs-target="#deleteSubKriteria" data-bs-toggle="modal" v-on:click="id_subkriteria = item.id_subkriteria; nama_subkriteria = item.nama_subkriteria;">Hapus</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
              </div>
              </div>

              <!-- <div class="container-lg">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Tambah Data SubKriteria
                </button> -->

                <!--table modal--> 
                  <!-- <table class="table table-striped">
                      <thead>
                        <tr>
                            <th scope="col">No</th>
                              <th scope="col">Nama SubKriteria</th>
                              <th scope="col">Nilai Rating</th>
                            <th scope="col">Aksi</th>
                          </tr>
                            <tr>
                              <th scope="row"></th>
                              <td></td>
                              <td></td>
                              <td>
                                <button type="button" class="btn btn-info">Tambah</button>
                              </td>
                            </tr>
                        </thead>
                    </table> -->

              <!-- button modal -->
                </div>
            </div>
          </div>
          <div class="modal fade" id="deleteSubKriteria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan Sub Kriteria Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- modal body -->
              <div class="modal-body">
              <!-- form input modal-->
                <form class="row" method="POST" action="<?php echo base_url()?>Datakriteria/deleteSub">
                    <span>Anda yakin ingin menghapus sub kriteria {{nama_subkriteria}} ?</span>
                    <input type="hidden" name="id_subkriteria" v-bind:value="id_subkriteria">
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">YES</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NO</button>
                    </div>
                </form>
              </div>
                </div>
            </div>
          </div>
          <div class="modal fade" id="modalAddSubKriteria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{id_subkriteria ? 'Ubah' : 'Tambah'}} Sub Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <!-- modal body -->
              <div class="modal-body">
              <!-- form input modal-->
                <form class="row" method="POST" action="<?php echo base_url()?>Datakriteria/insertSub">
                    <div class="col-12">
                      <label for="namakriteria" class="col-form-label">Nama Sub Kriteria</label>
                        <div class="col-auto">
                          <input type="hidden" class="form-control" name="id_kriteria" v-bind:value="id_kriteria">
                          <input type="hidden" class="form-control" name="id_subkriteria" id="id_subkriteria" v-bind:value="id_subkriteria">
                          <input type="text" class="form-control field-subkriteria" name="nama_subkriteria" v-model="nama_subkriteria">
                        </div>
                    </div>
                    <div class="col-12">
                      <label for="bobotkriteria" class="col-form-label">Nilai Rating</label>
                        <div class="col-auto">
                          <input type="number" class="form-control field-subkriteria" name="nilai_rating" v-model="nilai_rating">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button v-bind:type="!nama_subkriteria.length || !nilai_rating.length ? 'button' : 'submit'" v-on:click="showError('subkriteria')" class="btn btn-success btn-simpan-subkriteria">Simpan</button>
                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
              </div>

              <!-- <div class="container-lg">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  Tambah Data SubKriteria
                </button> -->

                <!--table modal--> 
                  <!-- <table class="table table-striped">
                      <thead>
                        <tr>
                            <th scope="col">No</th>
                              <th scope="col">Nama SubKriteria</th>
                              <th scope="col">Nilai Rating</th>
                            <th scope="col">Aksi</th>
                          </tr>
                            <tr>
                              <th scope="row"></th>
                              <td></td>
                              <td></td>
                              <td>
                                <button type="button" class="btn btn-info">Tambah</button>
                              </td>
                            </tr>
                        </thead>
                    </table> -->

              <!-- button modal -->
                </div>
            </div>
          </div>
        </div>
        
        <!-- end of modal -->
        

        <!-- tabel -->
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Kode Kriteria</th>
              <th scope="col">Nama Kriteria</th>
              <th scope="col">Bobot Kriteria</th>
              <th scope="col">Aksi</th>
            </tr>
            <?php $no = 1; foreach($data as $k => $v): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= $v->kd_kriteria ?></td>
              <td><?= $v->nama_kriteria ?></td>
              <td><?= $v->bobot_kriteria ?></td>
              <td>
                <button type="button" class="btn btn-success" v-on:click="getListData(<?= $v->id_kriteria ?>, '<?= $v->nama_kriteria ?>')" data-bs-toggle="modal" data-bs-target="#modalSubKriteria">Sub Kriteria</button>
                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal" v-on:click="id_kriteria = <?= $v->id_kriteria ?>; kd_kriteria = '<?= $v->kd_kriteria ?>'; nama_kriteria = '<?= $v->nama_kriteria ?>'; bobot_kriteria = <?= $v->bobot_kriteria ?>;">Ubah</button>
                <button type="button" class="btn btn-danger" data-bs-target="#deleteKriteria" data-bs-toggle="modal" v-on:click="id_kriteria = <?= $v->id_kriteria ?>; nama_kriteria = '<?= $v->nama_kriteria ?>';">Hapus</button>
              </td>
            </tr>
            <?php endforeach?>
            <tr>
              <td colspan="3" align="center"><strong>TOTAL</strong></td>
              <td colspan="2">{{total_weight}}</td>
            </tr>
          </thead>
        </table>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
        <script type="text/javascript">
          const vue = new Vue({
            el: '#app',
            data: {
              listSubKriteria: null,
              nama_kriteria: '',
              id_kriteria: 0,
              nama_subkriteria: '',
              id_subkriteria: 0,
              kd_kriteria: '',
              bobot_kriteria: '',
              nilai_rating: '',
              total_weight: <?= json_encode($data) ?>.map(r => eval(r.bobot_kriteria)).reduce((a, b) => a + b)
            },
            methods: {
              getListData: async (id_kriteria, nama_kriteria) => {
                console.log(id_kriteria)
                const data = await $.ajax({
                  url: `Datakriteria/getListSubKriteria/${id_kriteria}`,
                  dataType: 'JSON',
                })
                vue.nama_kriteria = nama_kriteria
                vue.id_kriteria = id_kriteria
                vue.listSubKriteria = data
              },
              resetForm: entity => {
                setTimeout(() => $('.field-' + entity).each((idx, el) => $(el).val('')), 100)
              },
              showError: entity => {
                if($('.btn-simpan-' + entity).attr('type') == 'button') Swal.fire({title: 'Semua Data Wajib Diisi!', icon:'error'})
              }
            },
            mounted() {
              localStorage.total_weight = this.total_weight
            }
          })
        </script>
  </body>
</html>

