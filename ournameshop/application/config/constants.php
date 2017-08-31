<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


define('URL_PAGE_SUFFIX', 'page-');
define('OAUTH_PROVIDER_FB', 1);


define('ORDER_STATUS_UNPAID', 1);
define('ORDER_STATUS_PAID', 2);
define('ORDER_STATUS_SHIPPED', 3);
define('ORDER_STATUS_REFUNDED', 4);


define('PRINT_PROVIDER_PRINT_AURA', 1);



define('PAY_METHOD_PP', 1);
define('PAY_METHOD_STRIPE', 2);

define('LNAME_REQ_STATUS_PENDING', 1);
define('LNAME_REQ_STATUS_ACCEPTED', 2);
define('LNAME_REQ_STATUS_REJECTED', 3);

define('TEMPLATE_OPTION_MONOCHROME', 1);

define('CURL_SSLVERSION_TLSv1', 'TLSv1.x');

define('STORE_ADMIN_URL_PREFIX', 'manage');


define('GROUP_ID_SUPER_ADMIN', 1);
define('GROUP_ID_CUSTOMER', 2);
define('GROUP_ID_STORE_OWNER', 3);


define('IMG_THUMB_PREFIX', 'th_');
define('IMG_ORIG_PREFIX', 'orig');
define('IMG_FANCY_PREFIX', '_');


define('CART_ITEM_OPTION_DIGITAL', 1);

define('PA_PHONE_CASE_TYPE_ID', 11);



define('INDEX_SLIDER_BESTSELLERS', 1);
define('INDEX_SLIDER_POPULAR', 2);
define('INDEX_SLIDER_NUM', 12);



define('CAMPAIGN_OPTION_AUTO_RESTART', 1);
define('CAMPAIGN_OPTION_PRIVATE', 2);
define('CAMPAIGN_OPTION_ACTIVE', 4);


define('AFF_PROFIT_PERCENT', 50);

define('GMT_OFFSET', '-08:00');




