<div>

  
    <h4 class="text-center">Tambah Mitra Baru</h4>
    <hr>
    <!--form tambah mitra baru-->
    
    <form wire:submit.prevent="store" autocomplete="off">
        


        <div class="form-group">
          <div class="row gutters-xs">
            <div class="col-6">

              <label class="form-label">Nama Lengkap : {{$name}}</label>
              <input wire:model="name" type="text" name="name"
              id="name" 
              class="form-control @error('name') is-invalid @enderror" 
              placeholder="Nama" aria-describedby="helpId">
              @if (!empty($users))
              <div class="position-absolute  list-group bg-white shadow-lg" style="z-index: 1000">
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
              <small id="helpId" class="text-muted">Isikan nama lengkap</small>


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


      <hr>

    <!--<button type="submit" class="btn btn-sm btn-primary">Submit</button>-->
    <div class="btn-list text-center">
        <button type="submit" class="btn btn-primary ">Tambahkan Mitra</button>

        <button type="button" class="btn btn-secondary" wire:click="closeModal()">Batal</button>
      </div>
   </form>

  
 onblur="blurFunction()"
</div>
