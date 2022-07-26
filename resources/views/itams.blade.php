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
                        <i class="fas fa-table me-1"></i>
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
                                <div class="mt-4">
                                    <button type="button" class="btn btn-success mb-2" onclick="addRow()">+</button>
                                    <table class="table text-center table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">price</th>
                                                <th scope="col">Stock</th>
                                                <th scope="col">action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="add_row">
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">

    let item_list=document.getElementById('item_list');
    let myModal = new bootstrap.Modal(document.getElementById("myModal"), {});
    let add_inputfield = document.getElementById("add_row");

    let select_brand = document.getElementById("brand_select");
    let all_item='';
    let counter=0;
    let result=[];


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
                });
            table +=`</td>
                <td>
                    <button class="btn btn-success btn-sm"onclick="openmodel()"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger btn-sm"onclick="remove()"><i class="fa fa-trash"></i></button>
                </td>
            </tr>`;
            item_list.innerHTML += table;
        });
    }

    function openmodel()
    {
        myModal.show();
        reset();
    }

    function closemodel(){
        myModal.hide();
    }

    function addRow()
    {
        add_inputfield.innerHTML +=
        `<tr class="table_raw" data-rawindex="${counter}">
            <td><input type="text" id="name[${counter}]" class="form-control"></td>
            <td><input type="text" id="price[${counter}]" class="form-control"></td>
            <td><input type="text" id="stock[${counter}]"class="form-control"></td>
            <td><button class="btn btn-danger btn-sm">x</button></td>
        </tr>`
        counter++;
    }

    function reset()
    {
        add_inputfield.innerHTML ='';
        select_brand.value='';
        name.value='';
        price.value='';
        stock.value='';
        result='';
    }

    function FromSubmit()
    {
        let table_raws= document.querySelectorAll('.table_raw');

        table_raws.forEach(function(raw) {
    
        let name= document.getElementById(`name[${raw.dataset.rawindex}]`);
        let price= document.getElementById(`price[${raw.dataset.rawindex}]`);
        let stock= document.getElementById(`stock[${raw.dataset.rawindex}]`);

            result.push({
            'item_select':select_brand.value,
            'item_name' : name.value,
            'item_price':price.value,
            'item_stock' :stock.value 
            })

        });

        axios.post('/store-data',{
         'all_item': result 
        })
        .then(function (response) {
            closemodel();
            recall();
        })

    }
        
            
</script>
@endsection