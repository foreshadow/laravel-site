<?php

namespace App\Utilities;

class TOC
{
    protected $markdown;
    protected $numbers;
    protected $result;
    protected $html;
    protected $toc;

    function __construct($markdown, $numbers) 
    {
        $this->markdown = $markdown;
        $this->numbers = $numbers;
    }

    private function middle()
    {
        if (!isset($this->result)) {
            preg_match_all('/<h(.)>.*?<\/h.>/', $this->markdown, $matches, PREG_OFFSET_CAPTURE); 
            $t = [0, 0, 0, 0, 0, 0, 0];
            $l = 0;
            foreach ($matches[1] as &$v) {
                $h = $v[0] - 1;
                if ($h <= $l) {
                    $t[$h] += 1;
                } else if ($h > $l) {
                    $t[$h] = 1;
                }
                $s = $t[1];
                for ($i = 2; $i <= $h; $i += 1) {
                    $s .= '.' . $t[$i];
                }
                $v['level'] = $v[0];
                $v['offset'] = $v[1];
                if ($this->numbers) {
                    $v['string'] = $s;
                    $v['id'] = str_replace('.', '-', $s) . '-';
                } else {
                    $v['string'] = $v['id'] = '';
                }
                $l = $h;
            }
            $this->result = $matches[1];
            for ($i = 0; $i < count($matches[0]); $i += 1) {
                $this->result[$i]['heading'] = preg_replace('/<.*?>/', '', $matches[0][$i][0]);
            }
        }
        return $this->result;
    }

    function toc()
    {
        if (!isset($this->toc)) {
            $this->toc = '';
            foreach ($this->middle() as $r) {
                $this->toc .= '<a href="#' . $r['id'] . $r['heading'] . '" class="toc-' . ($r['level'] - 1) . ' ">';
                $this->toc .= $r['string'] . ' ' . $r['heading'] . '</a><br>';
            }
        } 
        return $this->toc;
    }

    function html()
    {
        if (!isset($this->html)) {
            $result = $this->middle();
            $n = count($result) - 1;
            if ($n == -1) {
                return $this->html = $this->markdown;
            }
            $this->html = substr($this->markdown, 0, 3);
            for ($i = 0; $i < $n; $i += 1) {
                $r =  $result[$i];
                $this->html .= ' id="' . $r['id'] . $r['heading'] . '">' . $r['string'] . ' ';
                $this->html .= substr($this->markdown, $r['offset'] + 2, $result[$i + 1]['offset'] - $r['offset'] - 1);
            }
            $this->html .= ' id="' . $result[$n]['id'] . $result[$n]['heading'] . '">' . $result[$n]['string'] . ' ';
            $this->html .= substr($this->markdown, $result[$n]['offset'] + 2);
        } 
        return $this->html;
    }
}
