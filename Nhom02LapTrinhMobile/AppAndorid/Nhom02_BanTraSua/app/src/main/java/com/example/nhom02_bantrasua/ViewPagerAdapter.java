package com.example.nhom02_bantrasua;

import androidx.annotation.NonNull;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentStatePagerAdapter;

import com.example.nhom02_bantrasua.Model.KhachHang;

public class ViewPagerAdapter extends FragmentStatePagerAdapter {

    KhachHang khachHang=new KhachHang();
    public ViewPagerAdapter(@NonNull FragmentManager fm, int behavior, KhachHang khachHang) {
        super(fm, behavior);
        this.khachHang=khachHang;
    }

    @NonNull
    @Override
    public Fragment getItem(int position) {
        switch (position)
        {
            case 0:
                return new FragmentDanhSachSanPham().newInstance(null,null,khachHang);
            case 1:
                return new FragmentGioHang().newInstance(null,null,khachHang);
            case 2:
                return new FragmentTrangChu();
            case 3:
                return new FragmentChiTietSanPham();
            case 4:
                return new FragmentTrangCaNhan();
            //Phanfragment kho co tren bottomnavigation
//            case 5:
//                return new FragmentChiTietSanPham();
            default:
                return new FragmentTrangChu();
        }
    }

    @Override
    public int getCount() {
        return 5;
    }
}
