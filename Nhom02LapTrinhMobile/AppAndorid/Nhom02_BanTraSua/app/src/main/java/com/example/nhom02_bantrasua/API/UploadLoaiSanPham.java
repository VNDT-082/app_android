package com.example.nhom02_bantrasua.API;

import com.example.nhom02_bantrasua.Model.LoaiSanPham;
import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.Retrofit;
import retrofit2.converter.gson.GsonConverterFactory;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.Part;

public interface UploadLoaiSanPham {
    public static String URL="https://vndt2001200082.000webhostapp.com/JsonDataForAndroid/";
    Gson gson=new GsonBuilder().setDateFormat("yyyy/MM/dd").create();
    UploadLoaiSanPham uploadLoaiSanPham=new Retrofit.Builder()
            .baseUrl(URL)
            .addConverterFactory(GsonConverterFactory.create(gson))
            .build()
            .create(UploadLoaiSanPham.class);
    @Multipart
    @POST("APIThemLoaiSanPham.php")
    Call<String> ThemLoaiSanPham(@Part (Const.TenLoai)RequestBody TenLoai,
                                      @Part (Const.HinnAnh)RequestBody file_LoaiSanPham);

}
