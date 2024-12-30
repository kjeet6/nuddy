import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
function toggleCarret() {
    const carretSidebar = document.getElementById('carret-sidebar');
    carretSidebar.classList.toggle('translate-x-full');
}


Alpine.start();
