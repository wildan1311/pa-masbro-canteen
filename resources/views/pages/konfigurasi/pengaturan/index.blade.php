<x-master-layout>
    <div class="main-content">
        <div class="title">
            Konfigurasi
        </div>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4>Pengaturan</h4>
                    <div class="row">
                        <div class="col-12">
                            @can('create pengaturan')
                                <a class="btn btn-primary add" href="{{ route('pengaturan.create') }}">Tambah</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nilai</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($pengaturan as $pg)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pg->nama }}</td>
                                    <td>{{ $pg->nilai ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('pengaturan.edit', $pg->id) }}"
                                            class="btn btn-secondary">Edit</a>
                                        <form action="{{ route('pengaturan.destroy', $pg->id) }}" class="d-inline"
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
    @endpush

</x-master-layout>
