<?php

/**
 * Class PreferencesController
 *
 * @SuppressWarnings("CyclomaticComplexity") // It's all 5. So ok.
 *
 */
class PreferencesController extends BaseController
{
    /**
     *
     */
    public function __construct()
    {

        View::share('title', 'Preferences');
        View::share('mainTitleIcon', 'fa-gear');
    }

    /**
     * @return $this|\Illuminate\View\View
     */
    public function index()
    {
        /** @var \FireflyIII\Database\Account\Account $acct */
        $acct = App::make('FireflyIII\Database\Account\Account');

        /** @var \FireflyIII\Shared\Preferences\Preferences $preferences */
        $preferences = App::make('FireflyIII\Shared\Preferences\Preferences');

        $accounts       = $acct->getAssetAccounts();
        $viewRange      = $preferences->get('viewRange', '1M');
        $viewRangeValue = $viewRange->data;
        $frontPage      = $preferences->get('frontpageAccounts', []);
        $budgetMax      = $preferences->get('budgetMaximum', 1000);
        $budgetMaximum  = $budgetMax->data;

        return View::make('preferences.index', compact('budgetMaximum'))->with('accounts', $accounts)->with('frontpageAccounts', $frontPage)->with(
            'viewRange', $viewRangeValue
        );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postIndex()
    {
        /** @var \FireflyIII\Shared\Preferences\Preferences $preferences */
        $preferences = App::make('FireflyIII\Shared\Preferences\Preferences');

        // frontpage accounts
        $frontpageAccounts = [];
        foreach (Input::get('frontpageAccounts') as $id) {
            $frontpageAccounts[] = intval($id);
        }
        $preferences->set('frontpageAccounts', $frontpageAccounts);

        // view range:
        $preferences->set('viewRange', Input::get('viewRange'));
        // forget session values:
        Session::forget('start');
        Session::forget('end');
        Session::forget('range');

        // budget maximum:
        $budgetMaximum = intval(Input::get('budgetMaximum'));
        $preferences->set('budgetMaximum', $budgetMaximum);


        Session::flash('success', 'Preferences saved!');

        return Redirect::route('preferences');
    }

} 