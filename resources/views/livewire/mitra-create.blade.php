<div>

 
    <!--form tambah mitra baru-->
    <form wire:submit.prevent="store">
        

        <div class="form-group">
          <label class="form-label">Nama : {{$name}}</label>
          <input wire:model="name" type="text" name="name"
          id="name" 
          class="form-control @error('name') is-invalid @enderror" 
          placeholder="Nama" aria-describedby="helpId">
          @error('name')
          <div class="invalid-feedback d-block" >
           <strong>{{ $message }}</strong>
           </div>
          @enderror
          <small id="helpId" class="text-muted">Isikan nama lengkap</small>
        </div>

        <div class="form-group">
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

        <div class="form-group">
            <label class="form-label">Tanggal Lahir</label>
            <div class="row gutters-xs">
                <div class="col-3">
                    <select name="" class="form-control custom-select" wire:model="hari_lahir">
                      <option selected="selected">Tanggal</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                      <option value="31">31</option>
                    </select>
                </div>
              <div class="col-5">
                <select name="" class="form-control custom-select" wire:model="bulan_lahir">
                  <option selected="selected">Bulan</option>
                  <option value="1">Januari</option>
                  <option value="2">Februari</option>
                  <option value="3">Maret</option>
                  <option value="4">April</option>
                  <option value="5">Mei</option>
                  <option  value="6">Juni</option>
                  <option value="7">Juli</option>
                  <option value="8">Agustus</option>
                  <option value="9">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">November</option>
                  <option value="12">December</option>
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
            <label class="form-label">Nomor Telepon/HP : {{$phone}}</label>
            <input wire:model="phone" type="text" name="phone" id="phone" class="form-control  @error('phone') is-invalid @enderror" placeholder="Nomor Hp" aria-describedby="helpId">
            @error('phone')
            <div class="invalid-feedback d-block" >
             <strong>{{ $message }}</strong>
             </div>
            @enderror
            <small id="helpId" class="text-muted">Isikan no. Hp yang aktif</small>

        </div>

        <div class="form-group">
            <label class="form-label">Pengalaman Survei</label>
            <textarea class="form-control" id="pengalaman" wire:model="pengalaman" rows="3" cols="5"></textarea>
        </div>

        <div class="form-group">
            <div class="form-label">Kualifikasi</div>
            <div class="custom-controls-stacked">
              <label class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" name="" wire:model="is_gadget" value="1" checked="">
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

        <button type="reset" class="btn btn-secondary" wire:click="closeModal()">Batal</button>
      </div>
   </form>

  

</div>
