<?php
// 特殊記号
$sp = ['NULL','SOH','STX','ETX','EOT','ENQ','ACK','BEL',
       'BS','HT','LF','VT','FF','CR','SO','SI','DLE',
       'DC1','DC2','DC3','DC4','NAK','SYN','ETV','CAN',
       'EM','SUB','ESC','FS','GS','RS','US','SPC'];
$sp[127] = 'DEL';

// header
$html = "<tr><th></th>";
for ($j = 0; $j < 16; $j++) {
  $html .= "<th>".sprintf("%X",$j)."</th>";
}
$html .= "</tr>";

// characters
for ($i = 0; $i <= 7; $i++) {
  $html .= "<tr><th>{$i}x</th>";
  for ($j = 0; $j < 16; $j++) {
    $code = ($i * 16) + $j;
    $ch = isset($sp[$code]) ? $sp[$code] : chr($code);
    $html .= "<td>$ch</td>";
  }
  $html .= "</tr>";
}

echo <<< EOS
<style>
  * { margin:0; padding:0; }
  table { margin: 12px; }
  td,th {
    font-size: 12px; padding: 4px;
    width: 32px; text-align: center;
    border-bottom: 1px solid silver;
    border-right: 1px solid silver;
  }
  th { color: white; background-color: blue; }
</style>
<table>
$html
</table>
EOS;

