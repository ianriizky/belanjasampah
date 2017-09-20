<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};
</script>
