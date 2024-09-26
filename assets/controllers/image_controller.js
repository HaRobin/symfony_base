import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['image', 'previewImage'];

    connect() {
        console.log('Stimulus controller connected');
    }

    selectSauce(event) {
        const sauceName = event.target.value;
        console.log(`Selected sauce: ${sauceName}`);
        this.selectedTarget.textContent = `Vous avez sélectionné : ${sauceName}`;
    }

    selectImage(event) {
        const selectedIndex = event.target.selectedIndex;
        const imageURL = event.target.options[selectedIndex].textContent;
        console.log('Previewing image | ', 'imageURL : ', imageURL);
        this.previewImageTarget.src = imageURL
    }
}