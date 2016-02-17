<?php
/*
 * В класс собраны всевозможные генераторы и пр.
 */
class Helper 
{   
    /*
     * Метод генерирующий случайную строку
     */
    public function generateCode($length=6) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        while (strlen($code) < $length) {
                $code .= $chars[mt_rand(0,$clen)];
        }
        return $code;
    }
    /*
     * Метод генерирующий хэш.
     */
    public function generateHash($code){
        $hash = md5($code);
        return $hash;
    }
    
}