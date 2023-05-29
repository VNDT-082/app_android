<?php
require("..//Model/Connection.php");
require("..//Model/LoaiSanPham.php");

$TenLoai="";
$HinhAnh="";
$TenLoai=$_POST["TenLoai"];
try {
    if (empty($_FILES['file_LoaiSanPham'])) {
        throw new Exception('Invalid upload');
    }

    switch ($_FILES['file_LoaiSanPham']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new Exception('No file uploaded');
        default:
            throw new Exception('An error occured');
    }

    if ($_FILES['file_LoaiSanPham']['size'] > 100000000) {
        throw new Exception('File too large');
    }

    $mime_types = ['image/png', 'image/jpeg', 'image/gif'];
    $file_info = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($file_info, $_FILES['file_LoaiSanPham']['tmp_name']);
    if (!in_array($mime_type, $mime_types)) {
        throw new Exception('Invalid file type');
    }

    $pathinfo = pathinfo($_FILES['file_LoaiSanPham']['name']);
    //$fname = $pathinfo['filename'];
    $fname = 'LoaiSanPham';
    $extension = $pathinfo['extension'];
    
    $dest = 'Images/imagesProducts/' . $fname . '.' . $extension;
    
    $i = 1;
    $fnameLast=$fname;
    $FILE_name=$fnameLast.".".$extension;
    while (file_exists($dest)) {
        $fnameLast = $fname . "_$i" ;
        $dest = 'Images/imagesProducts/'.$fnameLast.".".$extension;
        $FILE_name=$fnameLast.".".$extension;
        $i++;
    }

    if (move_uploaded_file($_FILES['file_LoaiSanPham']['tmp_name'], $dest))
    {
        $LoaiSanPham=new LoaiSanPham();
        $LoaiSanPham->tenLoai=$TenLoai;
        $LoaiSanPham->hinhAnh=$FILE_name;
        $LoaiSanPham->maLoai=$LoaiSanPham->ThemLoaiSanPham();
        if($LoaiSanPham->maLoai<=0)
        {
            echo "1";
        }
        else
        {
            echo "0";
        }
    }
} 
catch (Exception $e) {
    echo $e->getMessage();
}

?>