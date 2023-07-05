<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <title>CRUD API Hewan Lindung</title>
    </head>
    <body>
    <div class="container">
            <div id="message">
            </div>
            <h1 class="mt-4 mb-4 text-center text-secondary">Database Hewan Lindung Indonesia</h1>
            <form method="POST" action="/api_praktikum/login.php">
</form>
<span id="message"></span>

            <div class="card">
                <div class="card-header bg-black">
                    <div class="row">
                        <div class="col col-sm-9 text-white fw-bold">Data Hewan Lindung</div>
                        <div class="col col-sm-3">
                            <button type="button" id="add_data" class="btn btn-secondary btn-sm float-end">
                            <i class="fas fa-plus"></i> Add</button>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="sample_data">
                            <thead>
                                <tr>
                                    <th class="text-center">Nama Hewan</th>
                                    <th class="text-center">Taxonomy</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Population</th>
                                    <th class="text-center">Habitat</th>
                                    <th class="text-center">Location</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div><br></div>
            <div><button name="logout" type="submit" class="btn btn-secondary mb-4 ml-2">LOG OUT</button></div>
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
                                <label class="form-label">Nama Hewan</label>
                                <input type="text" name="name" id="name" class="form-control" />
                                <span id="name_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Taxonomy</label>
                                <input type="text" name="taxonomy" id="taxonomy" class="form-control" />
                                <span id="taxonomy_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                    <input type="text" name="status" id="status" class="form-control" />
                                    <span id="status_error" class="text-danger"></span>
                                </div>
                            <div class="mb-3">
                                <label class="form-label">Population</label>
                                <input type="text" name="population" id="population" class="form-control" />
                                <span id="population_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Habitat</label>
                                <input type="text" name="habitat" id="habitat" class="form-control" />
                                <span id="habitat_error" class="text-danger"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Location</label>
                                <input type="text" name="location" id="location" class="form-control" />
                                <span id="location_error" class="text-danger"></span>
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
    <script>
        $(document).ready(function() {
            showAll();
            $('#add_data').click(function(){

                $('#dynamic_modal_title').text('Add Data Hewan');

                $('#sample_form')[0].reset();

                $('#action').val('Add');

                $('#action_button').text('Add');

                $('.text-danger').text('');

                $('#action_modal').modal('show');

            });

            $('#sample_form').on('submit', function(event){

                event.preventDefault();
                
                if($('#action').val() == "Add"){
                    var formData = {
                        'name'          : $('#name').val(),
                        'taxonomy'         : $('#taxonomy').val(),
                        'status'           : $('#status').val(),
                        'population'    : $('#population').val(),
                        'habitat'        : $('#habitat').val(),
                        'location'        : $('#location').val()
                    }
                    $.ajax({
                        url:"http://localhost/api_praktikum1/api/animal/create.php",
                        method:"POST",
                        data: JSON.stringify(formData),
                        success:function(data){
                            $('#action_button').attr('disabled', false);
                            $('#message').html('<div class="alert alert-success">'+data.message+'</div>');
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
                        'id'            : $('#id').val(),
                        'name'          : $('#name').val(),
                        'taxonomy'         : $('#taxonomy').val(),
                        'status'           : $('#status').val(),
                        'population'    : $('#population').val(),
                        'habitat'        : $('#habitat').val(),
                        'location'        : $('#location').val()
                    }
                    $.ajax({
                        url:"http://localhost/api_praktikum1/api/animal/update.php",
                        method:"PUT",
                        data: JSON.stringify(formData),
                        success:function(data){
                            $('#action_button').attr('disabled', false);
                            $('#message').html('<div class="alert alert-success">'+data.message+'</div>');
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
                    url: "http://localhost/api_praktikum1/api/animal/read.php",
                    success: function(response) { 
                        // console.log(response);
                        var json = response.body;
                        
                        var dataSet=[];
                        for (var i = 0; i < json.length; i++) {
                            var sub_array = {
                                'name' : json[i].name,
                                'taxonomy' : json[i].taxonomy,
                                'status' : json[i].status,
                                'population' : json[i].population,
                                'habitat' : json[i].habitat,
                                'location' : json[i].location,
                                'action' : '<button onclick="showOne(' + json[i].id + ')" class="btn btn-sm btn-success py-2 px-2 mx-2"><i class="fas fa-edit"></i>Edit</button>' +
                                '<button onclick="deleteOne(' + json[i].id + ')" class="btn btn-sm btn-danger py-2 px-2"><i class="fas fa-trash"></i>Delete</button>' 
                            };
                            dataSet.push(sub_array);
                        }
                        $('#sample_data').DataTable({
                            data: dataSet,
                            columns : [
                                { data : "name" },
                                { data : "taxonomy" },
                                { data : "status" },
                                { data : "population" },
                                { data : "habitat" },
                                { data : "location" },
                                { data : "action" }
                            ]
                        });
                    },
                    error: function(err) {
                        console.log(err);
                    }
            });
        } 
        function showOne(id) {
            $('#dynamic_modal_title').text('Edit Data Hewan');

            $('#sample_form')[0].reset();

            $('#action').val('Update');

            $('#action_button').text('Update');

            $('.text-danger').text('');

            $('#action_modal').modal('show');

            $.ajax({
                    type: "GET",
                    contentType: "application/json",
                    url: "http://localhost/api_praktikum1/api/animal/read.php?id="+id,
                    success: function(response) { 
                        $('#id').val(response.id);
                        $('#name').val(response.name);
                        $('#taxonomy').val(response.taxonomy);
                        $('#status').val(response.status);
                        $('#population').val(response.population);
                        $('#habitat').val(response.habitat);
                        $('#location').val(response.location);

                        
                    },
                    error: function(err) {
                        console.log(err);
                    }
            });


        }
        function deleteOne(id) {
            if (confirm('Yakin untuk hapus data?')) {
            $.ajax({
                url:"http://localhost/api_praktikum1/api/animal/delete.php",
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
                }
            });
        }
    }
    </script>
    </body>
</html>