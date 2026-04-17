import Canine from "Canine.js";

class Wolf extends Canine {
    constructor(name, age){
        super(name, age);
    }

    makeNoise(){
        return `${this.name} howls `;
    }

    sleep(){
        return `${this.name} is sleeping`;
    }
}

export default Wolf;