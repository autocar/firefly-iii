<?php namespace FireflyIII\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LimitRepetition
 *
 * @package FireflyIII\Models
 */
class LimitRepetition extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function budgetLimit()
    {
        return $this->belongsTo('FireflyIII\Models\BudgetLimit');
    }

    /**
     * @return array
     */
    public function getDates()
    {
        return ['created_at', 'updated_at', 'startdate', 'enddate'];
    }

    public function spentInRepetition()
    {
        $sum = \DB::table('transactions')
                  ->leftJoin('transaction_journals', 'transaction_journals.id', '=', 'transactions.transaction_journal_id')
                  ->leftJoin('budget_transaction_journal', 'budget_transaction_journal.transaction_journal_id', '=', 'transaction_journals.id')
                  ->leftJoin('budget_limits', 'budget_limits.budget_id', '=', 'budget_transaction_journal.budget_id')
                  ->leftJoin('limit_repetitions', 'limit_repetitions.budget_limit_id', '=', 'budget_limits.id')
                  ->where('transaction_journals.date', '>=', $this->startdate->format('Y-m-d'))
                  ->where('transaction_journals.date', '<=', $this->enddate->format('Y-m-d'))
                  ->where('transactions.amount', '>', 0)
                  ->where('limit_repetitions.id', '=', $this->id)
                  ->sum('transactions.amount');

        return floatval($sum);
    }

}
