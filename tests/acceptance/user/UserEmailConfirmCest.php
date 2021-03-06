<?php
namespace user;
use \WebGuy;

class UserEmailConfirmCest
{
    public function testEmailConfirm(WebGuy $I, $scenario)
    {
        $I = new WebGuy\UserSteps($scenario);
        $testMail = 'test2@yupe.local';
        $I->changeEmail($testMail);
        $key = $I->grabFromDatabase('yupe_user_user', 'activate_key', array('email' => $testMail));
        $I->amOnPage(\RecoveryPage::getConfirmRoute($key));
        $I->see('Вы успешно подтвердили новый e-mail!',\CommonPage::SUCCESS_CSS_CLASS);
        $I->seeInDatabase('yupe_user_user', array('email_confirm' => 1, 'email' => $testMail));
    }
}