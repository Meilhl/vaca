<?php
function verifMail ($mail) 
{
	if (preg_match ('/^[a-zA-Z0-9_]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$]/i', $mail ) ) {
		return false;
	}
	list ($nom, $domaine) = explode ('@', $mail);
	if (getmxrr ($domaine, $mxhosts))  {
		return true;
	} else {
		return false;
	} 
} 
?>