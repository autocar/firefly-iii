<?php

namespace FireflyIII\Http\Requests;

use Auth;
use FireflyIII\Models\Account;

/**
 * Class ProfileFormRequest
 *
 * @package FireflyIII\Http\Requests
 */
class ProfileFormRequest extends Request
{
    /**
     * @return bool
     */
    public function authorize()
    {
        // Only allow logged in users
        return Auth::check();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'current_password'               => 'required',
            'new_password'              => 'required|confirmed',
            'new_password_confirmation' => 'required',
        ];
    }
}