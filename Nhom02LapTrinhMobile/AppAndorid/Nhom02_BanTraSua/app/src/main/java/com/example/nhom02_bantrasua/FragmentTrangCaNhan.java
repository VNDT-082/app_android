package com.example.nhom02_bantrasua;

import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.fragment.app.Fragment;

import com.example.nhom02_bantrasua.AdapterPackage.AdapterDonHang;
import com.example.nhom02_bantrasua.AdapterPackage.AdapterProduct;
import com.example.nhom02_bantrasua.Model.ChiTietDatHang;
import com.example.nhom02_bantrasua.Model.DonHang;
import com.example.nhom02_bantrasua.Model.KhachHang;
import com.example.nhom02_bantrasua.Model.Product;

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

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link FragmentTrangCaNhan#newInstance} factory method to
 * create an instance of this fragment.
 */
public class FragmentTrangCaNhan extends Fragment {

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;
    KhachHang khachHang;
    View mView;


    TextView tvTenKhachHang,tvSDTDangNhap,tvGioiTinh,tvNgaySinh,tvLoaiKhachHang,tvEmail;
    EditText edtMatKhau;
    Button btnDoiMatKhau;
    ListView listViewDonHangChoDuyet, listViewDonHangDaMua;

    AdapterDonHang adapterDonHangDaMua,adapterDonHangChoDuyet;


    public FragmentTrangCaNhan() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment FragmentTrangCaNhan.
     */
    // TODO: Rename and change types and number of parameters
    public static FragmentTrangCaNhan newInstance(String param1, String param2) {
        FragmentTrangCaNhan fragment = new FragmentTrangCaNhan();
        Bundle args = new Bundle();
        args.putString(ARG_PARAM1, param1);
        args.putString(ARG_PARAM2, param2);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mParam1 = getArguments().getString(ARG_PARAM1);
            mParam2 = getArguments().getString(ARG_PARAM2);
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment

        mView= inflater.inflate(R.layout.fragment_trang_ca_nhan, container, false);
        MainActivity mainActivity=(MainActivity) getActivity();
        khachHang=mainActivity.khachHang;
        addControls(mView);

        ContacTask_DonHang contacTask_donHang=new ContacTask_DonHang();
        contacTask_donHang.execute();

        return  mView;
    }
    private void addControls(View mView)
    {
        tvTenKhachHang=mView.findViewById(R.id.tvTenKhachHang);
        tvSDTDangNhap=mView.findViewById(R.id.tvSDTDangNhap);
        tvGioiTinh=mView.findViewById(R.id.tvGioiTinh);
        tvNgaySinh=mView.findViewById(R.id.tvNgaySinh);
        tvLoaiKhachHang=mView.findViewById(R.id.tvLoaiKhachHang);
        tvEmail=mView.findViewById(R.id.tvEmail);
        edtMatKhau=mView.findViewById(R.id.edtMatKhau);
        btnDoiMatKhau=mView.findViewById(R.id.btnDoiMatKhau);
        listViewDonHangChoDuyet=mView.findViewById(R.id.listViewDonHangChoDuyet);
        listViewDonHangDaMua=mView.findViewById(R.id.listViewDonHangDaMua);


        tvTenKhachHang.setText(khachHang.getTenNguoiDung());
        tvSDTDangNhap.setText(khachHang.getSDTDangNhap());
        if(khachHang.getGioiTinh().equals("0"))
        {
            tvGioiTinh.setText("Nữ");
        }
        else {
            tvGioiTinh.setText("Nam");
        }
        tvNgaySinh.setText(khachHang.getNgaySinh());
        tvLoaiKhachHang.setText(khachHang.getTenLoaiKhach());
        tvEmail.setText(khachHang.getEmail());
        edtMatKhau.setText(khachHang.getMatKhau());
    }


    class ContacTask_DonHang extends AsyncTask<Void, Void, ArrayList<DonHang>>
    {

        @Override
        protected ArrayList<DonHang> doInBackground(Void... voids) {
            ArrayList<DonHang> ds =new ArrayList<DonHang>();

            try {
                String strUrl="https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/LayDonHangChoDuyetMotKhach.php?MaNguoiDung="
                        +khachHang.getMaNguoiDung();
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

            ArrayList<DonHang> dsDaMua =new ArrayList<DonHang>();
            ArrayList<DonHang> dsChoDuyet =new ArrayList<DonHang>();
            for (DonHang donHang:donHangs) {
                if(donHang.getTrangThai().equals("0"))
                {
                    dsChoDuyet.add(donHang);
                }
                if(donHang.getTrangThai().equals("1"))
                {
                    dsDaMua.add(donHang);
                }
            }
            Toast.makeText(getContext(), "donghang:"+donHangs.size(), Toast.LENGTH_SHORT).show();
            adapterDonHangChoDuyet=new AdapterDonHang(dsChoDuyet,getContext());
            adapterDonHangDaMua=new AdapterDonHang(dsDaMua,getContext());

            listViewDonHangChoDuyet.setAdapter(adapterDonHangChoDuyet);
            listViewDonHangDaMua.setAdapter(adapterDonHangDaMua);
        }
    }

}