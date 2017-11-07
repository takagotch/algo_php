#!/bin/sh
# mecab-dict-index path
index=/usr/lib/mecab/mecab-dict-index
dict_dir=/usr/share/mecab/dic/ipadic

# WikipediaのCSVを変換
output=./wikipedia.dic
input=./wikipedia-list.csv
$index -d $dict_dir -u $output -f utf-8 -c utf-8 $input

# はてなキーワードのCSVを変換
output=./hatena.dic
input=./hatena-list.csv
$index -d $dict_dir -u $output -f utf-8 -c utf-8 $input

