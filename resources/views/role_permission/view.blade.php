<div class="modal fade" id="view_modal" tabindex="-1" aria-labelledby="exampleModalLabel"      aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="role_text"></h5>
                <button type="button" class="btn-close" onClick="closemodel()" ></button>
            </div>
                {{-- @dump($permissions) --}}
            <div class="modal-body p-4">
                <table class="table table-bordered">
                    <thead class="bg-light">
                        <tr>
                            <th>permission</th>
                            <th> Has permission</th>
                        </tr>
                    </thead>
                    <tbody id="permissions">
                        {{-- @foreach ($permissions as  $data)
                            <tr>
                                <td>{{$data->permission}}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>