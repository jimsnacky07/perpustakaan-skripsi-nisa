@extends('layouts.main')

@section('content')
    <form class="navbar-search mb-3" action="{{ route('daftarbuku.index') }}" method="GET">
        <div class="input-group">
            <input type="search" name="search" class="form-control bg-light border-1 small" placeholder="Cari Judul Buku"
                aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>

    <div class="card container-fluid mb-3">

        <div class="row d-flex flex-wrap justify-content-center">

            @forelse ($buku as $item)
                <div class="col-auto my-2" style="width:18rem;">
                    <div class="card mx-2 my-2" style="min-height:28rem;">
                        @if ($item->gambar != null)
                            <img class="card-img-top" style="max-height:180px;"
                                src="{{ Storage::url('public/buku/' . $item->gambar) }}">
                        @else
                            <img class="card-img-top" style="height:200px;"
                                src="{{ asset('adminlte/dist/img/noImage.jpg') }}">
                        @endif
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div class="detai-buku">
                                <p class="cart-text m-0">Judul Buku : {{ $item->judul_buku }}</p>
                                <p class="cart-text m-0">No ISBN Buku : {{ $item->no_isbn }}</p>
                                <p class="cart-text m-0">Tahun Terbit : {{ $item->tahun_terbit }}</p>
                                <p class="card-text m-0">Pengarang : <a href="#"
                                        style="text-decoration: none;">{{ $item->pengarang_buku }}</a></p>
                                <p class="card-text m-0">Kategori : {{ $item->kategoriBuku->name }}</p>
                                {{-- <p class="cart-text m-0">Stock Buku : {{ $item->jumlah_buku ?? $item->jumlah_buku = 0 ?? 'Stock Buku Habis'}}</p> --}}
                                <p class="cart-text m-0">
                                    @if ($item->jumlah_buku == 0)
                                        <span class="text-danger">Stock Buku Habis</span>
                                    @else
                                        Stock Buku: {{ $item->jumlah_buku }}
                                    @endif
                                </p>
                            </div>

                            <form action="{{ route('daftarbuku.store') }}" method="POST">
                                @csrf
                                @if ($item->jumlah_buku > 0)
                                    <div class="button-area">
                                        <input type="hidden" name="id_buku_pinjam[]" value="{{ $item->id }}">
                                        <input type="hidden" name="isbn_buku[]" value="{{ $item->no_isbn }}">
                                        <input type="hidden" name="judul_buku[]" value="{{ $item->judul_buku }}">
                                        <button
                                            onclick="return confirm('Apakah Kamu Yakin Ingin Meminjam Buku {{ $item->judul_buku }} ini?')"
                                            class="btn-sm btn-primary px-4" type="submit">
                                            Pinjam Buku
                                        </button>

                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <h1 class="text-primary mt-3">Tidak ada buku</h1>
            @endforelse

        </div>

        <div class="d-flex justify-content-between mx-2 my-2">
            <p class="text-primary my-2">Menampilkan {{ $buku->currentPage() }} dari {{ $buku->lastPage() }} Halaman</p>

            {{ $buku->links() }}
        </div>

    </div>
@endsection
