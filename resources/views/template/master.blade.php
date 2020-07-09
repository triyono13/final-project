@include('template.partial.head')
        <!-- Navigation Bar-->
        @include('template.partial.navbar')
        <!-- End Navigation Bar-->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        @yield('content')
        <!-- end wrapper -->

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        

        <!-- Footer Start -->
        @include('template.partial.footer')
        <!-- end Footer -->
        
    </body>
</html>