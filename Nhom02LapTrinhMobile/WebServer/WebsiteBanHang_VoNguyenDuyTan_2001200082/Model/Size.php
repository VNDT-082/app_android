<?php
class Size{
    public $MaSize;
    public $TenSize;
    public $Gia;
    public $HinhAnh;
    public function __construct($MaSize="SM",$TenSize="Size M", $Gia=0,$HinhAnh="SizeM.png")
    {
        $this->MaSize=$MaSize;
        $this->TenSize=$TenSize;
        $this->Gia=$Gia;
        $this->HinhAnh=$HinhAnh;
    }
    public static function getAll()
    {
        $connection=new Connection();
        $sql="SELECT * FROM size ;";
        $resultData=$connection->excuteQuery($sql);
        $listSize=array();
        if($resultData!=null)
        {
            foreach($resultData as $size)
            {
                $s=new Size();
                $s->MaSize=$size["MaSize"];
                $s->TenSize=$size["TenSize"];
                $s->Gia=$size["Gia"];
                $s->HinhAnh=$size["HinhAnh"];
                $listSize[]=$s;
            }
        }
        return $listSize;
    }
    public static function getOne($MaSize)
    {
        $connection=new Connection();
        $sql="SELECT * FROM size  WHERE size.MaSize='".$MaSize."';";
        $resultData=$connection->excuteQuery($sql);
        $listSize=array();
        if($resultData!=null)
        {
            foreach($resultData as $size)
            {
                $s=new Size();
                $s->MaSize=$size["MaSize"];
                $s->TenSize=$size["TenSize"];
                $s->Gia=$size["Gia"];
                $s->HinhAnh=$size["HinhAnh"];
                $listSize[]=$s;
                return $s;
            }
        }
        return null;
    }
}

?>