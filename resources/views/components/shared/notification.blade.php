@if (session('message'))
    @include('components.shared.message')
@endif

@if (session('error'))
    @include('components.shared.error')
@endif

@push('scripts')
    <script>
        function closeNotification() {
            const notification = document.getElementById('notification');
            if (notification) {
                notification.style.display = 'none';
            }
        }

        setTimeout(() => {
            closeNotification();
        }, 3000);
    </script>
@endpush
