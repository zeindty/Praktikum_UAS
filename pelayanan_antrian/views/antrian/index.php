
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PELAYANAN ANTRIAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  </head>
  <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                </ul>
                <form class="d-flex" role="search">
                </form>
                </div>
            </div>
        </nav>
        <div id="message">
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-sm-9">DATA PELAYANAN ANTRIAN</div>
                    <div class="col col-sm-3">
                        <a href="#" class="btn btn-warning btn-sm float-end" id="generate">Generate</a>
                        <a href="#" class="btn btn-secondary btn-sm float-end" id="add_data">Add</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="sample_data">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Waktu Kedatangan</th>
                                <th>Selisih Kedatangan</th>
                                <th>Waktu Awal Pelayanan</th>
                                <th>Selisih Pelayanan Kasir</th>
                                <th>Watu Selesai</th>
                                <th>Selisih Keluar Antrian</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" id="action_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form method="post" id="sample_form">
                        <div class="modal-header">
                            <h5 class="modal-title" id="dynamic_modal_title"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Waktu Kedatangan</label>
                                <input type="text" name="waktu_kedatangan" id="waktu_kedatangan" class="form-control" />
                                <span id="waktu_kedatangan_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Selisih Kedatangan</label>
                                <input type="selisih_kedatangan" name="selisih_kedatangan" id="selisih_kedatangan" class="form-control" />
                                <span id="selisih_kedatangan_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Waktu Awal Pelayanan</label>
                                <input type="waktu_awal_pelayanan" name="waktu_awal_pelayanan" id="waktu_awal_pelayanan" class="form-control" />
                                <span id="waktu_awal_pelayanan_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Selisih Pelayanan Kasir</label>
                                <input type="text" name="selisih_pelayanan_kasir" id="selisih_pelayanan_kasir" class="form-control" />
                                <span id="selisih_pelayanan_kasir_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Waktu Selesai</label>
                                <input type="waktu_selesai" name="waktu_selesai" id="waktu_selesai" class="form-control" />
                                <span id="waktu_selesai_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Selisih Keluar Antrian</label>
                                <input type="selisih_keluar_antrian" name="selisih_keluar_antrian" id="selisih_keluar_antrian" class="form-control" />
                                <span id="selisih_keluar_antrian_error" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id" id="id" />
                            <input type="hidden" name="action" id="action" value="Add" />
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="action_button">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal" tabindex="-1" id="generate_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                        <div class="modal-header">
                            <h5 class="modal-title" id="dynamic_modal_title_generate"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Gerai MCD Solo Grand Mall melakukan percobaan terhadap pelayanan antrian dari data sebanyak <b id="total"></b>
                            Kemudian, dari hasil simulasi tersebut dapat disimpulkan sebagai berikut:
                                <ul>
                                    <li id='waktu_tunggu'></li>
                                    <li id='banyak_antrian'></li>

                                </ul>
                            </p>
                        </div>
                        <div class="modal-footer">
                           
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
    
    
    <script>
    $(document).ready(function() {
        showAll();

        $('#add_data').click(function(){
            $('#dynamic_modal_title').text('Add Data Pelayanan Antrian');
            $('#sample_form')[0].reset();
            $('#action').val('Add');
            $('#action_button').text('Add');
            $('.text-danger').text('');
            $('#action_modal').modal('show');
        });

        $('#generate').click(function(){
            $('#dynamic_modal_title_generate').text('Simpulan Pelayanan Antrian MCD');
            $('.text-danger').text('');
            $('#generate_modal').modal('show');

            var id = 1;

            $.ajax({
            type: "GET",
            contentType: "application/json",
            url:
            "http://localhost/pelayanan_antrian/api/dataantrian/generate-by-avg.php?id="+id,
            success: function(response) {
                $('#waktu_tunggu').html(response.waktu_tunggu);
                $('#banyak_antrian').html(response.banyak_antrian);

            },
            error: function(err) {
                console.log(err);
            }
        });
        });
        
        $('#sample_form').on('submit', function(event){
            event.preventDefault();
            if($('#action').val() == "Add"){
                var formData = {
                'waktu_kedatangan' : $('#waktu_kedatangan').val(),
                'selisih_kedatangan' : $('#selisih_kedatangan').val(),
                'waktu_awal_pelayanan' : $('#waktu_awal_pelayanan').val(),
                'selisih_pelayanan_kasir' : $('#selisih_pelayanan_kasir').val(),
                'waktu_selesai' : $('#waktu_selesai').val(),
                'selisih_keluar_antrian' : $('#selisih_keluar_antrian').val()
                }

                $.ajax({
                    url:"http://localhost/pelayanan_antrian/api/dataantrian/create.php",
                    method:"POST",
                    data: JSON.stringify(formData),
                    success:function(data){
                        $('#action_button').attr('disabled', false);
                        $('#message').html('<div class="alert alert-success">'+data+'</div>');
                        $('#action_modal').modal('hide');
                        $('#sample_data').DataTable().destroy();
                        showAll();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }else if($('#action').val() == "Update"){
                var formData = {
                    'id' : $('#id').val(),
                    'waktu_kedatangan' : $('#waktu_kedatangan').val(),
                    'selisih_kedatangan' : $('#selisih_kedatangan').val(),
                    'waktu_awal_pelayanan' : $('#waktu_awal_pelayanan').val(),
                    'selisih_pelayanan_kasir' : $('#selisih_pelayanan_kasir').val(),
                    'waktu_selesai' : $('#waktu_selesai').val(),
                    'selisih_keluar_antrian' : $('#selisih_keluar_antrian').val()
                    }

                $.ajax({
                    url:"http://localhost/pelayanan_antrian/api/dataantrian/update.php",
                    method:"PUT",
                    data: JSON.stringify(formData),
                    success:function(data){
                        $('#action_button').attr('disabled', false);
                        $('#message').html('<div class="alert alert-success">'+data+'</div>');
                        $('#action_modal').modal('hide');
                        $('#sample_data').DataTable().destroy();
                        showAll();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });
            }
            });
    });

    function showAll() {
        $.ajax({
            type: "GET",
            contentType: "application/json",
            url:"http://localhost/pelayanan_antrian/api/dataantrian/read.php",
            success: function(response) {
            // console.log(response);
                $('#total').html('');
                var json = response.body;
                var dataSet=[];
                for (var i = 0; i < json.length; i++) {
                    var sub_array = {
                        'no' : i+1,
                        'waktu_kedatangan' : json[i].waktu_kedatangan,
                        'selisih_kedatangan' : json[i].selisih_kedatangan,
                        'waktu_awal_pelayanan' : json[i].waktu_awal_pelayanan,
                        'selisih_pelayanan_kasir' : json[i].selisih_pelayanan_kasir,
                        'waktu_selesai' : json[i].waktu_selesai,
                        'selisih_keluar_antrian' : json[i].selisih_keluar_antrian,
                        'action' : '<button onclick="deleteOne('+json[i].id+')" class="btn btn-sm btn-danger">Delete</button>'
                    };
                    dataSet.push(sub_array);
                }
                $('#sample_data').DataTable({
                    data: dataSet,
                    columns : [
                        { data : "no" },
                        { data : "waktu_kedatangan" },
                        { data : "selisih_kedatangan" },
                        { data : "waktu_awal_pelayanan" },
                        { data : "selisih_pelayanan_kasir" },
                        { data : "waktu_selesai" },
                        { data : "selisih_keluar_antrian" },
                        { data : "action" }
                    ]
                });
                $('#total').append(response.itemCount)
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    function showOne(id) {
        $('#dynamic_modal_title').text('Edit Data');
        $('#sample_form')[0].reset();
        $('#action').val('Update');
        $('#action_button').text('Update');
        $('.text-danger').text('');
        $('#action_modal').modal('show');

        $.ajax({
            type: "GET",
            contentType: "application/json",
            url:
            "http://localhost/pelayanan_antrian/api/dataantrian/read.php?id="+id, 
            success: function(response) {
                $('#id').val(response.id);
                $('#waktu_kedatangan').val(response.waktu_kedatangan);
                $('#selisih_kedatangan').val(response.selisih_kedatangan);
                $('#waktu_awal_pelayanan').val(response.waktu_awal_pelayanan);
                $('#selisih_pelayanan_kasir').val(response.selisih_pelayanan_kasir);
                $('#waktu_selesai').val(response.waktu_selesai);
                $('#selisih_keluar_antrian').val(response.selisih_keluar_antrian).change();
            },
            error: function(err) {
                console.log(err);
            }
        });
    }

    function deleteOne(id) {
        alert('Yakin untuk hapus data ?');
        $.ajax({
            url:"http://localhost/pelayanan_antrian/api/dataantrian/delete.php",
            method:"DELETE",
            data: JSON.stringify({"id" : id}),
            success:function(data){
                $('#action_button').attr('disabled', false);
                $('#message').html('<div class="alert alert-success">'+data+'</div>');
                $('#action_modal').modal('hide');
                $('#sample_data').DataTable().destroy();
                showAll();
            },
            error: function(err) {
                console.log(err);
                $('#message').html('<div class="alert alert-danger">'+err.responseJSON+'</div>');  
            }
        });
    }
    </script>
</body>
</html>