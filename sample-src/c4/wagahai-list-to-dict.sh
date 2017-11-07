#!/bin/sh

# mecab-dict-index path
index=/usr/lib/mecab/mecab-dict-index
dict_dir=/usr/share/mecab/dic/ipadic
output=./wagahai-list.dic
input=./wagahai-list.csv

# convert
$index -d $dict_dir -u $output -f utf-8 -c utf-8 $input


