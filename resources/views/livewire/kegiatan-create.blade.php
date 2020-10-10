<div>

    <div class="container mt-4">
        <div class="row-sm-12">
          <div class="col-sm-8 mx-auto">
            <form class="card" wire:submit.prevent="store">
              <div class="card-header text-center">
                <div class="card-title">
                  <strong>Buat Kegiatan Baru </strong>
                  
                </div>
              </div>
              <div class="card-body p-6">
                <div class="form-group">
                  <label class="form-label">Nama Kegiatan</label>
                  <input type="text" wire:model="nama_kegiatan" class="form-control form-control-lg" placeholder="Isikan Nama Kegiatan">
                </div>
                <div class="form-group">
                  <label class="form-label">Tahun </label>
                <input type="text" class="form-control" placeholder="Isikan Tahun Pelaksanaan" wire:model="tahun" value="{{\Carbon\Carbon::now()->year}}">
                </div>
                <div class="form-group">
                  <label class="form-label">Deskripsi</label>
                  <textarea class="form-control" id="deskripsi" wire:model="deskripsi" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label class="form-label">Tanggal Pelatihan</label>
                  <div class="row gutters-xs">
                    <div class="col-6">
                        <input wire:model="mulai_pelatihan" type="text" name="mulai_pelatihan"
                        id="mulai_pelatihan" 
                        class="form-control @error('mulai_pelatihan') is-invalid @enderror" 
                        placeholder="Waktu Selesai Pelatihan">
                        @error('tanggal_lahir')
                        <div class="invalid-feedback d-block" >
                         <strong>{{ $message }}</strong>
                         </div>
                        @enderror

                    </div>

                    <div class="col-6">
                      <input wire:model="selesai_pelatihan" type="text" name="selesai_pelatihan"
                      id="selesai_pelatihan" 
                      class="form-control @error('selesai_pelatihan') is-invalid @enderror" 
                      placeholder="Waktu Mulai Pelatihan">
                      @error('tanggal_lahir')
                      <div class="invalid-feedback d-block" >
                       <strong>{{ $message }}</strong>
                      </div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label class="form-label">Tanggal Pelaksanaan Lapangan</label>
                  <div class="row gutters-xs">
                      <div class="col-6">
                        <input wire:model="mulai_pelaksanaan" type="text" name="mulai_pelaksanaan"
                        id="mulai_pelaksanaan" 
                        class="form-control @error('mulai_pelaksanaan') is-invalid @enderror" 
                        placeholder="Waktu Mulai Kegiatan Lapangan">
                        @error('mulai_pelaksanaan')
                        <div class="invalid-feedback d-block" >
                         <strong>{{ $message }}</strong>
                         </div>
                        @enderror

                      </div>

                    <div class="col-6">
                      <input wire:model="selesai_pelaksanaan" type="text" name="selesai_pelaksanaan"
                      id="selesai_pelaksanaan" 
                      class="form-control @error('selesai_pelatihan') is-invalid @enderror" 
                      placeholder="Waktu Selesai Kegiatan Lapangan">
                      @error('tanggal_lahir')
                      <div class="invalid-feedback d-block" >
                       <strong>{{ $message }}</strong>
                      </div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label">Template Sertifikat</div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="sertifikat_template">
                    <label class="custom-file-label">Pilih File</label>
                  </div>
                </div>

                <div class="form-label">Template SPK</div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="spk_template">
                  <label class="custom-file-label">Pilih File</label>
                </div>
              </div>
                
                <div class="form-footer m-4">
                  <button type="submit" class="btn btn-primary btn-block ">Tambah Kegiatan Baru</button>
                </div>
              </div>
            </form>

          </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('assets/flatpickr/flatpickr.js') }}" ></script>
    <script>
 
 
      $("#mulai_pelatihan").flatpickr({
        altInput: true,
        altFormat: "d-m-Y",
        dateFormat: "Y/m/d",
       });
       $("#mulai_pelaksanaan").flatpickr({
          altInput: true,
          altFormat: "d-m-Y",
          dateFormat: "Y/m/d",
       });
       $("#selesai_pelatihan").flatpickr({
          altInput: true,
          altFormat: "d-m-Y",
          dateFormat: "Y/m/d",
       });
       $("#selesai_pelaksanaan").flatpickr({
          altInput: true,
          altFormat: "d-m-Y",
          dateFormat: "Y/m/d",
       });
     </script>

</div>
