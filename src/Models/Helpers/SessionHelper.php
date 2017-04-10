<?php
/**
 * Created by PhpStorm.
 * User: jonas
 * Date: 10.04.2017
 * Time: 10:13
 */

namespace Source\Models\Helpers;

/**
 * Class SessionHelper
 *
 * This code came from https://stackoverflow.com/users/567663/paul,
 * found on https://stackoverflow.com/questions/7643425/how-to-unit-test-session-variables-in-php.
 * edited by Paul Oct 4 '11 at 7:00
 *
 * @package Source\Models\Helpers
 */
class SessionHelper {

    public static function init() {

        session_cache_limiter(false);
        date_default_timezone_set('Europe/Berlin');
        if (!isset($_SESSION)) {
            // If we are run from the command line interface then we do not care
            // about headers sent using the session_start.
            if (PHP_SAPI === 'cli') {
                $_SESSION = array();
            } elseif (!headers_sent()) {
                if (!session_start()) {
                    throw new \Exception(__METHOD__ . 'session_start failed.');
                }
            } else {
                throw new \Exception(
                    __METHOD__ . 'Session started after headers sent.');
            }
        }
    }
}