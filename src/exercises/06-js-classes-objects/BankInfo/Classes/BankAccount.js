export default class BankAccount {
    constructor(num, name, bal) {
        this.number = num;
        this.name = name;
        this.balance = bal;
    }

    deposit(amount) {
        this.balance += amount;
    }

    withdraw(amount) {
        this.balance -= amount;
    }

    getBalance() {
        return this.balance;
    }

    toString() {
        return `Account: ${this.number}, Name: ${this.name}, Balance: €${this.balance}`;
    }
}