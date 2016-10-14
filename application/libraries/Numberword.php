<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Numberword
{
    // TODO
    // add to options
    // words without spaces
    // array of possible numbers => words
    private $word_array = array();
    // thousand array,
    private $thousand = array();
    // variables
    private $val, $currency0, $currency1;
    // codeigniter instance
    private $ci;
    private $val_array, $dec_value, $dec_word, $num_value, $num_word;
    var $val_word;
    function __construct($params = array())
    {

        $l = '';
        $this->ci =& get_instance();
        if(is_numeric($params['clientid'])){
            $client_language = get_client_default_language($params['clientid']);
            if (!empty($client_language)) {
                if (file_exists(APPPATH . 'language/' . $client_language)) {
                    $l = $client_language;
                }
            }
        }
        $language = $l;
        if($language == ''){
            $language = get_option('active_language');
        }
        $this->ci->lang->load($language . '_num_words_lang', $language);
        if (file_exists(APPPATH . 'language/' . $language . '/custom_lang.php')) {
            $CI->lang->load('custom_lang', $language);
        }
        array_push($this->thousand, "");
        array_push($this->thousand, _l('num_word_thousand') . ' ');
        array_push($this->thousand, _l('num_word_million') . ' ');
        array_push($this->thousand, _l('num_word_billion') . ' ');
        array_push($this->thousand, _l('num_word_trillion') . ' ');
        array_push($this->thousand, _l('num_word_zillion') . ' ');
        for ($i = 1; $i < 100; $i++) {
            $this->word_array[$i] = _l('num_word_' . $i);
        }
        for ($i = 100; $i <= 900; $i = $i + 100) {
            $this->word_array[$i] = _l('num_word_' . $i);
        }
    }
    public function convert($in_val = 0, $in_currency0 = "", $in_currency1 = true)
    {
        $this->val       = $in_val;
        $this->currency0 = _l('num_word_' . strtoupper($in_currency0));

        // Currency not found
        if (strpos($this->currency0, 'num_word_') !== false) {
            $this->currency0 = '';
        }
        if ($in_currency1 == false) {
            $this->currency1 = '';
        } else {
            $this->currency1 = _l('num_word_cents');
        }
        // remove commas from comma separated numbers
        $this->val = abs(floatval(str_replace(",", "", $this->val)));
        if ($this->val > 0) {
            // convert to number format
            $this->val       = number_format($this->val, '2', ',', ',');
            // split to array of 3(s) digits and 2 digit
            $this->val_array = explode(",", $this->val);
            // separate decimal digit
            $this->dec_value = intval($this->val_array[count($this->val_array) - 1]);
            if ($this->dec_value > 0) {
                // convert decimal part to word;
                $this->dec_word = $this->word_array[$this->dec_value] . " " . $this->currency1;
            }
            // loop through all 3(s) digits in VAL array
            $t              = 0;
            // initialize the number to word variable
            $this->num_word = "";
            for ($i = count($this->val_array) - 2; $i >= 0; $i--) {
                // separate each element in VAL array to 1 and 2 digits
                $this->num_value = intval($this->val_array[$i]);
                // if VAL = 0 then no word
                if ($this->num_value == 0) {
                    $this->num_word = " " . $this->num_word;
                }
                // if 0 < VAL < 100 or 2 digits
                elseif (strlen($this->num_value . "") <= 2) {
                    $this->num_word = $this->word_array[$this->num_value] . " " . $this->thousand[$t] . $this->num_word;
                    // add 'and' if not last element in VAL
                    if ($i == 1) {
                        $this->num_word = "and " . $this->num_word;
                    }
                }
                // if VAL >= 100, set the hundred word
                else {
                    @$this->num_word = $this->word_array[substr($this->num_value, 0, 1) . "00"] . (intval(substr($this->num_value, 1, 2)) > 0 ? " and " : "") . $this->word_array[intval(substr($this->num_value, 1, 2))] . " " . $this->thousand[$t] . $this->num_word;
                }
                $t++;
            }
            // add currency to word
            if (!empty($this->num_word)) {
                $this->num_word .= "" . $this->currency0;
                // check if is ex. One Dollars - then in this case remove the S plural - this may never happen :)
                if ($this->num_word == $this->word_array[1] . " " . $this->currency0) {
                    $this->num_word = substr($this->num_word, 0, -1);
                }
            }
        }
        // join the number and decimal words
        $this->val_word = $this->num_word . " " . $this->dec_word;
        if (get_option('total_to_words_lowercase') == 1) {
            return trim(mb_strtolower($this->val_word));
        }
        return trim($this->val_word);
    }
}
