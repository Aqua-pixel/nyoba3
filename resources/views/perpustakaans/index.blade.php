    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My App</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <div id="app">
        <div class="main-wrapper">
            <div class="container-fluid">
            <div class="container-fluid">
                <div class="card mt-5">
                <div class="card-header">
                    <h3>PERPUS</h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    <p>
                    <a class="btn btn-primary" href="{{ route('Perpustakaans.create') }}">NEW Record</a>
                    </p>
                    <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>judul</th>
                        <th>penulis</th>
                        <th>gambar</th>
                        <th>Price</th>
                        <th>jumlah</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $counter = 1;
                        @endphp
                        @forelse ($Perpustakaans as $perpustakaan)
                        <tr>
                            <td>{{ $counter++ }}</td>
                            <td>{{ $perpustakaan->id }}</td>
                            <td>{{ $perpustakaan->judul }}</td>
                            <td>{{ $perpustakaan->penulis }}</td>
                            <td><img src="{{ asset('storage/storage/'.$perpustakaan->gambar)}}" alt="{{ $perpustakaan->judul }}" style="max-width: 100px;"></td>
                            <td>{{ $perpustakaan->price }}</td>
                            <td>{{ $perpustakaan->jumlah }}</td>
                            <td>
                            <a href="{{ route('Perpustakaans.edit', ['id' => $perpustakaan->id]) }}" class="btn btn-secondary btn-sm">edit</a>
                            <a href="#" class="btn btn-sm btn-danger" onclick="
                                event.preventDefault();
                                if (confirm('Do you want to remove this?')) {
                                document.getElementById('delete-row-{{ $perpustakaan->id }}').submit();
                                }">
                                delete
                            </a>
                            <a href="{{ route('Perpustakaans.show', ['id' => $perpustakaan->id]) }}" class="btn btn-info btn-sm">Show</a>
                            <form id="delete-row-{{ $perpustakaan->id }}" action="{{ route('perpustakaans.destroy', ['id' => $perpustakaan->id]) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <form action="{{ route('Perpustakaans.index') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                            </form>
                            
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                No record found!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </body>
    </html>