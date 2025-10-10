<?php

header('Content-Type: text/html; charset=utf-8');

require_once 'bank_account.php';
require_once 'savings_account.php';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Лабораторна робота №5</title>
</head>
<body>
    <div class="container">
        <h1>Тестування системи банківських рахунків</h1>

        <div class="account-block">
            <h3>Тестування звичайного рахунку (Bank Account)</h3>
            <?php
            $simpleAccount = new BankAccount(1000, 'UAH');
            echo "<p class='balance'>Початковий баланс: {$simpleAccount->getBalance()} {$simpleAccount->getCurrency()}</p>";

            try {
                $simpleAccount->deposit(500);
                $simpleAccount->withdraw(200);
            } catch (Exception $e) {
                echo "<div class='error'>Виняток: " . $e->getMessage() . "</div>";
            }
            echo "<p class='balance'>Баланс після операцій: {$simpleAccount->getBalance()} {$simpleAccount->getCurrency()}</p><hr>";


            echo "<h4>Спроба виконати некоректні операції:</h4>";
            try {
                // Спроба зняти більше, ніж є на рахунку
                $simpleAccount->withdraw(2000);
            } catch (Exception $e) {
                echo "<div class='error'>Виняток: " . $e->getMessage() . "</div>";
            }

            try {
                // Спроба поповнити на негативну суму
                $simpleAccount->deposit(-100);
            } catch (Exception $e) {
                echo "<div class='error'>Виняток: " . $e->getMessage() . "</div>";
            }
            echo "<p class='balance'>Кінцевий баланс: {$simpleAccount->getBalance()} {$simpleAccount->getCurrency()}</p>";
            ?>
        </div>

        <div class="account-block">
            <h3>Тестування накопичувального рахунку (Savings Account)</h3>
            <?php
            $savingsAccount = new SavingsAccount(5000, 'UAH');
            echo "<p class='balance'>Початковий баланс: {$savingsAccount->getBalance()} {$savingsAccount->getCurrency()}</p>";
            
            try {
                $savingsAccount->deposit(1000);
                $savingsAccount->applyInterest();
            } catch (Exception $e) {
                echo "<div class='error'>Виняток: " . $e->getMessage() . "</div>";
            }
            echo "<p class='balance'>Баланс після нарахування відсотків: {$savingsAccount->getBalance()} {$savingsAccount->getCurrency()}</p><hr>";

            echo "<h4>Зміна статичної відсоткової ставки і повторне нарахування:</h4>";
            SavingsAccount::$interestRate = 7.5;
            $savingsAccount->applyInterest();
            echo "<p class='balance'>Кінцевий баланс: {$savingsAccount->getBalance()} {$savingsAccount->getCurrency()}</p>";
            ?>
        </div>
    </div>
</body>
</html>