<?php namespace FireflyIII\Http\Controllers;

use Auth;
use FireflyIII\Http\Requests;
use FireflyIII\Http\Requests\ProfileFormRequest;
use Hash;
use Redirect;
use Session;

/**
 * Class ProfileController
 *
 * @package FireflyIII\Http\Controllers
 */
class ProfileController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function changePassword()
    {
        return view('profile.change-password')->with('title', Auth::user()->email)->with('subTitle', 'Change your password')->with(
            'mainTitleIcon', 'fa-user'
        );
    }

    /**
     * @return \Illuminate\View\View
     *
     */
    public function index()
    {
        return view('profile.index')->with('title', 'Profile')->with('subTitle', Auth::user()->email)->with('mainTitleIcon', 'fa-user');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function postChangePassword(ProfileFormRequest $request)
    {
        // old, new1, new2
        if (!Hash::check($request->get('current_password'), Auth::user()->password)) {
            Session::flash('error', 'Invalid current password!');

            return Redirect::route('change-password');
        }
        $result = $this->_validatePassword($request->get('current_password'), $request->get('new_password'), $request->get('new_password_confirmation'));
        if (!($result === true)) {
            Session::flash('error', $result);

            return Redirect::route('change-password');
        }

        // update the user with the new password.
        Auth::user()->password = $request->get('new_password');
        Auth::user()->save();

        Session::flash('success', 'Password changed!');

        return Redirect::route('profile');
    }

    /**
     * @SuppressWarnings("CyclomaticComplexity") // It's exactly 5. So I don't mind.
     *
     * @param string $old
     * @param string $new1
     * @param string $new2
     *
     * @return string|bool
     */
    protected function _validatePassword($old, $new1, $new2)
    {
        if (strlen($new1) == 0 || strlen($new2) == 0) {
            return 'Do fill in a password!';

        }
        if ($new1 == $old) {
            return 'The idea is to change your password.';
        }

        if ($new1 !== $new2) {
            return 'New passwords do not match!';
        }

        return true;

    }
}
