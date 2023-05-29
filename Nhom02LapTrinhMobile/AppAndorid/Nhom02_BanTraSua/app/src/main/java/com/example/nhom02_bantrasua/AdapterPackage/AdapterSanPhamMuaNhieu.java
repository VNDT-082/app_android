package com.example.nhom02_bantrasua.AdapterPackage;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;

import com.example.nhom02_bantrasua.ChiTietSanPham;
import com.example.nhom02_bantrasua.Model.Product;
import com.example.nhom02_bantrasua.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

public class AdapterSanPhamMuaNhieu extends RecyclerView.Adapter<AdapterSanPhamMuaNhieu.MyViewHolder> {

    private LayoutInflater inflater;
    private ArrayList<Product> DanhSachSanPham;

    public AdapterSanPhamMuaNhieu(Context ctx, ArrayList<Product> danhSachSanPham){

        inflater = LayoutInflater.from(ctx);
        this.DanhSachSanPham = danhSachSanPham;
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {

        View view = inflater.inflate(R.layout.customlayoutspmuanhieu, parent, false);
        MyViewHolder holder = new MyViewHolder(view);



        return holder;
    }



    @Override
    public void onBindViewHolder(MyViewHolder holder, int position) {

        //holder..setImageResource(DanhSachLoaiSanPham.get(position).getTenLoai());
        holder.TenLoai.setText(DanhSachSanPham.get(position).getTenSanPham());
        holder.tvGia.setText(DanhSachSanPham.get(position).getGiaBan()+" vnđ");

        Picasso picasso=Picasso.with(inflater.getContext());
        picasso.load(DanhSachSanPham.get(position).getHinhAnh()).resize(90,90)
                .placeholder(R.drawable.trasua)
                .into(holder.imgTheLoai);
        picasso.cancelRequest(holder.imgTheLoai);
        picasso.invalidate(DanhSachSanPham.get(position).getHinhAnh());

        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Product product=(Product) DanhSachSanPham.get(position);
                Bundle bundle=new Bundle();
                bundle.putSerializable("SanPham",product);
                Intent intent=new Intent(view.getContext(), ChiTietSanPham.class);
                intent.putExtras(bundle);
                view.getContext().startActivity(intent);
                }
        });
    }

    @Override
    public int getItemCount() {
        return DanhSachSanPham.size();
    }

    class MyViewHolder extends RecyclerView.ViewHolder{

        TextView TenLoai, tvGia;
        ImageView imgTheLoai;

        public MyViewHolder(View itemView) {
            super(itemView);

            TenLoai = (TextView) itemView.findViewById(R.id.tvTenLoai);
            imgTheLoai = (ImageView) itemView.findViewById(R.id.imgLoaiSP);
            tvGia=(TextView)itemView.findViewById(R.id.tvGia);
        }

    }
}
