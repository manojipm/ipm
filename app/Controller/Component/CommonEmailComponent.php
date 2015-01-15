<?php

/**
 * Component for working common.

 */
class CommonEmailComponent extends Component {

    public $components = array('Session', 'Email');


    ################  Email send code ####################

    public function resetPassEmail($to, $sub, $userArr) {
        $email = new CakeEmail();
        $email->template('admin_password_reset', null);
        $email->emailFormat('html');
        $email->viewVars(array('users' => $userArr));
        $email->from(array(ADMIN_EMAIL => 'My dating Site'));
        $email->to($to);
        $email->subject($sub);
        $this->__sendEmail($email);
    }

    public function forgotPassEmail($to, $sub, $userArr) {
        $email = new CakeEmail();
        $email->template('admin_forgot_password', null);
        $email->emailFormat('html');
        $email->viewVars(array('users' => $userArr));
        $email->from(array(ADMIN_EMAIL => 'My dating Site'));
        $email->to($to);
        $email->subject($sub);
        $this->__sendEmail($email);
    }
    
    public function activationLinkEmail($to, $sub, $userArr) {
        $email = new CakeEmail();
        $email->template('account_activation_url', null);
        $email->emailFormat('html');
        $email->viewVars(array('users' => $userArr));
        $email->from(array(ADMIN_EMAIL => 'My dating Site'));
        $email->to($to);
        $email->subject($sub);
        $this->__sendEmail($email);
    }
	
	public function AgencyRegistration($ArrDetails = array()) {
		$to = ADMIN_EMAIL;
		$sub = 'Agency Registration';
        $email = new CakeEmail();
        $email->template('agency_registration', null);
        $email->emailFormat('html');
        $email->viewVars(array('ArrDetails' => $ArrDetails));
        $email->from(array('noreply@inlovebride.com' => 'InLoveBride'));
        $email->to($to);
        $email->subject($sub);
        $this->__sendEmail($email);
    }

    // Mail Send to Admin when agency register any girl profile
	public function AdminAgencyGirlProfileAdded($to, $sub, $userArr) {
        $email = new CakeEmail();
        $email->template('admin_girlprofile_added', null);
        $email->emailFormat('html');
        $email->viewVars(array('users' => $userArr));
        $email->from(array(ADMIN_EMAIL => 'InLoveBride'));
        $email->to($to);
        $email->subject($sub);
        $this->__sendEmail($email);
    }
	
	// Mail Send to Girl when agency register 
	public function GirlProfileMail($to, $sub, $userArr) {
        $email = new CakeEmail();
        $email->template('girlprofile', null);
        $email->emailFormat('html');
        $email->viewVars(array('users' => $userArr));
        $email->from(array(ADMIN_EMAIL => 'InLoveBride'));
        $email->to($to);
        $email->subject($sub);
        $this->__sendEmail($email);
    }
	
	
    public function __sendEmail($email) {
        if ($email->send())
            return true;
        else
            return false;
    }
   
    
    ################  Email send code ####################
    
}
