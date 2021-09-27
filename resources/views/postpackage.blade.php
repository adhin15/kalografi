<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PostPackage</title>
</head>

<body>
    <form action="storepackage" method="post" enctype="multipart/form-data">
        @csrf
        <label for="inputpaket"> NAMA PAKET :</label>
        <input id="inputpaket" type="text" name="namapaket">
        <br>
        <br>
        <label for="inputkategori"> NAMA KATEGORI :</label>
        <input id="inputkategori" type="text" name="kategori">
        <br>
        <br>
        <label for="inputworkhours"> WORKHOURS :</label>
        <input id="inputworkhours" type="text" name="workhours">
        <br>
        <br>
        <label for="inputday"> DAY :</label>
        <input id="inputday" type="text" name="day">
        <br>
        <br>
        <label for="inputphotographers"> PHOTOGRAPHERS :</label>
        <input id="inputphotographers" type="number" name="photographers">
        <br>
        <br>
        <label for="inputvideographers"> VIDEOGRAPHERS :</label>
        <input id="inputvideographers" type="number" name="videographers">
        <br>
        <br>
        <label for="inputvideographers"> FLASHDISK :</label>
        <input id="inputvideographers" type="number" name="flashdisk">
        <br>
        <br>
        <label for="inputedited"> EDITED :</label>
        <input id="inputedited" type="text" name="edited">
        <br>
        <br>
        <label for="inputprice"> PRICE :</label>
        <input id="inputprice" type="text" name="price">
        <br>
        <br>
        <label for="inputphotos"> PHOTOS :</label>
        <input id="inputphotos" type="file" name="image_one">
        <br>
        <br>
        <label for="inputphotos"> PHOTOS :</label>
        <input id="inputphotos" type="file" name="image_two">
        <br>
        <br>
        <label for="inputphotos"> PHOTOS :</label>
        <input id="inputphotos" type="file" name="image_three">
        <br>
        <br>
        <button type="submit">SEND</button>
    </form>

</body>

</html>
