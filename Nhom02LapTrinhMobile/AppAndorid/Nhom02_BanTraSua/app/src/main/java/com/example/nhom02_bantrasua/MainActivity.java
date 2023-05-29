package com.example.nhom02_bantrasua;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.FragmentStatePagerAdapter;
import androidx.viewpager.widget.ViewPager;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.widget.Toast;

import com.example.nhom02_bantrasua.Model.KhachHang;
import com.google.android.material.bottomnavigation.BottomNavigationView;

public class MainActivity extends AppCompatActivity {

    BottomNavigationView mBottomNavigationView;
//    public KhachHang khachHang=new KhachHang("1","3","Khách hàng thân thiết","Võ Nguyễn Duy Tân","0984123456","0984123456","DefaultPerson.pgn",
//            "1","2002-02-08","duytantt9@gmail.com","123",0);
public KhachHang khachHang=new KhachHang();
    private ViewPager mViewPager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        getSupportActionBar().hide();

        Intent intent= getIntent();
        Bundle bundle=intent.getExtras();
        if(bundle!=null)
        {
            khachHang=(KhachHang) bundle.getSerializable("KhachHang");
            //Toast.makeText(this, khachHang.getTenNguoiDung(), Toast.LENGTH_SHORT).show();
        }

        addControls();

        ViewPagerAdapter viewPagerAdapter=new ViewPagerAdapter(getSupportFragmentManager(),
                FragmentStatePagerAdapter.BEHAVIOR_SET_USER_VISIBLE_HINT, khachHang);
        mViewPager.setAdapter(viewPagerAdapter);

        mViewPager.addOnPageChangeListener(new ViewPager.OnPageChangeListener() {
            @Override
            public void onPageScrolled(int position, float positionOffset, int positionOffsetPixels) {

            }

            @Override
            public void onPageSelected(int position) {
                switch (position)
                {
                    case 0:
                        mBottomNavigationView.getMenu().findItem(R.id.TabProduct).setChecked(true);
                        break;
                    case 1:
                        mBottomNavigationView.getMenu().findItem(R.id.TabCart).setChecked(true);
                        break;
                    case 2:
                        mBottomNavigationView.getMenu().findItem(R.id.TabHome).setChecked(true);
                        break;
                    case 3:
                        mBottomNavigationView.getMenu().findItem(R.id.TabNotification).setChecked(true);
                        break;
                    case 4:
                        mBottomNavigationView.getMenu().findItem(R.id.TabPerson).setChecked(true);
                        break;
                }

            }

            @Override
            public void onPageScrollStateChanged(int state) {

            }
        });
        mBottomNavigationView.setOnNavigationItemSelectedListener(new BottomNavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                switch (item.getItemId())
                {
                    case R.id.TabProduct:
                    {
                        mViewPager.setCurrentItem(0);
                        break;
                    }

                    case R.id.TabCart:
                    {
                        mViewPager.setCurrentItem(1);
                        break;
                    }

                    case R.id.TabHome:
                    {
                        mViewPager.setCurrentItem(2);
                        break;
                    }

                    case R.id.TabNotification:
                    {
                        mViewPager.setCurrentItem(3);
                        break;
                    }

                    case R.id.TabPerson:
                    {
//                        FragmentManager fragmentManager = getSupportFragmentManager();
//                        FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
//                        fragmentManager.popBackStack(null, FragmentManager.POP_BACK_STACK_INCLUSIVE);
//                        List<Fragment> fragmentList=fragmentManager.getFragments();
//                        if(fragmentList!=null ||fragmentList.size()>0)
//                        {
//                            for(Fragment fragment:fragmentList)
//                            {
//                                fragmentTransaction.remove(fragment);
//                            }
//                        }
//                        fragmentTransaction.commit();
                        mViewPager.setCurrentItem(4);
                        break;
                    }

                }
                return false;
            }
        });
    }

    private void addControls() {
        mBottomNavigationView=(BottomNavigationView) findViewById(R.id.bottomNavigation);
        mViewPager=(ViewPager) findViewById(R.id.viewPager);
        mViewPager.setCurrentItem(2);
    }



}