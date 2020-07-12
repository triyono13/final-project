@extends('template.master')
@section('content')

<div class="wrapper">
    <div class="container-fluid">

        <!-- start page title -->
        @component('components.breadcrumb')
            @slot('title') Pertanyaan   @endslot
            @slot('title_li') Create   @endslot
        @endcomponent 
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card">
                    <div class="card-body">
                    <h1 class="header-title"><center>Buat Pertanyaan Baru</center></h1><hr>
                    @if(count ($errors)>0)
                        @foreach($errors->all() as $error)
                            {{$error}}
                        @endforeach
                    @endif
                    <form class="form-horizontal" action="{{route('pertanyaan.store')}}" method="POST" enctype='multipart/form-data'>
                    @csrf
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label" for="simpleinput"> - Judul Pertanyaan</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" name="judul" placeholder="Masukkan Nama Perusahaan Loker">
                                </div>
                            </div>
                            <div class="form-group row">
                    <label class="col-lg-2 col-form-label" for="simpleinput">Tags Pertanyaan</label>
                    <div class="col-lg-5">
                        <select class="select2 form-control select2-multiple" name="tags[]" data-toggle="select2" multiple="multiple">
                            @foreach ($tag as $result)
                                <option value="{{$result->id}}">{{$result->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>   
                        <div class="form-group row">
                            <label class="col-lg-5 col-form-label" for="simpleinput"> - Isi Pertanyaan</label>
                            <div class="col-lg-12">
                                <textarea class="form-control" name="isi" id="profile"></textarea>
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
@include('sweetalert::alert')
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    CKEDITOR.replace( 'profile' );
</script>

@endsection