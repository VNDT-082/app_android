package com.example.nhom02_bantrasua;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.nhom02_bantrasua.AdapterPackage.AdapterDonHang;
import com.example.nhom02_bantrasua.AdapterPackage.AdapterXuLyDonHang;
import com.example.nhom02_bantrasua.Model.ChiTietDatHang;
import com.example.nhom02_bantrasua.Model.ChiTietToppingGioHang;
import com.example.nhom02_bantrasua.Model.DonHang;
import com.example.nhom02_bantrasua.Model.GioHang;
import com.example.nhom02_bantrasua.Model.Topping;

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

public class QuanLyDonHang extends AppCompatActivity {

    ListView listview;
    ImageButton btnback;
    AdapterXuLyDonHang adapterXuLyDonHang;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_quan_ly_don_hang);
        getSupportActionBar().hide();
        addControls();
        ContacTask_QLDonHang contacTask_qlDonHang=new ContacTask_QLDonHang();
        contacTask_qlDonHang.execute();
        btnback.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(QuanLyDonHang.this,TrangChuAdmin.class);
                startActivity(intent);
            }
        });
    }
    private void addControls()
    {
        listview=(ListView) findViewById(R.id.listview);
        btnback=(ImageButton) findViewById(R.id.btnback);

    }

    class ContacTask_QLDonHang extends AsyncTask<Void, Void, ArrayList<DonHang>>
    {

        @Override
        protected ArrayList<DonHang> doInBackground(Void... voids) {
            ArrayList<DonHang> ds =new ArrayList<DonHang>();

            try {
                String strUrl="https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/LayTatCaDonHang.php";
                URL url=new URL(strUrl);

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
                if(jsonArray.length()>0)
                {
                    for(int i=0;i<jsonArray.length();i++)
                    {
                        JSONObject jsonObject =jsonArray.getJSONObject(i);
                        DonHang donHang=new DonHang();
                        donHang.setMaDonHang(jsonObject.getString("MaDonHang"));
                        donHang.setMaNguoiDung(jsonObject.getString("MaNguoiDung"));
                        donHang.setDiaChiNhan(jsonObject.getString("MaChiNhanh"));
                        donHang.setTongTien(jsonObject.getString("TongTien"));
                        donHang.setUuDai(jsonObject.getString("UuDai"));
                        donHang.setGiamGiaCon(jsonObject.getString("GiaGiamCon"));
                        donHang.setTrangThai(jsonObject.getString("TrangThai"));
                        donHang.setNgayMua(jsonObject.getString("NgayMua"));


//                        String strUrlSub="https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/LaySanPhamThuocDonHang.php?MaDonHang="
//                                + donHang.getMaDonHang();
//                        URL urlSub=new URL(strUrlSub);
//
//                        HttpURLConnection connectionSub=(HttpURLConnection) urlSub.openConnection();
//                        connectionSub.setRequestMethod("GET");
//                        InputStreamReader inputStreamReaderSub=new InputStreamReader(connectionSub.getInputStream());
//                        StringBuilder stringBuilderSub=new StringBuilder();
//                        BufferedReader bufferedReaderSub=new BufferedReader(inputStreamReaderSub);
//                        String lineSub=bufferedReaderSub.readLine();
//                        while (line!=null)
//                        {
//                            stringBuilderSub.append(lineSub);
//                            lineSub=bufferedReaderSub.readLine();
//
//                        }
//                        inputStreamReaderSub.close();
//                        JSONArray jsonArraySub=new JSONArray(stringBuilderSub.toString());
//                        if(jsonArraySub.length()>0 ||jsonArraySub!=null)
//                        {
//                            for (int j=0;j<jsonArraySub.length();j++)
//                            {
//                                JSONObject jsonObjectSub =jsonArray.getJSONObject(j);
//                                ChiTietDatHang chiTietDatHang=new ChiTietDatHang();
//                                chiTietDatHang.setMaSanPham(jsonObjectSub.getString("MaSanPham"));
//                                chiTietDatHang.setTenSanPham(jsonObjectSub.getString("TenSanPham"));
//                                chiTietDatHang.setMaDonHang(jsonObjectSub.getString("MaDonHang"));
//                                chiTietDatHang.setSoLuong(jsonObjectSub.getString("SoLuong"));
//                                chiTietDatHang.setGiaBan(jsonObjectSub.getString("GiaBan"));
//                                chiTietDatHang.setKhuyenMai(jsonObjectSub.getString("KhuyenMai"));
//                                chiTietDatHang.setGiamCon(jsonObjectSub.getString("GiamCon"));
//                                chiTietDatHang.setMaSize(jsonObjectSub.getString("MaSize"));
//                                chiTietDatHang.setLuongDuong(jsonObjectSub.getString("MaSanPham"));
//                                donHang.getDsSanPham().add(chiTietDatHang);
//                            }
//                        }
                        ds.add(donHang);
                    }
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

            return ds;
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

        }

        @Override
        protected void onPostExecute(ArrayList<DonHang> donHangs) {
            super.onPostExecute(donHangs);

            ArrayList<DonHang> ds =new ArrayList<DonHang>();
            for (DonHang donHang:donHangs) {
                if(donHang.getTrangThai().equals("0"))
                {
                    ds.add(donHang);
                }
            }
            adapterXuLyDonHang=new AdapterXuLyDonHang(ds,QuanLyDonHang.this);
            listview.setAdapter(adapterXuLyDonHang);
        }
    }


}
