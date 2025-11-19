<!DOCTYPE html>
<html lang="id">



@include('components.page.head')
<!-- page wrapper -->

<body>
 
  <!-- main-area -->
    @include('components.page.header')
    @yield('content')
  @include('components.page.footer')
</body><!-- End of .page_wrapper -->


@include('components.page.script')

</html>