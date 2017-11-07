<?php
require_once 'vendor/autoload.php';
require_once 'mecab.inc.php';

use Fieg\Bayes\TokenizerInterface;

class MecabTokenizer implements TokenizerInterface {
  // 分割処理を行うメソッド
  public function tokenize($string) {
    return mecab_parse_simple($string);    
  }
}

