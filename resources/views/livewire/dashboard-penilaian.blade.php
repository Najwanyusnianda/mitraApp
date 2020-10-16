<div>
    <div class="row">
        @if(!empty($kegiatan))
         <div class="card">
            <div class="card-header">
                Kinerja Mitra Pada Kegiatan 
                <span class="ml-1 font-weight-bold"> {{$kegiatan->nama_kegiatan ? $kegiatan->nama_kegiatan : ''}}</span> 
            </div>
            <div class="card-body">
                    <div class="table-responsiive">
                        <table class="table table-hover table-striped">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>Kecamatan</th>
                                    <th>Nilai Kinerja</th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($avg_kecamatans as $kecamatan)
                                    <tr>
                                        <th scope="row"><strong> {{$kecamatan->kecamatan}}</strong></th>
                                    <td>{{ round($kecamatan->avg,2)==0 ? 'belum dinilai' : round($kecamatan->avg,2) }}</td>
                                    </tr>
                                    @empty
                                        <p>Tidak ada penilaian</p>
                                    @endforelse
                                    @if ($avg_kab !=null)
                                    <tr>
                                        <th scope="row"><strong><h6>Kota Subulussalam</h6></strong></th>
                                        <td>{{$avg_kab->avg}}</td>
                                    </tr>
                                    @endif

                                </tbody>
                        </table>
                    </div>
            </div>

        </div>
        
        @else
        <div class="alert alert-primary mt-5 mb-6">
            <div>Tidak ada kegiatan yang ditemukan<strong><a href="{{ url('/kegiatan/create') }}"> Buat Kegiatan Baru?</a></strong></div>
        </div>
        @endif
       
    </div>
</div>
