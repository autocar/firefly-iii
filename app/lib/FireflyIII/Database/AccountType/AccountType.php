<?php

namespace FireflyIII\Database\AccountType;

use FireflyIII\Database\CommonDatabaseCallsInterface;
use FireflyIII\Database\CUDInterface;
use FireflyIII\Exception\FireflyException;
use FireflyIII\Exception\NotImplementedException;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Collection;

/**
 * Class AccountType
 *
 * @package FireflyIII\Database
 */
class AccountType implements CUDInterface, CommonDatabaseCallsInterface
{

    /**
     * @param Eloquent $model
     *
     * @return bool
     * @throws NotImplementedException
     */
    public function destroy(Eloquent $model)
    {
        throw new NotImplementedException;
    }

    /**
     * @param array $data
     *
     * @return \Eloquent
     * @throws NotImplementedException
     */
    public function store(array $data)
    {
        throw new NotImplementedException;
    }

    /**
     * @param Eloquent $model
     * @param array    $data
     *
     * @return bool
     * @throws NotImplementedException
     */
    public function update(Eloquent $model, array $data)
    {
        throw new NotImplementedException;
    }

    /**
     * Validates an array. Returns an array containing MessageBags
     * errors/warnings/successes.
     *
     * @param array $model
     *
     * @return array
     * @throws NotImplementedException
     */
    public function validate(array $model)
    {
        throw new NotImplementedException;
    }

    /**
     * Returns an object with id $id.
     *
     * @param int $objectId
     *
     * @return \Eloquent
     * @throws NotImplementedException
     */
    public function find($objectId)
    {
        throw new NotImplementedException;
    }

    /**
     * Finds an account type using one of the "$what"'s: expense, asset, revenue
     *
     * @param $what
     *
     * @return \AccountType|null
     * @throws FireflyException
     */
    public function findByWhat($what)
    {
        switch ($what) {
            case 'expense':
                return \AccountType::whereType('Expense account')->first();
                break;
            case 'asset':
                return \AccountType::whereType('Asset account')->first();
                break;
            case 'revenue':
                return \AccountType::whereType('Revenue account')->first();
                break;
            case 'cash':
                return \AccountType::whereType('Cash account')->first();
                break;
            case 'initial':
                return \AccountType::whereType('Initial balance account')->first();
                break;
            default:
                throw new FireflyException('Cannot find account type described as "' . e($what) . '".');
                break;

        }
    }

    /**
     * Returns all objects.
     *
     * @return Collection
     * @throws NotImplementedException
     */
    public function get()
    {
        throw new NotImplementedException;
    }

    /**
     * @param array $ids
     *
     * @return Collection
     * @throws NotImplementedException
     */
    public function getByIds(array $ids)
    {
        throw new NotImplementedException;
    }
}
