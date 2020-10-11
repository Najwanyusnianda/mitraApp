<div>


    <h4 class="text-center">Tambah Mitra Baru : {{ $kegiatan_id }}</h4>
    <hr>
    <!--form tambah mitra baru-->

    <form wire:submit.prevent="store" autocomplete="off">
      @if ($step==1)
      <section>
        <div class="row">
          <div class="col-sm-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item " aria-current="page">Identitas Pribadi</li>
              </ol>
            </nav>
          </div>
         
        </div>
        <div class="row align-items-center">
            <div class="col-sm-6">
                <label class="form-label"><span class="mr-4">1.</span>Nama Lengkap (Sesuai KTP)
                </label>
            </div>
            <div class="col-sm 6">
                <div class="form-group mb-2 ml-5">
                    <input wire:model="name" type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror" placeholder="Nama"
                        aria-describedby="userId">
                    @if(!empty($users))
                        <div class="position-absolute  w-100 list-group bg-white shadow-lg row" id="user-list"
                            style="z-index: 1000">
                            @foreach($users as $user)
                                <button type="button" class="list-group-item list-group-item-action"
                                    wire:click="fillUserForm({{ $user['id'] }})">{{ $user['name'] }}</button>
                            @endforeach
                        </div>
                    @endif
                    @error('name')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

            </div>
        </div>
        <hr class="mt-0 mb-2">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <label class="form-label"><span class="mr-4">2.</span>Nomor NIK (Sesuai E-KTP/SUKET)
                </label>
            </div>
            <div class="col-sm 6">
                <div class="form-group mb-2 ml-5">
                    <input wire:model="nik" type="text" name="nik" id="nik"
                        class="form-control @error('nik') is-invalid @enderror" placeholder="NIK"
                        aria-describedby="helpId">
                    @error('nik')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

            </div>
        </div>
        <hr class="mt-0 mb-2">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <label class="form-label"><span class="mr-4">3.</span>Nomor NPWP [*Jika Ada]
                </label>
            </div>
            <div class="col-sm 6">
                <div class="form-group mb-2 ml-5">
                    <input wire:model="npwp" type="text" name="npwp" id="npwp"
                        class="form-control @error('npwp') is-invalid @enderror" placeholder="Nomor NPWP">
                    @error('npwp')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

            </div>
        </div>
        <hr class="mt-0 mb-2">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="form-label"><span class="mr-4">4.</span>Alamat Domisili Saat Ini</label>
                    <select name="" class="form-control custom-select" wire:model="kecamatan">
                        <option value="" selected>Pilih Kecamatan</option>
                        @if(!empty($kecamatans))
                            @foreach($kecamatans as $key => $kec)
                                <option value="{{ $kec }}">{{ $key+1 }}. {{ $kec }}</option>
                            @endforeach
                        @endif
                    </select>
                    <textarea class="form-control mt-4" id="alamat" wire:model="alamat" rows="2"></textarea>

                </div>
            </div>

        </div>
        <hr class="mt-0 mb-2">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <label class="form-label"><span class="mr-4">5.</span>Tanggal Lahir
                </label>
            </div>
            <div class="col-sm 6">
                <div class="form-group mb-2 ml-5">
                    <input wire:model="tanggal_lahir" type="date" name="tanggal_lahir" id="tanggal_lahir"
                        class="form-control @error('nik') is-invalid @enderror" placeholder="Tanggal Lahir">
                    @error('tanggal_lahir')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>

            </div>
        </div>
        <hr class="mt-0 mb-2">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <label class="form-label"><span class="mr-4">6.</span>Jenis Kelamin
                </label>
            </div>
            <div class="col-sm 6">
                <div class="form-group mb-2 ml-5">
                    <div class="form-group mb-0 ml-5"><span>
                            <div class="selectgroup w-100">
                              <label class="selectgroup-item">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki"
                                        class="selectgroup-input is-invalid" wire:model="jenis_kelamin" {{ $jenis_kelamin== "Laki-laki" ? 'checked' : '' }}> 
                                        <span class="selectgroup-button">Laki-laki</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan"  wire:model="jenis_kelamin"
                                        class="selectgroup-input" {{ $jenis_kelamin== "Perempuan" ? 'checked' : '' }}>
                                    <span class="selectgroup-button"  >Perempuan</span>
                                </label>
                            </div>
                            <div class="error-radio-message" style="display: none;"></div>
                        </span>
                    </div>
                </div>

            </div>
        </div>
        <hr class="mt-0 mb-2">

        <div class="row align-items-center">
            <div class="col-sm-6">
                <label class="form-label"><span class="mr-4">7.</span>Agama
                </label>
            </div>
            <div class="col-sm 6">
                <div class="form-group mb-2 ml-5">
                    <select name="agama"  class="form-control custom-select" wire:model="agama"  placeholder="Pilih Agama?">
                        <option value=""  {{ empty($agama) ? 'selected' : '' }} disabled hidden >Pilih Agama</option>
                        <option value="islam"  {{ $agama=="islam" ? 'selected' : '' }}>Islam</option>
                        <option value="kristen"  {{ $agama=="kristen" ? 'selected' : '' }}>Kristen</option>
                        <option value="katholik" {{ $agama=="katholik" ? 'selected' : '' }}>Katholik</option>
                        <option value="hindu">Hindu</option>
                        <option value="budha">Budha</option>
                        <option value="konghucu">Konghucu</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

            </div>
        </div>
        <hr class="mt-0 mb-2">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <label class="form-label"><span class="mr-4">8.</span>Status Perkawinan 
                </label>
            </div>
            <div class="col-sm 6">
                <div class="form-group mb-2 ml-5">
                    <select name="" class="form-control custom-select" wire:model="is_kawin">
                        <option value="" {{ empty($is_kawin) ? 'selected' : '' }} disabled>Pilih Status Perkawinan</option>
                        <option value="Belum Kawin" {{ $is_kawin=="Belum Kawin" ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="Kawin" {{ $is_kawin=="Kawin" ? 'selected' : '' }}>Kawin</option>
                        <option value="Cerai Hidup" {{ $is_kawin=="Cerai Hidup" ? 'selected' : '' }}>Cerai Hidup</option>
                        <option value="Cerai Mati" {{ $is_kawin=="Cerai Mati" ? 'selected' : '' }}>Cerai Mati</option>

                    </select>
                </div>
            </div>
        </div>
        <hr class="mt-0 mb-2">

        <div class="row align-items-center">
            <div class="col-sm-6">
                <label class="form-label"><span class="mr-4">10.</span>Ijazah Tertinggi
                </label>
            </div>
            <div class="col-sm 6">
                <div class="form-group mb-2 ml-5">
                    <select name="pendidikan" class="form-control custom-select" wire:model="pendidikan">
                        <option value="">Pilih Ijazah Tertinggi</option>
                        <option value="SD / Sederajat ke bawah">SD / Sederajat ke bawah</option>
                        <option value="Tamat SMP / Sederajat">Tamat SMP / Sederajat</option>
                        <option value="Tamat SMA / Sederajat">Tamat SMA / Sederajat</option>
                        <option value="Tamat D1 / D2 / D3">Tamat D1 / D2 / D3</option>
                        <option value="Tamat D4 / S1">Tamat D4 / S1</option>
                        <option value="Tamat S2">Tamat S2</option>
                        <option value="Tamat S3">Tamat S3</option>
                    </select>
                </div>
            </div>
        </div>
        <hr class="mt-0 mb-2">

        <div class="row align-items-center">
            <div class="col-sm-6">
                <label class="form-label"><span class="mr-4">11.</span>Pekerjaan/Kegiatan Sehari-hari
                </label>
            </div>
            <div class="col-sm 6">
                <div class="form-group mb-2 ml-5">
                    <input wire:model="pekerjaan" type="text" name="pekerjaan" id="pekerjaan"
                        class="form-control @error('pekerjaan') is-invalid @enderror"
                        placeholder="Isikan Pekerjaan Sehari hari" aria-describedby="helpId">
                    @error('pekerjaan')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <hr class="mt-0 mb-2">


        <div class="row align-items-center">
            <div class="col-sm-6">
                <label class="form-label"><span class="mr-4">12.</span>Nomor Handphone yang bisa dihubungi
                </label>
            </div>
            <div class="col-sm 6">
                <div class="form-group mb-2 ml-5">
                    <input wire:model="phone" type="text" name="phone" id="phone"
                        class="form-control  @error('phone') is-invalid @enderror" placeholder="Nomor Hp"
                        aria-describedby="helpId">
                    @error('phone')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <hr class="mt-0 mb-2">

        <div class="row align-items-center">
            <div class="col-sm-6">
                <label class="form-label"><span class="mr-4">13.</span>Alamat Email
                </label>
            </div>
            <div class="col-sm 6">
                <div class="form-group mb-2 ml-5">
                    <input wire:model="email" type="email" name="email" id="email"
                        class="form-control  @error('email') is-invalid @enderror" placeholder="Email"
                        aria-describedby="helpId">
                    @error('email')
                        <div class="invalid-feedback d-block">
                            <strong>{{ $message }}</strong>
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <hr class="mt-0 mb-2">
      </section>
      <div class="btn-list text-center">
        <!--<button type="submit" class="btn btn-primary ">Tambahkan Mitra</button>-->
        <button type="button" class="btn btn-primary" wire:click="nextStep(2)">Berikutnya</button>
        <button type="button" class="btn btn-secondary" wire:click="closeModal()">Batal</button>

        
      </div>
      @endif

      @if ($step==2)
          <section>
            <div class="row">
              <div class="col-sm-12">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item " aria-current="page">Kualifikasi</li>
                  </ol>
                </nav>
              </div>
             
            </div>
            <div class="row align-items-center">
              <div class="col-sm-6">
                  <label class="form-label"><span class="mr-4">14.</span>Pengalaman Menjadi Petugas Sensus/Survei
                  </label>
              </div>
              <div class="col-sm 6">
                  <div class="form-group mb-2 ml-5">
                      <input wire:model="pengalaman" type="text" name="pengalaman" id="pengalaman"
                          class="form-control  @error('pengalaman') is-invalid @enderror" placeholder="Nomor Hp"
                          aria-describedby="helpId">
                        @error('pengalaman')
                          <div class="invalid-feedback d-block">
                              <strong>{{ $message }}</strong>
                          </div>
                        @enderror
                  </div>
              </div>
            </div>
            <hr class="mt-0 mb-2">
          <div class="row align-items-center">
              <div class="col-sm-6">
                  <label class="form-label"><span class="mr-4">15.</span>Memiliki Smartphone
                  </label>
              </div>
              <div class="col-sm 6">
                  <div class="form-group mb-2 ml-5">
                      <div class="form-group mb-0 ml-5"><span>
                              <div class="selectgroup w-100"><label class="selectgroup-item">
                                      <input type="radio" name="is_gadget" value="1"
                                          class="selectgroup-input is-invalid" wire:model="is_gadget"> <span
                                          class="selectgroup-button">Ya</span>
                                  </label>
                                  <label class="selectgroup-item">
                                      <input type="radio" name="is_gadget" value="0"
                                          class="selectgroup-input" wire:model="is_gadget">
                                      <span class="selectgroup-button">Tidak</span>
                                  </label>
                              </div>
                              <div class="error-radio-message" style="display: none;"></div>
                          </span>
                      </div>
                  </div>
  
              </div>
          </div>
          <hr class="mt-0 mb-2">
          <div class="row align-items-center">
            <div class="col-sm-6">
                <label class="form-label"><span class="mr-4">16.</span>Memiliki Kendaran Bermotor
                </label>
            </div>
            <div class="col-sm 6">
                <div class="form-group mb-2 ml-5">
                    <div class="form-group mb-0 ml-5"><span>
                            <div class="selectgroup w-100"><label class="selectgroup-item">
                                    <input type="radio" name="is_kendaraan" value="1"
                                        class="selectgroup-input is-invalid" wire:model="is_kendaraan"> <span
                                        class="selectgroup-button">Ya</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="is_kendaraan" value="0" wire:model="is_kendaraan"
                                        class="selectgroup-input">
                                    <span class="selectgroup-button">Tidak</span>
                                </label>
                            </div>
                            <div class="error-radio-message" style="display: none;"></div>
                        </span>
                    </div>
                </div>

            </div>
        </div>
        <hr class="mt-0 mb-2">
          
          </section>
          <div class="btn-list text-center">
            <button type="button" class="btn btn-secondary" wire:click="nextStep(1)">Sebelumnya</button>
            <button type="submit" class="btn btn-primary ">Tambahkan Mitra</button>
    
            <button type="button" class="btn btn-secondary" wire:click="closeModal()">Batal</button>
    
            
          </div>
      @endif


    </form>

    <script type="text/javascript" src="{{ asset('assets/flatpickr/flatpickr.js') }}"></script>
    <script>
        /* $( "#name" ).blur(function() {
  
      setTimeout(function() {
        $('#user-list').html('');
    }, 1500);
      //
    });


    $("#tanggal_lahir").flatpickr({
      altInput: true,
      altFormat: "d-m-Y",
      dateFormat: "Y/m/d",
    });*/
    </script>
</div>