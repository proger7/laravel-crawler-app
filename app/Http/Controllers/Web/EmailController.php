<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;


class EmailController extends Controller
{

	/**
	 * send email
	 * @return string
	 */
    public function sendEmail()
    {
		$emailJob = new SendEmailJob();
		dispatch($emailJob);
        echo __('account.success_email');
    }

}
