import Feline from "./Feline.js";

class Cat extends Feline {
    constructor(name, age){
        super(name, age);
    }

    makeNoise(){
        return `${this.name} says meow `;
    }

    sleep(){
        return `${this.name} is sleeping `;
    }
}

export default Cat;