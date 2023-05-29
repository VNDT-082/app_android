package com.example.nhom02_bantrasua;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;
import androidx.viewpager.widget.ViewPager;

import com.google.android.material.tabs.TabLayout;

/**
 * A simple {@link Fragment} subclass.
 * Use the {@link FragmentChiTietSanPham#newInstance} factory method to
 * create an instance of this fragment.
 */
public class FragmentChiTietSanPham extends Fragment {

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;
    private View view;

    private TabLayout tabLayout_ListProduct;
    private ViewPager viewPagerParent_dssp;
    public FragmentChiTietSanPham() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment ParentFragmentDanhSachSanPham.
     */
    // TODO: Rename and change types and number of parameters
    public static FragmentChiTietSanPham newInstance(String param1, String param2) {
        FragmentChiTietSanPham fragment = new FragmentChiTietSanPham();
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
//        addFragmentDanhSachSanPham();

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        view = inflater.inflate(R.layout.fragment_chi_tiet_san_pham, container, false);
//        addControls(view);


        return  view;
    }
//    private void addControls(View view) {
//        tabLayout_ListProduct=(TabLayout) view.findViewById(R.id.TabProduct);
//        viewPagerParent_dssp=(ViewPager) view.findViewById(R.id.viewPager);
//    }
//    private void addFragmentDanhSachSanPham()
//    {
//        try {
//            FragmentManager fragmentManager= getActivity().getSupportFragmentManager();
//            FragmentTransaction fragmentTransaction=fragmentManager.beginTransaction();
//            FragmentDanhSachSanPham frag=new FragmentDanhSachSanPham();
//            fragmentTransaction.add(R.id.viewPager,frag,"FragmentDanhSachSanPham");
//            fragmentTransaction.commit();
//        }
//        catch (Exception e)
//        {
//        }
//    }
}