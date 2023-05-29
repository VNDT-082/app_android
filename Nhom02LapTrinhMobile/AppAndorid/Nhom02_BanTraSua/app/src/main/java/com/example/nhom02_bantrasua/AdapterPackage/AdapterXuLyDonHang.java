package com.example.nhom02_bantrasua.AdapterPackage;

import android.content.Context;
import android.content.DialogInterface;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
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
import com.example.nhom02_bantrasua.Model.ChiTietDatHang;
import com.example.nhom02_bantrasua.Model.DonHang;
import com.example.nhom02_bantrasua.R;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class AdapterXuLyDonHang extends BaseAdapter {
    ArrayList<DonHang> arrayListDonHang;
    Context context;
    public  AdapterXuLyDonHang(ArrayList<DonHang> ds, Context context)
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

    public class ViewHolder_XLDonHang
    {
        TextView tvChiTietDonHang,tvThongTinDonHang, tvGiaDonHang;
        Button btnNhan,btnHuy;
    }
    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        AdapterXuLyDonHang.ViewHolder_XLDonHang viewHolder=null;
        if(view==null)
        {
            viewHolder=new AdapterXuLyDonHang.ViewHolder_XLDonHang();
            LayoutInflater inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view=inflater.inflate(R.layout.coustomlayout_qldonhang,null);
            viewHolder.tvChiTietDonHang=view.findViewById(R.id.tvChiTieDonHang1);
            viewHolder.tvThongTinDonHang=view.findViewById(R.id.tvThongTinDonHang1);
            viewHolder.tvGiaDonHang=view.findViewById(R.id.tvGiaDon1);
            viewHolder.btnHuy=view.findViewById(R.id.btnHuy);
            viewHolder.btnNhan=view.findViewById(R.id.btnNhan);
            view.setTag(viewHolder);

        }
        else
        {
            viewHolder=(AdapterXuLyDonHang.ViewHolder_XLDonHang) view.getTag();
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

        viewHolder.btnNhan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String ulr="https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/APINhanDon.php";
                DonHang donHang=(DonHang) getItem(i);
                NhanDon(ulr,donHang);
            }
        });
        viewHolder.btnHuy.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String url="https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/APIHuyDon.php";
                DonHang donHang=(DonHang) getItem(i);
                Toast.makeText(context, donHang.getMaDonHang(), Toast.LENGTH_SHORT).show();
                HuyDon(url,donHang);
            }
        });
        return view;
    }

    private void HuyDon(String url,DonHang donHang)
    {
        RequestQueue requestQueue= Volley.newRequestQueue(context);
        StringRequest stringRequest=new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                if(response.trim().equals("1"))
                {
                    AlertDialog.Builder builder = new AlertDialog.Builder(context);
                    builder.setTitle("Thông báo");
                    String mess="Đã từ chối đơn hàng: "+donHang.getMaDonHang();
                    for(ChiTietDatHang ct:donHang.getDsSanPham())
                    {
                        mess+="("+ct.getTenSanPham()+ct.getGiamCon()+")";
                    }
                    builder.setMessage(mess);
                    builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int which) {
                            // do something
                        }
                    });
                    builder.show();

                }
                else
                {
                    AlertDialog.Builder builder = new AlertDialog.Builder(context);
                    builder.setTitle("Thông báo");
                    builder.setMessage("Lỗi.");
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
                params.put("MaDonHang",donHang.getMaDonHang().trim());

                return params;
            }
        };
        requestQueue.add(stringRequest);
    }
    private void NhanDon(String url,DonHang donHang)
    {
        RequestQueue requestQueue= Volley.newRequestQueue(context);
        StringRequest stringRequest=new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                if(response.trim().equals("1"))
                {
                    AlertDialog.Builder builder = new AlertDialog.Builder(context);
                    builder.setTitle("Thông báo");
                    String mess="Đã nhận đơn hàng: "+donHang.getMaDonHang();
                    for(ChiTietDatHang ct:donHang.getDsSanPham())
                    {
                        mess+="("+ct.getTenSanPham()+ct.getGiamCon()+")";
                    }
                    builder.setMessage(mess);
                    builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int which) {
                            // do something
                        }
                    });
                    builder.show();

                }
                else
                {
                    AlertDialog.Builder builder = new AlertDialog.Builder(context);
                    builder.setTitle("Thông báo");
                    builder.setMessage("Lỗi.");
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
                params.put("MaDonHang",donHang.getMaDonHang().trim());

                return params;
            }
        };
        requestQueue.add(stringRequest);
    }

}