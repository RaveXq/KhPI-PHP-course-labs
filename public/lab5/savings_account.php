<?php
require_once 'bank_account.php';

class SavingsAccount extends BankAccount {
    public static $interestRate = 5.0;

    public function applyInterest() {
        $interest = $this->balance * (self::$interestRate / 100);
        $this->balance += $interest;
        
        $formattedInterest = round($interest, 2);
        echo "Нараховано відсотки: +{$formattedInterest} {$this->currency} (ставка " . self::$interestRate . "%).</p>";
    }
}