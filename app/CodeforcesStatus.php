<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodeforcesStatus extends Model
{
    public function codeforces_verdict_class()
    {
        $verdict = $this->verdict;
        if (!isset($verdict)) {
            return 'verdict-waiting';
        } elseif ($verdict == 'SKIPPED') {
            return '';
        } elseif ($verdict == 'CHALLENGED') {
            return 'verdict-failed';
        } elseif ($verdict == 'OK') {
            return 'verdict-accepted';
        } else {
            return 'verdict-rejected';
        }
    }

    public function codeforces_verdict($tests)
    {
        $verdict = $this->verdict;
        $testcase = $this->passedTestCount;
        $testset = $this->testset;
        if (!isset($verdict)) {
            if ($testset == 'TESTS' && isset($testcase)) {
                if ($tests) {
                    return 'Testing on test ' . (string) ($testcase + 1);
                } else {
                    return 'Testing';
                }
            } else {
                return 'In queue';
            }
        } elseif ($verdict == 'CHALLENGED') {
            return 'Hacked';
        } elseif ($verdict == 'SKIPPED') {
            return 'Skipped';
        } elseif ($verdict == 'OK') {
            if ($testset == 'PRETESTS') {
                return 'Pretest passed';
            } else {
                return 'Accepted';
            }
        } else {
            if ($tests) {
                return ucwords(strtolower(str_replace('_', ' ', $verdict))) . ' on test ' . (string) ($testcase + 1);
            } else {
                return ucwords(strtolower(str_replace('_', ' ', $verdict)));
            }
        }
    }
}
