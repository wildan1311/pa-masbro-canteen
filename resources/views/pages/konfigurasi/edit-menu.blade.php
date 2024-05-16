<x-master-layout>
    @push('cssLibrary')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Menu - Permissions</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('menu.update', $menu->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Name</label>
                                <input type="text" placeholder="Input Here" class="form-control" id="basicInput"
                                    name="name" required value="{{ $menu->nama }}">
                            </div>
                            {{-- <div class="mb-3">
                                <label for="basicInput" class="form-label">URL Aplikasi</label>
                                <input type="text" placeholder="Input Here" class="form-control" id="basicInput"
                                    name="url_aplikasi" value="{{ $menu->url_aplikasi }}">
                            </div> --}}
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">URL Server</label>
                                <input type="text" placeholder="Input Here" class="form-control" id="basicInput"
                                    name="url" value="{{ $menu->url }}">
                            </div>
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Category</label>
                                <input type="text" placeholder="Input Here" class="form-control" id="basicInput"
                                    name="category" required value="{{ $menu->kategori }}">
                            </div>
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Icon</label>
                                <input type="text" placeholder="Input Here" class="form-control" id="basicInput"
                                    name="icon" value="{{ $menu->ikon }}">
                            </div>
                            <div class="mb-3">
                                <label for="basicInput" class="form-label">Device</label>
                                <select name="device_id[]" class="form-control" id="" multiple="multiple">
                                    @foreach ($devices as $device)
                                        <option value="{{ $device->id }}" {{in_array($device->id, $menu->device->pluck('id')->toArray()) ? 'selected' : ''}}>{{ $device->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Permission</label><br>
                                @foreach (['create', 'read', 'update', 'delete'] as $item)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1"
                                            value="{{ $item }}" name="permissions[]"
                                            {{ $menu->permissions->where('name', "{$item} {$menu->nama}")->first() != null ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="inlineCheckbox1">{{ $item }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-4 float-right">
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" id="basicInput" value="Edit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    @push('jsLibrary')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @endpush

    @push('js')
        <script>
            $('select').select2();
        </script>
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
