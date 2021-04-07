<?php


class mUtil {

    public function autoCaption($string){
        return ucfirst(strtolower($string));
    }

    public function convertRealToCents($value){
        $result = '';

        try {
            $result = $value / 100;
        } catch (Exception $e) {
            $result = 'Erro ao converter o valor para centavos';
        }

        return $result;
    }
    
}
