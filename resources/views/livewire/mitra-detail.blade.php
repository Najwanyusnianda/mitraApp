<div>
    {{-- Stop trying to control. --}}
    <section>
        <h4>{{ $name }}</h4>
    </section>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Kegiatan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profil</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item " aria-current="page">Kegiatan Survei atau Sensus yang sedang diikuti</li>
                </ol>
            </nav>

            @if (!empty($check_mitra_exist ))
            @foreach ($check_mitra_exist as $kegiatan_now)
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <span class="status-icon bg-success"></span>
                    {{$kegiatan_now['nama_kegiatan']}}
                </div>
                <div class="col-sm 6">
      
                    {{ \Carbon\Carbon::parse($kegiatan_now['mulai'])->translatedFormat('d F Y')}} hingga {{ \Carbon\Carbon::parse($kegiatan_now['selesai'])->translatedFormat('d F Y')}}
                </div>
            </div>
            <hr class="mt-0 mb-2">
            @endforeach
            @else
            <div class="row align-items-center">
                <div class="col-sm-8">
                    Tidak ada kegiatan yang sedang diikuti
                </div>
               
            </div>
            @endif
            
            <br>
            <nav aria-label="breadcrumb mt-4">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item " aria-current="page">Kegiatan Survei atau Sensus yang pernah atau akan diikuti</li>
                </ol>
            </nav>
            @if (!empty($check_mitra_old_exist ))
            @foreach ($check_mitra_old_exist as $kegiatan_now)
            <div class="row align-items-center">
                <div class="col-sm-6">

                    @if (\Carbon\Carbon::parse($kegiatan_now['mulai']) < \Carbon\Carbon::now() )
                    <span class="status-icon bg-warning"></span>
                    @else
                    <span class="status-icon bg-info"></span>  
                    @endif
                    {{$kegiatan_now['nama_kegiatan']}}
                </div>
                <div class="col-sm 6">
      
                    {{ \Carbon\Carbon::parse($kegiatan_now['mulai'])->translatedFormat('d F Y')}} - {{ \Carbon\Carbon::parse($kegiatan_now['selesai'])->translatedFormat('d F Y')}}
                </div>
            </div>
            <hr class="mt-0 mb-2">
            @endforeach
            @else
            <div class="row align-items-center">
                <div class="col-sm-8">
                    tidak ada kegiatan yang pernah / akan diikuti
                </div>
                
            </div>
            @endif
        </div>

        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <section>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item " aria-current="page">Profil</li>
                    </ol>
                </nav>
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <label class="form-label">No.KTP
                        </label>
                    </div>
                    <div class="col-sm 6">
                        : {{ $nik }}
        
                    </div>
                </div>
                <hr class="mt-0 mb-2">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <label class="form-label">Jenis Kelamin
                        </label>
                    </div>
                    <div class="col-sm 6">
                       : {{ $jenis_kelamin }}
        
                    </div>
                </div>
            
                <hr class="mt-0 mb-2">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <label class="form-label">Tempat Tanggal lahir
                        </label>
                    </div>
                    <div class="col-sm 6">
                       : {{ \Carbon\Carbon::parse($tanggal_lahir)->format('d, M Y') }}
        
                    </div>
                </div>
            
                <hr class="mt-0 mb-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item " aria-current="page">Pendidikan</li>
                    </ol>
                </nav>
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <label class="form-label">Pendidikan
                        </label>
                    </div>
                    <div class="col-sm 6">
                       : {{ $pendidikan }}
        
                    </div>
                </div>
            
                <hr class="mt-0 mb-2">
        
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item " aria-current="page">Alamat</li>
                    </ol>
                </nav>
        
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <label class="form-label">Kecamatan:
                        </label>
                    </div>
                    <div class="col-sm 6">
                       : {{ $kecamatan }}
        
                    </div>
        
                </div>
        
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <label class="form-label">Rincian alamat:
                        </label>
                    </div>
                    <div class="col-sm 6">
                       : {{ $alamat }}
        
                    </div>
                </div>
            
                <hr class="mt-0 mb-2">
        
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item " aria-current="page">Kontak</li>
                    </ol>
                </nav>
        
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <label class="form-label">No. HP:
                        </label>
                    </div>
                    <div class="col-sm 6">
                       : {{ $phone }}
        
                    </div>
        
                </div>
        
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <label class="form-label">Email:
                        </label>
                    </div>
                    <div class="col-sm 6">
                       : {{ $email }}
        
                    </div>
                </div>
            
                <hr class="mt-0 mb-2">
        
        
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item " aria-current="page">Kualifikasi</li>
                    </ol>
                </nav>
        
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <label class="form-label">Kualifikasi Gadget:
                        </label>
                    </div>
                    <div class="col-sm 6">
                       : {{ $is_gadget ? 'Terpenuhi' : 'Tidak Terpenuhi' }}
        
                    </div>
        
                </div>
        
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <label class="form-label">Kepemilikan Kendaraan:
                        </label>
                    </div>
                    <div class="col-sm 6">
                       : {{ $is_kendaraan ? 'Terpenuhi' : 'Tidak Terpenuhi' }}
        
                    </div>
                </div>
            
                <hr class="mt-0 mb-2">
            </section>
        </div>
 
      </div>


        <div class="btn-list text-center">
            <button type="button" class="btn btn-secondary" wire:click="closeModalDetail()">Tutup</button>
          </div>

</div>
