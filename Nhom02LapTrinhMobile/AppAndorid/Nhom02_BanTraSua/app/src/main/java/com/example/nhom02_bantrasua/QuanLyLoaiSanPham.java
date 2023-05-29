package com.example.nhom02_bantrasua;

import androidx.activity.result.ActivityResult;
import androidx.activity.result.ActivityResultCallback;
import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.Manifest;
import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.net.Uri;
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
import android.widget.Toast;

import com.example.nhom02_bantrasua.API.Const;
import com.example.nhom02_bantrasua.API.UploadLoaiSanPham;
import com.example.nhom02_bantrasua.Model.LoaiSanPham;
import com.example.nhom02_bantrasua.Model.RealPathUtil;

import java.io.File;
import java.io.IOException;

import okhttp3.MediaType;
import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.Callback;
import retrofit2.Response;

public class QuanLyLoaiSanPham extends AppCompatActivity {

    public static final int REQUEST_CODE=10;
    public static final String TAG=QuanLyLoaiSanPham.class.getName();
    ImageButton btnback, btnfile;
    ImageView imgSP;
    TextView tvTenHinhAnh;
    EditText edtTenLoai;
    Button btnXoa, btnSua, btnThem;
    ListView listView;
    Uri mUri;
    private ProgressDialog progressDialog;

    //_______________________________________________
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
                        mUri=uri;
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
        setContentView(R.layout.activity_quan_ly_loai_san_pham);
        getSupportActionBar().hide();
        addControls();
        progressDialog=new ProgressDialog(this);
        progressDialog.setMessage("Vui lòng chờ...");
        btnfile.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                LayHinhAnh();
            }
        });
        btnThem.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(mUri!=null)
                {
                    CallAPIThemSanPham();
                }
            }
        });
        btnback.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent=new Intent(QuanLyLoaiSanPham.this,TrangChuAdmin.class);
                startActivity(intent);
            }
        });
    }

    private void addControls() {
        btnback = (ImageButton) findViewById(R.id.btnback);
        btnfile = (ImageButton) findViewById(R.id.btnfile);
        imgSP = (ImageView) findViewById(R.id.imgSP);
        tvTenHinhAnh = (TextView) findViewById(R.id.tvTenHinhAnh);
        btnSua = (Button) findViewById(R.id.btnSua);
        btnXoa = (Button) findViewById(R.id.btnXoa);
        btnThem = (Button) findViewById(R.id.btnThem);
        listView = (ListView) findViewById(R.id.listView);
        edtTenLoai=(EditText) findViewById(R.id.edtTenLoai);
    }
    private void LayHinhAnh() {
        if (Build.VERSION.SDK_INT < Build.VERSION_CODES.M) {
            openFileAnh();
            return;
        }

        if (checkSelfPermission(android.Manifest.permission.READ_EXTERNAL_STORAGE) == PackageManager.PERMISSION_GRANTED) {
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

    private void CallAPIThemSanPham()
    {
        progressDialog.show();

        String TenLoai=edtTenLoai.getText().toString().trim();
        RequestBody requestBodyTenLoai=RequestBody.create(MediaType.parse("multipart/form-data"),TenLoai);
        String strFilePath= RealPathUtil.getRealPath(this, mUri);
        Log.e("filename: ",requestBodyTenLoai.toString());
        File file=new File(strFilePath);
        RequestBody requestBodyHinhAnh=RequestBody.create(MediaType.parse("multipart/form-data"),file);
        //MultipartBody.Part muPart=MultipartBody.Part.createFormData(Const.HinnAnh, file.getName(),requestBodyHinhAnh);
        //Log.e("filename: ",muPart.toString());

        UploadLoaiSanPham.uploadLoaiSanPham.ThemLoaiSanPham(requestBodyTenLoai,requestBodyHinhAnh).enqueue(new Callback<String>() {
            @Override
            public void onResponse(Call<String> call, Response<String> response) {
                progressDialog.dismiss();
                String kq="";
                kq= response.body();
                if(kq.equals("1"))
                {
                    Toast.makeText(QuanLyLoaiSanPham.this, kq+"thanh cong", Toast.LENGTH_SHORT).show();
                }
                else {
                    Toast.makeText(QuanLyLoaiSanPham.this, kq+" khong thanh cong", Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(Call<String> call, Throwable t) {
                progressDialog.dismiss();
                Toast.makeText(QuanLyLoaiSanPham.this, "Lỗi thêm loại", Toast.LENGTH_SHORT).show();
            }
        });


    }
}