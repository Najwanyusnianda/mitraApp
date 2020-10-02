<div>
<div class="card  col-md-6 mx-auto">
  <div class="card-header">
    Nama Mitra
  </div>
  <div class="card-body mx-auto">
    <div class="row ">
        <form wire:submit.prevent="store">
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
            
                    <button type="reset" class="btn btn-secondary" >Batal</button>
                  </div>

            </div>
        </form>
    </div>
  </div>
</div>
</div>
