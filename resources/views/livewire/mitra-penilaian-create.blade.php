<div>

  @if (!empty($kegiatan_mitra_id))
  
  <p>Nama: {{ $mitra_name }} </p>
  <p>Indikator: 
    @if (empty($avg_pelatihan))
        Pelatihan
    @else
        @if (empty($avg_pelaksanaan))
        Pelaksaaan Lapangan
        @else
        Evaluasi Lapangan    
        @endif
    @endif
  </p>
  <hr>
  <form wire:submit.prevent="store" class="mx-auto text-center">
    <div class="form-group">
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

    </div>
  </form>
  @else
      <h1>ga da</h1>

  @endif



</div>
