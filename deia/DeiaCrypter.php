<?php

class Crypter
{
    const DEFAULT_KEY = "@$*%Pass@free3EDCfT69kLR";

    private $key;

    public function __construct($key = self::DEFAULT_KEY)
    {
        if(!is_string($key) || (is_string($key) && empty($key))){
            throw new InvalidArgumentException("Chave passada não é válida");
        }

        $this->key = $key;
    }

    public function encrypt($string)
    {
        if(!is_string($string) || (is_string($string) && empty($string))){
            throw new InvalidArgumentException("Informe o valor a ser encriptado");
        }

        srand((double) microtime() * 1000000);
        $key = md5($this->key);
        $td = mcrypt_module_open('des', '', 'cfb', '');
        $key = substr($key, 0, mcrypt_enc_get_key_size($td));
        $iv_size = mcrypt_enc_get_iv_size($td);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

        if (mcrypt_generic_init($td, $key, $iv) != -1) {
            $c_t = mcrypt_generic($td, $string);
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);
            $c_t = $iv . $c_t;
            return $c_t;
        }
    }

    public function decrypt($string)
    {
        if(!is_string($string) || (is_string($string) && empty($string))){
            throw new InvalidArgumentException("Informe o valor a ser decriptado");
        }

        $key = md5($this->key);
        $td = mcrypt_module_open('des', '', 'cfb', '');
        $key = substr($key, 0, mcrypt_enc_get_key_size($td));
        $iv_size = mcrypt_enc_get_iv_size($td);
        $iv = substr($string, 0, $iv_size);
        $string = substr($string, $iv_size);

        if (mcrypt_generic_init($td, $key, $iv) != -1) {
            $c_t = mdecrypt_generic($td, $string);
            mcrypt_generic_deinit($td);
            mcrypt_module_close($td);
            return $c_t;
        }
    }
}