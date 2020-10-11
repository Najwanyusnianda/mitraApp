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
                    <!-- <input type="text" class="form-control" placeholder="Isikan Tahun Pelaksanaan" wire:model="tahun" value="{{\Carbon\Carbon::now()->year}}">-->
                       <select name="" class="form-control custom-select" wire:model="tahun">
                      <option value="" selected="selected">Tahun</option>
                    @for($i = (int)\Carbon\carbon::now()->year-5; $i < (int)\Carbon\carbon::now()->year+3; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                       </select>
                </div>
                <div class="form-group">
                  <label class="form-label">Deskripsi</label>
                  <textarea class="form-control" id="deskripsi" wire:model="deskripsi" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label class="form-label">Tanggal Pelatihan</label>
                  <div class="row gutters-xs">
                    <div class="col-6">
                        <input wire:model="mulai_pelatihan" type="date" name="mulai_pelatihan"
                        id="mulai_pelatihan" 
                        class="form-control @error('mulai_pelatihan') is-invalid @enderror" 
                        placeholder="Waktu Mulai Pelatihan" >
                        @error('tanggal_lahir')
                        <div class="invalid-feedback d-block" >
                         <strong>{{ $message }}</strong>
                         </div>
                        @enderror

                    </div>

                    <div class="col-6">
                      <input wire:model="selesai_pelatihan" type="date" name="selesai_pelatihan"
                      id="selesai_pelatihan" 
                      class="form-control @error('selesai_pelatihan') is-invalid @enderror" 
                      placeholder="Waktu Selesai Pelatihan" >
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
                        <input wire:model="mulai_pelaksanaan" type="date" name="mulai_pelaksanaan"
                        id="mulai_pelaksanaan" 
                        class="form-control @error('mulai_pelaksanaan') is-invalid @enderror" 
                        placeholder="Waktu Mulai Kegiatan Lapangan" >
                        @error('mulai_pelaksanaan')
                        <div class="invalid-feedback d-block" >
                         <strong>{{ $message }}</strong>
                         </div>
                        @enderror

                      </div>

                    <div class="col-6">
                      <input wire:model="selesai_pelaksanaan" type="date" name="selesai_pelaksanaan"
                      id="selesai_pelaksanaan" 
                      class="form-control @error('selesai_pelatihan') is-invalid @enderror" 
                      placeholder="Waktu Selesai Kegiatan Lapangan" >
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
                 <!-- <div class="custom-file">
                    <input type="file" class="custom-file-input" name="template_sertifikat" id="template_sertifikat" wire:model="template_sertifikat">
                    <label class="custom-file-label text-truncate">Pilih File</label>
                  </div>-->
                  <input type="file" class="form-control-file text-truncate" name="template_sertifikat" id="template_sertifikat" wire:model="template_sertifikat">
                </div>

                <div class="form-label">Template SPK</div>
               <!-- <div class="custom-file">
                  <input type="file" class="custom-file-input" name="template_spk" wire:model="template_spk">
                  <label class="custom-file-label text-truncate">Pilih File</label>
                </div>-->
                <input type="file" class="form-control-file text-truncate" name="template_spk" wire:model="template_spk">
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
 
 $(document).ready(function(){
  $('.custom-file-input').on('change', function() { 
   let fileName = $(this).val().split('\\').pop(); 
   $(this).next('.custom-file-label').addClass("selected").html(fileName); 
});

   /*
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
       });*/
 });

     </script>

</div>
