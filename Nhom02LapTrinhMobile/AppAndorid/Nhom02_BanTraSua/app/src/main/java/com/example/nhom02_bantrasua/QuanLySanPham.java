package com.example.nhom02_bantrasua;

import androidx.activity.result.ActivityResult;
import androidx.activity.result.ActivityResultCallback;
import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.Manifest;
import android.app.Activity;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.provider.MediaStore;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.Spinner;
import android.widget.TextView;

import com.example.nhom02_bantrasua.AdapterPackage.AdapterProduct;
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

public class QuanLySanPham extends AppCompatActivity {

    public static final int REQUEST_CODE=10;
    public static final String TAG=QuanLySanPham.class.getName();
    ImageButton btnback, btnfile;
    ImageView imgSP;
    TextView tvTenHinhAnh;
    EditText edtTenSP, edtMoTa, edtGiaSP;
    Spinner spinnerLoaiSP, spinnerTrangThai;
    Button btnXoa, btnSua, btnThem;
    ListView listView;

    AdapterProduct adapterProduct;
    //____________________________________________________________________
    private ActivityResultLauncher<Intent> activityResultLauncher=registerForActivityResult(
            new ActivityResultContracts.StartActivityForResult(),
            new ActivityResultCallback<ActivityResult>() {
                @Override
                public void onActivityResult(ActivityResult result) {
                    Log.e(TAG,"onActivityResult");
                    if(result.getResultCode()== Activity.RESULT_OK)
                    {
                        Intent duLieu=result.getData();
                        if(duLieu==null)
                        {
                            return;
                        }
                        Uri uri=duLieu.getData();

                        try {
                            Bitmap bitmap= MediaStore.Images.Media.getBitmap(getContentResolver(),uri);
                            imgSP.setImageBitmap(bitmap);
                        } catch (IOException e) {
                            throw new RuntimeException(e);
                        }
                    }
                }
            });


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_quan_ly_san_pham);
        getSupportActionBar().hide();
        addControls();
        ContacTask contacTask=new ContacTask();
        contacTask.execute();
        btnfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                LayHinhAnh();
            }
        });
        btnback.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(QuanLySanPham.this,TrangChuAdmin.class);
                startActivity(intent);
            }
        });
    }

    private void addControls() {
        btnback = (ImageButton) findViewById(R.id.btnback);
        btnfile = (ImageButton) findViewById(R.id.btnfile);
        imgSP = (ImageView) findViewById(R.id.imgSP);
        tvTenHinhAnh = (TextView) findViewById(R.id.tvTenHinhAnh);
        edtTenSP = (EditText) findViewById(R.id.edtTenSP);
        edtMoTa = (EditText) findViewById(R.id.edtMoTa);
        edtGiaSP = (EditText) findViewById(R.id.edtGiaSP);
        spinnerLoaiSP = (Spinner) findViewById(R.id.spinnerLoaiSP);
        spinnerTrangThai = (Spinner) findViewById(R.id.spinnerTrangThai);
        btnSua = (Button) findViewById(R.id.btnSua);
        btnXoa = (Button) findViewById(R.id.btnXoa);
        btnThem = (Button) findViewById(R.id.btnThem);
        listView = (ListView) findViewById(R.id.listView);
    }

    private void LayHinhAnh() {
        if (Build.VERSION.SDK_INT < Build.VERSION_CODES.M) {
            openFileAnh();
            return;
        }

        if (checkSelfPermission(Manifest.permission.READ_EXTERNAL_STORAGE) == PackageManager.PERMISSION_GRANTED) {
            openFileAnh();
        }
        else {
            String[] permission={Manifest.permission.READ_EXTERNAL_STORAGE};
            requestPermissions(permission,REQUEST_CODE);

        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if(requestCode==REQUEST_CODE)
        {
            if(grantResults.length>0 && grantResults[0]==PackageManager.PERMISSION_GRANTED)
            {
                openFileAnh();
            }
        }

    }

    private void openFileAnh() {
        Intent intent=new Intent();
        intent.setType("image/*");
        intent.setAction(Intent.ACTION_GET_CONTENT);
        activityResultLauncher.launch(Intent.createChooser(intent,"Chọn ảnh"));
    }
    class ContacTask extends AsyncTask<Void, Void, ArrayList<Product>>
    {

        @Override
        protected ArrayList<Product> doInBackground(Void... voids) {
            ArrayList<Product> ds =new ArrayList<Product>();
            try {

                URL url=new URL("https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/jSonSanPham.php");
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
            adapterProduct=new AdapterProduct(products,QuanLySanPham.this,null);
            listView.setAdapter(adapterProduct);
        }
    }
}
