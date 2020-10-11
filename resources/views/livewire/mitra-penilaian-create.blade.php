<div>

  @if (!empty($kegiatan_mitra_id))
  
  <p> </p>
 
  <ol class="breadcrumb">
    <li class="breadcrumb-item " aria-current="page">
      <strong>Nama: {{ $mitra_name }}  (NIK: {{ $mitra_nik }})</strong>
    </li>
  </ol>
  <ol class="breadcrumb">
    <li class="breadcrumb-item " aria-current="page">
      Indikator Penilaian: 
    @if (empty($avg_pelatihan))
        Pelatihan
    @else
        @if (empty($avg_pelaksanaan))
        Pelaksaaan Lapangan
        @else
        Evaluasi Lapangan    
        @endif
    @endif
    </li>
  </ol>
  <hr>
  <form wire:submit.prevent="store" class="mx-auto text-center">
    <div class="row align-items-center">
      <div class="col-sm-6">
        <label class="form-label"><span class="mr-4"></span> Nilai Disiplin
        </label>
      </div>
      <div class="col-sm 6">
        <div class="form-group mb-2 ml-5">
          <div class="selectgroup selectgroup-pills">
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="disiplin_val" value="1" class="selectgroup-input" checked="">
              <span class="selectgroup-button selectgroup-button-icon">1</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="disiplin_val" value="2" class="selectgroup-input">
              <span class="selectgroup-button selectgroup-button-icon">2</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="disiplin_val" value="3" class="selectgroup-input">
              <span class="selectgroup-button selectgroup-button-icon">3</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="disiplin_val" value="4" class="selectgroup-input">
              <span class="selectgroup-button selectgroup-button-icon">4</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="disiplin_val" value="5" class="selectgroup-input">
              <span class="selectgroup-button selectgroup-button-icon">5</span>
            </label>
        </div>
        </div>
      </div>
    </div>
    <hr class="mt-0 mb-2">
    <div class="row align-items-center">
      <div class="col-sm-6">
        <label class="form-label"><span class="mr-4"></span>Nilai Kerjasama
        </label>
      </div>
      <div class="col-sm 6">
        <div class="form-group mb-2 ml-5">
          <div class="selectgroup selectgroup-pills">
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="kerjasama_val" value="1" class="selectgroup-input" checked="">
              <span class="selectgroup-button selectgroup-button-icon">1</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="kerjasama_val" value="2" class="selectgroup-input">
              <span class="selectgroup-button selectgroup-button-icon">2</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="kerjasama_val" value="3" class="selectgroup-input">
              <span class="selectgroup-button selectgroup-button-icon">3</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="kerjasama_val" value="4" class="selectgroup-input">
              <span class="selectgroup-button selectgroup-button-icon">4</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="kerjasama_val" value="5" class="selectgroup-input">
              <span class="selectgroup-button selectgroup-button-icon">5</span>
            </label>
        </div>
        </div>
      </div>
    </div>
    <hr class="mt-0 mb-2">
    <div class="row align-items-center">
      <div class="col-sm-6">
        <label class="form-label"><span class="mr-4"></span>Nilai Kualitas
        </label>
      </div>
      <div class="col-sm 6">
        <div class="form-group mb-2 ml-5">
          <div class="selectgroup selectgroup-pills">
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="kualitas_val" value="1" class="selectgroup-input" checked="">
              <span class="selectgroup-button selectgroup-button-icon">1</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="kualitas_val" value="2" class="selectgroup-input">
              <span class="selectgroup-button selectgroup-button-icon">2</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="kualitas_val" value="3" class="selectgroup-input">
              <span class="selectgroup-button selectgroup-button-icon">3</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="kualitas_val" value="4" class="selectgroup-input">
              <span class="selectgroup-button selectgroup-button-icon">4</span>
            </label>
            <label class="selectgroup-item">
              <input type="radio" name="" wire:model="kualitas_val" value="5" class="selectgroup-input">
              <span class="selectgroup-button selectgroup-button-icon">5</span>
            </label>
          </div>

        </div>
      </div>
    </div>
    <hr class="mt-0 mb-2">

    <!--<div class="form-group">
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td class="align-middle">
                        Disiplin: {{$disiplin_val}}
                    </td>
                    <td>
                        <div class="selectgroup selectgroup-pills">
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="disiplin_val" value="1" class="selectgroup-input" checked="">
                              <span class="selectgroup-button selectgroup-button-icon">1</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="disiplin_val" value="2" class="selectgroup-input">
                              <span class="selectgroup-button selectgroup-button-icon">2</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="disiplin_val" value="3" class="selectgroup-input">
                              <span class="selectgroup-button selectgroup-button-icon">3</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="disiplin_val" value="4" class="selectgroup-input">
                              <span class="selectgroup-button selectgroup-button-icon">4</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="disiplin_val" value="5" class="selectgroup-input">
                              <span class="selectgroup-button selectgroup-button-icon">5</span>
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="align-middle">
                        Kualitas: {{$kualitas_val}}
                    </td>
                    <td>
                        <div class="selectgroup selectgroup-pills">
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="kualitas_val" value="1" class="selectgroup-input" checked="">
                              <span class="selectgroup-button selectgroup-button-icon">1</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="kualitas_val" value="2" class="selectgroup-input">
                              <span class="selectgroup-button selectgroup-button-icon">2</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="kualitas_val" value="3" class="selectgroup-input">
                              <span class="selectgroup-button selectgroup-button-icon">3</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="kualitas_val" value="4" class="selectgroup-input">
                              <span class="selectgroup-button selectgroup-button-icon">4</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="kualitas_val" value="5" class="selectgroup-input">
                              <span class="selectgroup-button selectgroup-button-icon">5</span>
                            </label>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="align-middle">
                        Kerjasama: {{$kerjasama_val}}
                    </td>
                    <td>
                        <div class="selectgroup selectgroup-pills">
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="kerjasama_val" value="1" class="selectgroup-input" checked="">
                              <span class="selectgroup-button selectgroup-button-icon">1</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="kerjasama_val" value="2" class="selectgroup-input">
                              <span class="selectgroup-button selectgroup-button-icon">2</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="kerjasama_val" value="3" class="selectgroup-input">
                              <span class="selectgroup-button selectgroup-button-icon">3</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="kerjasama_val" value="4" class="selectgroup-input">
                              <span class="selectgroup-button selectgroup-button-icon">4</span>
                            </label>
                            <label class="selectgroup-item">
                              <input type="radio" name="" wire:model="kerjasama_val" value="5" class="selectgroup-input">
                              <span class="selectgroup-button selectgroup-button-icon">5</span>
                            </label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <div class="btn-list text-center">
            <button type="submit" class="btn btn-primary ">Simpan Penilaian</button>
    
            <button wire:click="closeModal()" class="btn btn-secondary" >Batal</button>
          </div>

    </div>-->
    <br>
    <div class="alert alert-warning" role="alert">
      Nilai tidak dapat diubah setelah diberikan
    </div>
    <br>
    <div class="btn-list text-center mt-2">
      <button type="submit" class="btn btn-primary ">Simpan Penilaian</button>

      <button wire:click="closeModal()" type="button" class="btn btn-secondary" >Batal</button>
    </div>
  </form>
  @else
      <h1>ga da</h1>

  @endif



</div>
