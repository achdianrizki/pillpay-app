@if (session('success') || session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                setTimeout(() => {
                    window.notyf?.success(@json(session('success')));
                }, 1000);
            @endif

            @if (session('error'))
                setTimeout(() => {
                    window.notyf?.error(@json(session('error')));
                }, 1000);
            @endif
        });
    </script>
@endif
