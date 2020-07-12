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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-11">
                                <h2>{{$pertanyaan->isi_pertanyaan}} - {{$pertanyaan->users->name}}</h2>
                            </div>
                                <div class="col-lg-1">
                                    <form class="form-horizontal" action="{{route('vote.pertanyaanup', $pertanyaan->id)}}" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                        <input type="text" value="{{$pertanyaan->users_id}}" name="user" hidden readonly>
                                        <button class="btn btn-primary btn-sm">↑</button>
                                    </form>
                                        <h5>&nbsp;&nbsp;&nbsp;&nbsp;{{$hitung_vote_pertanyaan}}</h5>
                                    <form class="form-horizontal" action="{{route('vote.pertanyaandown', $pertanyaan->id)}}" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                        <input type="text" value="{{$pertanyaan->users_id}}" name="user" hidden readonly>
                                        <button class="btn btn-primary btn-sm">↓</button>
                                    </form>
                                </div>
                        </div>
                    @foreach ($komentar_pertanyaan as $komentar_pertanyaans)
                    <div class="row">
                        <div class="col-lg-1">
                        </div>
                        <div class="col-lg-5">
                            <hr><span>{!! $komentar_pertanyaans->isi_komentar !!}</span><hr></div>
                        </div>
                    @endforeach
                    <a href="#" class="btn btn-success btn-sm waves-effect waves-light" data-toggle="modal" data-target="#mKomentar">Tambah Komentar</a><br><br><br><br>
                    <h3>{{ $hitung }} &nbsp;Jawaban</h4><hr>
                    @foreach ($jawaban as $hasil)
                        @if ($pertanyaan->id == $hasil->pertanyaans_id)
                        <div class="row">
                            <div class="col-lg-11">
                                <h4>{!! $hasil->jawaban !!} </h4>
                                <span>Dijawab oleh : {{$hasil->users->name}}
                                @if ($pertanyaan->users_id == Auth::user()->id)
                                    @if(count($verif) > 0)
                                        @if ($hasil->status == 1)
                                        <span>- Jawaban Relevan</span>
                                        @endif
                                    @else
                                    <form class="form-horizontal" action="{{route('jawaban.verif', $hasil->id)}}" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                        <input type="text" value="{{$hasil->users_id}}" name="user" hidden readonly>
                                        <button class="btn btn-primary btn-sm">Verifikasi Jawaban{{$hasil->id}}</button>
                                    </form>
                                    @endif
                                @endif
                            </div>
                                <div class="col-lg-1">
                                    <form class="form-horizontal" action="{{route('vote.jawabanup', $hasil->id)}}" method="POST" enctype='multipart/form-data'>
                                        @csrf
                                        <input type="text" value="{{$pertanyaan->users_id}}" name="user" hidden readonly>
                                        <button class="btn btn-primary btn-sm">↑</button>
                                    </form>
                                    <br><br>
                                    <h5> &nbsp;&nbsp;&nbsp;&nbsp;
                                        {{$vote_jawaban->id}}
                                    </h5>
                                    <br>
                                    <form class="form-horizontal" action="{{route('vote.pertanyaandown', $hasil->id)}}" method="POST" enctype='multipart/form-data'>
                                        @csrf
                                        <input type="text" value="{{$pertanyaan->users_id}}" name="user" hidden readonly>
                                        <button class="btn btn-primary btn-sm">↓</button>
                                    </form>
                                </div>
                        </div>
                            @foreach ($komentar_jawaban as $komentar_jawabans)
                                @if ($hasil->id == $komentar_jawabans->jawabans_id)
                                
                                <div class="row">
                                    <div class="col-lg-1">
                                    </div>
                                    <div class="col-lg-5">
                                        <hr><span>{!! $komentar_jawabans->isi_komentar!!}</span><hr>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            
                        <a href="#" onclick="edit_kategori('{{route('komentar.jawaban.edit', $hasil->id)}}')" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Edit Kategori" class="btn btn-success btn-sm waves-effect waves-light" >Tambah Komentar</a><br><br><br>
                        @endif
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

<div id="mKtgEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Edit Data Kategori</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'jawaban' );
    CKEDITOR.replace( 'komentar_pertanyaan' );
</script>

<script type="text/javascript">
    function edit_kategori(file) {
        var myfile = file;
        $('#mKtgEdit').modal('show');
        $('#mKtgEdit .modal-body').load(myfile);
    }
</script>
@endsection