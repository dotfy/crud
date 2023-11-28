<?php
include_once("db.php");

?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD İŞLEMLERİ</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>




</head>

<body>

    <div class="container mt-5">
        <h2>CRUD İşlemleri</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Yeni Kullanıcı Ekle</button>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Ad</th>
                    <th>Soyad</th>
                    <th>Email</th>
                    <th>Maaş</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sorgu = $db->prepare("SELECT * FROM calisanlar");
                $sorgu->execute();
                while ($calisanBilgileri = $sorgu->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($calisanBilgileri['ad'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($calisanBilgileri['soyad'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($calisanBilgileri['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($calisanBilgileri['maas'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <div class="row justify-content-center">

                                <form class="mx-1" action="duzenle.php" method="post">
                                    <input type="hidden" name="calisan_id" value="<?php echo $calisanBilgileri['id']; ?>">
                                    <button type="submit" name="duzenle" class="btn btn-success btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </form>

                                <form class="mx-1" id="deleteForm" action="islemler.php" method="post">
                                    <input type="hidden" name="calisan_sil" value="<?php echo $calisanBilgileri['id']; ?>">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="personelSil(<?= htmlspecialchars($calisanBilgileri['id']); ?>)"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>

                <?php } ?>





            </tbody>
        </table>
    </div>

    <!-- Personel Ekle Popup başlangıç -->
    <div class="modal" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Yeni Kullanıcı Ekle</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <form id="personelForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Ad:</label>
                                <input type="text" class="form-control" name="adEkle" require>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Soyad:</label>
                                <input type="text" class="form-control" name="soyadEkle" require>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Email:</label>
                                <input type="text" class="form-control" name="emailEkle" require>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Maaş:</label>
                                <input type="text" class="form-control" name="maasEkle" require>
                            </div>
                        </div>
                        <input type="hidden" name="pEkle">
                        <div class="form-row">
                            <button type="button" class="btn btn-primary" onclick="personelEkle()">Personel Ekle</button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                </div>

            </div>
        </div>
    </div>
<!-- Personel Ekle Popup Son -->




</body>

</html>


<script>
        // Personel Silme Sweetalert ve post işlemi

    function personelSil(id) {
        Swal.fire({
            title: 'Emin Misin?',
            text: " Bu Kaydın Tamamen Silinmesini Onaylıyor Musunuz?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet Sil!',
            cancelButtonText: 'İptal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Kullanıcı eveet tuşuna bastığında POST isteği yap
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "islemler.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {
                            var responseText = xhr.responseText;
                            if (responseText === 'success') {
                                Swal.fire('Silindi!', '', 'success');

                                setTimeout(function() {
                                    location.reload();
                                }, 1500);
                            } else if (responseText === 'failure') {
                                Swal.fire('Silinmedi', '', 'error');
                            } else {
                                Swal.fire('Sistemsel Bir Hata Oluştu', '', 'error');
                            }
                        } else {
                            Swal.fire('Bir hata oluştu', '', 'error');
                        }
                    }
                };
                xhr.send("calisan_sil=" + id);
            } else if (result.isDenied) {
                Swal.fire('Silinmedi', '', 'info');
            }
        });
    }
</script>

<script>
    // Personel Ekleme Sweetalert ve post işlemi
    function personelEkle() {
        var formData = new FormData(document.getElementById("personelForm"));

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "islemler.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var responseText = xhr.responseText;
                    if (responseText === 'success') {
                        Swal.fire('Eklendi!', '', 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
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

        xhr.send(formData);
    }
</script>