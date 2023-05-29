package com.example.nhom02_bantrasua;

import android.content.Context;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.LinearLayout;
import android.widget.ListView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;

import com.example.nhom02_bantrasua.AdapterPackage.AdapterProduct;
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
 * Use the {@link FragmentDanhSachSanPham#newInstance} factory method to
 * create an instance of this fragment.
 */
public class FragmentDanhSachSanPham extends Fragment {

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";
    Context context;
    private ListView listView;
    private View mView;
    private LinearLayout linearLayout_fragmentdssp;

    private AdapterProduct customAdapterProduct;
    ArrayList<Product> dsSanPham;
    //CustomAdapterProduct customAdapterProduct;
    AdapterProduct adapterProduct;
    static KhachHang khachHang=new KhachHang();

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;


    public FragmentDanhSachSanPham() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment FragmentDanhSachSanPham.
     */
    // TODO: Rename and change types and number of parameters
    //public static FragmentDanhSachSanPham newInstance(String param1, String param2,KhachHang khachHang) {
    public static FragmentDanhSachSanPham newInstance(String param1, String param2,KhachHang khachHang) {
        FragmentDanhSachSanPham fragment = new FragmentDanhSachSanPham();
        Bundle args = new Bundle();
        args.putString(ARG_PARAM1, param1);
        args.putString(ARG_PARAM2, param2);

        args.putSerializable("KhachHang",khachHang);
        //FragmentDanhSachSanPham fragmentDanhSachSanPham=new FragmentDanhSachSanPham();

        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mParam1 = getArguments().getString(ARG_PARAM1);
            mParam2 = getArguments().getString(ARG_PARAM2);
            khachHang=(KhachHang) getArguments().getSerializable("KhachHang");
        }
    }

    @Override
    public void onViewCreated(@NonNull View view, @Nullable Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        mView= inflater.inflate(R.layout.fragment_danh_sach_san_pham, container, false);

        addControls(mView);

        ContacTask contacTask=new ContacTask();
        contacTask.execute();


        return  mView;
    }

    private void addControls(View view) {
        listView=(ListView) view.findViewById(R.id.listView);
        linearLayout_fragmentdssp=(LinearLayout) view.findViewById(R.id.linearLayout_fragmentdssp);
    }


    class ContacTask extends AsyncTask<Void, Void, ArrayList<Product>>
    {

        @Override
        protected ArrayList<Product> doInBackground(Void... voids) {
            ArrayList<Product> ds =new ArrayList<Product>();
            try {

                URL url=new URL("https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/jSonSanPham.php");
                //URL url=new URL("http://192.168.19.184/WebsiteBanHang_VoNguyenDuyTan_2001200082/JsonDataForAndroid/jSonSanPham.php");
                //URL url=new URL("https://vo-nguyen-duy-tan.000webhostapp.com/WebsiteBanHang_VoNguyenDuyTan_2001200082/JsonDataForAndroid/jSonSanPham.php");
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

            dsSanPham=new ArrayList<Product>();
            for (Product pr:products) {
                dsSanPham.add(pr);
            }
            adapterProduct=new AdapterProduct(dsSanPham,getContext(),khachHang);
            listView.setAdapter(adapterProduct);
        }
    }
}