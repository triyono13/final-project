@extends('template.master')

@section('content')
<div class="wrapper">
    <div class="container-fluid">
            @if(count ($errors)>0)
                @foreach($errors->all() as $error)
                    {{$error}}
                @endforeach
            @endif
        <!-- start page title -->
        <div class="row">
          <div class="col-12">
              <div class="page-title-box"><br>
                  <h1>{{$pertanyaan->judul}}</h1>
                  <span>Pertanyaan dibuat : {{$pertanyaan->updated_at->diffForHumans()}}</span>
              </div>
          </div>
      </div><br>
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card">
                    <div class="card-body">
                    <h2>{{$pertanyaan->isi_pertanyaan}}</h2>
                    @foreach ($komentar_pertanyaan as $komentar_pertanyaans)
                    <hr>
                    <span>{!! $komentar_pertanyaans->isi_komentar !!}</span><hr>
                    @endforeach
                    <a href="#" class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target="#mKomentar">Tambah Komentar</a><br><br><br><br>
                    <h3>{{ $hitung }} &nbsp;Jawaban</h4><hr>
                    @foreach ($jawaban as $result => $hasil)
                    <h4>{!! $hasil->jawaban !!} - {{$hasil->pertanyaan->judul}}</h4>
                    <hr>
                    <span>Test Komentar</span><hr>
                    <a href="#" class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target="#mTaUsr">Tambah Komentar</a><br><br><br>


<div id="mTaUsr" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST"  action="{{route('komentar.jawaban.simpan', $komentar_pertanyaans->id)}}">
                @csrf
                    <div class="form-group">
                        <div class="col-lg-12">
                            <center><label>Komentar</label></center>
                            <textarea placeholder="Keterangan Transaksi" class="form-control" name="komentar" id="komentar" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--END MODAL INPUT DATA-->
                    @endforeach













                    <form class="form-horizontal" action="{{route('jawaban.simpan', $pertanyaan->id)}}" method="POST" enctype='multipart/form-data'>
                    @csrf
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label" for="simpleinput"> - Kontribusikan Jawabanmu</label>
                            <div class="col-lg-12">
                                <textarea class="form-control" name="jawaban" id="jawaban"></textarea>
                            </div>
                        </div><hr>
                        <div class="form-group row">
                            <button class="btn btn-primary btn-block">Simpan Post</button>
                        </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- end row --> 
    </div> <!-- end container-fluid -->
</div>



<div id="mKomentar" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Tambah Data Kategori ini pertanyaan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST"  action="{{route('komentar.pertanyaan.simpan', $pertanyaan->id)}}">
                @csrf
                    <div class="form-group">
                        <div class="col-lg-12">
                            <center><label>Komentar</label></center>
                            <textarea placeholder="Keterangan Transaksi" class="form-control" name="komentar" id="komentar_pertanyaan" required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--END MODAL INPUT DATA-->

<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'jawaban' );
    CKEDITOR.replace( 'komentar' );
    CKEDITOR.replace( 'komentar_pertanyaan' );
</script>
@endsection