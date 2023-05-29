package com.example.nhom02_bantrasua;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.ViewFlipper;

import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.example.nhom02_bantrasua.AdapterPackage.AdapterLoaiSP;
import com.example.nhom02_bantrasua.AdapterPackage.AdapterSanPhamMuaNhieu;
import com.example.nhom02_bantrasua.Model.KhuyenMai;
import com.example.nhom02_bantrasua.Model.LoaiSanPham;
import com.example.nhom02_bantrasua.Model.Product;
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

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link FragmentTrangChu#newInstance} factory method to
 * create an instance of this fragment.
 */
public class FragmentTrangChu extends Fragment {

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;

    private RecyclerView recylistLoaiSanPham, recyleViewSanPhamNoiBac;
    private ArrayList<Product> DanhSachSanPham;
    ArrayList<LoaiSanPham> dsLoaiSanPham;

    ArrayList<KhuyenMai> dsKhuyenMai;
    private AdapterLoaiSP adapterLoaiSP;
    private AdapterSanPhamMuaNhieu adapterSanPhamMuaNhieu;
    ImageButton btnSearch,btnLogin;
    EditText edtSearch;
    ViewFlipper viewFliper;
    View mView;

    public FragmentTrangChu() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment FragmentTrangChu.
     */
    // TODO: Rename and change types and number of parameters
    public static FragmentTrangChu newInstance(String param1, String param2) {
        FragmentTrangChu fragment = new FragmentTrangChu();
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
        mView= inflater.inflate(R.layout.fragment_trang_chu, container, false);
        addControls(mView);
        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(mView.getContext(),Login.class);
                startActivity(intent);
            }
        });
        ContacTask_LoaiSanPham contacTask=new ContacTask_LoaiSanPham();
        contacTask.execute();
        ContacTask_SPMuaNhieu contacTaskSP=new ContacTask_SPMuaNhieu();
        contacTaskSP.execute();
        ContacTask_KhuyenMai contacTask_khuyenMai=new ContacTask_KhuyenMai();
        contacTask_khuyenMai.execute();

        return mView;
    }
    private void addControls(View mView)
    {
        btnLogin=(ImageButton)mView.findViewById(R.id.btnLogin);
        btnSearch= (ImageButton) mView.findViewById(R.id.btnSearch);
        edtSearch=(EditText) mView.findViewById(R.id.edtSearch);
        recylistLoaiSanPham=(RecyclerView)mView.findViewById(R.id.recylistLoaiSanPham);
        recyleViewSanPhamNoiBac=(RecyclerView) mView.findViewById(R.id.recyleViewSanPhamNoiBac);
        viewFliper=(ViewFlipper) mView.findViewById(R.id.viewFliper);
    }
    class ContacTask_LoaiSanPham extends AsyncTask<Void, Void, ArrayList<LoaiSanPham>>
    {

        @Override
        protected ArrayList<LoaiSanPham> doInBackground(Void... voids) {
            ArrayList<LoaiSanPham> ds =new ArrayList<LoaiSanPham>();
            try {

                URL url=new URL("https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/jSonLoaiSanPham.php");
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
                    LoaiSanPham loaiSanPham=new LoaiSanPham();
                    String urlImage="https://vndt2001200082.000webhostapp.com/Images/imagesProducts/";
                    loaiSanPham.setMaLoai(jsonObject.getString("MaLoai"));
                    loaiSanPham.setTenLoai(jsonObject.getString("TenLoai"));
                    loaiSanPham.setHinhAnh(urlImage + jsonObject.getString("hinhanh"));
                    ds.add(loaiSanPham);
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

            return ds;
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

        }

        @Override
        protected void onPostExecute(ArrayList<LoaiSanPham> loaiSanPhams) {
            super.onPostExecute(loaiSanPhams);

            dsLoaiSanPham=new ArrayList<LoaiSanPham>();
            for (LoaiSanPham pr:loaiSanPhams) {
                dsLoaiSanPham.add(pr);
            }
            adapterLoaiSP=new AdapterLoaiSP(getContext(),dsLoaiSanPham);
            recylistLoaiSanPham.setAdapter(adapterLoaiSP);
            recylistLoaiSanPham.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.HORIZONTAL, false));
        }
    }
    class ContacTask_SPMuaNhieu extends AsyncTask<Void, Void, ArrayList<Product>>
    {

        @Override
        protected ArrayList<Product> doInBackground(Void... voids) {
            ArrayList<Product> ds =new ArrayList<Product>();
            try {

                URL url=new URL("https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/jSonTopTamSanPhamMuaMuaNhieu.php");
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
                    Product sp=new Product();
                    String urlImage="https://vndt2001200082.000webhostapp.com/Images/imagesProducts/";
                    sp.setMaSanPham(jsonObject.getString("maSanPham"));
                    sp.setTenSanPham(jsonObject.getString("tenSanPham"));
                    sp.setMaLoai(jsonObject.getString("maLoai"));
                    sp.setMoTa(jsonObject.getString("moTa"));
                    sp.setLuotMua(Integer.valueOf(jsonObject.getString("luotMua")));
                    sp.setHinhAnh(urlImage+jsonObject.getString("hinhAnh"));
                    sp.setGiaBan(Double.valueOf(jsonObject.getString("giaBan")));
                    ds.add(sp);
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

            return ds;
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

        }

        @Override
        protected void onPostExecute(ArrayList<Product> products) {
            super.onPostExecute(products);

            DanhSachSanPham=new ArrayList<Product>();
            for (Product pr:products) {
                DanhSachSanPham.add(pr);
            }
            adapterSanPhamMuaNhieu =new AdapterSanPhamMuaNhieu(getContext(), DanhSachSanPham);
            recyleViewSanPhamNoiBac.setAdapter(adapterSanPhamMuaNhieu);
            recyleViewSanPhamNoiBac.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.HORIZONTAL, false));
        }
    }

    class ContacTask_KhuyenMai extends AsyncTask<Void, Void, ArrayList<KhuyenMai>>
    {

        @Override
        protected ArrayList<KhuyenMai> doInBackground(Void... voids) {
            ArrayList<KhuyenMai> ds =new ArrayList<KhuyenMai>();
            try {

                URL url=new URL("https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/jSonLayDanhSachKhuyenMai.php");
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
                    KhuyenMai khuyenMai=new KhuyenMai();
                    String urlImage="https://vndt2001200082.000webhostapp.com/Images/imagesProducts/";
                    khuyenMai.setId(jsonObject.getString("id"));
                    khuyenMai.setMaSanPham(jsonObject.getString("MaSanPham"));
                    khuyenMai.setNoiDung(jsonObject.getString("NoiDung"));
                    khuyenMai.setChiTiet(jsonObject.getString("ChiTiet"));
                    khuyenMai.setNgayBatDau(jsonObject.getString("NgayBatDau"));
                    khuyenMai.setNgayKetThuc(jsonObject.getString("NgayKetThuc"));
                    khuyenMai.setHinhAnh(urlImage + jsonObject.getString("HinhAnh"));
                    ds.add(khuyenMai);
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

            return ds;
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

        }

        @Override
        protected void onPostExecute(ArrayList<KhuyenMai> khuyenMais) {
            super.onPostExecute(khuyenMais);

            dsKhuyenMai=new ArrayList<KhuyenMai>();
            for (KhuyenMai pr:khuyenMais) {
                dsKhuyenMai.add(pr);
            }
            for (KhuyenMai kn:dsKhuyenMai)
            {
                ViewFliperImages(kn.getHinhAnh());
            }       }
    }
    void ViewFliperImages(String img)
    {
        ImageView imageView=new ImageView(getContext());
        Picasso picasso=Picasso.with(getContext());
        picasso.load(img).fit()
                .placeholder(R.drawable.bannertranguyenchat)
                .into(imageView);
        picasso.invalidate(img);
        viewFliper.addView(imageView);
        viewFliper.setFlipInterval(3000);
        viewFliper.setAutoStart(true);
        viewFliper.setInAnimation(getContext(), android.R.anim.slide_in_left);
        viewFliper.setOutAnimation(getContext(), android.R.anim.slide_out_right);
    }
}