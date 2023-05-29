package com.example.nhom02_bantrasua;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.text.method.SingleLineTransformationMethod;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.nhom02_bantrasua.Model.ChiTietToppingGioHang;
import com.example.nhom02_bantrasua.Model.GioHang;
import com.example.nhom02_bantrasua.Model.KhachHang;
import com.example.nhom02_bantrasua.Model.Topping;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class SignUp extends AppCompatActivity {

    EditText edtTenKhachHang,edtSDTDangNhap,edtEmail,editTextDate,edtMatKhau;
    Spinner SpinnerGioiTinh;
    Button btnDangKy;
    TextView tvDangNhap;
    ArrayList<String> DSGioiTinh=new ArrayList<String>();
    ArrayAdapter<String> adapterSpinnerGioiTinh;
    String gt="Nam";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);
        getSupportActionBar().hide();
        addControls();
        SpinnerGioiTinh.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                gt=(String)adapterView.getItemAtPosition(i);
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }
        });
        btnDangKy.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String Email=String.valueOf(edtEmail.getText()).trim();
                String TenKhachHang=String.valueOf(edtTenKhachHang.getText()).trim();
                String SDTDangNhap=String.valueOf(edtSDTDangNhap.getText()).trim();
                String NgaySinh=String.valueOf(editTextDate.getText()).trim();
                String MatKhau=String.valueOf(edtMatKhau.getText()).trim();

                KhachHang khachHang=new KhachHang();
                khachHang.setEmail(Email);
                khachHang.setTenNguoiDung(TenKhachHang);
                khachHang.setSDTDangNhap(SDTDangNhap);
                khachHang.setNgaySinh(NgaySinh);
                khachHang.setMatKhau(MatKhau);
                if(gt.equals("Nữ"))
                {
                    khachHang.setGioiTinh("0");
                }
                else
                {
                    khachHang.setGioiTinh("1");
                }
                String url="https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/APIThemKhachHang.php";
                ThemKhacHang(url,khachHang);
            }
        });
    }

    private void ThemKhacHang(String url, KhachHang khachHang)
    {
        RequestQueue requestQueue= Volley.newRequestQueue(SignUp.this);
        StringRequest stringRequest=new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                if(!response.trim().equals("0"))
                {
                    Intent intent =new Intent(SignUp.this,Login.class);
                    SignUp.this.startActivity(intent);

                }
                else
                {
                    AlertDialog.Builder builder = new AlertDialog.Builder(SignUp.this);
                    builder.setTitle("Thông báo");
                    builder.setMessage("Lỗi đăng ký, vui lòng thử lại");
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
                params.put("TenKhachHang",khachHang.getTenNguoiDung().trim());
                params.put("SDT",khachHang.getSDTDangNhap().trim());
                params.put("NgaySinh",khachHang.getNgaySinh().trim());
                params.put("MatKhau",khachHang.getMatKhau().trim());
                params.put("GioiTinh",khachHang.getGioiTinh().trim());
                params.put("Email",khachHang.getEmail().trim());

                return params;
            }
        };
        requestQueue.add(stringRequest);
    }
    private void addControls()
    {
        edtEmail=(EditText) findViewById(R.id.edtEmail);
        edtTenKhachHang=(EditText) findViewById(R.id.edtTenKhachHang);
        edtSDTDangNhap=(EditText) findViewById(R.id.edtSDTDangNhap);
        editTextDate=(EditText) findViewById(R.id.editTextDate);
        edtMatKhau=(EditText) findViewById(R.id.edtMatKhau);
        SpinnerGioiTinh=(Spinner) findViewById(R.id.SpinnerGioiTinh);
        btnDangKy=(Button) findViewById(R.id.btnDangKy);
        tvDangNhap=(TextView) findViewById(R.id.tvDangNhap);
        DSGioiTinh.add("Chọn giới tính");
        DSGioiTinh.add("Nam");
        DSGioiTinh.add("Nữ");
        adapterSpinnerGioiTinh=new ArrayAdapter<>(
                this, android.R.layout.simple_spinner_item,DSGioiTinh);
        SpinnerGioiTinh.setAdapter(adapterSpinnerGioiTinh);

    }
}