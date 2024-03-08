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
                    <h4>Tambah Menu</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('menu.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Name</label>
                                    <input type="text" placeholder="Input Here" class="form-control" id="basicInput"
                                        name="name">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Url Aplikasi</label>
                                    <input type="text" placeholder="Input Here" class="form-control" id="basicInput"
                                        name="url_aplikasi">
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Url Server</label>
                                    <input type="text" placeholder="Input Here" class="form-control" id="basicInput"
                                        name="url">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Category</label>
                                    <input type="text" placeholder="Input Here" class="form-control" id="basicInput"
                                        name="category">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">icon</label>
                                    <input type="text" placeholder="Input Here" class="form-control" id="basicInput"
                                        name="icon">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Device</label>
                                    <select name="device_id" class="form-control" id="">
                                        @foreach ($devices as $device)
                                            <option value="{{$device->id}}">{{$device->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="basicInput" class="form-label">Role Yang Bisa Akses</label>
                                    <select name="roles[]" id="role" class="form-control" multiple="multiple">
                                        @foreach ($roles as $role)
                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-12 mb-3">
                            <label for="">Permission</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="create"
                                    name="permissions[]">
                                <label class="form-check-label" for="inlineCheckbox1">Create</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="read"
                                    name="permissions[]">
                                <label class="form-check-label" for="inlineCheckbox2">Read</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="update"
                                    name="permissions[]">
                                <label class="form-check-label" for="inlineCheckbox2">Update</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="delete"
                                    name="permissions[]">
                                <label class="form-check-label" for="inlineCheckbox2">Delete</label>
                            </div>
                        </div>
                        <div class="col-4 float-right">
                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" id="basicInput" value="Simpan">
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
