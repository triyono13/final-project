@extends('template.master')

@section('content')
<div class="wrapper">
    <div class="container-fluid">

        <!-- start page title -->
        @component('components.breadcrumb')
            @slot('title') User   @endslot
            @slot('title_li') User   @endslot
        @endcomponent 
        <!-- end page title --> 

        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <a href="index.html">
                                <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                            </a>
                            <p class="text-muted mb-4 mt-3">Larahub Profile Detail</p>
                        </div>

                        <div class="text-center w-75 m-auto">
                            <img src="assets/images/users/avatar-1.jpg" height="88" alt="user-image" class="rounded-circle shadow-sm">
                            <h4 class="text-dark-50 text-center mt-2">I'm {{$user->name}} </h4>
                            <p>Reputasi : {{$user->reputasi}} Point</p>
                        </div>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end row --> 
        
    </div> <!-- end container-fluid -->
</div>
@endsection