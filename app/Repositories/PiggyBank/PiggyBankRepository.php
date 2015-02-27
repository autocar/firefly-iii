<?php

namespace FireflyIII\Repositories\PiggyBank;

use FireflyIII\Models\PiggyBank;
use FireflyIII\Models\PiggyBankRepetition;
use Illuminate\Support\Collection;
use Navigation;

/**
 * Class PiggyBankRepository
 *
 * @package FireflyIII\Repositories\PiggyBank
 */
class PiggyBankRepository implements PiggyBankRepositoryInterface
{

    /**
     * @param array $data
     *
     * @return PiggyBank
     */
    public function store(array $data)
    {

        $piggyBank = PiggyBank::create($data);

        return $piggyBank;
    }

    /**
     * @param PiggyBank $account
     * @param array     $data
     *
     * @return PiggyBank
     */
    public function update(PiggyBank $piggyBank, array $data)
    {
        /**
        'rep_length'   => $request->get('rep_length'),
        'rep_every'    => intval($request->get('rep_every')),
        'rep_times'    => intval($request->get('rep_times')),
        'remind_me'    => intval($request->get('remind_me')) == 1 ? true : false ,
        'reminder'     => $request->get('reminder'),
         */

        $piggyBank->name         = $data['name'];
        $piggyBank->account_id   = intval($data['account_id']);
        $piggyBank->targetamount = floatval($data['targetamount']);
        $piggyBank->targetdate   = $data['targetdate'];
        $piggyBank->reminder     = $data['reminder'];
        $piggyBank->rep_length   = isset($data['rep_length']) ? $data['rep_length'] : null;
        $piggyBank->rep_every    =isset($data['rep_every']) ? $data['rep_every'] : null;
        $piggyBank->rep_times    = isset($data['rep_times']) ? $data['rep_times'] : null;
        $piggyBank->remind_me    = isset($data['remind_me']) ? $data['remind_me'] : null;

        $piggyBank->save();
        return $piggyBank;
    }

    /**
     * @SuppressWarnings("CyclomaticComplexity") // It's exactly 5. So I don't mind.
     *
     * Based on the piggy bank, the reminder-setting and
     * other variables this method tries to divide the piggy bank into equal parts. Each is
     * accommodated by a reminder (if everything goes to plan).
     *
     * @param PiggyBankRepetition $repetition
     *
     * @return Collection
     */
    public function calculateParts(PiggyBankRepetition $repetition)
    {
        /** @var PiggyBank $piggyBank */
        $piggyBank    = $repetition->piggyBank()->first();
        $bars         = new Collection;
        $currentStart = clone $repetition->startdate;

        if (is_null($piggyBank->reminder)) {
            $entry = ['repetition'    => $repetition, 'amountPerBar' => floatval($piggyBank->targetamount),
                      'currentAmount' => floatval($repetition->currentamount), 'cumulativeAmount' => floatval($piggyBank->targetamount),
                      'startDate'     => clone $repetition->startdate, 'targetDate' => clone $repetition->targetdate];
            $bars->push($this->createPiggyBankPart($entry));

            return $bars;
        }

        while ($currentStart < $repetition->targetdate) {
            $currentTarget = Navigation::endOfX($currentStart, $piggyBank->reminder, $repetition->targetdate);
            $entry         = ['repetition'       => $repetition, 'amountPerBar' => null, 'currentAmount' => floatval($repetition->currentamount),
                              'cumulativeAmount' => null, 'startDate' => $currentStart, 'targetDate' => $currentTarget];
            $bars->push($this->createPiggyBankPart($entry));
            $currentStart = clone $currentTarget;
            $currentStart->addDay();

        }
        $amountPerBar = floatval($piggyBank->targetamount) / $bars->count();
        $cumulative   = $amountPerBar;
        /** @var PiggyBankPart $bar */
        foreach ($bars as $index => $bar) {
            $bar->setAmountPerBar($amountPerBar);
            $bar->setCumulativeAmount($cumulative);
            if ($bars->count() - 1 == $index) {
                $bar->setCumulativeAmount($piggyBank->targetamount);
            }
            $cumulative += $amountPerBar;
        }

        return $bars;
    }

    /**
     * @param array $data
     *
     * @return PiggyBankPart
     */
    public function createPiggyBankPart(array $data)
    {
        $part = new PiggyBankPart;
        $part->setRepetition($data['repetition']);
        $part->setAmountPerBar($data['amountPerBar']);
        $part->setCurrentamount($data['currentAmount']);
        $part->setCumulativeAmount($data['cumulativeAmount']);
        $part->setStartdate($data['startDate']);
        $part->setTargetdate($data['targetDate']);

        return $part;
    }
}