<?php require("LayoutMenuAdminHeader.php");

$DanhSachChiNhanh=ChiNhanh::getAll();
 
?>
<div class="row">
    <div class="col-md-12">
        <h4 class="w-100 fw-bold" style="color:#6f6e6e;"><b>Quản lý chi nhánh ❭❭</b></h4><hr/>
        <table class="table table-success  table-striped" style="width: 100%;" >
            <tr>
                <td style="width: 3%;">Mã chi nhánh</td>
                <td style="width: 28%;">Tên chi nhánh</td>
                <td style="width: 50%;">Địa chỉ</td>
                <td style="width: 12%;">SDT</td>
                <td style="width: 7%;"></td>
            </tr>

            <form>
                <tr>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="MaChiNhanh" value="" style="width: 100%;" disabled="false"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="TenChiNhanh" value="" style="width: 100%; "/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="DiaChi" value="" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <input type="text" name="SDT" value="" style="width: 100%;"/>
                    </td>
                    <td style="text-align: center; vertical-align: middle;">
                        <button class="btnIcon" type="submit" name="ThemChiNhanh"><img src="Images/add.png" width="80%"/></button>
                    </td>
                </tr>
            </form>
            <?php if($DanhSachChiNhanh!=null):
                    foreach($DanhSachChiNhanh as $ChiNhanh):?>
                   <form>
                        <tr>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="text" name="MaChiNhanh" value="<?=$ChiNhanh->MaChiNhanh?>" style="width: 100%;" disabled="false"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="text" name="TenChiNhanh" value="<?=$ChiNhanh->TenChiNhanh?>" style="width: 100%; "/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="text" name="DiaChi" value="<?=$ChiNhanh->DiaChi?>" style="width: 100%;"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <input type="text" name="SDT" value="<?=$ChiNhanh->SDT?>" style="width: 100%;"/>
                            </td>
                            <td style="text-align: center; vertical-align: middle;">
                                <button class="btnIcon" type="submit" name="SuaChiNhanh"><img src="Images/add.png" width="80%"/></button>
                            </td>
                        </tr>
                    </form>
                        
                    <?php endforeach; endif;?>
            

            
        </table>
    </div>
    
</div>



<?php require("LayoutMenuAdminFooter.php");?>