
class Animal {
    constructor(name, age) {
        this.name = name;  
        this.age = age;     
    }
    sleep() {
        return `${this.name} is sleeping.`;
    }       
    makeNoise() {    
        return `${this.name} says Meow!`;
    }
    roam () {   
        return `${this.name} is roaming around.`;
    }
}

export default Animal;