package com.example.nhom02_bantrasua;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.ListView;
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
import com.example.nhom02_bantrasua.AdapterPackage.AdapterTopping;
import com.example.nhom02_bantrasua.Model.ChiTietToppingGioHang;
import com.example.nhom02_bantrasua.Model.GioHang;
import com.example.nhom02_bantrasua.Model.KhachHang;
import com.example.nhom02_bantrasua.Model.Product;
import com.example.nhom02_bantrasua.Model.Size;
import com.example.nhom02_bantrasua.Model.Topping;
import com.squareup.picasso.Picasso;

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

public class ChiTietSanPham extends AppCompatActivity {

    Context CONTEXT= this;
    Product SANPHAM=new Product();
    KhachHang KHACHHANG=new KhachHang();
    ImageButton btnQuayVe,btnSubtract,btnAdd, btnSearch;
    ImageView imgSanPham, imgKhachHang;
    Button btnThemGioHang, btnTenNhanXet;
    EditText edtSearch, edtSoLuong;
    TextView tvTenSanPham,tvGia, tvChiTiet, tvGiaSize;
    Spinner Spinner_Size, Spinner_LuongDuong, Spinner_LuongDa;
    ListView listViewTopping;

    //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    ArrayList<String> LUONGDUONG=new ArrayList<String>();
    ArrayList<String> LUONGDA=new ArrayList<String>();

    ArrayAdapter<String> adapterSpinnerLuongDuong;
    ArrayAdapter<String> adapterSpinnerLuongDa;
    ArrayAdapter<Size> adapterSpinnerSize;

    ArrayList<Topping> DANHSACHTOPPING;


