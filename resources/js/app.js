import Alpine from 'alpinejs';
import AOS from 'aos';
import 'aos/dist/aos.css';
import { initFlowbite } from 'flowbite';
import 'animate.css';
import './efectos.js';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    AOS.init({
        duration: 800,
        easing: 'ease-out-cubic',
        once: true,
        offset: 80,
    });
    initFlowbite();
});

// Re-init Flowbite cuando Alpine renderiza dropdowns dinámicos
document.addEventListener('alpine:initialized', () => initFlowbite());
