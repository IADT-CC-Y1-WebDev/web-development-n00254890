class Car {
    constructor(_make, _model, _year, _color, _extras = []) { // 1. constructors 
        this.make = _make;
        this.model = _model;
        this.year = _year;
        this.color = _color;
        this.extras = _extras; //extras array
    }   
       getExtras() { // 2. method to return extras
        return this.extras;
    }

    toString(){
        return `
        Make: ${this.make}
        Model: ${this.model}
        Year: ${this.year}
        Colour: ${this.color}
        Extras: ${this.extras.join(", ")}
        `;
    }

}

export default Car;