<?php

namespace App\Controllers;

include('App/Models/Cnp.php');

use App\Models\Cnp;

class CnpController
{
    /**
     * Test if CNP is valid or not.
     *
     * @param array $request
     * @return bool
     */
    public function isCnpValid(array $request)
    {
        return (new Cnp($request['cnp']))->validate();
    }
}