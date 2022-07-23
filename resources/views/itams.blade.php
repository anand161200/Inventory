@extends('dashbord')
@section('content')
<main>
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
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>Brand</th>
                            <th>Items</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="item_list">
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script type="text/javascript">

    let item_list=document.getElementById('item_list');
    let all_item='';

    axios.get('/item-list')
        .then(function (response) {
        let item_data=response.data.itam; 
            all_item=item_data;
            reload();
        });
    
    function reload()
    {
        Object.keys(all_item).forEach(function(key) {
            let table = `<tr>
                <td>${key}</td>
                <td>`;
                all_item[key].forEach(function(item) {
                    table += `<span class="badge bg-secondary" style="margin-right: 10px;">
                            ${item.name}
                        </span>`;
                });
            table +=`</td></tr>`;
            item_list.innerHTML += table;
        });
    }
            
</script>
@endsection