<?php
class Topping
{
    public $MaTopping;
    public $TenTopping;
    public $Gia;
    public $HinhAnh;

    public function getMaTopping()
    {
        return $this->MaTopping;
    }
    public function setMaTopping($MaTopping)
    {
        $this->MaTopping=$MaTopping;
    }
    public function getTenTopping()
    {
        return $this->TenTopping;
    }
    public function setTenTopping($TenTopping)
    {
        $this->TenTopping=$TenTopping;
    }
    public function getGia()
    {
        return $this->Gia;
    }
    public function setGia($Gia)
    {
        $this->Gia=$Gia;
    }
    public function getHinhAnh()
    {
        return $this->HinhAnh;
    }
    public function setHinhAnh($HinhAnh)
    {
        $this->HinhAnh=$HinhAnh;
    }
    public function __construct($MaTopping="",$TenTopping="",$Gia=0,$HinhAnh="")
    {
        $this->HinhAnh=$HinhAnh;
        $this->MaTopping=$MaTopping;
        $this->Gia=$Gia;
        $this->TenTopping=$TenTopping;
    }

    // public static function getAll($values)
    // {
    //     $ListTopping=array();
    //     foreach($values as $value)
    //     {
    //         $topping=new Topping();
    //         $topping->setMaTopping($value["MaTopping"]);
    //         $topping->setTenTopping($value["TenTopping"]);
    //         $topping->setGia($value["Gia"]);
    //         $topping->setHinhAnh($value["HinhAnh"]);
    //         $ListTopping[]=$topping;
    //     }
    //     return $ListTopping;
    // }


    public static function getAll()
    {
        $ListTopping=array();
        $sql="select*from topping";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        if($resultData!=null)
        {
            foreach($resultData as $value)
            {
                $topping=new Topping();
                $topping->setMaTopping($value["MaTopping"]);
                $topping->setTenTopping($value["TenTopping"]);
                $topping->setGia($value["Gia"]);
                $topping->setHinhAnh($value["HinhAnh"]);
                $ListTopping[]=$topping;
            }
            return $ListTopping;
        }
        return null;
    }

     public static function getOneByID($MaTopping)
    {
        $sql="SELECT *from topping WHERE MaTopping=$MaTopping";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        if($resultData!=null)
        {
            foreach($resultData as $value)
            {
                $topping=new Topping();
                $topping->setMaTopping($value["MaTopping"]);
                $topping->setTenTopping($value["TenTopping"]);
                $topping->setGia($value["Gia"]);
                $topping->setHinhAnh($value["HinhAnh"]);
                return $topping;
            }
        }
        return null;
    }
}



?>