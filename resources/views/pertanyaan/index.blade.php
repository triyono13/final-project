@extends('template.master')

@section('content')
<div class="wrapper">
    <div class="container-fluid">

        <!-- start page title -->
        @component('components.breadcrumb')
            @slot('title') Homepage   @endslot
            @slot('title_li') Home   @endslot
        @endcomponent 
        <!-- end page title --> 

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="header-title"><center>Recent Question</center></h1><hr>
                        <a href="{{route('pertanyaan.create')}}" class="btn btn-success btn-sm waves-effect waves-light">Buat Pertanyaan Baru</a><br><br>
                        <div class="table-responsive mt-3">
                            <table class="table table-hover table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Judul Pertanyaan</th>
                                        <th>Tags</th>
                                        <th>Created Date</th>
                                        <th>Updated Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @foreach ($pertanyaan as $result => $hasil)
                                    <td>{{$result + $pertanyaan -> firstitem()}}</td>
                                    <td><a href="#">{{$hasil->judul}}</a></td>
                                    <td>#</td>
                                    <td>{{$hasil->created_at}}</td>
                                    <td>{{$hasil->updated_at}}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row --> 
        
    </div> <!-- end container-fluid -->
</div>
@endsection