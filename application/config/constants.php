<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



/********************** DATABASE TABLES ***************************/
defined('TBL_USER')      OR define('TBL_USER', 'users'); //
defined('TBL_BRANDS')      OR define('TBL_BRANDS', 'tbl_brands'); //
defined('TBL_CATEGORY')      OR define('TBL_CATEGORY', 'tbl_category'); //
defined('TBL_CATEGORY_CONTENT')      OR define('TBL_CATEGORY_CONTENT', 'tbl_category_content'); //

defined('TBL_ROLE')      OR define('TBL_ROLE', 'groups'); //
defined('TBL_USERGROUP')      OR define('TBL_USERGROUP', 'users_groups'); //
defined('TBL_ATTRIBUTE')      OR define('TBL_ATTRIBUTE', 'tbl_attribute'); //
defined('TBL_ATTRIBUTEVALUE') OR define('TBL_ATTRIBUTEVALUE', 'tbl_attribute_value'); //
defined('TBL_PRODUCTTYPE') OR define('TBL_PRODUCTTYPE', 'tbl_product_type'); //
defined('TBL_PRODUCT') OR define('TBL_PRODUCT', 'tbl_products'); //
defined('TBL_PRODUCT_IMAGE') OR define('TBL_PRODUCT_IMAGE', 'tbl_product_image'); //
defined('TBL_PRODUCT_DETAIL') OR define('TBL_PRODUCT_DETAIL', 'tbl_product_details'); //
defined('TBL_PRODUCT_VARIANT') OR define('TBL_PRODUCT_VARIANT', 'tbl_product_variants'); //
defined('TBL_BANNER') OR define('TBL_BANNER', 'tbl_banner'); //
defined('TBL_BANNER_CONTENT') OR define('TBL_BANNER_CONTENT', 'tbl_banner_content'); //
defined('TBL_PAGE') OR define('TBL_PAGE', 'tbl_pages'); //
defined('TBL_CONTACT') OR define('TBL_CONTACT', 'tbl_contacts'); //
defined('TBL_TESTIMONIAL') OR define('TBL_TESTIMONIAL', 'tbl_testimonial'); //
defined('TBL_BILLING') OR define('TBL_BILLING', 'tbl_billing_address'); //
defined('TBL_SHIPPING') OR define('TBL_SHIPPING', 'tbl_shipping_address'); //

defined('TBL_ORDER') OR define('TBL_ORDER', 'tbl_orders'); //
defined('TBL_ORDER_DETAIL') OR define('TBL_ORDER_DETAIL', 'tbl_order_details'); //

defined('SALES_TAX_PER') OR define('SALES_TAX_PER', '0.0825'); //

defined('EMAIL_SMTP_PROTOCOL') OR define('EMAIL_SMTP_PROTOCOL', 'smtp');
defined('EMAIL_SMTP_HOST') OR define('EMAIL_SMTP_HOST', 'mail.copymaxinc.com'); //ssl://copymaxinc.com
defined('EMAIL_SMTP_PORT') OR define('EMAIL_SMTP_PORT', 465);
defined('EMAIL_SMTP_USER') OR define('EMAIL_SMTP_USER', 'info@copymaxinc.com');
defined('EMAIL_SMTP_FROM_EMAIL') OR define('EMAIL_SMTP_FROM_EMAIL', 'info@copymaxinc.com');
defined('EMAIL_SMTP_FROM_NAME') OR define('EMAIL_SMTP_FROM_NAME', 'Copymax Inc.');
defined('EMAIL_SMTP_PASSWORD') OR define('EMAIL_SMTP_PASSWORD', 'S^0Ha@~mt{SZ');
defined('EMAIL_SMTP_CRYPTO') OR define('EMAIL_SMTP_CRYPTO', 'ssl'); //ssl,tls;
defined('EMAIL_SMTP_VALIDATION') OR define('EMAIL_SMTP_VALIDATION', true);
defined('EMAIL_SMTP_CHARSET') OR define('EMAIL_SMTP_CHARSET', 'utf-8');
defined('EMAIL_SMTP_NEWLINE') OR define('EMAIL_SMTP_NEWLINE', '\r\n');
defined('EMAIL_SMTP_MAIL_TYPE') OR define('EMAIL_SMTP_MAIL_TYPE', 'html');
