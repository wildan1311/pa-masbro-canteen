<x-master-layout>
    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4>Permission {{ $role->name }}</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Nama Permission</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($role->permissions as $permission)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        <a href="{{route('role.destroy.permission', [
                                            'id' => $role->id,
                                            'permission' => $permission->name,
                                        ])}}" class="btn btn-danger" type="submit">Hapus Permission</a>
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
