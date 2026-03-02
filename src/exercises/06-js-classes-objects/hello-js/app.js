
let user = {
    firstName: "John",
    lastName: "Jones",
    age: 32,
    hobbies: ["Gym", "Movies"],
    friends: [
        {
        firstName: "Tim",
        lastName: "Murphy",
        age: 25,
        },
        {
        firstName: "Jake",
        lastName: "Walsh",
        age: 28,
        }
    ],
};

let donuts = ["Cholcolate", "Jam", "Custard"];

donuts.forEach((donut, i) => {
// console.log((i + 1) + " " + donut);
console.log(`Option ${i+1}: ${donut}`);  //string interpolation

});
