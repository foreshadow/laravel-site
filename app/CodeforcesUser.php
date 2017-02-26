<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeforcesUser extends Model
{
    public function codeforces_rank_color_class()
    {
        $rating = $this->rating;
        if ($rating >= 2900) {
            return 'user-legendary';
        } elseif ($rating >= 2600) {
            return 'user-red';
        } elseif ($rating >= 2400) {
            return 'user-red';
        } elseif ($rating >= 2200) {
            return 'user-orange';
        } elseif ($rating >= 1900) {
            return 'user-violet';
        } elseif ($rating >= 1600) {
            return 'user-blue';
        } elseif ($rating >= 1400) {
            return 'user-cyan';
        } elseif ($rating >= 1200) {
            return 'user-green';
        } else {
            return 'user-gray';
        }
    }
}
