<?php
// リングバッファを表現したもの
class RingBuffer {
  // 内部データ(配列で表現)
  private $buf = array();
  private $top;
  private $bottom;
  private $size;

  // コンストラクタ
  public function __construct($size) {
    $this->size = $size;
    $this->buf = array_fill(0, $size, null);
    $this->top = 0;
    $this->bottom = -1;
  }
  // 値を取得する
  public function get($index) {
    $i = ($this->top + $index) % $this->size;
    return $this->buf[$i];
  }
  // 値を設定する
  public function set($index, $v) {
    $i = ($this->top + $index) % $this->size;
    $this->buf[$i] = $v;
  }
  // 値を末尾に追加
  public function append($v) {
    $this->bottom = ($this->bottom + 1) % $this->size;
    $this->buf[$this->bottom] = $v;
    if ($this->top >= $this->bottom) {
      $this->top = $this->bottom + 1;
    }
  }
}

