import Canine from "./Canine.js";

class Dog extends Canine {
    constructor(name, age){
        super(name, age);
    }

    makeNoise(){
        return `${this.name} barks`;
    }

    sleep(){
        return `${this.name} is sleeping`;
    }
}

export default Dog;