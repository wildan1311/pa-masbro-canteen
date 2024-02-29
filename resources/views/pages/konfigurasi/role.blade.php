<x-master-layout>
    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4>Role</h4>
                    <div class="row">
                        <div class="col-12">
                            {{-- @can('create konfigurasi/menu') --}}
                                <a class="btn btn-primary add" href="{{route('role.create')}}">Tambah</a>
                            {{-- @endcan --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                            <th>No</th>
                            <th>Nama Role</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>
                                        @foreach ($role->permissions as $permission)
                                            <span class="btn btn-sm btn-primary m-1">{{$permission->name}}</span> <br>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{route('role.show', $role->id)}}" class="btn btn-primary">Lihat Permission</a>
                                        <a href="{{route('role.edit', $role->id)}}" class="btn btn-secondary">Edit</a>
                                        <form action="{{route('role.destroy', $role->id)}}" class="d-inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @push('js')
        {{-- {!! $dataTable->scripts() !!}

        <script>
            $('.add').on('click', function(e){
                e.preventDefault();

                $.ajax({
                    url: this.href,
                    method: 'get',
                    success: function (response) {
                        const modal = $('#modal_action').html(response);
                        modal.modal('show');

                        $('#form_action').on('submit', function(e){
                            e.preventDefault();
                            console.log(this);

                            $.ajax({
                                url: this.action,
                                method: this.method,
                                data: new FormData(this),
                                contentType: false,
                                processData: false,
                                success: function(response){
                                    $('#modal_action').modal('hide');
                                    window.location.reload();
                                },
                                error: function(err){
                                    const errors = err.responseJSON?.errors;

                                    if (errors){
                                        for(let [key, message] of Object.entries(errors)){
                                            $(`[name=${key}]`).addClass('is-invalid').parent().append(`<div class="invalid-feedback"> ${message} </div>`);
                                        }
                                    }
                                }
                            })
                        })
                    },
                    error: function(){

                    }
                })
            });
        </script> --}}
    @endpush

</x-master-layout>
