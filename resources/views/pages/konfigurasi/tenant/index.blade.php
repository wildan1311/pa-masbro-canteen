<x-master-layout>
    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4>tenant</h4>
                    <div class="row">
                        <div class="col-12">
                            @can('create tenant')
                                <a class="btn btn-primary add" href="{{ route('tenant.create') }}">Tambah</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Nama Tenant</th>
                            <th>Kavling</th>
                            <th>Jam Buka</th>
                            <th>Jam Tutup</th>
                            <th>Pemilik</th>
                            <th>Gambar</th>
                            <th>isOpen</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($tenants as $tenant)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tenant->nama_tenant }}</td>
                                    <td>{{ $tenant->nama_kavling ?? '-' }}</td>
                                    <td>{{ $tenant->jam_buka }}</td>
                                    <td>{{ $tenant->jam_tutup }}</td>
                                    <td>{{ $tenant->pemilik->name }}</td>
                                    <td>
                                        <img src="{{ $tenant->gambar }}" alt="" class="img-fluid"
                                            width="20px">
                                    </td>
                                    <td>{{ $tenant->is_open }}</td>
                                    <td>
                                        <a href="{{ route('tenant.edit', $tenant->id) }}"
                                            class="btn btn-secondary">Edit</a>
                                        <form action="{{ route('tenant.destroy', $tenant->id) }}" class="d-inline"
                                            method="POST">
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
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', 'Error');
            @endforeach
        @endif
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
