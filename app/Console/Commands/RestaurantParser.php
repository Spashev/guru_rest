<?php

namespace App\Console\Commands;

use App\Models\Restaurant;
use Illuminate\Console\Command;

class RestaurantParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:parse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start parse https://restoran.kz/restaurant';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
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
                'link' => $result[1][0]
            ];
            $link = str_replace('/', '\/', $rest['link']);
            $patternImg = '/<a class="embed-responsive-item" href="' . $link. '"><img class="img-cover lazyload" data-src="(.+?)" width="720" height="405" \/><\/a>/u';
            $images = [];
            preg_match_all($patternImg, $block, $images);
            $rest['image'] =  $images[1][0];

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
        
        foreach($rests as $rest) {
            Restaurant::create($rest);
        }
    }

}
