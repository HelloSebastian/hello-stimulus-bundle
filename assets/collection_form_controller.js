import {Controller} from 'stimulus';

export default class extends Controller {

    static targets = [
        "item",
        "holder"
    ];

    static values = {
        prototype: String
    };

    connect() {
        this.itemCount = this.itemTargets.length;
    }

    add() {
        let prototype = this.prototypeValue;
        prototype = prototype.replace(/__name__/g, this.itemCount);
        this.holderTarget.insertAdjacentHTML('beforeend', prototype);

        this.itemCount++;
    }
}
