<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/helpers.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

<script>
    userNotification("{{ session('message') }}", "{{ session('type') }}")
</script>
