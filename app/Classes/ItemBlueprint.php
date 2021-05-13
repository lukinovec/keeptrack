<?php

namespace App\Classes;

// rozšiřitelnost
class ItemBlueprint extends Abstract\AbstractItem
{
    public function prepare()
    {
        switch ($this->searchtype) {
                case 'movie':
                    if ($this->type == 'series') {
                        $total_seasons = (int) Request::create('movie_details', $this->apiID)->search()['totalSeasons'];
                        $seasons = [];
                        for ($i = 1; $i <= $total_seasons; $i++) {
                            $seasons[] = ['number' => $i, 'episodes' => Request::create('season', $this->apiID)->search($i)];
                        }
                        $this->progress = ['seasons' => $seasons, 'totalSeasons' => $total_seasons];
                    }
                    break;

                case 'book':
                    $this->image = preg_replace('/._.*_/', '._SY385_', $this->image);
                    break;
                /**
                 * Můžete přidat další case pro rozšíření,
                 *  například
                 *  case 'anime':
                 *     $this->progress = ["episodes" => $this->progress["episodes"]];
                 *     break;
                 */
                default:
                    break;
        }

        return $this;
    }
}
