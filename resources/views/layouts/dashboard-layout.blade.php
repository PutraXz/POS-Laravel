<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poslite</title>
    @vite(['resources/js/app.js'])
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
    <link href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .main-content {
            margin-left: var(--sidebar-width);
            margin-right: 0;
        }
    </style>
</head>

<body>

    <div class="main-content" id="mainContent">
        <main class="container-fluid py-4 px-4">
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
    @stack('script')
</body>

</html>
