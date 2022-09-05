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
        <h1 class="mt-4">Role</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">permission</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex bd-highlight">
                    <div class="me-auto bd-highlight">
                        <i class="fas fa-table me-1"></i>
                        permission List
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>Permission</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody id="permission_raw">
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

        axios.get('/checkPermission')
        .then(function(response){
            permission_raw.innerHTML = '';
            all_permission = response.data.all_permission;

            all_permission.forEach(function(data, index){
                permission_raw.innerHTML += 
                `<tr>
                    <td>${data.permission}</td>
                </tr>`;
            })
        })

</script>
@endsection