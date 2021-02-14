'use strict';

class SpecialSumCache
{
  
    constructor()
    {      
      this._cache = {}
      this._sumN = {}
    }

    sumN(n)
    {
      if(!this._sumN[n]){
        if(n==1){
          this._sumN[n] = n;
        }else{
          this._sumN[n] = this.sumN(n-1) +  BigInt(n);
        }
      }

      return BigInt(this._sumN[n]);
    }

    specialSum(k, n) {
      if ( !(this._cache[k] && this._cache[k][n])) {
        if (k === 1)
        {
          this._cache[k] = { ...this._cache[k], [n]: this.sumN(n) };
        }
        else
        {
          let temp = BigInt(0);

          for(let i=1; i<=n; i++){
            temp += this.specialSum(k-1, i);
          }

          this._cache[k] = { ...this._cache[k], [n]: temp };
        }
      }

      return this._cache[k][n];
    }

}

const sum = new SpecialSumCache();
console.log(sum.specialSum(100, 100));
