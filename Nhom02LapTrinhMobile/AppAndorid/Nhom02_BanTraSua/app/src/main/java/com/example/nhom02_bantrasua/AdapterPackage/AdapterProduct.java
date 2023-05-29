package com.example.nhom02_bantrasua.AdapterPackage;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.nhom02_bantrasua.ChiTietSanPham;
import com.example.nhom02_bantrasua.MainActivity;
import com.example.nhom02_bantrasua.Model.KhachHang;
import com.example.nhom02_bantrasua.Model.Product;
import com.example.nhom02_bantrasua.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

public class AdapterProduct extends BaseAdapter {
    ArrayList<Product> arrayListProduct;
    Context context;
    KhachHang khachHang;

    private AdapterView.OnItemClickListener mListener;



    public AdapterProduct(ArrayList<Product> arrayListProduct, Context context, KhachHang khachHang) {
        this.arrayListProduct = arrayListProduct;
        this.context = context;
        this.khachHang=khachHang;
    }

    @Override
    public int getCount() {
        return arrayListProduct.size();
    }

    @Override
    public Object getItem(int i) {
        return arrayListProduct.get(i);
    }

    @Override
    public long getItemId(int i) {
        return i;
    }
    public  class  ViewHolder
    {
        TextView tv_sp_name, tv_sp_luotmua, tv_sp_gia;
        ImageView sp_image;
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        ViewHolder viewHolder=null;
        if(view==null)
        {
            viewHolder=new ViewHolder();
            LayoutInflater inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view=inflater.inflate(R.layout.customlayout_product,null);
            viewHolder.sp_image=view.findViewById(R.id.sp_image);
            viewHolder.tv_sp_gia=view.findViewById(R.id.tv_sp_gia);
            viewHolder.tv_sp_luotmua=view.findViewById(R.id.tv_sp_luotmua);
            viewHolder.tv_sp_name=view.findViewById(R.id.tv_sp_name);
            view.setTag(viewHolder);

        }
        else
        {
            viewHolder=(ViewHolder) view.getTag();
            Product product= (Product) getItem(i);
            viewHolder.tv_sp_name.setText(product.getTenSanPham());
            viewHolder.tv_sp_gia.setText(String.valueOf(product.getGiaBan()));
            viewHolder.tv_sp_luotmua.setText(String.valueOf(product.getLuotMua()));

            Picasso picasso=Picasso.with(context);
            picasso.load(product.getHinhAnh()).resize(90,90)
                    .placeholder(R.drawable.trasua)
                    .into(viewHolder.sp_image);
            picasso.invalidate(product.getHinhAnh());

        }

        view.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Product sanpham_=(Product) getItem(i);
                Toast.makeText(context, sanpham_.getTenSanPham(), Toast.LENGTH_SHORT).show();
                MainActivity mainActivity=new MainActivity();
                KhachHang khachHang_=(KhachHang)mainActivity.khachHang;
                Bundle bundle=new Bundle();
                //Bundle bundle1=new Bundle();
                bundle.putSerializable("SanPham",sanpham_);
                bundle.putSerializable("KhachHang_",khachHang);
                Intent intent=new Intent(view.getContext(), ChiTietSanPham.class);
                intent.putExtras(bundle);
                //intent.putExtras(bundle1);
                view.getContext().startActivity(intent);
            }
        });



        return view;
    }

//    public void setOnItemClickListener(AdapterView.OnItemClickListener listener) {
//        mListener = listener;
//    }
}