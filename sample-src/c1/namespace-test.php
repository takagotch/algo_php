<?php
// 名前空間を指定 
namespace hoge\lib;
function output($s) {
  echo strtoupper($s)."\n";
}

// 名前空間を指定
namespace fuga\lib;
function output($s) {
  echo "(*{$s}*)\n";
}

// 名前空間を指定
namespace project_a;

// 名前空間の異なるoutput()を呼び出す
// hoge\lib の outputを呼び出す
\hoge\lib\output("test"); // TEST

// fuga\lib の outputを呼び出す
\fuga\lib\output("test"); // (*test*)

