window.onload = init;
function init() {
    //
}

function checkConfirm(text) {
    if(confirm(text)) {
        return true;
    } else {
        return false;
    }
}

function validName(names) {
	if(names.value.length <= 3) {
		names.style.border = "2px solid #FF0000";
		document.getElementById('form'+names.name).innerHTML = "TwĂłj nick jest zbyt krĂłtki!";
	} else {
		names.style.border = "2px solid #008000";
		document.getElementById('form'+names.name).innerHTML = "";
	}
}

function validEmail(email) {
	var regexps = /^([a-zA-Z0-9])+([.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-]+)+/
	if(regexps.test(email.value)) {
		email.style.border = "2px solid #008000";
		document.getElementById('form'+email.name).innerHTML = "";
	} else {
		email.style.border = "2px solid #FF0000";	
		document.getElementById('form'+email.name).innerHTML = "TwĂłj email jest nieprawidĹ‚owy!";
	}
}

function validPassword(pass) {
	if(pass.value.length <= 5) {
		pass.style.border = "2px solid #FF0000";
		document.getElementById('form'+pass.name).innerHTML = "Twoje hasĹ‚o jest zbyt krĂłtkie!";
	} else {
		pass.style.border = "2px solid #008000";
		document.getElementById('form'+pass.name).innerHTML = "";
	}
}

function validPassword2(pass2) {
	if(pass2.value != document.forms['register'].pass1.value) {
		pass2.style.border = "2px solid #FF0000";
		document.getElementById('form'+pass2.name).innerHTML = "Podane hasĹ‚a nie zgadzajÄ… siÄ™!";
	} else {
		pass2.style.border = "2px solid #008000";
		document.getElementById('form'+pass2.name).innerHTML = "";
	}
}