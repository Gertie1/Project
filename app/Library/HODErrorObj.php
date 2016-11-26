<?php
/**
 * Created by PhpStorm.
 * User: gety
 * Date: 11/24/2016
 * Time: 3:22 PM
 */

namespace App\Library;


class HODErrorObj
{
    public $error = 0;
    public $reason = "";
    public $detail = "";
    public $jobID = "";

    function HODErrorObj($code, $reason, $detail="", $jobID="") {
        $this->error = $code;
        $this->reason = $reason;
        $this->detail = $detail;
        $this->jobID = $jobID;
    }
}