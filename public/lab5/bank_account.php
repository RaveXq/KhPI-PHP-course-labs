<?php

require_once 'account_interface.php';

class BankAccount implements AccountInterface {
    const MIN_BALANCE = 0;

    protected $balance;
    protected $currency;

    public function __construct($initialBalance, $currency = "UAH") {
        $this->balance = $initialBalance;
        $this->currency = $currency;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function deposit($amount) {
        if ($amount <= 0) {
            throw new Exception("Помилка: сума поповнення не може бути негативною.");
        }
        $this->balance += $amount;
        echo "Рахунок поповнено на {$amount} {$this->currency}.</p>";
    }

    public function withdraw($amount) {
        if ($amount <= 0) {
            throw new Exception("Помилка: сума для зняття не може бути негативною.");
        }

        $newBalance = $this->balance - $amount;
        if ($newBalance < self::MIN_BALANCE) {
            throw new Exception("Помилка: недостатньо коштів для зняття {$amount} {$this->currency}.");
        }
        
        $this->balance = $newBalance;
        echo "З рахунку знято {$amount} {$this->currency}.</p>";
    }
}