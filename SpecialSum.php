<?php

class SpecialSumCache
{
    public $_cache;
    public $sumN;

    function sumN($n)
    {
      if(!isset($this->_sumN[$n])){
        if($n==1){
          $this->_sumN[$n] = $n;

          return $this->_sumN[$n];
        }
        $this->_sumN[$n] = $this->sumN($n-1) + $n;

        return $this->_sumN[$n];
      }

      return $this->_sumN[$n];
    }

    function specialSum($k, $n) {
      if ( !isset($this->_cache[$k][$n])) {
        if ($k === 1)
        {
          $this->_cache[$k][$n] = $this->sumN($n);
        }
        else
        {
          $temp = 0;
          for($i=1; $i<=$n; $i++){
            $temp += $this->specialSum($k-1, $i);
          }

          $this->_cache[$k][$n] = $temp;
        }
      }

      return $this->_cache[$k][$n];
    }

}

$sum = new SpecialSumCache();
echo $sum->specialSum(100, 100). '     '.PHP_EOL;
