<?php

namespace komicho;

use Illuminate\Http\Request;
use komicho\Models\ModelWebToken;

class laravelWebToken
{
    private $makeToken;
    private $ModelWebToken;

    public function __construct()
    {
        $this->makeToken = md5(uniqid());
        $this->ModelWebToken = new ModelWebToken;
    }

    public function create()
    {
        header("X-userToken: " . $this->makeToken);
        return $this->makeToken;
    }

    public function id(Request $request)
    {
        $token = $request->header('userToken');
        if (empty($token)) {
            $this->token = false;
            return $this;
        } 
        $this->token = $token;
        return $this;
    }

    public function add($key, $value)
    {
        if (!$this->token) {
            return 'Token Not found';
        }

        $token = $this->token;
        $exist = $this->ModelWebToken->exist($token, $key);
        if (!$exist) {
            $this->ModelWebToken->addValue($token, $key, $value);
        } else {
            $this->ModelWebToken->updateValue($token, $key, $value);
        }
        return [
            'token' => $token,
            'key' => $key,
            'value' => $value
        ];
    }

    public function get($key)
    {
        if (!$this->token) {
            return 'Token Not found';
        }

        return $this->ModelWebToken->getValue($this->token, $key);
    }

    public function exists($key)
    {
        if (!$this->token) {
            return 'Token Not found';
        }

        $exist = $this->ModelWebToken->exist($this->token, $key);
        if ( $exist != false ) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($key)
    {
        if (!$this->token) {
            return 'Token Not found';
        }
        
        $this->ModelWebToken->del($this->token, $key);
    }
}