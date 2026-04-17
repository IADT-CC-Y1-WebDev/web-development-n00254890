import Feline from "Feline.js";

class Lion extends Feline {
    constructor(name, age){
        super(name, age);
    }

    makeNoise(){
        return `${this.name} roars `;
    }

    sleep(){
        return `${this.name} is sleeping `;
    }
}

export default Lion;