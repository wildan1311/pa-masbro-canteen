<x-master-layout>
    <div class="main-content">
        <div class="title">
            Menu Kategori
        </div>
        <div class="content-wrapper">
            <div class="card">
                <div class="card-header">
                    <h4>Menu Kategori</h4>
                    <div class="row">
                        <div class="col-12">
                            @can('create menu kategori')
                                <a class="btn btn-primary add" href="{{ route('menu-kategori.create') }}">Tambah</a>
                            @endcan
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($menus as $menu)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $menu->nama }}</td>
                                    <td>{{ $menu->kategori->nama ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('menu-kategori.edit', $menu->id) }}"
                                            class="btn btn-secondary">Edit</a>
                                        <form action="{{ route('menu-kategori.destroy', $menu->id) }}" class="d-inline"
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
