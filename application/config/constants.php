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
| FL INITIAL CONFIGS 
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SYSTEM_NAME', 'Nextlook');
define('SYSTEM_CODE', 'ZV_POS_NL91_LV');
define('SYSTEM_SHOTR_NAME', 'NL Web');
define('SYSTEM_POWERED_BY', 'Zone Venture');

define('INVOICE_NO_PREFIX', 'NLI'. date('my'));
define('SUP_INVOICE_NO_PREFIX', 'SI'. date('my'));
define('SALE_ORDER_NO_PREFIX', 'SO'. date('my'));
define('QUOTE_NO_PREFIX', 'ZVQ'. date('my'));


/*
|--------------------------------------------------------------------------
| FL INITIAL SETUPS
|--------------------------------------------------------------------------
|
| Controlling the process
|
 */
//  1--> enabed; 0-->disabled
define('SYSTEM_LOG_ENABLE', 0);

/*
|--------------------------------------------------------------------------
| FL Form Actions
|--------------------------------------------------------------------------
|
| Controlling the process
|
 */
//  1--> enabed; 0-->disabled
define('Add', 'Create New');
define('Edit', 'Update');
define('Delete', 'Remove');
define('View', 'View');

 /*
|--------------------------------------------------------------------------
| DB Tables
|--------------------------------------------------------------------------
|
| These are used to database table  name
|
*/
//FL TABLE PREFIX
define('TB_PREFIX',      		'');

define('USER_TBL',      		TB_PREFIX.'user_auth');
define('USER_ROLE',      		TB_PREFIX.'user_role');
define('USER',                          TB_PREFIX.'user_details');
define('MODULES',                       TB_PREFIX.'modules');
define('MODULES_ACTION',                TB_PREFIX.'module_actions');
define('MODULE_USER_ROLE_ACT',          TB_PREFIX.'module_user_role');
//define('HOTELS',                        TB_PREFIX.'hotels');
define('COMPANIES',                     TB_PREFIX.'company');
define('COUNTRY_LIST',                  TB_PREFIX.'countries');
define('COUNTRY_STATES',                TB_PREFIX.'country_states');
define('COUNTRY_DISTRICTS',             TB_PREFIX.'country_districts');
define('COUNTRY_CITIES',                TB_PREFIX.'country_cities ');
define('SYSTEM_LOG',                    TB_PREFIX.'system_log');
define('SYSTEM_LOG_DETAIL',             TB_PREFIX.'system_log_detail');
define('BANNERS',                       TB_PREFIX.'cms_banner');
define('DROPDOWN_LIST',                 TB_PREFIX.'dropdown_list');
define('DROPDOWN_LIST_NAMES',           TB_PREFIX.'dropdown_list_names'); 
define('TIME_BASE',                     TB_PREFIX.'time_base'); 
define('CURRENCY',                      TB_PREFIX.'currency'); 
define('CUSTOMERS',                     TB_PREFIX.'customers');
define('CUSTOMER_BRANCHES',             TB_PREFIX.'customer_branches');
define('CUSTOMER_TYPE',                 TB_PREFIX.'customer_type'); 
define('ADDONS',                        TB_PREFIX.'addons');
define('ADDON_CALC_INCLUDED',           TB_PREFIX.'addon_calculation_included');
define('PAYMENT_TERMS',                 TB_PREFIX.'payment_terms');
define('TRANSECTION',                   TB_PREFIX.'transection');
define('TRANSECTION_TYPES',             TB_PREFIX.'transection_types');
define('ITEM_UOM',                      TB_PREFIX.'item_uom');
define('ITEMS',                         TB_PREFIX.'items');
define('ITEM_CAT',                      TB_PREFIX.'item_categories');
define('ITEM_PRICES',                   TB_PREFIX.'item_prices');
define('ITEM_STOCK',                    TB_PREFIX.'item_stock');
define('ITEM_STOCK_TRANS',              TB_PREFIX.'item_stock_transection');
define('SUPPLIERS',                     TB_PREFIX.'suppliers');
define('INV_LOCATION',                  TB_PREFIX.'inventory_location');
define('INVOICES',                      TB_PREFIX.'invoices');
define('SUPPLIER_INVOICE',              TB_PREFIX.'supplier_invoice');
define('SUPPLIER_INVOICE_DESC',         TB_PREFIX.'supplier_invoice_description');
define('SALES_ORDERS',                  TB_PREFIX.'sales_orders');
define('SALES_ORDER_DESC',              TB_PREFIX.'sales_order_description');
define('INVOICE_DESC',                  TB_PREFIX.'invoice_description');
define('QUOTATIONS',                    TB_PREFIX.'quotations');
define('SALES_PERSONS',                 TB_PREFIX.'sales_persons');
define('SALES_ORDER_ITEM_TEMP',         TB_PREFIX.'sales_order_item_temp');


/*
|--------------------------------------------------------------------------
| MESSAGES
|--------------------------------------------------------------------------
|
| Success Error....messages
|
*/

//define('HOTEL_LOGO',	'./storage/images/company/');
define('RECORD_ADD',	'Record added Successfully');
define('RECORD_UPDATE',	'Record updated Successfully');
define('RECORD_DELETE',	'Record Deleted Successfully');
define('ERROR',	'Error! Something went wrong.');

/*
|--------------------------------------------------------------------------
| STORAGE PLACES 
|--------------------------------------------------------------------------
|
| These are containing all the file storage places
|
*/

//define('HOTEL_LOGO',	'./storage/images/company/');
define('SAMPLE_PIC',	'./storage/images/');
define('COMPANY_LOGO',	'./storage/images/company/');
define('USER_PROFILE_PIC',	'./storage/images/users/profile/');
define('DB_BACKUPS',	'./storage/backups/database_backup/');
define('FILE_BACKUPS',	'./storage/backups/file_backups/');
define('DEFAULT_IMAGE_LOC',	'./storage/images/default/');
define('DEFAULT_PIC',	'./storage/images/default/default.jpg');
define('BANNERS_PIC',	'./storage/images/CMS/banners/'); 
define('CUSTOMER_IMAGES',	'./storage/images/customers/cust_images/'); 
define('ITEM_IMAGES',	'./storage/images/items/'); 
define('FONTS_LOC',	'./storage/fonts/'); 
define('FILE_BACKUP_SOURCE',	'./storage/');
define('CAT_IMAGES',	'./storage/images/categories/');
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
