@extends('admin.base')
@section('form-officer')


<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
    <div class="row align-items-center">
        <div class="col-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pegawai</li>
                </ol>
                </nav>
            <h1 class="mb-0 fw-bold">Data Pegawai</h1> 
        </div>
        <div class="col-6">
            <div class="text-end upgrade-btn">
                <a href="{{(route('show-officer'))}}" class="btn btn-primary text-white"
                    target="_blank">Lihat Data</a>
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
                    <form action="{{ route('store') }}" class="form-horizontal form-material mx-2" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="form-group m-t-40">
                            <label class="col-md-12">NIP</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="NIP" class="form-control form-control-line" name="nip" id="" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Nama</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Nama Lengkap" class="form-control form-control-line" name="nama" id="" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Tempat Lahir</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Tempat Lahir" class="form-control form-control-line" name="tempat_lahir" id="" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Alamat</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Alamat Lengkap" class="form-control form-control-line" name="alamat" id="" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Tgl Lahir</label>
                            <div class="col-md-12">
                                <input type="date" class="form-control form-control-line" name="tgl_lahir" id="" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Jenis Kelamin</label>
                            <div class="col-sm-12">
                                <select name="jenis_kelamin" class="form-select shadow-none form-control-line">
                                    <option value="" selected disabled hidden>--Jenis Kelamin--</option>
                                    <option @if(old('jenis_kelamin')=='Laki-Laki') selected @endif value="Laki-Laki">Laki-Laki</option>
                                    <option @if(old('jenis_kelamin')=='Perempuan') selected @endif value="Laki-Laki">Perempuan</option>
                                    @error('jenis_kelamin')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Golongan</label>
                            <div class="col-sm-12">
                                <select name="golongan" class="form-select shadow-none form-control-line">
                                    <option value="" selected disabled hidden>--Golongan--</option>
                                    @foreach($golongan as $g)
                                        <option value="{{$g->id}}" {{old('golongan')==$g->id ? 'selected':''}}>{{$g->golongan}}</option>
                                    @endforeach
                                    @error('golongan')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Eselon</label>
                            <div class="col-sm-12">
                                <select name="eselon" class="form-select shadow-none form-control-line">
                                    <option value="" selected disabled hidden>--Eselon--</option>
                                    @foreach($eselon as $e)
                                        <option value="{{$e->id}}" {{old('eselon')==$e->id ? 'selected':''}}>{{$e->eselon}}</option>
                                    @endforeach
                                    @error('eselon')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-12">Jabatan</label>
                            <div class="col-sm-12">
                                <select name="jabatan" class="form-select shadow-none form-control-line">
                                    <option value="" selected disabled hidden>--Jabatan--</option>
                                    @foreach($jabatan as $j)
                                        <option value="{{$j->id}}" {{old('jabatan')==$j->id ? 'selected':''}}>{{$j->jabatan}}</option>
                                    @endforeach
                                    @error('jabatan')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Tempat Tugas</label>
                            <div class="col-md-12">
                                <input type="text" placeholder="Tempat Tugas" class="form-control form-control-line" name="tempat_tugas" id="" value="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Agama</label>
                                    <select name="agama" class="form-select shadow-none form-control-line">
                                    <option value="" selected disabled hidden>--Agama--</option>
                                    <option @if(old('agama')=='Islam') selected @endif value="Islam">Islam</option>
                                    <option @if(old('agama')=='Kristen/Protestan') selected @endif value="Kristen/Protestan">Kristen/Protestan</option>
                                    <option @if(old('agama')=='Katholik') selected @endif value="Katholik">Katholik</option>
                                    <option @if(old('agama')=='Hindu') selected @endif value="Hindu">Hindu</option>
                                    <option @if(old('agama')=='Budha') selected @endif value="Budha">Budha</option>
                                    <option @if(old('agama')=='Khong hu chu') selected @endif value="Khong hu chu">Khong hu chu</option>
                                    @error('agama')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                     @enderror
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="example-email" class="col-md-12">Unit Kerja</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-line" name="unit_kerja" id="" value="">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="example-email" class="col-md-12">No Telpon</label>
                            <div class="col-md-12">
                                <input type="number" class="form-control form-control-line" name="no_hp" id="" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="example-email" class="col-md-12">NPWP</label>
                            <div class="col-md-12">
                                <input type="number" class="form-control form-control-line" name="npwp" id="" value="">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                
                                <div class="form-group">
                                    <label for="exampleFormControlFile1">Input foto pegawai</label>
                                    <input type="file" name="foto" class="form-control-file" id="exampleFormControlFile1" >
                                    @error('foto')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-text text-muted">The image must have a maximum size of 1MB</div>
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