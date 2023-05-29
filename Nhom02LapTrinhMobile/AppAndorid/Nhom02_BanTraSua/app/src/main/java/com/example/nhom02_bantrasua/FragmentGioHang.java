package com.example.nhom02_bantrasua;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.fragment.app.Fragment;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.nhom02_bantrasua.AdapterPackage.AdapterGioHang;
import com.example.nhom02_bantrasua.Model.ChiTietToppingGioHang;
import com.example.nhom02_bantrasua.Model.GioHang;
import com.example.nhom02_bantrasua.Model.KhachHang;
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

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link FragmentGioHang#newInstance} factory method to
 * create an instance of this fragment.
 */
public class FragmentGioHang extends Fragment {

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";


    Context context;
    private ListView listView;
    private TextView tvTongTien;
    private Button btnThanhToan;
    private View mView;
    private EditText edtDiaChiNhanHang;

    ArrayList<GioHang> dsGioHang;

    long TongTien;

    private AdapterGioHang adapterGioHang;

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;
    public static KhachHang khachHang=new KhachHang();

    public FragmentGioHang() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment FragmentGioHang.
     */
    // TODO: Rename and change types and number of parameters
    public static FragmentGioHang newInstance(String param1, String param2,KhachHang khachHang) {
        FragmentGioHang fragment = new FragmentGioHang();
        Bundle args = new Bundle();
        args.putString(ARG_PARAM1, param1);
        args.putString(ARG_PARAM2, param2);

        args.putSerializable("KhachHang",khachHang);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mParam1 = getArguments().getString(ARG_PARAM1);
            mParam2 = getArguments().getString(ARG_PARAM2);
            //khachHang=(KhachHang) getArguments().getSerializable("KhachHang");
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        mView = inflater.inflate(R.layout.fragment_gio_hang, container, false);
        addControls(mView);
        MainActivity mainActivity=(MainActivity) getActivity();
        khachHang=(KhachHang) mainActivity.khachHang;

        if(khachHang.getMaNguoiDung().equals(""))
        {
            edtDiaChiNhanHang.setText("Hãy đăng nhập để mua hàng");
        }
        else {
            ContacTask_GioHang contacTask=new ContacTask_GioHang();
            contacTask.execute();
        }

        btnThanhToan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String urlDatMua="https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/APIDatMua.php";
                String diaChi=String.valueOf(edtDiaChiNhanHang.getText());
                DatMua(urlDatMua,khachHang.getMaNguoiDung(),diaChi);
            }
        });
        return mView;
    }
    public void addControls(View view)
    {
        listView=(ListView) view.findViewById(R.id.listViewGioHang);
        tvTongTien=(TextView) view.findViewById(R.id.tvTongTien);
        btnThanhToan=(Button) view.findViewById(R.id.btnDatNgay);
        edtDiaChiNhanHang=(EditText) view.findViewById(R.id.edtDiaChiNhanHang);
        //linearLayout_fragmentdssp=(LinearLayout) view.findViewById(R.id.linearLayout_fragmentdssp);
    }
    private void DatMua(String url,String MaNguoiDung,String DiaChi)
    {
        RequestQueue requestQueue= Volley.newRequestQueue(getContext());
        StringRequest stringRequest=new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                if(response.trim().equals("1"))
                {
                    Toast.makeText(getContext(), "Mua thành công.", Toast.LENGTH_SHORT).show();
                }
                else
                {
                    Toast.makeText(getContext(), "Mua thành không công.", Toast.LENGTH_SHORT).show();

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
                params.put("MaNguoiDung",MaNguoiDung.trim());
                params.put("DiaChiNhanHang",DiaChi.trim());

                return params;
            }
        };
        requestQueue.add(stringRequest);
    }

    class ContacTask_GioHang extends AsyncTask<Void, Void, ArrayList<GioHang>>
    {

        @Override
        protected ArrayList<GioHang> doInBackground(Void... voids) {
            ArrayList<GioHang> ds =new ArrayList<GioHang>();
            try {

                URL url=new URL("https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/jSonGetGioHangMotKhachHang.php?MaKhachHang="
                        +khachHang.getMaNguoiDung());
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
                if(jsonArray==null || jsonArray.length()<=0)
                {
                    GioHang gioHang=new GioHang();
                    String urlImage="https://vndt2001200082.000webhostapp.com/Images/imagesProducts/";
                    gioHang.setID("0");
                    gioHang.setMaNguoiDung("0");
                    gioHang.setMaSanPham("0");
                    gioHang.setTenSanPham("Chưa có sản phẩm nào trong giỏ hàng");
                    gioHang.setGiaSanPham("0");
                    gioHang.setHinhAnh(urlImage + "SizeL.png");
                    gioHang.setMaSize("0");
                    gioHang.setGiaSize("0");
                    gioHang.setSoLuong("0");
                    gioHang.setLuongDuong("0");
                    gioHang.setLuongDa("");
                    ds.add(gioHang);
                    return ds;
                }
                else
                {
                    for(int i=0;i<jsonArray.length();i++)
                    {
                        JSONObject jsonObject =jsonArray.getJSONObject(i);
                        GioHang gioHang=new GioHang();
                        String urlImage="https://vndt2001200082.000webhostapp.com/Images/imagesProducts/";
                        gioHang.setID(jsonObject.getString("ID"));
                        gioHang.setMaNguoiDung(jsonObject.getString("MaNguoiDung"));
                        gioHang.setMaSanPham(jsonObject.getString("MaSanPham"));
                        gioHang.setTenSanPham(jsonObject.getString("TenSanPham"));
                        gioHang.setGiaSanPham(jsonObject.getString("GiaBan"));
                        gioHang.setHinhAnh(urlImage + jsonObject.getString("HinhAnh"));
                        gioHang.setMaSize(jsonObject.getString("MaSize"));
                        gioHang.setGiaSize(jsonObject.getString("Gia"));
                        gioHang.setSoLuong(jsonObject.getString("SoLuong"));
                        gioHang.setLuongDuong(jsonObject.getString("LuongDuong"));
                        gioHang.setLuongDa(jsonObject.getString("LuongDa"));


                        URL urlSub=new URL("https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/"+
                                "jSonLayChiTietToppingCuaSanPham.php?id="+gioHang.getID());
                        HttpURLConnection connectionSub=(HttpURLConnection) urlSub.openConnection();
                        connectionSub.setRequestMethod("GET");
                        InputStreamReader inputStreamReaderSub=new InputStreamReader(connectionSub.getInputStream());
                        StringBuilder stringBuilderSub=new StringBuilder();
                        BufferedReader bufferedReaderSub=new BufferedReader(inputStreamReaderSub);
                        String lineSub=null;
                        lineSub=bufferedReaderSub.readLine();
                        while (lineSub!=null)
                        {
                            stringBuilderSub.append(lineSub);
                            lineSub=bufferedReaderSub.readLine();

                        }
                        inputStreamReaderSub.close();
                        JSONArray jsonArraySub=new JSONArray(stringBuilderSub.toString());

                        if(jsonArraySub!=null)
                        {
                            ArrayList<ChiTietToppingGioHang> dsSub=new ArrayList<ChiTietToppingGioHang>();
                            for(int j=0;j<jsonArraySub.length();j++)
                            {
                                JSONObject jsonObjectSub =jsonArraySub.getJSONObject(j);
                                ChiTietToppingGioHang ct=new ChiTietToppingGioHang();
                                ct.setID(jsonObjectSub.getString("ID"));
                                Topping tp=new Topping();
                                tp.setMaTopping(jsonObjectSub.getString("MaTopping"));
                                tp.setGia(Double.valueOf(jsonObjectSub.getString("Gia")));
                                tp.setTenTopping(jsonObjectSub.getString("TenTopping"));
                                tp.setHinhAnh(urlImage + jsonObjectSub.getString(  "HinhAnh"));
                                ct.setTopping(tp);
                                dsSub.add(ct);
                            }
                            gioHang.setChiTietTopping(dsSub);

                        }

                        ds.add(gioHang);
                    }
                    return ds;
                }



            } catch (MalformedURLException e) {
                throw new RuntimeException(e);
            } catch (IOException e) {
                throw new RuntimeException(e);
            } catch (JSONException e) {
                throw new RuntimeException(e);
            }
            //return ds;
        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();

        }

        @Override
        protected void onPostExecute(ArrayList<GioHang> gioHangs) {
            super.onPostExecute(gioHangs);
            dsGioHang=new ArrayList<GioHang>();
            TongTien=Long.valueOf(0);
            for (GioHang pr:gioHangs) {
                dsGioHang.add(pr);
                TongTien+=Long.valueOf(pr.getGiaSanPham());
                if(pr.getChiTietTopping().size()!=0)
                {
                    for (ChiTietToppingGioHang topping: pr.getChiTietTopping()) {
                        TongTien+=(long)topping.getTopping().getGia();
                    }
                }

            }
            tvTongTien.setText("Tổng tiền: "+TongTien+" vnđ");
            if(!dsGioHang.get(0).getID().equals("0"))
            {
                adapterGioHang=new AdapterGioHang(dsGioHang,getContext());
                listView.setAdapter(adapterGioHang);
            }

        }
    }
}