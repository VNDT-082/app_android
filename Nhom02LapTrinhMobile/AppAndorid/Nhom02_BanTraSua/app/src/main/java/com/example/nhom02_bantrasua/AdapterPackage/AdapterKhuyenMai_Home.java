package com.example.nhom02_bantrasua.AdapterPackage;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;

import androidx.recyclerview.widget.RecyclerView;

import com.example.nhom02_bantrasua.Model.KhuyenMai;
import com.example.nhom02_bantrasua.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

public class AdapterKhuyenMai_Home extends RecyclerView.Adapter<AdapterKhuyenMai_Home.MyViewHolderKhuyenMai> {

    private LayoutInflater inflater;
    private ArrayList<KhuyenMai> DanhSachKhuyenMai;

    public AdapterKhuyenMai_Home(Context ctx, ArrayList<KhuyenMai> danhSachKhuyenMai){

        inflater = LayoutInflater.from(ctx);
        this.DanhSachKhuyenMai = danhSachKhuyenMai;
    }

    @Override
    public MyViewHolderKhuyenMai onCreateViewHolder(ViewGroup parent, int viewType) {

        View view = inflater.inflate(R.layout.customlayoutkhuyenmai, parent, false);
        MyViewHolderKhuyenMai holder = new MyViewHolderKhuyenMai(view);

        return holder;
    }

    @Override
    public void onBindViewHolder(MyViewHolderKhuyenMai holder, int position) {

        Picasso picasso=Picasso.with(inflater.getContext());
        picasso.load(DanhSachKhuyenMai.get(position).getHinhAnh()).fit()
                .placeholder(R.drawable.bannertranguyenchat)
                .into(holder.imgKhuyenMai);
        picasso.cancelRequest(holder.imgKhuyenMai);
        picasso.invalidate(DanhSachKhuyenMai.get(position).getHinhAnh());


    }

    @Override
    public int getItemCount() {
        return DanhSachKhuyenMai.size();
    }

    class MyViewHolderKhuyenMai extends RecyclerView.ViewHolder{
        ImageView imgKhuyenMai;

        public MyViewHolderKhuyenMai(View itemView) {
            super(itemView);
            imgKhuyenMai = (ImageView) itemView.findViewById(R.id.imgKhuyenMai);
        }

    }
}