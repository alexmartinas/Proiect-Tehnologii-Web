package com.example.vladd.testingandroid;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class IdDeviceActivity extends AppCompatActivity {

    private Button buttonId;
    Button btnGoi;
    private TextView ResponseView;
    EditText edtId;
    String URL_POST = "http://192.168.2.102:80/device/id";


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_id_device);

        edtId = (EditText)findViewById(R.id.editText);
        btnGoi = (Button) findViewById(R.id.setId);
        ResponseView = (TextView)findViewById(R.id.TextResponseView);

        btnGoi.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View view) {

                InsertSV();
            }

        });
    }

    private void InsertSV() {

        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_POST, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {

                Toast.makeText(getApplication(), response, Toast.LENGTH_SHORT).show();
                if(response.equals("You are now being tracked!"))
                {
                    Intent toy = new Intent(IdDeviceActivity.this, MainActivity.class);
                    startActivity(toy);
                }


            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                //System.out.println(error.networkResponse.data);
                Toast.makeText(IdDeviceActivity.this, error + "", Toast.LENGTH_SHORT).show();
            }
        }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {

                Map<String, String> params = new HashMap<String, String>();
                String Id = edtId.getText().toString();
                params.put("ID", Id);

                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

}
