<?php

namespace App\Controllers\Frontend;

use App\Config;
use App\Models\Account as ModelsAccount;

use App\Modules\Auth;
use App\Modules\Flashmessage;

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
        $this->redirectWhenNotLoggedIn(Config::$member_type);

        View::renderTemplate('Frontend/Statico/change-password.html');
    }

    public function sendChangeAction()
    {
        $this->redirectWhenNotLoggedIn(Config::$member_type);

        $user = ModelsAccount::findById();

        $userAccount = new ModelsAccount($_POST);

        if ($user && password_verify($_POST['cpassword'], $user->pass)) {
            if ($userAccount->save()) {
                Flashmessage::set('Your new password has been set correctly', Flashmessage::SUCCESS);
                $this->redirect('/');
            } else {
                Flashmessage::set($userAccount->errors['password'], Flashmessage::FAIL);
                View::renderTemplate('Frontend/Statico/change-password.html');
            }
        } else {
            Flashmessage::set('Invalid current password', Flashmessage::FAIL);
            View::renderTemplate('Frontend/Statico/change-password.html');
        }

    }
}
