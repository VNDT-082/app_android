<?php
require("HomeController.php");
if($_SERVER['REQUEST_METHOD'] == 'POST' )
{
    if(isset($_POST["addLoaiSanPham"]))
    {
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
                    header('location: NoConnect.php');
                    exit();
                }
                else
                {
                    header('location: QuanLySanPham.php');
                    exit();
                }
            }
        } 
        catch (Exception $e) {
            echo $e->getMessage();
        }

    }
    if(isset($_POST["update_LoaiSanPham"]))
    {
        $TenLoai="";
        $HinhAnh="";
        $MaLoai="";
        $TenLoai=$_POST["TenLoai"];
        $MaLoai=$_POST["MaLoai"];
        try {
            if(!isset($_POST['file_LoaiSanPham']))
            {
                $LoaiSanPham=new LoaiSanPham();
                $LoaiSanPham->maLoai=$MaLoai;
                $LoaiSanPham->tenLoai=$TenLoai;
                $kq=$LoaiSanPham->SuaLoaiSanPhamKhongUploadAnh();
                if($kq<=0)
                {
                    header('location: NoConnect.php');
                    exit();
                }
                else
                {
                    header('location: QuanLySanPham.php');
                    exit();
                }

            }
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
            $fCurrent_name = $pathinfo['filename'];
            $fname = 'LoaiSanPham';
            $extension = $pathinfo['extension'];
            
            $dest = 'Images/imagesProducts/' . $fname . '.' . $extension;
            $CurrentDest='Images/imagesProducts/' . $fCurrent_name . '.' . $extension;
            $FILE_name_Current=$fCurrent_name.".".$extension;
            if(file_exists($CurrentDest))
            {
                $LoaiSanPham=new LoaiSanPham();
                $LoaiSanPham->maLoai=$MaLoai;
                $LoaiSanPham->tenLoai=$TenLoai;
                $LoaiSanPham->hinhAnh=$FILE_name_Current;
                $kq=$LoaiSanPham->SuaLoaiSanPham();
                if($kq<=0)
                {
                    header('location: NoConnect.php');
                    exit();
                }
                else
                {
                    header('location: QuanLySanPham.php');
                    exit();
                }
            }
            else{
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
                    $LoaiSanPham->maLoai=$MaLoai;
                    $LoaiSanPham->tenLoai=$TenLoai;
                    $LoaiSanPham->hinhAnh=$FILE_name;
                    $LoaiSanPham->maLoai=$LoaiSanPham->ThemLoaiSanPham();
                    $kq=$LoaiSanPham->SuaLoaiSanPham();
                    if($kq<=0)
                    {
                        header('location: NoConnect.php');
                        exit();
                    }
                    else
                    {
                        header('location: QuanLySanPham.php');
                        exit();
                    }
                }
            }
            
        } 
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    if(isset($_POST["delete_LoaiSanPham"]))
    {
        $MaLoai=0;
        $MaLoai=$_POST["MaLoai"];
        $LoaiSanPham=LoaiSanPham::LayMotLoaiSanPham($MaLoai);
        if($LoaiSanPham!=null)
        {
            $DanhSachSanPhamThuocLoai=SanPham::getAllProductSameCategory($MaLoai);
            if($DanhSachSanPhamThuocLoai!=null)
            {
                foreach($DanhSachSanPhamThuocLoai as $sanpham)
                {
                    $kq=$sanpham->ChuyenMaLoaiVeDefault();
                }
                if($kq<=0)
                {
                    header('location: NoConnect.php');
                    exit();
                }
                else
                {
                    $kq=$LoaiSanPham->XoaMotLoaiSanPham();
                    if($kq<=0)
                    {
                        header('location: NoConnect.php');
                        exit();
                    }
                    else
                    {
                        $linkImage='Images/imagesProducts/'.$LoaiSanPham->hinhAnh;
                        unlink($linkImage);
                        header('location: QuanLySanPham.php');
                        exit();
                    }
                }
            }
            else
            {
                $kq=$LoaiSanPham->XoaMotLoaiSanPham();
                if($kq<=0)
                {
                    header('location: NoConnect.php');
                    exit();
                }
                else
                {
                    $linkImage='Images/imagesProducts/'.$LoaiSanPham->hinhAnh;
                    unlink($linkImage);
                    header('location: QuanLySanPham.php');
                    exit();
                }
            }
        }
    }
    if(isset($_POST["ThemSanPham"]))
    {
        $SanPham=new SanPham();
        $SanPham->tenSanPham=$_POST["TenSanPham"];
        $SanPham->maLoai=$_POST["MaLoaiSanPham"];
        $SanPham->moTa=$_POST["Mota"];
        //$SanPham->luotMua=$_POST["LuotMua"];
        $SanPham->giaBan=$_POST["Gia"];
        $SanPham->trangThai=$_POST["TrangThai"];
        $fileHinhAnhSanPham;
        echo $SanPham->tenSanPham.$SanPham->maLoai.$SanPham->moTa.$SanPham->giaBan.$SanPham->trangThai;
        try {
            if (empty($_FILES['fileHinhAnhSanPham'])) {
                throw new Exception('Invalid upload');
            }

            switch ($_FILES['fileHinhAnhSanPham']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new Exception('No file uploaded');
                default:
                    throw new Exception('An error occured');
            }

            if ($_FILES['fileHinhAnhSanPham']['size'] > 100000000) {
                throw new Exception('File too large');
            }

            $mime_types = ['image/png', 'image/jpeg', 'image/gif'];
            $file_info = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($file_info, $_FILES['fileHinhAnhSanPham']['tmp_name']);
            if (!in_array($mime_type, $mime_types)) {
                throw new Exception('Invalid file type');
            }

            $pathinfo = pathinfo($_FILES['fileHinhAnhSanPham']['name']);
            //$fname = $pathinfo['filename'];
            $fname = 'SanPham';
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

            if (move_uploaded_file($_FILES['fileHinhAnhSanPham']['tmp_name'], $dest))
            {
                $SanPham->hinhAnh=$FILE_name;
                $SanPham->maSanPham=$SanPham->ThemMotSanPham();
                if($SanPham->maSanPham<=0)
                {
                    header('location: NoConnect.php');
                    exit();
                }
                else
                {
                    header('location: QuanLySanPham.php');
                    exit();
                }
            }
        } 
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    if(isset($_POST["updateSanPham"]))
    {
        $SanPham=new SanPham();
        $SanPham->tenSanPham=$_POST["TenSanPham"];
        $SanPham->maLoai=$_POST["MaLoaiSanPham"];
        $SanPham->moTa=$_POST["Mota"];
        $SanPham->maSanPham=$_POST["MaSanPham"];
        $SanPham->giaBan=$_POST["Gia"];
        $SanPham->trangThai=$_POST["TrangThai"];
        $fileHinhAnhSanPham;
        $SanPhamTemp=SanPham::LayMotSanPham($SanPham->maSanPham);
        
        try {
            if(!isset($_FILES["fileHinhAnhSanPham"]))
            {
                $SanPham->hinhAnh=$SanPhamTemp->hinhAnh;
                $kq=$SanPham->SuaMotSanPham();
                if($kq<=0)
                {
                    header('location: NoConnect.php');
                    exit();
                }
                else
                {
                    header('location: QuanLySanPham.php');
                    exit();
                }
            }
            if (empty($_FILES['fileHinhAnhSanPham'])) {
                throw new Exception('Invalid upload');
            }

            switch ($_FILES['fileHinhAnhSanPham']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new Exception('No file uploaded');
                default:
                    throw new Exception('An error occured');
            }

            if ($_FILES['fileHinhAnhSanPham']['size'] > 100000000) {
                throw new Exception('File too large');
            }

            $mime_types = ['image/png', 'image/jpeg', 'image/gif'];
            $file_info = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($file_info, $_FILES['fileHinhAnhSanPham']['tmp_name']);
            if (!in_array($mime_type, $mime_types)) {
                throw new Exception('Invalid file type');
            }

            $pathinfo = pathinfo($_FILES['fileHinhAnhSanPham']['name']);
            //$fname = $pathinfo['filename'];
            $fname = 'SanPham';
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

            if (move_uploaded_file($_FILES['fileHinhAnhSanPham']['tmp_name'], $dest))
            {
                $SanPham->hinhAnh=$FILE_name;
                $kq=$SanPham->SuaMotSanPham();
                if($kq<=0)
                {
                    header('location: NoConnect.php');
                    exit();
                }
                else
                {
                    if($SanPhamTemp!=null)
                    {
                        $linkImage='Images/imagesProducts/'.$SanPhamTemp->hinhAnh;
                        unlink($linkImage);
                    }
                    header('location: QuanLySanPham.php');
                    exit();
                }
            }
        } 
        catch (Exception $e) {
            echo $e->getMessage();
        }   
    }
    if(isset($_POST["deleteSanPham"]))
    {
        $MaSanPham=$_POST["MaSanPham"];
        $SanPham=SanPham::LayMotSanPham($MaSanPham);
        if($SanPham!=null)
        {
            $kq=$SanPham->XoaMotSanPham();
            if($kq<=0)
            {
                header('location: NoConnect.php');
                exit();
            }
            else
            {
                $linkImage='Images/imagesProducts/'.$SanPham->hinhAnh;
                unlink($linkImage);
                header('location: QuanLySanPham.php');
                exit();
            }
        }
    }
    if(isset($_POST["ThemKhuyenMai"]))
    {
        $KhuyenMai=new KhuyenMai();
        $KhuyenMai->MaSanPham=$_POST["MaSanPhamKhuyenMai"];
        $KhuyenMai->NoiDung=$_POST["NoiDungKhuyenMai"];
        $KhuyenMai->ChiTiet=$_POST["ChiTiet"];
        $KhuyenMai->NgayBatDau=$_POST["NgayBatDau"];
        $KhuyenMai->NgayKetThuc=$_POST["NgayKetThuc"];
        try {
            if (empty($_FILES['fileAnhKhuyenMai'])) {
                throw new Exception('Invalid upload');
            }

            switch ($_FILES['fileAnhKhuyenMai']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new Exception('No file uploaded');
                default:
                    throw new Exception('An error occured');
            }

            if ($_FILES['fileAnhKhuyenMai']['size'] > 100000000) {
                throw new Exception('File too large');
            }

            $mime_types = ['image/png', 'image/jpeg', 'image/gif'];
            $file_info = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($file_info, $_FILES['fileAnhKhuyenMai']['tmp_name']);
            if (!in_array($mime_type, $mime_types)) {
                throw new Exception('Invalid file type');
            }

            $pathinfo = pathinfo($_FILES['fileAnhKhuyenMai']['name']);
            //$fname = $pathinfo['filename'];
            $fname = 'KhuyenMai';
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

            if (move_uploaded_file($_FILES['fileAnhKhuyenMai']['tmp_name'], $dest))
            {
                $KhuyenMai->HinhAnh=$FILE_name;
                $KhuyenMai->id=$KhuyenMai->ThemMotKhuyenMai();
                if($KhuyenMai->id<=0)
                {
                    header('location: NoConnect.php');
                    exit();
                }
                else
                {
                    header('location: QuanLySanPham.php');
                    exit();
                }
            }
        } 
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    if(isset($_POST["updateKhuyenMai"]))
    {
        $KhuyenMai=new KhuyenMai();
        $KhuyenMai->id=$_POST["IdKhuyenMai"];
        $KhuyenMai->MaSanPham=$_POST["MaSanPhamKhuyenMai"];
        $KhuyenMai->NoiDung=$_POST["NoiDungKhuyenMai"];
        $KhuyenMai->ChiTiet=$_POST["ChiTiet"];
        $KhuyenMai->NgayBatDau=$_POST["NgayBatDau"];
        $KhuyenMai->NgayKetThuc=$_POST["NgayKetThuc"];
        $kq=$KhuyenMai->SuaMotKhuyenMai();
        if($kq<=0)
        {
            header('location: NoConnect.php');
            exit();
        }
        else
        {
            header('location: QuanLySanPham.php');
            exit();
        }
    }
    if(isset($_POST["deleteKhuyenMai"]))
    {
        $KhuyenMai=new KhuyenMai();
        $id_KhuyenMai=$_POST["IdKhuyenMai"];
        $KhuyenMai=KhuyenMai::LayMotKhuyenMai($id_KhuyenMai);
        if($KhuyenMai!=null)
        {
            $kq=$KhuyenMai->XoaMotKhuyenMai();
            if($kq<=0)
            {
                header('location: NoConnect.php');
                exit();
            }
            else
            {
                $linkImage='Images/imagesProducts/'.$KhuyenMai->HinhAnh;
                unlink($linkImage);
                header('location: QuanLySanPham.php');
                exit();
            }
        }
        
    }
}
?>
