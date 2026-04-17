import Car from "./classes/Car.js";

let bmw = new Car('BMW', '5 Series', 2025, 'Green');
let audi = new Car('Audi', 'A4', 2024, 'Red', ['Sunroof', 'Leather Seats']);
let mercedes = new Car('Mercedes', 'C-Class', 2023, 'Black', ['Navigation System', 'Heated Seats']);

const myCarCollection = [bmw, audi, mercedes];

// 5. Loop through and call getExtras()
myCarCollection.forEach(car => {
    console.log(`Extras for ${car.make} ${car.model}:`, car.getExtras());
});