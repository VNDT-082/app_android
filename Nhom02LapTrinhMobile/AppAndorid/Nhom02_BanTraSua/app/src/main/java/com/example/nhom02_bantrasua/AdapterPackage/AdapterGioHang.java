package com.example.nhom02_bantrasua.AdapterPackage;

import android.content.Context;
import android.content.DialogInterface;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.nhom02_bantrasua.ChiTietSanPham;
import com.example.nhom02_bantrasua.Model.ChiTietToppingGioHang;
import com.example.nhom02_bantrasua.Model.GioHang;
import com.example.nhom02_bantrasua.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class AdapterGioHang extends BaseAdapter {
    ArrayList<GioHang> arrayListGioHang;
    Context context;
    public  AdapterGioHang(ArrayList<GioHang> arrayListGioHang, Context context)
    {
        this.context=context;
        this.arrayListGioHang =arrayListGioHang;
    }
    @Override
    public int getCount() {
        return arrayListGioHang.size();
    }

    @Override
    public Object getItem(int i) {
        return arrayListGioHang.get(i);
    }

    @Override
    public long getItemId(int i) {
        return i;
    }

    public class ViewHolder_GioHang
    {
        ImageView imgSanPham;
        TextView tvTenSanPham,tvGia, tvChiTiet;
        ImageButton btnDelete;
        EditText edtSoLuong;
    }
    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        ViewHolder_GioHang viewHolder=null;
        if(view==null)
        {
            viewHolder=new ViewHolder_GioHang();
            LayoutInflater inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view=inflater.inflate(R.layout.customlayout_giohang,null);
            viewHolder.imgSanPham=view.findViewById(R.id.imgSanPham);
            viewHolder.tvTenSanPham=view.findViewById(R.id.tvTenSanPham);
            viewHolder.tvGia=view.findViewById(R.id.tvGia);
            viewHolder.tvChiTiet=view.findViewById(R.id.tvChiTiet);
            viewHolder.btnDelete=view.findViewById(R.id.btnDelete);
            viewHolder.edtSoLuong=view.findViewById(R.id.edtSoLuong);
            view.setTag(viewHolder);

        }
        else
        {
            viewHolder=(ViewHolder_GioHang) view.getTag();
            GioHang gioHang=(GioHang) getItem(i);
            viewHolder.tvTenSanPham.setText(String.valueOf(gioHang.getTenSanPham()));
            viewHolder.tvGia.setText(String.valueOf(gioHang.getGiaSanPham()));
            viewHolder.edtSoLuong.setText(String.valueOf(gioHang.getSoLuong()));
            viewHolder.tvChiTiet.setText(String.valueOf(""));
            String ChiTietToppingGioHang="";
            if(gioHang.getChiTietTopping().size()!=0)
            {
                for(ChiTietToppingGioHang ct:gioHang.getChiTietTopping())
                {
                    ChiTietToppingGioHang+=ct.getTopping().TenTopping+"("+String.valueOf(ct.getTopping().getGia())+"); ";
                }
            }
            viewHolder.tvChiTiet.setText(ChiTietToppingGioHang);
            Picasso picasso=Picasso.with(context);
            picasso.load(gioHang.getHinhAnh()).resize(90,90)
                    .placeholder(R.drawable.trasua)
                    .into(viewHolder.imgSanPham);
            picasso.cancelRequest(viewHolder.imgSanPham);
            picasso.invalidate(gioHang.getHinhAnh());

            viewHolder.btnDelete.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    String urlDelete="https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/APIXoaMotSanPhamGioHang.php";
                    XoaMotSanPhamKhoiGioHang(urlDelete,gioHang.getID());
                }
            });
        }

        return view;
    }
    private void XoaMotSanPhamKhoiGioHang(String url, String IdGioHang)
    {
        RequestQueue requestQueue= Volley.newRequestQueue(context);
        StringRequest stringRequest=new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                if(response.trim().equals("1"))
                {
                    AlertDialog.Builder builder = new AlertDialog.Builder(context);
                    builder.setTitle("Thông báo");
                    builder.setMessage("Đã xóa sản phẩm");
                    builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int which) {
                            // do something
                        }
                    });
                    builder.show();

                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("Lỗi","Lỗi\n"+error.toString());
            }
        }){
            @Nullable
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params=new HashMap<>();
                params.put("ID",IdGioHang.trim());

                return params;
            }
        };
        requestQueue.add(stringRequest);
    }
}
