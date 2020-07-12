<?php

use App\Floor;
use App\Hospital;
use App\serial;

function generateRandomSerial($serialLength = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomSerial = '';
    for ($i = 0; $i < $serialLength; $i++) {
        $randomSerial .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomSerial;
}

// count el 3ohda
function countCustody(Hospital $hospital, Floor $floor){
    return count(serial::where('hospital_id', $hospital->id)->where('floor_id', $floor->id)->get());
}
