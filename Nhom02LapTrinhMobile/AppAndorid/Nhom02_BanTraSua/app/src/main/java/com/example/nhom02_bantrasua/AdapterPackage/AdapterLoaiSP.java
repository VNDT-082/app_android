package com.example.nhom02_bantrasua.AdapterPackage;

import android.app.Activity;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.recyclerview.widget.RecyclerView;
import androidx.viewpager.widget.ViewPager;

import com.example.nhom02_bantrasua.Model.LoaiSanPham;
import com.example.nhom02_bantrasua.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

public class AdapterLoaiSP extends RecyclerView.Adapter<AdapterLoaiSP.MyViewHolderLoaiSanPham> {

    private LayoutInflater inflater;
    private ArrayList<LoaiSanPham> DanhSachLoaiSanPham;
    private View mView;
    private Context context;

    public AdapterLoaiSP(Context ctx, ArrayList<LoaiSanPham> danhSachLoaiSanPham){

        this.context=ctx;
        inflater = LayoutInflater.from(ctx);
        this.DanhSachLoaiSanPham = danhSachLoaiSanPham;
    }

    @Override
    public MyViewHolderLoaiSanPham onCreateViewHolder(ViewGroup parent, int viewType) {

        View view = inflater.inflate(R.layout.customlayout_loaisanpham, parent, false);
        MyViewHolderLoaiSanPham holder = new MyViewHolderLoaiSanPham(view);
        mView=view;
        return holder;
    }

    @Override
    public void onBindViewHolder(MyViewHolderLoaiSanPham holder, int position) {

        //holder..setImageResource(DanhSachLoaiSanPham.get(position).getTenLoai());
        holder.TenLoai.setText(DanhSachLoaiSanPham.get(position).getTenLoai());

        Picasso picasso=Picasso.with(inflater.getContext());
        picasso.load(DanhSachLoaiSanPham.get(position).getHinhAnh()).resize(90,90)
                .placeholder(R.drawable.trasua)
                .into(holder.imgTheLoai);
        picasso.cancelRequest(holder.imgTheLoai);
        picasso.invalidate(DanhSachLoaiSanPham.get(position).getHinhAnh());

        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Activity activity= (Activity) context;
                ViewPager viewPager=activity.findViewById(R.id.viewPager);
                viewPager.setCurrentItem(0,true);
            }
        });

    }

    @Override
    public int getItemCount() {
        return DanhSachLoaiSanPham.size();
    }

    class MyViewHolderLoaiSanPham extends RecyclerView.ViewHolder{

        TextView TenLoai;
        ImageView imgTheLoai;

        public MyViewHolderLoaiSanPham(View itemView) {
            super(itemView);

            TenLoai = (TextView) itemView.findViewById(R.id.tvTenLoai);
            imgTheLoai = (ImageView) itemView.findViewById(R.id.imgLoaiSP);
        }

    }
}
