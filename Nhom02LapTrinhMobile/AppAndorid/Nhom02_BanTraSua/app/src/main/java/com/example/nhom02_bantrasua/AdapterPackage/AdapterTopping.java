package com.example.nhom02_bantrasua.AdapterPackage;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.CheckBox;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.nhom02_bantrasua.Model.Topping;
import com.example.nhom02_bantrasua.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

public class AdapterTopping extends BaseAdapter {
    ArrayList<Topping> arrayListTopping;
    ArrayList<Topping> arrayListTopping1=new ArrayList<Topping>();
    Context context;
    public  AdapterTopping(ArrayList<Topping> ds, Context context)
    {
        this.context=context;
        this.arrayListTopping=ds;
    }
    @Override
    public int getCount() {
        return arrayListTopping.size();
    }

    @Override
    public Object getItem(int i) {
        return arrayListTopping.get(i);
    }

    @Override
    public long getItemId(int i) {
        return i;
    }

    public class ViewHolder_Topping
    {
        ImageView imgTopping;
        TextView tvTenTopping,tvGiaTopping;
        CheckBox cbTopping;
    }
    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        ViewHolder_Topping viewHolder=null;
        if(view==null)
        {
            viewHolder=new ViewHolder_Topping();
            LayoutInflater inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            view=inflater.inflate(R.layout.customlayout_topping,null);
            viewHolder.imgTopping=view.findViewById(R.id.imgTopping);
            viewHolder.tvGiaTopping=view.findViewById(R.id.tvGiaTopping);
            viewHolder.tvTenTopping=view.findViewById(R.id.tvTenTopping);
            viewHolder.cbTopping=view.findViewById(R.id.cbTopping);
            view.setTag(viewHolder);

        }
        else
        {
            viewHolder=(ViewHolder_Topping) view.getTag();
            Topping topping=(Topping) getItem(i);
            viewHolder.tvTenTopping.setText(topping.getTenTopping());
            viewHolder.tvGiaTopping.setText(String.valueOf(topping.getGia()));

            Picasso picasso=Picasso.with(context);
            picasso.load(topping.getHinhAnh()).resize(90,90)
                    .placeholder(R.drawable.trasua)
                    .into(viewHolder.imgTopping);
            picasso.cancelRequest(viewHolder.imgTopping);
            picasso.invalidate(topping.getHinhAnh());


        }
        viewHolder.cbTopping.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Topping topping=(Topping) arrayListTopping.get(i);
                arrayListTopping1.add(topping);
            }
        });
        return view;
    }
    public ArrayList<Topping> DanhSachToppingDaChon()
    {
        return arrayListTopping1;
    }

}
