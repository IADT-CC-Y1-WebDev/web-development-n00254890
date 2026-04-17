import Cat from "./classes/Cat.js";
import Dog from "./classes/Dog.js";
import Lion from "./classes/Lion.js";
import Wolf from "./classes/Wolf.js";

let cat1 = new Cat("Tom", 2);
let dog1 = new Dog("Rover", 3);
let lion1 = new Lion("Tony", 5);
let wolf1 = new Wolf("Wolfie", 7);

let animals = [cat1, dog1, lion1, wolf1];

animals.forEach((animal) => {
  animal.makeNoise();
  animal.roam();
  animal.sleep();

  console.log("==========");
});