    AdapterTopping adapterTopping;
    //=====================================
    Size sizeDat=new Size();
    String luongDuong="vừa đủ";
    String luongDa="vừa đủ";
    ArrayList<Topping> danhSachTopping=new ArrayList<Topping>();



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_chi_tiet_san_pham);
        getSupportActionBar().hide();

        addControlls();
        Intent intent= getIntent();
        Bundle bundle=intent.getExtras();
        if(bundle!=null)
        {
            SANPHAM=(Product) bundle.getSerializable("SanPham");
            KHACHHANG=(KhachHang)bundle.getSerializable("KhachHang_") ;
            Toast.makeText(CONTEXT, KHACHHANG.getTenNguoiDung(), Toast.LENGTH_SHORT).show();
            tvTenSanPham.setText(SANPHAM.getTenSanPham());
            tvGia.setText(String.valueOf(SANPHAM.getGiaBan())+"VNĐ");
            tvChiTiet.setText(SANPHAM.getMoTa());
            Picasso.with(this).load(SANPHAM.getHinhAnh())
                    .placeholder(R.drawable.poster)
                    .into(imgSanPham);
            imgKhachHang.setImageResource(R.drawable.persondefault);
        }
        ContacTask contacTask=new ContacTask();
        contacTask.execute();

        btnQuayVe.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(ChiTietSanPham.this, MainActivity.class);
                startActivity(intent);
            }
        });
        btnAdd.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                int soLuong=Integer.valueOf(String.valueOf(edtSoLuong.getText()));
                if(soLuong>100)
                {
                    soLuong=100;
                    Toast.makeText(CONTEXT, "so luong khong qua 100", Toast.LENGTH_SHORT).show();
                }
                else {
                    soLuong++;
                }

                edtSoLuong.setText(String.valueOf(soLuong));
            }
        });
        btnSubtract.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                int soLuong=Integer.valueOf(String.valueOf(edtSoLuong.getText()));
                if(soLuong==0)
                {
                    edtSoLuong.setText(String.valueOf(0));
                }
                else
                {
                    soLuong--;
                    edtSoLuong.setText(String.valueOf(soLuong));
                }
            }
        });

        //========================================================================
        //===============DATHANG==================================================
        Spinner_Size.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
               sizeDat=(Size) adapterView.getItemAtPosition(i);
                tvGiaSize.setText(sizeDat.getGia()+" vnđ");
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }
        });
        Spinner_LuongDa.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                luongDa=(String)adapterView.getItemAtPosition(i);
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }
        });
        Spinner_LuongDuong.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                luongDuong=(String)adapterView.getItemAtPosition(i);
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }
        });

        btnThemGioHang.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {


                int soLuong=Integer.valueOf(edtSoLuong.getText().toString());
                if(soLuong==0)
                {
                    AlertDialog.Builder builder = new AlertDialog.Builder(ChiTietSanPham.this);
                    builder.setTitle("Thông báo");
                    builder.setMessage("Bạn chưa chọn số lượng");
                    builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int which) {
                            // do something
                        }
                    });
                    builder.show();
                }
                else {
                    if(adapterTopping.DanhSachToppingDaChon().size()>0)
                    {
                        danhSachTopping= adapterTopping.DanhSachToppingDaChon();
                    }
                    else {
                        danhSachTopping=null;
                    }

                    MainActivity mainActivity=new MainActivity();
                    if(KHACHHANG!=null)
                    {
                        GioHang gioHang=new GioHang();
                        gioHang.setMaSanPham(SANPHAM.getMaSanPham());
                        gioHang.setMaNguoiDung(KHACHHANG.getMaNguoiDung());
                        gioHang.setTenSanPham(SANPHAM.getTenSanPham());
                        gioHang.setMaSize(sizeDat.getMaSize());
                        gioHang.setSoLuong(String.valueOf(soLuong));
                        gioHang.setLuongDuong(luongDuong);
                        gioHang.setLuongDa(luongDa);
                        gioHang.setGiaSize(sizeDat.getGia());
                        gioHang.setHinhAnh(SANPHAM.getHinhAnh());
                        gioHang.setGiaSanPham(String.valueOf(SANPHAM.getGiaBan()));
                        Toast.makeText(ChiTietSanPham.this, String.valueOf(gioHang.getTenSanPham())+";"
                                +String.valueOf(gioHang.getMaSize())+
                                ";"+String.valueOf(gioHang.getLuongDuong()), Toast.LENGTH_SHORT).show();
                        String urlInsert="https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/APIThemMotGioHang.php";
                        ThemGioHang(urlInsert,gioHang);


                    }

                }
            }
        });
    }
    public void addControlls()
    {
        btnQuayVe=(ImageButton) findViewById(R.id.btnQuayVe);
        btnSubtract=(ImageButton) findViewById(R.id.btnSubtract);
        btnAdd=(ImageButton) findViewById(R.id.btnAdd);
        btnSearch=(ImageButton) findViewById(R.id.btnSearch);
        btnThemGioHang=(Button) findViewById(R.id.btnThemGioHang);
        btnTenNhanXet=(Button) findViewById(R.id.btnTenNhanXet);
        edtSearch=(EditText) findViewById(R.id.edtSearch);
        edtSoLuong=(EditText) findViewById(R.id.edtSoLuong);
        tvTenSanPham=(TextView) findViewById(R.id.tvTenSanPham);
        tvGia=(TextView) findViewById(R.id.tvGia);
        tvGiaSize=(TextView)findViewById(R.id.tvGiaSize);
        tvChiTiet=(TextView)findViewById(R.id.tvChiTiet);
        Spinner_LuongDa=(Spinner) findViewById(R.id.Spinner_LuongDa);
        Spinner_Size=(Spinner) findViewById(R.id.Spinner_Size);
        Spinner_LuongDuong=(Spinner) findViewById(R.id.Spinner_LuongDuong);
        imgSanPham=(ImageView) findViewById(R.id.imgSanPham);
        imgKhachHang=(ImageView) findViewById(R.id.imgKhachHang);
        listViewTopping=(ListView)findViewById(R.id.listViewTopping);
        LUONGDUONG.add("vừa đủ");
        LUONGDUONG.add("ít đường");
        LUONGDUONG.add("nhiều đường");
        LUONGDA.add("vừa đủ");
        LUONGDA.add("ít đá");
        LUONGDA.add("nhiều đá");
        adapterSpinnerLuongDuong=new ArrayAdapter<>(
                this, android.R.layout.simple_spinner_item,LUONGDUONG);
        adapterSpinnerLuongDuong.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        Spinner_LuongDuong.setAdapter(adapterSpinnerLuongDuong);

        adapterSpinnerLuongDa=new ArrayAdapter<>(
                this, android.R.layout.simple_spinner_item,LUONGDA);
        adapterSpinnerLuongDa.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        Spinner_LuongDa.setAdapter(adapterSpinnerLuongDa);

        ArrayList<Size> DanhSachSize=Size.DanhSachSize();
        adapterSpinnerSize=new ArrayAdapter<>(this, android.R.layout.simple_spinner_item,DanhSachSize);
        adapterSpinnerSize.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        Spinner_Size.setAdapter(adapterSpinnerSize);

    }
    private void ThemGioHang(String url,GioHang gioHang)
    {
        RequestQueue requestQueue= Volley.newRequestQueue(ChiTietSanPham.this);
        StringRequest stringRequest=new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                if(response.trim().equals("err"))
                {
                    AlertDialog.Builder builder = new AlertDialog.Builder(ChiTietSanPham.this);
                    builder.setTitle("Thông báo");
                    builder.setMessage("Lỗi thêm sản phẩm, vui lòng thử lại");
                    builder.setPositiveButton("OK", new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int which) {
                            // do something
                        }
                    });
                    builder.show();

                }
                else
                {
                    Toast.makeText(ChiTietSanPham.this, "Thêm giỏ hàng:"+response.trim()
                            +" thành công.", Toast.LENGTH_SHORT).show();

                    String urlTopping="https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/APIThemChiTietToppingGioHang.php";
                    if(danhSachTopping!=null)
                    {
                        String idGioHang=response.trim();
                        for (Topping topping: danhSachTopping) {
                            ChiTietToppingGioHang chiTietToppingGioHang=new ChiTietToppingGioHang();
                            chiTietToppingGioHang.setID(idGioHang);
                            chiTietToppingGioHang.setTopping(topping);
                            ThemToppingChoSanPham(urlTopping,chiTietToppingGioHang);
                        }
                    }
                    Bundle bundle2=new Bundle();
                    bundle2.putSerializable("KhachHang",KHACHHANG);
                    Intent intent1=new Intent(ChiTietSanPham.this, MainActivity.class);
                    intent1.putExtras(bundle2);
                    ChiTietSanPham.this.startActivity(intent1);

                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(ChiTietSanPham.this, "Xảy ra lỗi: ", Toast.LENGTH_SHORT).show();
                Log.d("Lỗi","Lỗi\n"+error.toString());
            }
        }){
            @Nullable
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params=new HashMap<>();
                params.put("MaSize",gioHang.getMaSize().trim());
                params.put("LuongDuong",gioHang.getLuongDuong().trim());
                params.put("LuongDa",gioHang.getLuongDa().trim());
                params.put("SoLuong",gioHang.getSoLuong().trim());
                params.put("MaSanPham",gioHang.getMaSanPham().trim());
                params.put("MaNguoiDung",gioHang.getMaNguoiDung().trim());

                return params;
            }
        };
        requestQueue.add(stringRequest);
    }


    private void ThemToppingChoSanPham(String url, ChiTietToppingGioHang chiTietToppingGioHang)
    {
        RequestQueue requestQueue= Volley.newRequestQueue(ChiTietSanPham.this);
        StringRequest stringRequest=new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                if(response.trim().equals("err"))
                {
                    AlertDialog.Builder builder = new AlertDialog.Builder(ChiTietSanPham.this);
                    builder.setTitle("Thông báo");
                    builder.setMessage("Lỗi thêm sản phẩm, vui lòng thử lại");
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
                Toast.makeText(ChiTietSanPham.this, "Xảy ra lỗi: ", Toast.LENGTH_SHORT).show();
                Log.d("Lỗi","Lỗi\n"+error.toString());
            }
        }){
            @Nullable
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String,String> params=new HashMap<>();
                params.put("ID",chiTietToppingGioHang.getID().trim());
                params.put("MaTopping",chiTietToppingGioHang.getTopping().MaTopping.trim());
                params.put("Gia",String.valueOf(chiTietToppingGioHang.getTopping().getGia()).trim());

                return params;
            }
        };
        requestQueue.add(stringRequest);
    }

    class ContacTask extends AsyncTask<Void, Void, ArrayList<Topping>>
    {

        @Override
        protected ArrayList<Topping> doInBackground(Void... voids) {
            ArrayList<Topping> ds =new ArrayList<Topping>();
            try {
                URL url=new URL("https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/jSonTopping.php");
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
                    Topping topping=new Topping();
                    String urlImage="https://vndt2001200082.000webhostapp.com/Images/imagesProducts/";
                    topping.setMaTopping(jsonObject.getString("MaTopping"));
                    topping.setTenTopping(jsonObject.getString("TenTopping"));
                    topping.setGia(Double.valueOf(jsonObject.getString("Gia")));
                    topping.setHinhAnh(urlImage + jsonObject.getString("HinhAnh"));
                    ds.add(topping);
                    //Toast.makeText(MainActivity.this, s, Toast.LENGTH_SHORT).show();
                }


            } catch (MalformedURLException e) {
                throw new RuntimeException(e);
            } catch (IOException e) {
                throw new RuntimeException(e);
            } catch (JSONException e) {
                throw new RuntimeException(e);
            }

            return ds;
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

        }

        @Override
        protected void onPostExecute(ArrayList<Topping> toppings) {
            super.onPostExecute(toppings);

            DANHSACHTOPPING=new ArrayList<Topping>();
            for (Topping topping:toppings) {
                DANHSACHTOPPING.add(topping);
            }

            adapterTopping=new AdapterTopping(DANHSACHTOPPING,CONTEXT);
            listViewTopping.setAdapter(adapterTopping);
        }
    }
}

