package com.example.nhom02_bantrasua;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.nhom02_bantrasua.AdapterPackage.AdapterLoaiSP;
import com.example.nhom02_bantrasua.Model.GioHang;
import com.example.nhom02_bantrasua.Model.KhachHang;
import com.example.nhom02_bantrasua.Model.LoaiSanPham;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class Login extends AppCompatActivity {

    TextView tvDangKy;
    EditText edtMatKhau, edtSDTDangNhap;
    Button btnDangNhap;

    String SDTDangNhap, MatKhau;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        getSupportActionBar().hide();
        addControls();
        tvDangKy.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(Login.this,SignUp.class);
                Login.this.startActivity(intent);
            }
        });
        btnDangNhap.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                SDTDangNhap=String.valueOf(edtSDTDangNhap.getText()).trim();
                MatKhau=String.valueOf(edtMatKhau.getText()).trim();
                if(SDTDangNhap!=null &&MatKhau!=null)
                {
                    String urlInsert="https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/APILogin.php";
                    DangNhap(urlInsert,SDTDangNhap,MatKhau);
                }

            }
        });
    }

    private void addControls() {

        tvDangKy=(TextView) findViewById(R.id.tvDangKy);
        edtMatKhau=(EditText) findViewById(R.id.edtMatKhau);
        edtSDTDangNhap=(EditText) findViewById(R.id.edtSDTDangNhap);
        btnDangNhap=(Button) findViewById(R.id.btnDangNhap);
    }
    private void DangNhap(String url, String SDTDangNhap,String MatKhau)
    {
        RequestQueue requestQueue= Volley.newRequestQueue(Login.this);
        StringRequest stringRequest=new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                if(response.trim().equals("err"))
                {
                    AlertDialog.Builder builder = new AlertDialog.Builder(Login.this);
                    builder.setTitle("Thông báo");
                    builder.setMessage("Lỗi đăng nhập, vui lòng thử lại");
                    builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int which) {
                            // do something
                        }
                    });
                    builder.show();

                }
                if(response.trim().equals("0"))
                {
                    //Toast.makeText(Login.this, "KhachHang", Toast.LENGTH_SHORT).show();
                    ContacTask_DangNhap contacTask_dangNhap=new ContacTask_DangNhap();
                    contacTask_dangNhap.execute();

                }
                if(response.trim().equals("1"))
                {
                    Toast.makeText(Login.this, "Nhan vien", Toast.LENGTH_SHORT).show();
                    Intent intent =new Intent(Login.this,TrangChuAdmin.class);
                    Login.this.startActivity(intent);

                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(Login.this, "Xảy ra lỗi: ", Toast.LENGTH_SHORT).show();
                Log.d("Lỗi","Lỗi\n"+error.toString());
            }
        }){
            @Nullable
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params=new HashMap<>();
                params.put("SDTDangNhap",SDTDangNhap);
                params.put("MatKhau",MatKhau);

                return params;
            }
        };
        requestQueue.add(stringRequest);
    }
    class ContacTask_DangNhap extends AsyncTask<Void, Void, KhachHang>
    {

        @Override
        protected KhachHang doInBackground(Void... voids) {
            KhachHang khachHang=new KhachHang();
            try {
                String urlInfor="https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/LayMotKhachHangBangSDT.php?SDTDangNhap="+SDTDangNhap;
                URL url=new URL(urlInfor);
                HttpURLConnection connection=(HttpURLConnection) url.openConnection();
                connection.setRequestMethod("GET");
                InputStreamReader inputStreamReader=new InputStreamReader(connection.getInputStream());
                StringBuilder stringBuilder=new StringBuilder();
                BufferedReader bufferedReader=new BufferedReader(inputStreamReader);
                String line=bufferedReader.readLine();
                while (line!=null)
                {
                    stringBuilder.append(line);
                    line=bufferedReader.readLine();

                }
                inputStreamReader.close();
                JSONArray jsonArray=new JSONArray(stringBuilder.toString());
                for(int i=0;i<jsonArray.length();i++)
                {
                    JSONObject jsonObject =jsonArray.getJSONObject(i);

                    String urlImage="https://vndt2001200082.000webhostapp.com/Images/imagesProducts/";
                    khachHang.setMaNguoiDung(jsonObject.getString("MaNguoiDung"));
                    khachHang.setMaLoaiKhach(jsonObject.getString("MaLoaiKH"));
                    khachHang.setTenLoaiKhach(jsonObject.getString("TenLoaiKhach"));
                    khachHang.setUuDai(Integer.valueOf(jsonObject.getString("UuDai")));
                    khachHang.setTenNguoiDung(jsonObject.getString("TenNguoiDung"));
                    khachHang.setSDTDangNhap(jsonObject.getString("SDTDangNhap"));
                    khachHang.setSDTLienHe(jsonObject.getString("SDTLienHe"));
                    khachHang.setEmail(jsonObject.getString("Email"));
                    khachHang.setAnhDaiDien(urlImage + jsonObject.getString("AnhDaiDien"));
                    khachHang.setGioiTinh(jsonObject.getString("GioiTinh"));
                    khachHang.setNgaySinh(jsonObject.getString("NgaySinh"));
                    //Toast.makeText(MainActivity.this, s, Toast.LENGTH_SHORT).show();
                }


            } catch (MalformedURLException e) {
                throw new RuntimeException(e);
            } catch (IOException e) {
                throw new RuntimeException(e);
            } catch (JSONException e) {
                throw new RuntimeException(e);
            }/* catch (ProtocolException e) {
                throw new RuntimeException(e);
            } catch (IOException e) {
                throw new RuntimeException(e);
            }*/

            return khachHang;
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

        }

        @Override
        protected void onPostExecute(KhachHang khachHang) {
            super.onPostExecute(khachHang);
            Toast.makeText(Login.this, "khachhang:"+khachHang.getTenNguoiDung(), Toast.LENGTH_SHORT).show();
                    Bundle bundle2=new Bundle();
                    bundle2.putSerializable("KhachHang",khachHang);
                    Intent intent1=new Intent(Login.this, MainActivity.class);
                    intent1.putExtras(bundle2);
                    Login.this.startActivity(intent1);

        }
    }

}