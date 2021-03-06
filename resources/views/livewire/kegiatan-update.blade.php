<div>
    {{-- Do your work, then step back. --}}
    <div class="container mt-4">
        <div class="row-sm-12">
          <div class="col-sm-8 mx-auto">
            <form class="card" wire:submit.prevent="update" enctype="multipart/form-data">
              <div class="card-header text-center">
                <div class="card-title">
                  <strong>Update Kegiatan</strong>
                   
                </div>
              </div>
              <div class="card-body p-6">
                <div class="form-group">
                  <label class="form-label">Nama Kegiatan</label>
                  <input type="text" id="nama_kegiatan" wire:model="nama_kegiatan" class="form-control form-control-lg @error('nama_kegiatan') is-invalid @enderror" placeholder="Isikan Nama Kegiatan" disabled>
                  @if(!empty($kegiatans))
                  <div class="position-absolute  w-100 list-group bg-white shadow-lg row" id="kegiatan-list"
                      style="z-index: 1000">
                      @foreach($kegiatans as $kegiatan)
                          <button type="button" class="list-group-item list-group-item-action"
                              wire:click="fillKegiatanForm({{ $kegiatan['id'] }})">{{ $kegiatan['nama_kegiatan'] }}</button>
                      @endforeach
                  </div>

                  @endif
                  @if ($kegiatan_error ==true)
                  <div class="alert alert-danger mt-1" role="alert">
                    <h4 class="alert-heading"></h4>
                   
                    <p class="mb-0">Nama Kegiatan Tidak terdapat dalam master</p>
                  </div>
                  @endif


              @error('nama_kegiatan')
                  <div class="invalid-feedback d-block">
                      <strong>{{ $message }}</strong>
                  </div>
              @enderror
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
                <div class="form-group" wire:ignore>
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
                
                <div class="form-group" wire:ignore >
                  <label class="form-label">Tanggal Pelaksanaan Lapangan:</label>
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
                      class="form-control @error('selesai_pelaksanaan') is-invalid @enderror" 
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
                  <div class="form-label">Template Sertifikat : 
                      <a href="{{route('get.files_sertifikat',[$kegiatan_id]) }}" target="_blank">Template Saat ini</a>
                  </div>
                 <!-- <div class="custom-file">
                    <input type="file" class="custom-file-input" name="template_sertifikat" id="template_sertifikat" wire:model="template_sertifikat">
                    <label class="custom-file-label text-truncate">Pilih File</label>
                  </div>-->
                  <input type="file" class="form-control-file text-truncate"  id="template_sertifikat" wire:model="template_sertifikat">
                  <small> Contoh template Sertifikat: <a href="{{ asset('template/template_sertifikat.docx') }}" target="_blank">disini</a> </small>
                </div>

                <div class="form-label">Template SPK:
                  <a href="{{route('get.files_spk',[$kegiatan_id]) }}" target="_blank">Template Saat ini</a>
                </div>

               <!-- <div class="custom-file">
                  <input type="file" class="custom-file-input" name="template_spk" wire:model="template_spk">
                  <label class="custom-file-label text-truncate">Pilih File</label>
                </div>-->
                <input type="file" class="form-control-file text-truncate" name="template_spk" wire:model="template_spk">
                <small> Contoh template SPK: <a href="{{ asset('template/spk_template.docx') }}" target="_blank">disini</a> </small>
              </div>
              
                
                <div class="form-footer m-4">
                  <button type="submit" class="btn btn-primary btn-block ">Update Kegiatan</button>
                </div>
              </div>
            </form>

          </div>
        </div>
    </div>


    <script type="text/javascript" src="{{ asset('assets/flatpickr/flatpickr.js') }}" ></script>
    <script>
     
     $(document).ready(function(){
      /*$('.custom-file-input').on('change', function() { 
       let fileName = $(this).val().split('\\').pop(); 
       $(this).next('.custom-file-label').addClass("selected").html(fileName); 
    });*/





    $( "#nama_kegiatan" ).blur(function() {
      
      setTimeout(function() {
        $('#kegiatan-list').html('');
    }, 1500);
      //
    });
    //
        $('#mulai_pelaksanaan').on('change', function (e) {
           @this.set('mulai_pelaksanaan', e.target.value);
           var value=$(this).val();
           $("#selesai_pelaksanaan").flatpickr({
              altInput: true,
              altFormat: "d-m-Y",
              dateFormat: "Y/m/d",
              minDate:value,
           });
        });
        $('#selesai_pelaksanaan').on('change', function (e) {
           @this.set('selesai_pelaksanaan', e.target.value);
        });
    //
        $('#mulai_pelatihan').on('change', function (e) {
           @this.set('mulai_pelatihan', e.target.value);
    
           var value=$(this).val();
     
           $("#selesai_pelatihan").flatpickr({
              altInput: true,
              altFormat: "d-m-Y",
              dateFormat: "Y/m/d",
              minDate:value,
           });
           $("#mulai_pelaksanaan").flatpickr({
              altInput: true,
              altFormat: "d-m-Y",
              dateFormat: "Y/m/d",
              minDate:value,
             
           });
         
           $("#selesai_pelaksanaan").flatpickr({
              altInput: true,
              altFormat: "d-m-Y",
              dateFormat: "Y/m/d",
              minDate:value,
           });
        });
    
    //
        $('#selesai_pelatihan').on('change', function (e) {
           @this.set('selesai_pelatihan', e.target.value);
           var value=$(this).val();
      
           $("#mulai_pelaksanaan").flatpickr({
              altInput: true,
              altFormat: "d-m-Y",
              dateFormat: "Y/m/d",
              minDate:value,
             
           });
         
           $("#selesai_pelaksanaan").flatpickr({
              altInput: true,
              altFormat: "d-m-Y",
              dateFormat: "Y/m/d",
              minDate:value,
           });
        });
    //---------------------
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
           
    
    
    
       
    
     });
    
         </script>


</div>
