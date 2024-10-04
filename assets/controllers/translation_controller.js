import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['translation'];

    connect() {
        console.log('Stimulus controller connected');
    }

    toggleLanguage() {
        const currentRoute = window.location.pathname;
        console.log('Current route:', currentRoute);
        const newRoute = currentRoute.startsWith('/fr/')
            ? currentRoute.replace(/^\/fr/, '/en')
            : currentRoute.replace(/^\/en/, '/fr');
        window.location.href = newRoute;
    }
}