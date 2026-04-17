class CurrentAccount extends BankAccount {
    constructor(num, name, bal) {
        super(num, name, bal);
        this.transactionCount = 0;
    }

    deposit(amount) {
        this.transactionCount++;
        super.deposit(amount);
    }

    withdraw(amount) {
        this.transactionCount++;
        super.withdraw(amount);
    }

    getTransactionCount() {
        return this.transactionCount;
    }
}