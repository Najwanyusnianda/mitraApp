<div>
    {{-- Stop trying to control. --}}
    <section>
        <h4>{{ $name }}</h4>
    </section>
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


        <div class="btn-list text-center">

    
            <button type="button" class="btn btn-secondary" wire:click="closeModalDetail()">Tutup</button>
    
            
          </div>

</div>
