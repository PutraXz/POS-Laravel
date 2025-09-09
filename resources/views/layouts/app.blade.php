<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poslite</title>
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>

    <div class="main-content @yield('main_mod')" id="mainContent">
        <main class="container-fluid py-4">
            @yield('content')
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebarLeft = document.getElementById('sidebarLeft');
            const overlay = document.getElementById('sidebarOverlay');
            const openBtn = document.getElementById('sidebarToggleOutside');
            const closeBtn = document.getElementById('sidebarToggleInside');

            const open = () => {
                sidebarLeft.classList.add('show');
                overlay.classList.add('active');
            }
            const close = () => {
                sidebarLeft.classList.remove('show');
                overlay.classList.remove('active');
            }

            openBtn?.addEventListener('click', open);
            closeBtn?.addEventListener('click', close);
            overlay?.addEventListener('click', close);
        });
    </script>
</body>

</html>
