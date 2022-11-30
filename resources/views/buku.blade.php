@extends('layouts.app')
@section('content')
    <h2 class="text-center">Buku</h2>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Add New</button>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ISBN</th>
                <th scope="col">Judul</th>
                <th scope="col">Sinopsis</th>
                <th scope="col">Penerbit</th>
                <th scope="col">Cover</th>
                <th scope="col">Kategori</th>
                <th scope="col">Petugas</th>
                <th scope="col" colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $buku)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $buku->isbn }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->sinopsis }}</td>
                    <td>{{ $buku->penerbit }}</td>
                    <td><img src="{{ asset('storage/'.$buku->cover) }}" alt="" width="70px"></td>
                    <td>{{ $buku->kategori->nama_kategori }}</td>
                    <td>{{ $buku->users_id }}</td>
                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit{{$buku->id}}">Edit</button></td>
                    <td><a href="{{url('delbuk/'.$buku->id)}}"><button type="button" class="btn btn-primary">Delete</button></a></td>
                </tr>
                {{-- EDIT --}}
                <div class="modal fade" id="edit{{$buku->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title fs-5" id="exampleModalLabel">Update</h3>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('buku.update',$buku->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="mb-3">
                                        <label class="form-label">ISBN</label>
                                        <input type="text" class="form-control" name="isbn" value="{{$buku->isbn}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Judul</label>
                                        <input type="text" class="form-control" name="judul" value="{{$buku->judul}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Sinopsis</label>
                                        <input type="text" class="form-control" name="sinopsis" value="{{$buku->sinopsis}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Penerbit</label>
                                        <input type="text" class="form-control" name="penerbit" value="{{$buku->penerbit}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Cover</label>
                                        <img src="{{asset('storage/'.$buku->cover)}}" alt="" width="300px">
                                        <input type="file" class="form-control" name="cover">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <select class="form-control" name="kategori_id">
                                            <option value="" >Pilih Kategori</option>
                                            @foreach ($data2 as $item)
                                            <option value="{{ $item->id }}" @selected($buku->kategori_id==$item->id) >{{ $item->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Petugas</label>
                                        <input type="number" class="form-control" name="users_id" value="{{Auth::User()->id}}" readonly>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- END --}}
            @endforeach
        </tbody>
    </table>
@endsection


<div class="modal fade" id="tambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="exampleModalLabel">Add New</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('buku.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">ISBN</label>
                        <input type="text" class="form-control" name="isbn" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" class="form-control" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sinopsis</label>
                        <input type="text" class="form-control" name="sinopsis" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cover</label>
                        <input type="file" class="form-control" name="cover" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select" name="kategori_id">
                            <option selected disabled>Pilih Kategori</option>
                            @foreach ($data2 as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Petugas</label>
                        <input type="number" class="form-control" name="users_id" value="{{Auth::User()->id}}" readonly>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
