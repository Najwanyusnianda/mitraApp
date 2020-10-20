@if ($mitras->isEmpty())
<div class="alert alert-primary mt-5 mb-6">
  <div>Tidak ada mitra yang tersedia pada kegiatan ini</div>
</div>
@else
<table class="table card-table table-vcenter text-nowrap table-hove">
  <thead>
      <tr>
          <th>#</th>
          <th>Nama</th>
         
          <th>Kecamatan</th>

          <th></th>


      </tr>
  </thead>
  <tbody>
      <?php $no=0; ?>
      @foreach ($mitras as $mitra)
      <?php $no++; ?>
      <tr>
            <th scope="row">{{$no}}</th>
          <td>
              <strong></strong>
              <div>{{$mitra->name}}</div>
              <div class="small text-muted">
                {{$mitra->nik}}
              </div>
            </td>
          
          <td>{{$mitra->kecamatan}}</td>

          <td class="text-right">
     
            @if (empty($mitra->avg_evaluasi))
            <button class="btn btn-secondary btn-sm" disabled="disabled">
              @if (empty($mitra->avg_pelatihan))
                Belum dinilai
              @else
                @if (empty($mitra->avg_pelaksanaan))
                  Pelatihan:  {{$mitra->avg_pelatihan}}
                @else
                  Pelaksanaan Lapangan: {{$mitra->avg_pelaksanaan}}
                @endif
              @endif
              
              </button>
            @else
                <button disabled="disabled" class="btn btn-success btn-sm"><strong class="h5"> Nilai Rata - Rata :{{ $mitra->total_nilai }}</strong></button>
            @endif


          </td>

        
      </tr> 
      @endforeach

      
  </tbody>

</table>

@endif
