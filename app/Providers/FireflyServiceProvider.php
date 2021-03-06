<?php

namespace FireflyIII\Providers;

use FireflyIII\Support\Amount;
use FireflyIII\Support\ExpandedForm;
use FireflyIII\Support\Navigation;
use FireflyIII\Support\Preferences;
use FireflyIII\Support\Steam;
use FireflyIII\Validation\FireflyValidator;
use Illuminate\Support\ServiceProvider;
use Validator;

/**
 * Class FireflyServiceProvider
 *
 * @package FireflyIII\Providers
 */
class FireflyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::resolver(
            function ($translator, $data, $rules, $messages) {
                return new FireflyValidator($translator, $data, $rules, $messages);
            }
        );
    }

    public function register()
    {
        $this->app->bind(
            'preferences', function () {
            return new Preferences;
        }
        );
        $this->app->bind(
            'navigation', function () {
            return new Navigation;
        }
        );
        $this->app->bind(
            'amount', function () {
            return new Amount;
        }
        );

        $this->app->bind(
            'steam', function () {
            return new Steam;
        }
        );
        $this->app->bind(
            'expandedform', function () {
            return new ExpandedForm;
        }
        );

        $this->app->bind('FireflyIII\Repositories\Account\AccountRepositoryInterface', 'FireflyIII\Repositories\Account\AccountRepository');
        $this->app->bind('FireflyIII\Repositories\Budget\BudgetRepositoryInterface', 'FireflyIII\Repositories\Budget\BudgetRepository');
        $this->app->bind('FireflyIII\Repositories\Category\CategoryRepositoryInterface', 'FireflyIII\Repositories\Category\CategoryRepository');
        $this->app->bind('FireflyIII\Repositories\Journal\JournalRepositoryInterface', 'FireflyIII\Repositories\Journal\JournalRepository');
        $this->app->bind('FireflyIII\Repositories\Bill\BillRepositoryInterface', 'FireflyIII\Repositories\Bill\BillRepository');
        $this->app->bind('FireflyIII\Repositories\PiggyBank\PiggyBankRepositoryInterface', 'FireflyIII\Repositories\PiggyBank\PiggyBankRepository');
        $this->app->bind('FireflyIII\Support\Search\SearchInterface', 'FireflyIII\Support\Search\Search');

        $this->app->bind('FireflyIII\Helpers\Report\ReportHelperInterface', 'FireflyIII\Helpers\Report\ReportHelper');
        $this->app->bind('FireflyIII\Helpers\Report\ReportQueryInterface', 'FireflyIII\Helpers\Report\ReportQuery');

    }

}