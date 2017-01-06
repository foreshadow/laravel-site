<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ParsedownExtensionMathJaxLaTeX;

class Article extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    function creator() {
        return User::find($this->creator);
    }

    function modifier() {
        return User::find($this->modifier);
    }

    function info() {
        return $this->creator()->name . ' 创建于 ' . Utilities\Functions::datetime($this->created_at) . '　|　' . 
               $this->modifier()->name . ' 最后更新于 ' . Utilities\Functions::datetime($this->updated_at);
    }

    function gfm($excerpt = null) 
    {
        if ($excerpt) {
            $a = explode('```', mb_substr($this->body, 0, $excerpt)); 
        } else {
            $a = explode('```', $this->body); 
        }
        for ($i = 0; $i < count($a); $i += 2) { 
            $a[$i] = str_replace("\n", "  \n", $a[$i]); 
        } 
        // return (new Parsedown())->text(implode('```', $a));
        return (new ParsedownExtensionMathJaxLaTeX())->text(implode('```', $a));
    }

    function excerpt($length = 240)
    {
        return mb_substr($this->body, 0, $excerpt);
    }

    function text($lines = 5)
    {
        $text = preg_replace('/<.*?>/', '<br>', $this->gfm());
        $text = preg_replace("/<br>\n<br>/", '<br>', $text);
        $array = array_slice(explode('<br>', $text), 1, $lines);
        return implode('<br>', $array);
    }
}
