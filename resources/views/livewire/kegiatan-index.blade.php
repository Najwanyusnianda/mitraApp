<div>
  <section>
    <div class="card">

      <div class="card-body">
        <ul class="nav nav-pills nav-stacked">
          <li class="nav-item">
            <button class="nav-link btn btn-info">Tambah Kegiatan</button>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link btn btn-info">Daftar Kegiatan</a>
          </li>

        </ul>
      </div>
    </div>

  </section>
    <section>
        <div class="container">
            @foreach ($kegiatans as $kegiatan)

            <div class="row-lg-8">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                        <span class="badge {{$kegiatan->is_active ? 'badge-success' : 'badge-danger' }} badge-sm">{{$kegiatan->is_active ? 'aktif' : 'tidak aktif' }} </span>
                         {{$kegiatan->nama_kegiatan }}
                    </h3>
                    <div class="card-options">
                      <a href="#" class="btn btn-primary btn-sm">Detail</a>
                      @if ($kegiatan->is_active)
                      <a href="#" class="btn btn-secondary btn-sm ml-2"> Tambah Petugas</a>
                      @else
                          
                      @endif
                      
                    </div>
                  </div>
                  <div class="card-body">
                    {{$kegiatan->deskripsi}}
                  </div>
                </div>
            </div>
            @endforeach
            {{$kegiatans->links()}}
        </div>
    </section>


</div>
