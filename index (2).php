<?php

$subject = file_get_contents('https://restoran.kz/restaurant');

$pattern = '/<div class="mb-5">/u';
$blocks = preg_split($pattern, $subject);
unset($blocks[0]);

$rests = [];

foreach ($blocks as $block) {
    $pattern = '/<a class="link-inherit-color" href="(.+?)">(.+?)<\/a>/u';
    $result = [];
    preg_match_all($pattern, $block, $result);

    $rest = [
        'name' => $result[2][0],
        'link' => $result[1][0],
    ];
    
    $pattern = '/<li class="d-flex mr-5 mb-3"><svg class="icon icon_md flex-none mr-3" aria-hidden="true"><use xlink:href="(.+?)"><\/use><\/svg>(.+?)<\/li>/u';
    $result = [];
    preg_match_all($pattern, $block, $result);

    $paramsMap = [
        'cuisine' => '#icon-plate',
        'price' => '#icon-tenge-in-circle',
        'options' => '#icon-lightning-in-circle'
    ];

    foreach ($paramsMap as $key => $value) {
        $index = array_search($value, $result[1]);
        if ($index !== false) {
            $rest[$key] = $result[2][$index];
        }
    }

    $rests[] = $rest;
}

print_r($rests);