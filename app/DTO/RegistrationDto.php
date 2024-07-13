<?php
namespace App\DTO;

class RegistrationDTO{
    public $userId;
    public $trainingId;
    public $status;
    public $advance;
    public $remaind;
    
    public function __construct($userId,$trainingId,$status,$advance,$remaind)
    {
        $this->userId= $userId;
        $this->trainingId = $trainingId;
        $this->status= $status;
        $this->advance = $advance;
        $this->remaind= $remaind;

    }
}
