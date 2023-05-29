<?php
class Connection
{
    public $pdo;

    public function __construct()
    {
        
        $host="localhost";
        //$host="127.0.0.1";
        $database="quanlybandoan";
        $user="root";
        $pass="mysql";
        $dns="mysql:host=$host;port=3306;dbname=$database;charset=UTF8";

        // $host="sql208.epizy.com";
        // $database="epiz_34265825_QuanLyBanDoAn";
        // $user="epiz_34265825";
        // $pass="E5Ie6eK0DIPLq";
        // $dns="mysql:host=$host;port=3306;dbname=$database;charset=UTF8";

        
        // $host="sql213.liveblog365.com";
        // //$host="127.0.0.1";
        // $database="lblog_34274498_QuanLyBanDoAn";
        // $user="lblog_34274498";
        // $pass="EET424WZY9U93i8";
        // $dns="mysql:host=$host;port=3306;dbname=$database;charset=UTF8";

    
        
        try
        {
            $this->pdo=new PDO($dns,$user,$pass);
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
            exit();
        }
    }
    public function excuteQuery($StrSql)
    {
        $result=$this->pdo->prepare($StrSql);
        if($result->execute())
        {
            $data=$result->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        else
        {
            $err=$result->errorInfo();
            var_dump($err);
            return null;
        }

    }
    public function SelectAll($callProc)
    {
        $result=$this->pdo->prepare($callProc);
        if($result->execute())
        {
            $data=$result->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }
        else
        {
            $err=$result->errorInfo();
            var_dump($err);
            return null;
        }

    }

    public function getOneProcduct($id)
    {
        //$sql_selectOne="SELECT * FROM sanpham WHERE MaSanPham =:id";
        $sql_selectOne="SELECT * FROM sanpham WHERE MaSanPham ='$id'";
        $stmt=$this->pdo->prepare($sql_selectOne);
        //$stmt->bindParam(':id',$id,PDO::PARAM_INT);
        if($stmt->execute())
        {
            $product=$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $product;
        }
        else{
            $err=$stmt->errorInfo();
            var_dump($err);
        }
    }

    public function getAllCartByCustomer($MaNguoiDung)
    {
        $sql="SELECT * FROM giohang WHERE MaNguoiDung='$MaNguoiDung';";
        $stmt=$this->pdo->prepare($sql);
        if($stmt->execute())
        {
            $stmt->setFetchMode(PDO::FETCH_CLASS,'GioHang');
            return $stmt->fetchAll();
        }
    }
     public function excuteInsert($sql)
    {
        try{
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec($sql);
            $result = $this->pdo->lastInsertId();
            return $result;
        }
        catch(PDOException $e){echo $e->getMessage();}
        
    }

     public function excuteUpdate($sql)
    {
        try{
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result=$this->pdo->exec($sql);
            return $result;
        }
        catch(PDOException $e){echo $e->getMessage();}
        
    }
    public function AddOneProduct($sql)
    {
        try{
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec($sql);
        }
        catch(PDOException $e){echo $e->getMessage();}
        
    }
    

}

?>