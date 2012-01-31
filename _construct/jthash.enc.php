<?php
  /*
   Copyright (C) 2011 by JTprojects (Jian Ting)

   Permission is hereby granted, free of charge, to any person obtaining a copy
   of this software and associated documentation files (the "Software"), to deal
   in the Software without restriction, including without limitation the rights
   to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
   copies of the Software, and to permit persons to whom the Software is
   furnished to do so, subject to the following conditions:

   The above copyright notice and this permission notice shall be included in
   all copies or substantial portions of the Software.

   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
   IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
   FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
   AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
   LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
   OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
   THE SOFTWARE.
   */
  if (!defined('BASEPATH'))exit('Failed Hax0r');
  /*
    jtHash API 1.2
    What is jtHash?
      Well, jtHash is a string encoder. Safe for everything.
   */
  class jthash {
    public function hash($mode){
      if($mode == "encode"){
        $hash = array(
                      'q' => 'm',//Small alphebets
                      'w' => 'n',
                      'e' => 'b',
                      'r' => 'v',
                      't' => 'c',
                      'y' => 'x',
                      'u' => 'z',
                      'i' => 'l',
                      'o' => 'k',
                      'p' => 'j',
                      'a' => 'h',
                      's' => 'g',
                      'd' => 'f',
                      'f' => 'd',
                      'g' => 's',
                      'h' => 'a',
                      'j' => 'p',
                      'k' => 'o',
                      'l' => 'i',
                      'z' => 'u',
                      'x' => 'y',
                      'c' => 't',
                      'v' => 'r',
                      'b' => 'e',
                      'n' => 'w',
                      'm' => 'q',
                      '=' => '+',//Special CHaracters
                      '<' => '^',
                      '>' => '%',
                      '$' => '4',
                      '(' => '9',
                      ')' => '0',
                      'Q' => 'M',//Capitalized alphebets
                      'W' => 'N',
                      'E' => 'B',
                      'R' => 'V',
                      'T' => 'C',
                      'Y' => 'X',
                      'U' => 'Z',
                      'I' => 'L',
                      'O' => 'K',
                      'P' => 'J',
                      'A' => 'H',
                      'S' => 'G',
                      'D' => 'F',
                      'F' => 'D',
                      'G' => 'S',
                      'H' => 'A',
                      'J' => 'P',
                      'K' => 'O',
                      'L' => 'I',
                      'Z' => 'U',
                      'X' => 'Y',
                      'C' => 'T',
                      'V' => 'R',
                      'B' => 'E',
                      'N' => 'W',
                      'M' => 'Q',
                      );
        return $hash;
      }elseif($mode == "decode"){
        $hash = array(
                      'm' => 'q',//Small alphebets
                      'n' => 'w',
                      'b' => 'e',
                      'v' => 'r',
                      'c' => 't',
                      'x' => 'y',
                      'z' => 'u',
                      'l' => 'i',
                      'k' => 'o',
                      'j' => 'p',
                      'h' => 'a',
                      'g' => 's',
                      'f' => 'd',
                      'd' => 'f',
                      's' => 'g',
                      'a' => 'h',
                      'p' => 'j',
                      'o' => 'k',
                      'i' => 'l',
                      'u' => 'z',
                      'y' => 'x',
                      't' => 'c',
                      'r' => 'v',
                      'e' => 'b',
                      'w' => 'n',
                      'q' => 'm',
                      '+' => '=',//Special CHaracters
                      '^' => '<',
                      '%' => '>',
                      '4' => '$',
                      '9' => '(',
                      '0' => ')',
                      'M' => 'Q',//Capitalized alphebets
                      'N' => 'W',
                      'B' => 'E',
                      'V' => 'R',
                      'C' => 'T',
                      'X' => 'Y',
                      'Z' => 'U',
                      'L' => 'I',
                      'K' => 'O',
                      'J' => 'P',
                      'H' => 'A',
                      'G' => 'S',
                      'F' => 'D',
                      'D' => 'F',
                      'S' => 'G',
                      'A' => 'H',
                      'P' => 'J',
                      'O' => 'K',
                      'I' => 'L',
                      'U' => 'Z',
                      'Y' => 'X',
                      'T' => 'C',
                      'R' => 'V',
                      'E' => 'B',
                      'W' => 'N',
                      'Q' => 'M',
                      );
        return $hash;
      }
    }
    public function encode($string){
      $encode = $string;
      $encode = strtr($encode, $this->hash('encode'));
      $encode = $encode.jt_hash_secret;
      return $encode;
    }
    public function decode($string){
      $decode = explode(jt_hash_secret, $string);
      $decode = strtr($decode[0], $this->hash('decode'));
      return $decode;
    }
    public function withoutHashSecret($string, $type){
      if($type == "encode"){
        $encode = strtr($string, $this->hash('decode'));
        return $encode;
      }elseif($type == "decode"){
        $decode = strtr($string, $this->hash('decode'));
        return $decode;
      }else{
        return false;
      }
    }
  }
?>