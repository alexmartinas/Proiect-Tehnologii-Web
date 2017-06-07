package com.example.vladd.testingandroid;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {

    EditText edtTen,edtMail;
    Button btnGoi;
    String URL_POST = "http://192.168.2.102/demoandroid/post.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        edtTen = (EditText) findViewById(R.id.editText);
        edtMail = (EditText) findViewById(R.id.editText2);
        btnGoi = (Button) findViewById(R.id.button);

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

                Toast.makeText(getApplication(),response,Toast.LENGTH_SHORT).show();
            }
            }, new Response.ErrorListener() {

                @Override
                public void onErrorResponse(VolleyError error) {
                        Toast.makeText(MainActivity.this,error+"",Toast.LENGTH_SHORT).show();
                }
        }
        ){
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {

                Map<String,String> params = new HashMap<String,String>();
                String TEN = edtTen.getText().toString();
                String EMAIL = edtMail.getText().toString();
                params.put("TEN",TEN);
                params.put("EMAIL",EMAIL);

                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

}
