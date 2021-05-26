import {Controller} from 'stimulus';


export default class extends Controller {
    connect() {
    }

    remove() {
        this.element.remove();
    }
}
