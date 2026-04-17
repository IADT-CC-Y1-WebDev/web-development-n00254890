class SavingsAccount extends BankAccount {
    constructor(num, name, bal, rate) {
        super(num, name, bal);
        this.interestRate = rate;
    }

    // Override toString()
    toString() {
        let rate = this.interestRate * 100;
        return `Savings Account: ${this.number}, Name: ${this.name}, ` +
               `Balance: €${this.balance}, Interest: ${rate}%`;
    }
}