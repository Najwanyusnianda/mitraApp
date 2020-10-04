<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
<div class="card row-12">

    <div class="card-body">
    <h4 class="card-title">Pilih Kegiatan: </h4>
        @if ($kegiatans->isNotEmpty())
            
        <div class="form-group">
            <label for=""></label>
            <select class="custom-select" name="" id=""  wire:model="kegiatan_id">
                <option selected>Pilih Kegiatan</option>
                @foreach ($kegiatans as $kegiatan)
            <option value="{{$kegiatan->id}}">{{$kegiatan->nama_kegiatan}}</option>
                @endforeach
 
            </select>
        </div>
            
        @endif

    </div>
</div>
</div>
