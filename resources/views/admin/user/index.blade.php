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
        <h1 class="mt-4">User</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">User</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex bd-highlight">
                    <div class="me-auto bd-highlight">
                        <i class="fas fa-table me-1"></i>
                        User List
                    </div>
                    <div class="bd-highlight">
                        <button type="button" class="btn btn-primary btn-sm" onClick="openmodel()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <!-- Modal -->
               @include('admin.user.form')
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>First Name</th>
                            <th>Address</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="user_details">
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    let user_details = document.getElementById('user_details');
    let myModal = new bootstrap.Modal(document.getElementById("myModal"), {});

    // input filed
    let select_role = document.getElementById("select_role");
    let firstName = document.getElementById('firstName');
    let lastName = document.getElementById('lastName');
    let address = document.getElementById('address');
    let Gender =document.querySelectorAll('.Gender');
    let email = document.getElementById('email');
    let phoneNumber = document.getElementById('phoneNumber');
    let password = document.getElementById('password');

   
    let user_id='';
    let user_data ="";

    window.onload=function() {  
        recall();  
    }

    function recall()  
    {
        axios.get('/user/user_list')
        .then(function (response) {
        let user_list = response.data.user_list; 
            user_data = user_list;
            reload();
        })
    }

    function reload()
    {
        user_details.innerHTML = "";

        user_data.forEach(element => {
        user_details.innerHTML += 
        `<tr>
            <td>${element.firstName}</td>
            <td>${element.address}</td>
            <td>${element.Gender}</td>
            <td>${element.email}</td>
            <td>${element.phoneNumber}</td>
            <td>
                <span class="badge bg-secondary" style="margin-right: 10px;">
                ${element.role.name} </span>
            </td>
            <td>
                <button class="btn btn-success btn-sm" onclick="openmodel(${element.id})"><i class="fa fa-edit"></i></button>
                <button class="btn btn-danger btn-sm" onclick="remove(${element.id})"><i class="fa fa-trash"></i></button>
            </td>
            </tr>`   
        });
    }

    function openmodel(id = '') 
    {
        errorReset();

        if(id !== '')
        {
            axios.get(`/user/user-edit/${id}`)
            .then(function (response) {
                let data = response.data.details;
                user_id = data.id;
                firstName.value = data.firstName;
                lastName.value = data.lastName;
                address.value = data.address;
                Gender.forEach(function(ele){
                    if(ele.value == data.Gender )
                    {
                        ele.checked = true  
                    }
                })
                email.value = data.email;
                phoneNumber.value = data.phoneNumber;
                password.value = data.password;
                select_role.value = data.role_id;

                title_text.innerHTML=`${data.firstName} :-Update`;
                button_text.innerHTML='Update';
            })
        }
        else
        {
            reset();
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
        errorReset();
        gender_value= "";
        for(var i = 0; i < Gender.length; i++){
          if(Gender[i].checked){
            gender_value = Gender[i].value;
           }
        }
      
      axios.post('/user/user-data',{
        'id' : user_id,
        'firstname' : firstName.value,    
        'lastname' : lastName.value,    
        'Address' : address.value, 
        'gender' : gender_value,    
        'Email' : email.value,    
        'phonenumber' : phoneNumber.value,  
        'Password' : password.value, 
        'select_name'  : select_role.value,   
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
                axios.post('/user/delete-user',{ 
                    'user_id' : id          
                })
                .then(function (response) {
                let data_item = response.data.data; 
                    recall();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: `${data_item.firstName} delete successfully`,
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
                        text: 'Sorry somthing have a Rong!',
                        timer: 1500
                    }) 
                })   
            }
        })
    }

    function reset()
    {
        user_id ='';
        firstName.value ='';
        lastName.value ='';
        address.value ='';
        Gender.value ='';
        email.value ='';
        phoneNumber.value ='';
        password.value ='';
    }

    function errorReset()
    {
        let all_error = document.querySelectorAll('.err_msg');

        all_error.forEach(function(element){
          element.innerHTML = ""
        })
    }

</script>
@endsection