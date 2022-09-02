@extends('dashbord')
@section('content')
<main>
    <style>
        .error {
        color: #F00;
        background-color: #FFF;
        }
    </style>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Brands</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Brand</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex bd-highlight">
                    <div class="me-auto bd-highlight">
                        <i class="fas fa-table me-1"></i>
                        Brand List
                    </div>
                    <div class="bd-highlight">
                        <button type="button" class="btn btn-primary btn-sm" onClick="openmodel()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"      aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="title_text"></h5>
                                <button type="button" class="btn-close" onClick="closemodel()" ></button>
                            </div>
                            <div class="modal-body p-4">
                                <form id="frm">
                                    <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" id="name" name="name" class="form-control">
                                    <span class="text-danger" id="brand"></span>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                                <button type="submit" onClick="FromSubmit()" value="" class="btn btn-primary" id="button_text"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="brand_list">
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</main>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript">

        let brand_list = document.getElementById('brand_list');
        let myModal = new bootstrap.Modal(document.getElementById("myModal"), {});
        let brand_name = document.getElementById('name');
        let name_error = document.getElementById('brand');

        // Title tax
        let title_text = document.getElementById('title_text');
        let button_text = document.getElementById('button_text');
        let all_brand='';
        let brand_id='';
        let error={};


        window.onload=function() {
            recall();  
        }

        let validation = $('#frm').validate({
            errorClass: 'error',
            rules:{
                name: {
                   'required':true
                }
            },
            messages:{
                name: {
                    'required'  :'Please Enter your name'
                }
            }
        });

        function recall()
        {
            axios.get('/brand_list')
            .then(function (response) {
            let brand_data = response.data.brand; 
                all_brand = brand_data;
                reload();
            })
        }

        function reload()
        {
            brand_list.innerHTML = "";

            all_brand.forEach(element => {
            brand_list.innerHTML += 
            `<tr>
                <td>${element.name}</td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="openmodel(${element.id})"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="remove(${element.id})"><i class="fa fa-trash"></i></button>
                </td>
             </tr>`   
            });
        }
        
        function openmodel(id = '')
        {
            name_error.innerHTML ='';
            if(id !== '')
            {
                axios.get(`/role-edit/${id}`)
                .then(function (response) {
                    let data = response.data.details;
                    brand_name.value = data.name;
                    brand_id = data.id;
                    title_text.innerHTML=`${data.name} :-Update`;
                    button_text.innerHTML='Update';
                })
            }
            else
            {
                brand_id ='';
                brand_name.value ='';
                title_text.innerHTML = "ADD";
                button_text.innerHTML = 'Submit';
            }
            myModal.show();
        }

        function closemodel() {
            myModal.hide();
        }

        function FromSubmit()
        { 
            //console.log(brand_id);
            if(validation.form())
            {
                axios.post('/brand-data',{
                'id' : brand_id,
                'brand' : brand_name.value,    
                })
                .then(function (response) {
                    closemodel();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: `Your work has been saved`,
                        showConfirmButton: false,
                        timer: 1500
                    }) 
                    recall();
                })
                .catch(function (error) {
                    error = error.response.data.errors;
                    Object.keys(error).forEach(function(key) { 
                        document.getElementById(key).innerHTML = error[key]; 
                    }); 
                })  
            }   
        }

        function remove(id)
        {

            Swal.fire({
                title: 'Are you sure want to delete ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('/delete_brand',{ 
                        'brand_id' : id          
                    })
                    .then(function (response) {
                    let data_item = response.data.data; 
                        recall();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: `${data_item.name} delete successfully`,
                            showConfirmButton: false,
                            timer: 1500
                        })       
                    }) 
                    .catch(function (error) { 
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: ' Oops',
                            showConfirmButton: false,
                            text: 'This Brand is used in item!',
                            timer: 1500
                        }) 
                    })   
                }
            })
        }
    </script>  
@endsection