<?php
/**
 * String starts with
 * @param  string $haystack
 * @param  string $needle
 * @return boolean
 */
if (!function_exists('_startsWith')) {
    function _startsWith($haystack, $needle)
    {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }
}
/**
 * String ends with
 * @param  string $haystack
 * @param  string $needle
 * @return boolean
 */
if (!function_exists('endsWith')) {
    function endsWith($haystack, $needle)
    {
        // search forward starting from end minus needle length characters
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
    }
}
/**
 * Get string after specific charcter/word
 * @param  string $string    string from where to get
 * @param  substring $substring search for
 * @return string
 */
function strafter($string, $substring)
{
    $pos = strpos($string, $substring);
    if ($pos === false)
        return $string;
    else
        return (substr($string, $pos + strlen($substring)));
}
/**
 * Get string before specific charcter/word
 * @param  string $string    string from where to get
 * @param  substring $substring search for
 * @return string
 */
function strbefore($string, $substring)
{
    $pos = strpos($string, $substring);
    if ($pos === false)
        return $string;
    else
        return (substr($string, 0, $pos));
}
/**
 * Is internet connection open
 * @param  string  $domain
 * @return boolean
 */
function is_connected($domain = 'www.perfexcrm.com')
{
    $connected = @fsockopen($domain, 80);
    //website, port  (try 80 or 443)
    if ($connected) {
        $is_conn = true; //action when connected
        fclose($connected);
    } else {
        $is_conn = false; //action in connection failure
    }
    return $is_conn;
}
/**
 * Replace Last Occurence of a String in a String
 * @since  Version 1.0.1
 * @param  string $search  string to be replaced
 * @param  string $replace replace with
 * @param  string $subject [the string to search
 * @return string
 */
function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);
    if ($pos !== false) {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}

/**
 * Dump more beautiful added by AFA
 */
if (!function_exists('dump')) {
    function dump ($var, $label = 'Dump', $echo = TRUE)
    {
        // Store dump in variable
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        }
        else {
            return $output;
        }
    }
}