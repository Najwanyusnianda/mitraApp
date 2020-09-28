<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
<div class="card row-12">

    <div class="card-body">
    <h4 class="card-title">Pilih Kegiatan: {{$kegiatan_id}}</h4>
        @if ($kegiatans->isNotEmpty())
            
        <div class="form-group">
            <label for=""></label>
            <select class="custom-select" name="" id=""  wire:model="kegiatan_id">
                <option selected>Select one</option>
                @foreach ($kegiatans as $kegiatan)
            <option value="{{$kegiatan->id}}">{{$kegiatan->nama_kegiatan}}</option>
                @endforeach
 
            </select>
        </div>
            
        @endif

    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div>
</div>
