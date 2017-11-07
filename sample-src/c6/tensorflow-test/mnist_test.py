# -*- coding: utf-8 -*-
import input_data
import tensorflow as tf
# MNIST データセットのダウンロードと読み込み---(*1)
mnist = input_data.read_data_sets("MNIST_data/", one_hot=True)

# 訓練画像を入れる変数を準備 ---- (*2)
# 訓練画像は28x28pxなので1行784列のベクトルとして扱う
x = tf.placeholder("float", [None, 784])
# 重み(画像のピクセル数とラベル数の行列)
W = tf.Variable(tf.zeros([784, 10]))
# バイアス(ラベル数の行列)
b = tf.Variable(tf.zeros([10]))
# Softmax関数を定義
y = tf.nn.softmax(tf.matmul(x, W) + b)
# 学習時に正解データのラベルを入れるための変数
y_ = tf.placeholder("float", [None,10])
# クロスエントリピー
cross_entropy = -tf.reduce_sum(y_ * tf.log(y))
# 学習手法を定義
train_step = tf.train.GradientDescentOptimizer(0.01).minimize(cross_entropy)

# セッションを準備 --- (*3)
sess = tf.Session()
# 変数の初期化処理 
init = tf.initialize_all_variables()
sess.run(init)

# 1000回学習する --- (*4)
for i in range(1000):
  # mini batch で使用する分のデータ
  batch_xs, batch_ys = mnist.train.next_batch(100)
  # 勾配を用いた更新を行う
  sess.run(train_step, feed_dict={x: batch_xs, y_: batch_ys})

# 精度を計算 ---(*5)
# 予測yと正解ラベルy_を比較
correct_prediction = tf.equal(tf.argmax(y, 1), tf.argmax(y_, 1))
accuracy = tf.reduce_mean(tf.cast(correct_prediction, "float"))
# 結果を表示
print "精度:"
print sess.run(accuracy, feed_dict={x: mnist.test.images, y_: mnist.test.labels})


