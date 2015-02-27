<?php

namespace FireflyIII\Support;

use Cache;
use FireflyIII\Models\Transaction;
use FireflyIII\Models\TransactionCurrency;
use Preferences as Prefs;

/**
 * Class Amount
 *
 * @package FireflyIII\Support
 */
class Amount
{
    /**
     * @param      $amount
     * @param bool $coloured
     *
     * @return string
     */
    public function format($amount, $coloured = true)
    {
        $currencySymbol = $this->getCurrencySymbol();

        return $this->formatWithSymbol($currencySymbol, $amount, $coloured);


    }

    /**
     * @param Transaction|\Transaction $transaction
     * @param bool                     $coloured
     *
     * @return string
     */
    public function formatTransaction(Transaction $transaction, $coloured = true)
    {
        $symbol = $transaction->transactionJournal->transactionCurrency->symbol;
        $amount = floatval($transaction->amount);

        return $this->formatWithSymbol($symbol, $amount, $coloured);


    }

    /**
     * @param string $symbol
     * @param float  $amount
     * @param bool   $coloured
     *
     * @return string
     */
    public function formatWithSymbol($symbol, $amount, $coloured = true)
    {
        $amount = floatval($amount);
        $amount = round($amount, 2);
        $string = number_format($amount, 2, ',', '.');

        if ($coloured === true) {
            if ($amount === 0.0) {
                return '<span style="color:#999">' . $symbol . ' ' . $string . '</span>';
            }
            if ($amount > 0) {
                return '<span class="text-success">' . $symbol . ' ' . $string . '</span>';
            }

            return '<span class="text-danger">' . $symbol . ' ' . $string . '</span>';
        }

        // &#8364;
        return $symbol . ' ' . $string;
    }


    /**
     * @return string
     */
    public function getCurrencySymbol()
    {
        if (defined('FFCURRENCYSYMBOL')) {
            return FFCURRENCYSYMBOL;
        }
        if (\Cache::has('FFCURRENCYSYMBOL')) {
            define('FFCURRENCYSYMBOL', \Cache::get('FFCURRENCYSYMBOL'));

            return FFCURRENCYSYMBOL;
        }

        $currencyPreference = Prefs::get('currencyPreference', 'EUR');
        $currency           = TransactionCurrency::whereCode($currencyPreference->data)->first();

        \Cache::forever('FFCURRENCYSYMBOL', $currency->symbol);

        define('FFCURRENCYSYMBOL', $currency->symbol);

        return $currency->symbol;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        if (defined('FFCURRENCYCODE')) {
            return FFCURRENCYCODE;
        }
        if (Cache::has('FFCURRENCYCODE')) {
            define('FFCURRENCYCODE', Cache::get('FFCURRENCYCODE'));

            return FFCURRENCYCODE;
        }


        $currencyPreference = Prefs::get('currencyPreference', 'EUR');
        $currency           = TransactionCurrency::whereCode($currencyPreference->data)->first();

        \Cache::forever('FFCURRENCYCODE', $currency->code);

        define('FFCURRENCYCODE', $currency->code);

        return $currency->code;
    }

    public function getDefaultCurrency()
    {
        $currencyPreference = Prefs::get('currencyPreference', 'EUR');
        $currency           = TransactionCurrency::whereCode($currencyPreference->data)->first();

        return $currency;
    }
}