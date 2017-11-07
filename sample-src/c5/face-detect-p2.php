<?php
require_once 'vendor/mauricesvay/php-facedetection/FaceDetector.php';

// サンプルの学習データを利用して顔検出器を生成
$detector = new svay\FaceDetector('detection.dat');
// 画像を読み込み顔検出を行う
$detector->faceDetect('images/face1.jpg');
// 検出結果を出力
$face = $detector->getFace();
var_dump($face);

