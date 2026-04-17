import bank from "./classes/BankAccount.js";

let bank = new BankAccount("1111111111", "Alice", 100.00);
let savings = new SavingsAccount("2222222222", "Bob", 500.00, 0.05);
let current = new CurrentAccount("3333333333", "Charlie", 100.00);


current.deposit(50.00);
current.withdraw(20.00);
current.deposit(30.00);

console.log("Balance: €" + current.getBalance());
console.log("Transactions: " + current.getTransactionCount());
console.log(bank.toString());
console.log(savings.toString());
console.log(current.toString());