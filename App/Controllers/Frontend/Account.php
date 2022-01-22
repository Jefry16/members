<?php

namespace App\Controllers\Frontend;

use App\Modules\Auth;
use Core\View;

/**
 * Ajax controller
 *
 * PHP version 7.0
 */
class Account extends \Core\Controller
{
    public function resetPasswordAction()
    {
        View::renderTemplate('Frontend/Statico/reset-password.html');
    }

    public function sendResetAction()
    {
        $this->redirectIfNotRequestMethod('POST', '/account/reset-password');
        echo 'Todo: send email if any';
    }

    public function changePasswordAction()
    {
        $this->redirectWhenAdminOrUserNotLoggedIn();
        View::renderTemplate('Frontend/Statico/change-password.html');
    }

    public function sendChangeAction()
    {
        var_dump($_SESSION);
    }
}
