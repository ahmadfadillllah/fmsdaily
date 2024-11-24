@if (session('success'))
    <script>
        Swal.fire(
        'Good job!',
        '{{ session('success') }}',
        'success'
        )
    </script>
@endif

@if (session('info'))
    <script>
        Swal.fire(
        'Upps!',
        '{{ session('info') }}',
        'info'
        )
    </script>
@endif

@if (session('alert'))
    <script>
        function showNotification(message) {
            const notifier = document.getElementById("notifier");
            const notificationMessage = document.getElementById("notification-message");
            notificationMessage.innerText = message;
            notifier.classList.add("show");
            setTimeout(() => {
                notifier.classList.add("hide");
                setTimeout(() => {
                    notifier.classList.remove("show", "hide");
                }, 500);
            }, 3000);
        }

        document.addEventListener("DOMContentLoaded", function () {
            showNotification("Selamat datang, {{ Auth::user()->name }}!");
        });
    </script>
@endif
