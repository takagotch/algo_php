<?php
// スタック構造を表現したもの
class Stack {
  // 内部データ（配列で表現）
  private $stack = array();

  // データを末尾に追加
  public function push($v) {
    $this->stack[] = $v;
  }

  // データを末尾から取り出す
  public function pop() {
    return array_pop($this->stack);
  }

  // データ個数を返す
  public function length() {
    return count($this->stack);
  }
}

