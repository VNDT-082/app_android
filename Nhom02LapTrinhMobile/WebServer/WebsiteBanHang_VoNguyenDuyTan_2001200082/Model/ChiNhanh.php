<?php
class ChiNhanh{
    public $MaChiNhanh;
    public $TenChiNhanh;
    public $DiaChi;
    public $SDT;
    public function __construct($MaChiNhanh="",$TenChiNhanh="",$DiaChi="",$SDT="")
    {
        $this->MaChiNhanh=$MaChiNhanh;
        $this->TenChiNhanh=$TenChiNhanh;
        $this->DiaChi=$DiaChi;
        $this->SDT=$SDT;
    }
    public static function getAll()
    {

        $sql="SELECT * FROM `chinhanh`";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        $dsChiNhanh=array();
        if($resultData!=null)
        {
            foreach($resultData as $cn)
            {
                $ChiNhanh=new ChiNhanh();
                $ChiNhanh->MaChiNhanh=$cn['MaChiNhanh'];
                $ChiNhanh->TenChiNhanh=$cn['TenChiNhanh'];
                $ChiNhanh->DiaChi=$cn['DiaChi'];
                $ChiNhanh->SDT=$cn['SDT'];
                $dsChiNhanh[]=$ChiNhanh;
            }
            return $dsChiNhanh;
        }
        return null;
    }
    public static function LayMotChiNhanh($MaChiNhanh)
    {
        $sql="SELECT * FROM chinhanh WHERE chinhanh.MaChiNhanh=1;";
        $connection=new Connection();
        $resultData=$connection->excuteQuery($sql);
        if($resultData!=null)
        {
            foreach($resultData as $cn)
            {
                $ChiNhanh=new ChiNhanh();
                $ChiNhanh->MaChiNhanh=$cn['MaChiNhanh'];
                $ChiNhanh->TenChiNhanh=$cn['TenChiNhanh'];
                $ChiNhanh->DiaChi=$cn['DiaChi'];
                $ChiNhanh->SDT=$cn['SDT'];
                return $ChiNhanh;
            }
        }
        return null;
    }
}
?>