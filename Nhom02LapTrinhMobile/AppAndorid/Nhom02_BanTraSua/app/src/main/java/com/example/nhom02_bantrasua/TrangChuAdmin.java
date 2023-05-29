package com.example.nhom02_bantrasua;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.FrameLayout;
import android.widget.TextView;

import com.example.nhom02_bantrasua.AdapterPackage.AdapterXuLyDonHang;
import com.example.nhom02_bantrasua.Model.DonHang;

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

public class TrangChuAdmin extends AppCompatActivity {

    FrameLayout btnDonDat,btnQLSanPham,btnQLLoaiSanPham, btnDangXuat;
    TextView tvDonDat, tvDoanhThu;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_trang_chu_admin);
        getSupportActionBar().hide();
        addControls();
        ContacTask_Admin contacTask_admin=new ContacTask_Admin();
        contacTask_admin.execute();
        btnQLSanPham.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(TrangChuAdmin.this,QuanLySanPham.class);
                TrangChuAdmin.this.startActivity(intent);
            }
        });
        btnDonDat.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(TrangChuAdmin.this,QuanLyDonHang.class);
                TrangChuAdmin.this.startActivity(intent);
            }
        });
        btnQLLoaiSanPham.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(TrangChuAdmin.this,QuanLyLoaiSanPham.class);
                TrangChuAdmin.this.startActivity(intent);
            }
        });
        btnDangXuat.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(TrangChuAdmin.this,Login.class);
                TrangChuAdmin.this.startActivity(intent);
            }
        });
    }
    void addControls()
    {
        btnDonDat=(FrameLayout) findViewById(R.id.btnDonDat);
        btnQLSanPham=(FrameLayout) findViewById(R.id.btnQLSanPham);
        btnQLLoaiSanPham=(FrameLayout) findViewById(R.id.btnQLLoaiSanPham);
        btnDangXuat=(FrameLayout)findViewById(R.id.btnDangXuat);
        tvDoanhThu=(TextView) findViewById(R.id.tvDoanhThu);
        tvDonDat=(TextView) findViewById(R.id.tvDonDat);
    }
    class ContacTask_Admin extends AsyncTask<Void, Void, ArrayList<DonHang>>
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
            double tongtien=0;
            int dondat=0;
            for (DonHang donHang:donHangs) {
                tongtien+=Double.valueOf(donHang.getGiamGiaCon());
                if(donHang.getTrangThai().equals("0"))
                {
                    dondat++;
                    ds.add(donHang);
                }
            }
            tvDonDat.setText("Đơn đặt: "+dondat);
            tvDoanhThu.setText("Doanh thu: "+tongtien+" vnđ");
        }
    }


}