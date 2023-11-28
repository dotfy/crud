<?php
include_once("db.php");
include_once('fonksiyonlar.php');

// Personel Ekle Başlangıç

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pEkle'])) {
    $sorgu = $db->prepare("INSERT INTO calisanlar 
    (ad, soyad, email, maas) VALUES
    (:calisin_isim, :calisan_soyad, :calisan_email, :calisan_maas)
");

    $personelEkle = $sorgu->execute(array(
        'calisin_isim' => Guvenlik(filter_var($_POST['adEkle'], FILTER_SANITIZE_STRING)),
        'calisan_soyad' => Guvenlik(filter_var($_POST['soyadEkle'], FILTER_SANITIZE_STRING)),
        'calisan_email' => Guvenlik(filter_var($_POST['emailEkle'], FILTER_SANITIZE_EMAIL)),
        'calisan_maas' => Guvenlik(filter_var($_POST['maasEkle'], FILTER_SANITIZE_NUMBER_FLOAT))
    ));

    if ($personelEkle) {
        echo "success";
    } else {
        echo "failure:";
    }
    exit;
}

// Personel Ekle Son

// Personel Güncelleme Başlangıç

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['calisan_id'])) {
    $sorgu = $db->prepare("UPDATE calisanlar SET
        ad=:calisin_isim,
        soyad=:calisan_soyad,
        email=:calisan_email,
        maas=:calisan_maas WHERE id=:calisan_id
    ");

    $guncelle = $sorgu->execute(array(
        'calisin_isim' => Guvenlik(filter_var($_POST['ad'], FILTER_SANITIZE_STRING)),
        'calisan_soyad' => Guvenlik(filter_var($_POST['soyad'], FILTER_SANITIZE_STRING)),
        'calisan_email' => Guvenlik(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)),
        'calisan_maas' => Guvenlik(filter_var($_POST['maas'], FILTER_SANITIZE_NUMBER_FLOAT)),
        'calisan_id' => Guvenlik(filter_var($_POST['calisan_id'], FILTER_SANITIZE_NUMBER_INT))
    ));

    if ($guncelle) {
        echo "success";
    } else {
        echo "failure:";
    }
    exit;
}

// Personel Güncelleme SON



// Personel Sil Başlangıç
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["calisan_sil"])) {
    $sorgu = $db->prepare("DELETE FROM calisanlar WHERE id=:calisan_id");
    $sonuc = $sorgu->execute(array(
        'calisan_id' => Guvenlik(filter_var($_POST['calisan_sil'], FILTER_SANITIZE_NUMBER_INT))
    ));

    if ($sonuc) {
        echo "success";
    } else {
        echo "failure";
    }
}
// Personel Sil son
