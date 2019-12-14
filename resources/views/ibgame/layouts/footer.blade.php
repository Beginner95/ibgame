<!-- scripts -->
<script
        src="https://code.jquery.com/jquery-3.4.0.min.js"
        integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
        crossorigin="anonymous">
</script> <!-- jQuery -->
<script src='{{ asset(env('THEME')) }}/js/jquery.vide.js'></script>
<script src="{{ asset(env('THEME')) }}/js/main.js"></script> <!-- main scripts -->
@if (Request::route()->getName() == 'admin.index')
    <script src="{{ asset(env('THEME')) }}/js/admin_main.js"></script>
@endif
<!-- scripts -->
</body>
</html>