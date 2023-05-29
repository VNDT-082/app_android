<?php
class ChiTietToppingGioHang
{
    
    public $id;
    public $Topping;
    public function __construct($id=0, Topping $Topping=null)
    {
        $this->id=$id;
        $this->Topping=$Topping;
    }
    public static function getAll($id)
    {
        $sql="SELECT chitiettoppinggiohang.ID,chitiettoppinggiohang.MaTopping, chitiettoppinggiohang.Gia, topping.TenTopping, topping.HinhAnh FROM chitiettoppinggiohang, topping WHERE ID=$id AND topping.MaTopping=chitiettoppinggiohang.MaTopping;";

        $connection=new Connection();
        $ResultData=$connection->excuteQuery($sql);
        $listTopping=array();
        if($ResultData!=null)
        {
            foreach($ResultData as $topping)
            {
                $ct=new ChiTietToppingGioHang();
                $ct->id=$topping["ID"];
                
                $tp=new Topping();
                $tp->MaTopping=$topping["MaTopping"];
                $tp->Gia=$topping["Gia"];
                $tp->TenTopping=$topping["TenTopping"];
                $tp->HinhAnh=$topping["HinhAnh"];
                $ct->Topping=$tp;
                $listTopping[]=$ct;
            }
            return $listTopping;
        }
        return null;
    }

    public static function XoaToppingKhoiSanPham($ID, $MaTopping)
    {
        $connection=new Connection();
        $kq=false;
        $sql="DELETE FROM chitiettoppinggiohang WHERE chitiettoppinggiohang.ID=$ID AND chitiettoppinggiohang.MaTopping=$MaTopping;";
        $kq= $connection->excuteUpdate($sql);
        return $kq;
    }
    public static function XoaHetToppingKhoiSanPham($ID)
    {
        $connection=new Connection();
        $kq=false;
        $sql="DELETE FROM chitiettoppinggiohang  WHERE chitiettoppinggiohang.ID=$ID;";
        $kq= $connection->excuteUpdate($sql);
        return $kq;
    }


}
?>