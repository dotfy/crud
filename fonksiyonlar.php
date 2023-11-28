<?php 

function Guvenlik($Deger){
    $BoslukSil      =   trim($Deger);
    $TaglariTemizle =   strip_tags($BoslukSil);
    $EtkisizYap     =   htmlspecialchars($TaglariTemizle, ENT_QUOTES);
    $Sonuc          =   $EtkisizYap;
    return $Sonuc;
}

function RakamlarHaricTumKarakterleriSil($Deger){
    $Islem      =   preg_replace("/[^0-9]/", "", $Deger);
    $Sonuc      =   $Islem;
    return $Sonuc;
}



?>