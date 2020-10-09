<div>

  
    <h4 class="text-center">Tambah Mitra Baru</h4>
    <hr>
    <!--form tambah mitra baru-->
    
    <form wire:submit.prevent="store" autocomplete="off">
        
      <div class="row align-items-center">
          <div class="col-sm-6">
            <label class="form-label"><span class="mr-4">1.</span>Nama Lengkap (Sesuai KTP)
            </label>
          </div>
          <div class="col-sm 6">
            <div class="form-group mb-2 ml-5">
              <input wire:model="name" type="text" name="name"
              id="name" 
              class="form-control @error('name') is-invalid @enderror" 
              placeholder="Nama" aria-describedby="userId">
              @if (!empty($users))
              <div class="position-absolute  w-100 list-group bg-white shadow-lg row" id="user-list" style="z-index: 1000">
                @foreach ($users as $user)
                    <button type="button"  class="list-group-item list-group-item-action" wire:click="fillUserForm({{ $user['id'] }})" >{{ $user['name'] }}</button>
                @endforeach
              </div>
             @endif
              @error('name')
              <div class="invalid-feedback d-block" >
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
            <input wire:model="nik" type="text" name="nik"
            id="nik" 
            class="form-control @error('nik') is-invalid @enderror" 
            placeholder="NIK" aria-describedby="helpId">
            @error('nik')
            <div class="invalid-feedback d-block" >
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
            <input wire:model="npwp" type="text" name="npwp"
            id="npwp" 
            class="form-control @error('npwp') is-invalid @enderror" 
            placeholder="Nomor NPWP">
            @error('npwp')
            <div class="invalid-feedback d-block" >
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
            <textarea class="form-control" id="alamat" wire:model="alamat" rows="2"></textarea>
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
            <input wire:model="tanggal_lahir" type="text" name="tanggal_lahir"
            id="tanggal_lahir" 
            class="form-control @error('nik') is-invalid @enderror" 
            placeholder="Tanggal Lahir">
            @error('tanggal_lahir')
            <div class="invalid-feedback d-block" >
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
                    <div class="selectgroup w-100"><label class="selectgroup-item">
                            <input type="radio"
                                name="jenis_kelamin" value="1" class="selectgroup-input is-invalid"> <span
                                class="selectgroup-button">Laki-laki</span>
                              </label> 
                                <label class="selectgroup-item">
                                  <input type="radio" name="jenis_kelamin" value="2"
                                class="selectgroup-input"> 
                                <span class="selectgroup-button">Perempuan</span>
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
            <select name="" class="form-control custom-select" wire:model="is_kawin">
              <option value="" >Islam</option>
              <option value="" >Kristen</option>
              <option value="" >Katholik</option>
              <option value="" >Hindu</option>
              <option value="" >Budha</option>
              <option value="" >Konghucu</option>
              <option value="" >Lainnya</option>     
            </select>
          </div>

        </div>
      </div>
      <hr class="mt-0 mb-2">

        <!--<div class="form-group">
          <div class="row gutters-xs">
            <div class="col-4">
              <label class="form-label">Jenis Kelamin</label>
              <select name="" class="form-control custom-select" wire:model="jenis_kelamin">
                <option value="" selected>Jenis Kelamin</option>
                <option value="L">Laki-Laki</option>
                <option value="P">Perempuan</option>

              </select>
            </div>
            <div class="col-4">
 
                <label class="form-label">Status Perkawinan</label>
                <select name="" class="form-control custom-select" wire:model="is_kawin">
                  <option value="1" selected>Kawin</option>
                  <option value="2" selected>Sudah Kawin</option> 
                </select>
           
            </div>
              <div class="col-4">
                <label class="form-label">Agama</label>
                <select name="" class="form-control custom-select" wire:model="is_kawin">
                  <option value="1" selected>Kawin</option>
                  <option value="2" selected>Sudah Kawin</option> 
                </select>
              </div>
          </div>
          <div class="row gutters-xs">
              <div class="col-6">

              <label class="form-label">Nama Lengkap : {{$name}}</label>
              <input wire:model="name" type="text" name="name"
              id="name" 
              class="form-control @error('name') is-invalid @enderror" 
              placeholder="Nama" aria-describedby="userId">
              @if (!empty($users))
              <div class="position-absolute  w-100 list-group bg-white shadow-lg row" id="user-list" style="z-index: 1000">
                @foreach ($users as $user)
                    <button type="button"  class="list-group-item list-group-item-action" wire:click="fillUserForm({{ $user['id'] }})" >{{ $user['name'] }}</button>
                @endforeach
              </div>
             @endif
              @error('name')
              <div class="invalid-feedback d-block" >
               <strong>{{ $message }}</strong>
               </div>
              @enderror
              <small id="userId" class="text-muted">Isikan nama lengkap</small>


            </div>
            <div class="col-6">
              <label class="form-label">Nomor Induk Kependudukan (NIK) </label>
              <input wire:model="nik" type="text" name="nik"
              id="nik" 
              class="form-control @error('nik') is-invalid @enderror" 
              placeholder="NIK" aria-describedby="helpId">
              @error('nik')
              <div class="invalid-feedback d-block" >
               <strong>{{ $message }}</strong>
               </div>
              @enderror
              <small id="helpId" class="text-muted">Isikan NIK sesuai dengan KTP</small>
            </div>

          </div>
        </div>

        <div class="form-group">
          <div class="row gutters-xs">
            <div class="col-6">
              <label class="form-label">Nomor Telepon/HP : {{$phone}}</label>
              <input wire:model="phone" type="text" name="phone" id="phone" class="form-control  @error('phone') is-invalid @enderror" placeholder="Nomor Hp" aria-describedby="helpId">
              @error('phone')
              <div class="invalid-feedback d-block" >
               <strong>{{ $message }}</strong>
               </div>
              @enderror
              <small id="helpId" class="text-muted">Isikan no. Hp yang aktif</small>
            </div>
            <div class="col-6">
              <label class="form-label">Email: {{$email}}</label>
              <input wire:model="email" type="email" name="email" id="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" aria-describedby="helpId">
              @error('email')
              <div class="invalid-feedback d-block" >
               <strong>{{ $message }}</strong>
               </div>
              @enderror
              <small id="helpId" class="text-muted">Isikan Email yang aktif</small>
            </div>
          </div>
        </div>

        
        
        <div class="form-group">
            <label class="form-label">Tanggal Lahir</label>
            <div class="row gutters-xs">
                <div class="col-3">
               
                    <select name="" class="form-control custom-select" wire:model="hari_lahir">
                      <option value="" selected >Tanggal</option>
                      @for ($i =0; $i<31;$i++)
                      <option value="{{ $i+1 }}" >{{ $i+1 }}</option>
                      @endfor
                    </select>
                </div>
              <div class="col-5">
                <select name="" class="form-control custom-select" wire:model="bulan_lahir">
                  <option value="" selected>Bulan</option>
                  <option value="1">Januari</option>
                  <option value="2">Februari</option>
                  <option value="3">Maret</option>
                  <option value="4">April</option>
                  <option value="5">Mei</option>
                  <option value="6" >Juni</option>
                  <option value="7">Juli</option>
                  <option value="8">Agustus</option>
                  <option value="9">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">November</option>
                  <option value="12">Desember</option>
                </select>
              </div>
              <div class="col-4">
                <select name="" class="form-control custom-select" wire:model="tahun_lahir">
                  <option value="" selected="selected">Tahun</option>
                    @for ($i = (int)\Carbon\carbon::now()->year-100; $i < (int)\Carbon\carbon::now()->year; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
              </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Pekerjaan Saat Ini </label>
            <input wire:model="pekerjaan" type="text" name="pekerjaan"
            id="pekerjaan" 
            class="form-control @error('pekerjaan') is-invalid @enderror" 
            placeholder="pekerjaan" aria-describedby="helpId">
            @error('pekerjaan')
            <div class="invalid-feedback d-block" >
             <strong>{{ $message }}</strong>
             </div>
            @enderror
            <small id="helpId" class="text-muted">Isikan Pekerjaan/Profesi </small>
        </div>

        <div class="form-group">
            <label class="form-label">Pengalaman Survei</label>
            <textarea class="form-control" id="pengalaman" wire:model="pengalaman" rows="3" cols="5"></textarea>
        </div>

        <div class="form-group">
            <div class="form-label">Kualifikasi</div>
            <div class="custom-controls-stacked">
              <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="" wire:model="is_gadget" value="1" >
                <span class="custom-control-label">Spesifikasi Gadget Mencukupi</span>
              </label>
              <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="" value="1" wire:model="is_kendaraan">
                <span class="custom-control-label">Mempunyai Kendaraan Bermotor</span>
              </label>
            </div>
        </div>


      <hr>-->

    <!--<button type="submit" class="btn btn-sm btn-primary">Submit</button>-->
    <div class="btn-list text-center">
        <button type="submit" class="btn btn-primary ">Tambahkan Mitra</button>

        <button type="button" class="btn btn-secondary" wire:click="closeModal()">Batal</button>
      </div>
   </form>

  
   <script>
     $( "#name" ).blur(function() {
  
      setTimeout(function() {
        $('#user-list').html('');
    }, 1500);
      //
    });


    $("#tanggal_lahir").flatpickr({
      dateFormat: "d-m-Y",
    });
   </script>
</div>
