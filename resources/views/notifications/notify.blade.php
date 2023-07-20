
@if( Session::get('success')  != null)
    <script>
        toastr.success("{{ Session::get('success') }}");
    </script>
@endif

@if ( Session::get('error')  != null)
    <script>
        toastr.error("{{ Session::get('error') }}");
    </script>
@endif
