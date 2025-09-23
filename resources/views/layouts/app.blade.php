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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const cartSidebar = document.getElementById('cartSidebar');

            // Klik kartu produk -> add to cart
            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('click', async () => {
                    const id = card.dataset.id;
                    const res = await fetch(`{{ route('cart.add') }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            product_id: id
                        })
                    });
                    const data = await res.json();
                    if (data.ok) cartSidebar.innerHTML = data.html;
                    bindCartButtons(); // re-bind tombol +/−/hapus setelah render ulang
                });
            });

            function bindCartButtons() {
                // increment
                cartSidebar.querySelectorAll('.cart-inc').forEach(btn => {
                    btn.addEventListener('click', async (e) => {
                        const id = btn.dataset.id;
                        const qtyEl = cartSidebar.querySelector(`.cart-qty[data-id="${id}"]`);
                        const newQty = parseInt(qtyEl.textContent, 10) + 1;
                        await updateQty(id, newQty);
                    });
                });

                // decrement
                cartSidebar.querySelectorAll('.cart-dec').forEach(btn => {
                    btn.addEventListener('click', async (e) => {
                        const id = btn.dataset.id;
                        const qtyEl = cartSidebar.querySelector(`.cart-qty[data-id="${id}"]`);
                        const newQty = Math.max(1, parseInt(qtyEl.textContent, 10) - 1);
                        await updateQty(id, newQty);
                    });
                });

                // remove
                cartSidebar.querySelectorAll('.cart-remove').forEach(btn => {
                    btn.addEventListener('click', async (e) => {
                        const id = btn.dataset.id;
                        const res = await fetch(`{{ route('cart.remove') }}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                product_id: id
                            })
                        });
                        const data = await res.json();
                        if (data.ok) {
                            cartSidebar.innerHTML = data.html;
                            bindCartButtons();
                        }
                    });
                });
            }

            async function updateQty(id, qty) {
                const res = await fetch(`{{ route('cart.update') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: id,
                        qty
                    })
                });
                const data = await res.json();
                if (data.ok) {
                    cartSidebar.innerHTML = data.html;
                    bindCartButtons();
                }
            }

            // initial bind (kalau ada item dari session)
            bindCartButtons();
        });
    </script>

</body>

</html>
