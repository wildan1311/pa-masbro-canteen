<x-master-layout>
    <div class="main-content">
        <div class="title">
            Pembayaran
        </div>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4>Tenant</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Nama Tenant</th>
                            <th>Biaya</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @forelse($tenants as $tenant)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tenant->nama_tenant }}</td>
                                    <td>Rp.{{ number_format($tenant->biaya, 2, ',','.') }}</td>
                                    <td>
                                        @php
                                            $transaksiDetailIds = explode(',', $tenant->transaksi_detail_ids);
                                        @endphp
                                        <form action="{{ route('pembayaran.transfer') }}" class="d-inline"
                                            method="POST">
                                            @csrf
                                            @foreach ($transaksiDetailIds as $id)
                                                <input type="hidden" name="ids[]" value="{{ $id }}">
                                            @endforeach
                                            <button type="submit" class="btn btn-primary">Transfer</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak Ada Pembayaran Yang Perlu Dilakukan</td>
                                </tr>
                            @endforelse ($tenants as $tenant)
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
