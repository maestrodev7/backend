<?php
namespace App\DTO;

class TrainingDTO{
    public $title;
    public $description;
    public $duration;
    public $price;
    public $trainerId;
    
    public function __construct($title,$description,$duration,$price,$trainerId)
    {
        $this->title= $title;
        $this->description = $description;
        $this->duration= $duration;
        $this->price = $price;
        $this->trainerId= $trainerId;

    }
}
