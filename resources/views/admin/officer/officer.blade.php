@extends('admin.base')
@section('officer')


<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data</li>
                </ol>
                </nav>
            <h1 class="mb-0 fw-bold">Data</h1> 
        </div>
        <div class="col-6">
            <div class="text-end upgrade-btn">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                    Lihat Data
                </button>                  
            </div>

            <div class="modal fade" id="myModal">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
              
                    <!-- Modal header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Data Pegawai</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
              
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Golongan</th>
                                  <th scope="col">Eselon</th>
                                  <th scope="col">Jabatan</th>
                                  <th scope="col">Aksi</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach($officer as $o)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $o->golongan}}</td>
                                    <td>{{ $o->eselon}}</td>
                                    <td>{{ $o->jabatan}}</td>
                                    <td>
                                        <form action="{{ route('destroy-officer',['id' => $o->id]) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <a href="{{ route('destroy-officer',['id' => $o->id]) }}" type="submit" class="btn btn-danger btn-sm btn-action trigger--fire-modal-2 delete-confirm">Hapus</a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                              </tbody>
                            </table>
                            {{ $officer->links() }}
                          </div>
                    </div>
              
                    <!-- Modal footer -->
                    {{-- <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div> --}}
              
                  </div>
                </div>
              </div>
              

            
        </div>

    </div>
</div>



<div class="container-fluid">
   
    <div class="row">
      
        <div class="col-lg-12 col-xlg-3 col-md-12">

            @if (session()->has('pesan'))
                <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>×</span>
                    </button>
                    {{ session()->get('pesan') }}
                </div>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Information</h4>
                    <h5 class="card-subtitle">
                        Harap isikan terlebih dahulu jenis <code>golongan</code>,<code>eselon</code>,dan <code>jabatan</code>
                      </h5>
                    <form action="{{route('store-officer')}}" class="form-horizontal form-material mx-2" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Golongan</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Isi sesuai dengan golongan anda" class="form-control form-control-line" name="golongan" id="" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Eselon</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Isi sesuai dengan Eselon anda" class="form-control form-control-line" name="eselon" id="" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Jabatan</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Isi sesuai dengan Jabatan anda" class="form-control form-control-line" name="jabatan" id="" value="">
                            </div>
                        </div>
                        
                        
                        
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success text-white" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
    <script>
    $('body').on('click','.delete-confirm',function (event) {
      event.preventDefault();
      const url = $(this).attr('href');
      Swal.fire({
        title: 'Apakah Kamu Yakin ? ',
        text: "Hapus Data ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus'
      }).then((result) => {
        if (result.value) {
          window.location.href = url;
        }
      })
    });
  </script>
@endpush

