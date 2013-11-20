<?php

  include('Header.tpl');
  include('Network.php');
  
  if(defined("SERVERDOWN_REASON")) die(SERVERDOWN_REASON);

  define('NAME_TO_LONG',    'Your Username may not be longer than 12 Characters');
  define('NAME_TO_SHORT',   'Your Username may not be shorter than 5 Characters');
  define('NAME_INVALID',    'Your Username may not contain | % " , ] [ or \'');
  define('NAME_SPECIFY',    'Please specify an Username');
  define('NAME_TAKEN',      'That Username is already taken');
  
  define('REFERER_INVALID', 'Referer\'s Username may not contain | % " , ] [ or \'');
  
  define('PASS_TO_LONG',    'Your Password may not be longer than 32 Characters');
  define('PASS_TO_SHORT',   'Your Password may not be shorter than 5 Characters');
  define('PASS_SPECIFY',    'Please specify a Password');
  define('PASS_WRONG',      'Passwords missmatch');
  
  define('NAME_INVALID',    'Your EMail may not contain | % " , ] [ or \'');

  $USERNAME = '';
  $PASSWORD = '';
  $COLOR    = 1;
  $EMAIL    = '';
  $REFERER  = '';

  if(!isset($_POST['register'])) include('RegristrationForm.tpl');
  
  $USERNAME = trim($_POST['playerName']);
  $PASSWORD = $_POST['playerPassword'];
  $COLOR    = $_POST['playerColor'];
  $EMAIL    = trim($_POST['playerMail']);
  $REFERER  = trim($_POST['referer']);
  
  checkUsername($USERNAME);
  checkReferer($REFERER);
  checkPassword($PASSWORD, $_POST['playerAgain']);
  checkColor($COLOR);
  checkEMail($EMAIL);
  
  checkAvailabilty($USERNAME);
  
  //How 'bout handling da Regristration here?
  
  include('RegristrationComplete.tpl');
  
  function handleError($func_error) {
    global $USERNAME, $PASSWORD, $COLOR, $EMAIL;
    
    define('ERROR', $func_error);
    include('RegristrationForm.tpl');
    
    return true;
  }
  
  function checkAvailabilty($func_username) {
    return true;
  }
  
  function checkUsername($func_username) {
    $func_length = strlen($func_username);
    
    if(!$func_length)     return handleError(NAME_SPECIFY);
    if($func_length > 12) return handleError(NAME_TO_LONG);
    if($func_length < 5)  return handleError(NAME_TO_SHORT);
    
    if(strpos($func_username, '|') !== false) return handleError(NAME_INVALID);
    if(strpos($func_username, '%') !== false) return handleError(NAME_INVALID);
    if(strpos($func_username, ',') !== false) return handleError(NAME_INVALID);
    if(strpos($func_username, "'") !== false) return handleError(NAME_INVALID);
    if(strpos($func_username, '"') !== false) return handleError(NAME_INVALID);
    if(strpos($func_username, '[') !== false) return handleError(NAME_INVALID);
    if(strpos($func_username, ']') !== false) return handleError(NAME_INVALID);
    
    return true;
  }
  
  function checkReferer($func_username) {
    $func_length = strlen($func_username);
    
    if(strpos($func_username, '|') !== false) return handleError(REFERER_INVALID);
    if(strpos($func_username, '%') !== false) return handleError(REFERER_INVALID);
    if(strpos($func_username, ',') !== false) return handleError(REFERER_INVALID);
    if(strpos($func_username, "'") !== false) return handleError(REFERER_INVALID);
    if(strpos($func_username, '"') !== false) return handleError(REFERER_INVALID);
    if(strpos($func_username, '[') !== false) return handleError(REFERER_INVALID);
    if(strpos($func_username, ']') !== false) return handleError(REFERER_INVALID);
    
    return true;
  }
  
  function checkPassword($func_password, $func_again) {
    $func_length = strlen($func_password);
    
    if(!$func_length)     return handleError(PASS_SPECIFY);
    if($func_length > 32) return handleError(PASS_TO_LONG);
    if($func_length < 5)  return handleError(PASS_TO_SHORT);
    
    if($func_password != $func_again) return handleError(PASS_WRONG);
    
    return true;
  }
  
  function checkColor($func_color) {
    return true;
  }
  
  function checkEMail($func_email) {
    if(strpos($func_email, '|') !== false) return handleError(MAIL_INVALID);
    if(strpos($func_email, '%') !== false) return handleError(MAIL_INVALID);
    if(strpos($func_email, ',') !== false) return handleError(MAIL_INVALID);
    if(strpos($func_email, "'") !== false) return handleError(MAIL_INVALID);
    if(strpos($func_email, '"') !== false) return handleError(MAIL_INVALID);
    if(strpos($func_email, '[') !== false) return handleError(MAIL_INVALID);
    if(strpos($func_email, ']') !== false) return handleError(MAIL_INVALID);
    
    return true;
  }

?>
