<x-master-layout>
    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4>Menu</h4>
                    <div class="row">
                        <div class="col-12">
                            @can('create menu')
                                <a class="btn btn-primary add" href="{{route('menu.create')}}">Tambah</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Url Mobile</th>
                            <th>Url Server</th>
                            <th>Category</th>
                            <th>Icon</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($menu as $mm)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$mm->name}}</td>
                                    <td>{{$mm->url_aplikasi ?? '-'}}</td>
                                    <td>{{$mm->url_server}}</td>
                                    <td>{{$mm->category}}</td>
                                    <td>{{$mm->icon}}</td>
                                    <td>
                                        <a href="{{route('menu.show', $mm->id)}}" class="btn btn-primary">Lihat Permission</a>
                                        <a href="{{route('menu.edit', $mm->id)}}" class="btn btn-secondary">Edit</a>
                                        <form action="{{route('menu.destroy', $mm->id)}}" class="d-inline" method="POST">
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
