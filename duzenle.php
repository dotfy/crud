<?php
include_once("db.php");

if (isset($_POST['calisan_id'])) {
    $sorgu = $db->prepare("SELECT * FROM calisanlar WHERE id=:calisan_id");
    $sorgu->execute(array(
        'calisan_id' => $_POST['calisan_id']
    ));
    $calisanBilgisi = $sorgu->fetch(PDO::FETCH_ASSOC);
}


?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD İŞLEMLERİ | Kullanıcı düzenle</title>
    <!-- Bootstrap CSS ve jQuery ekleyin -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Kullanıcı Düzenle</h2>
        <div class="card-body">
            <form id="personelDuzenleForm">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Ad:</label>
                        <input type="text" class="form-control" name="ad" value="<?php echo $calisanBilgisi['ad']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Soyad:</label>
                        <input type="text" class="form-control" name="soyad" value="<?php echo $calisanBilgisi['soyad']; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email:</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $calisanBilgisi['email']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Maaş:</label>
                        <input type="text" class="form-control" name="maas" value="<?php echo $calisanBilgisi['maas']; ?>">
                    </div>
                </div>
                <input type="hidden" name="calisan_id" value="<?php echo $calisanBilgisi['id']; ?>">
                <div class="form-row">
                    <button type="button" class="btn btn-primary" onclick="personelDuzenle()">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<script>
function personelDuzenle() {
    // Form verilerini al
    var formData = new FormData(document.getElementById("personelDuzenleForm"));

    // AJAX ile form gönderimi
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "islemler.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var responseText = xhr.responseText;
                if (responseText === 'success') {
                    Swal.fire('Güncellendi!', '', 'success').then(() => {
                        // Güncelleme başarılı olduğunda index.php'ye yönlendirme
                        window.location.href = 'index.php';
                    });
                } else if (responseText.startsWith('failure')) {
                    Swal.fire('Eklenmedi. Hata: ' + responseText.substring(8), '', 'error');
                } else {
                    Swal.fire('Sistemsel Bir Hata Oluştu', '', 'error');
                }
            } else {
                Swal.fire('Bir hata oluştu', '', 'error');
            }
        }
    };

    // Gönderilecek form verileri
    xhr.send(formData);
}
</script>