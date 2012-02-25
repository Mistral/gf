<?php
class checkLoginFilterPRE { // name of filter PRE before execute action

	public function run() { // method name must be "run" otherwise filter arent good work
		if(gfFW::Session()->isLogin()) {
			gfFW::Session()->setSessionValue('flash', 'You already logged in system. You can\'t use this section of web.');
			gfFW::Router()->setOpen('user', 'index', array()); // redirect, this filter need login = 1 and user must be logged in system. This method redirect user to action of login. 		
		} else {
			return true;
		}
	}
	
}
