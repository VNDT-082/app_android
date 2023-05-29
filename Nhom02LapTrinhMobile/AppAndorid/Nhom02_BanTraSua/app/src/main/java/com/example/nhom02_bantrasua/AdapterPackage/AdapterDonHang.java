package com.example.nhom02_bantrasua.AdapterPackage;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.CheckBox;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.nhom02_bantrasua.Model.ChiTietDatHang;
import com.example.nhom02_bantrasua.Model.DonHang;
import com.example.nhom02_bantrasua.Model.Product;
import com.example.nhom02_bantrasua.Model.Topping;
import com.example.nhom02_bantrasua.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

public class AdapterDonHang  extends BaseAdapter {
    ArrayList<DonHang> arrayListDonHang;
    Context context;
    public  AdapterDonHang(ArrayList<DonHang> ds, Context context)
    {
        this.context=context;
        this.arrayListDonHang=ds;
    }
    @Override
    public int getCount() {
        return arrayListDonHang.size();
    }

    @Override
    public Object getItem(int i) {
        return arrayListDonHang.get(i);
    }

    @Override
    public long getItemId(int i) {
        return i;
    }

    public class ViewHolder_DonHang
    {
        TextView tvChiTietDonHang,tvThongTinDonHang, tvGiaDonHang;
    }
    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        AdapterDonHang.ViewHolder_DonHang viewHolder=null;
        if(view==null)
        {
            viewHolder=new AdapterDonHang.ViewHolder_DonHang();
            LayoutInflater inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view=inflater.inflate(R.layout.cutomlayout_donhang,null);
            viewHolder.tvChiTietDonHang=view.findViewById(R.id.tvChiTieDonHang);
            viewHolder.tvThongTinDonHang=view.findViewById(R.id.tvThongTinDonHang);
            viewHolder.tvGiaDonHang=view.findViewById(R.id.tvGiaDon);
            view.setTag(viewHolder);

        }
        else
        {
            viewHolder=(AdapterDonHang.ViewHolder_DonHang) view.getTag();
            DonHang donHang=(DonHang) getItem(i);
            viewHolder.tvGiaDonHang.setText(donHang.getTongTien()+"vnđ giảm còn:" + donHang.getGiamGiaCon()+"vnđ");
            viewHolder.tvThongTinDonHang.setText("Mã đơn: "+donHang.getMaDonHang()+"; Ngày mua: "
                    +donHang.getNgayMua()+"; Địa chỉ nhận hàng: "+donHang.getDiaChiNhan());
            String chitiet="Chi tiết: ";
            if(donHang.getDsSanPham().size()>0)
            {
                for (ChiTietDatHang pr: donHang.getDsSanPham() )
                {
                    chitiet +=pr.getTenSanPham()+": "+pr.getGiaBan()+" ;";
                }
            }

            viewHolder.tvChiTietDonHang.setText(chitiet);

        }
        return view;
    }


}
