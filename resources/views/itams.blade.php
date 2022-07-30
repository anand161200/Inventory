@extends('dashbord')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Items</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Item</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex bd-highlight">
                    <div class="me-auto bd-highlight">
                        <i class="fa fa-mobile me-1"></i>
                        Item List
                    </div>
                    <div class="bd-highlight">
                        <button type="button" class="btn btn-primary btn-sm" onClick="openmodel()"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel"      aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title_text"></h5>
                            <button type="button" class="btn-close" onClick="closemodel()" ></button>
                        </div>
                        <div class="modal-body p-4">
                            <form>
                                <select class="form-select"  id="brand_select" aria-label="Default select example">
                                    <option value="">select Item</option> 
                                    @foreach ($brand as $val)
                                    <option value="{{ $val->id}}">{{ $val->name}} </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="brand_id"></span>
                                <div class="mt-4">
                                    <button type="button" class="btn btn-success mb-2" onclick="addRow()">+</button>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">price</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col">action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="item_rows">
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" onClick="FromSubmit()" value="" class="btn btn-primary" id="button_text">Submit</button>
                        </div>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">


    let item_list=document.getElementById('item_list');
    let myModal = new bootstrap.Modal(document.getElementById("myModal"), {});
    let item_rows = document.getElementById("item_rows");

    let select_brand = document.getElementById("brand_select");
     // ERROR MSG
    let brandname_error=document.getElementById("brand_id")
    
    let all_item='';
    let counter=0;
    let result={};
    let error={};


    window.onload=function() {
        recall(); 
    }

    function recall()
    {
        axios.get('/item-list')
        .then(function (response) {
        let item_data=response.data.itam; 
            all_item=item_data;
            reload();
        });
    }
    
    function reload()
    {
        let brand_id ='';
        // console.log(@json($brand))
        item_list.innerHTML="";
        Object.keys(all_item).forEach(function(key) {
            let table = `<tr>
                <td>${key}</td>
                <td>`;
                    all_item[key].forEach(function(item) {
                        table += `<span class="badge bg-secondary" style="margin-right: 10px;">
                            ${item.name}
                            </span>`;
                            brand_id=item.brand_id
                    });
                table +=`</td>
                <td>
                    <button class="btn btn-success btn-sm" onclick="openmodel('${brand_id}')"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm" onclick="removeItemList('${brand_id}')"><i class="fa fa-trash"></i></button>
                </td>
            </tr>`;
            item_list.innerHTML += table;
       
        });
    }

    function openmodel( brand_id = '')
    {
        errorReset();
        reset();
        if(brand_id !== '')
        {
            axios.get(`/item-details/${brand_id}`)
            .then(function (response) {
            let item_data=response.data.details;
                item_data.forEach(function(data) {
                    select_brand.value = data.brand_id;
                    addRow(data);
                })     
            })
        }
        else
        {
            addRow();
        }
        myModal.show();
    }

    function closemodel() {
        myModal.hide();
    }

    function addRow(data = null)
    {
        if(data !== null)
        {
            item_rows.innerHTML +=
            `<tr class="table_raw" id="raw_${counter}" data-rawindex="${counter}">
                <td><input type="text" id="name[${counter}]" value="${data.name}" class="form-control">
                    <span class="text-danger err_msg" id="all_item.${counter}.item_name"></span>
                </td>
                <td><input type="text" id="price[${counter}]" value="${data.price}" class="form-control">
                    <span class="text-danger err_msg" id="all_item.${counter}.item_price"></span>
                </td>
                <td><input type="text" id="stock[${counter}]" value="${data.stock}" class="form-control">
                    <span class="text-danger err_msg" id="all_item.${counter}.item_stock"></span>
                </td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRaw(${counter})">x</button></td>
            </tr>
            <td><input type="hidden" id="id[${counter}]" value="${data.id}" class="form-control"></td>`
            counter++;
        }
        else{
            item_rows.innerHTML +=
            `<tr class="table_raw" id="raw_${counter}" data-rawindex="${counter}">
                <td><input type="text" id="name[${counter}]" class="form-control">
                    <span class="text-danger err_msg" id="all_item.${counter}.item_name"></span>
                </td>
                <td><input type="text" id="price[${counter}]" class="form-control">
                    <span class="text-danger err_msg" id="all_item.${counter}.item_price"></span>
                </td>
                <td><input type="text" id="stock[${counter}]"class="form-control">
                    <span class="text-danger err_msg" id="all_item.${counter}.item_stock"></span>
                </td>
                <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRaw(${counter})">x</button></td>
            </tr>
            <td><input type="hidden" id="id[${counter}]" value="" class="form-control"></td>`
            counter++;
        }
    }

    function removeRaw(counter_number)
    { 
       document.getElementById(`raw_${counter_number}`).remove();
    }

    function errorReset()
    {
        brandname_error.innerHTML='';
        let all_error=document.querySelectorAll('.err_msg');

        all_error.forEach(function(element){
            element.innerHTML = ""
        })
    }

    function reset()
    {
        item_rows.innerHTML ='';
        select_brand.value='';
        counter=0;
        result={};
    }

    function FromSubmit()
    {
        errorReset();
    
        let table_raws= document.querySelectorAll('.table_raw');
        result={};

        table_raws.forEach(function(raw) {
        
        let id= document.getElementById(`id[${raw.dataset.rawindex}]`);
        let name= document.getElementById(`name[${raw.dataset.rawindex}]`);
        let price= document.getElementById(`price[${raw.dataset.rawindex}]`);
        let stock= document.getElementById(`stock[${raw.dataset.rawindex}]`);

            result[raw.dataset.rawindex] = {
                'item_id' : id.value,
                'item_name' : name.value,
                'item_price':price.value,
                'item_stock' :stock.value 
            }
        });

        axios.post('/store-data',{
            'brand_id':select_brand.value,
            'all_item': result,
        })
        .then(function (response) {
            closemodel();
            recall();
        })
        .catch(function (error) {
            error = error.response.data.errors;
            Object.keys(error).forEach(function(key) {
                document.getElementById(key).innerHTML=error[key];
            }); 
        })     
     }

    function removeItemList(brand_id)
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
                    axios.get(`/item-delete/${brand_id}`)
                    .then(function (response) {
                    recall();
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: ' delete successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })       
                })  
            }
        })
    }
           
</script>
@endsection