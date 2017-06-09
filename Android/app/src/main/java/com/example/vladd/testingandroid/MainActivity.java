package com.example.vladd.testingandroid;

import android.Manifest;
import android.content.pm.PackageManager;
import android.location.Location;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.FloatMath;
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
import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.GooglePlayServicesUtil;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.location.LocationRequest;
import com.google.android.gms.location.LocationServices;

import java.util.HashMap;
import java.util.Map;

import android.hardware.Sensor;
import android.hardware.SensorManager;
import android.hardware.SensorEvent;
import android.hardware.SensorEventListener;
import android.widget.TextView;


public class MainActivity extends AppCompatActivity implements SensorEventListener, GoogleApiClient.ConnectionCallbacks,
        GoogleApiClient.OnConnectionFailedListener, com.google.android.gms.location.LocationListener {

    private TextView xText, yText, zText;
    private Sensor mySensor;
    private SensorManager SM;
    private static int count;
    private static int timer;
    private static int relevantTimer;
    private static int checkType;
    private static int countCheckType;
    private static int zType,yType,xType;

    //for gps location
    private static final int MY_PERMISSION_REQUEST_CODE = 7171;
    private static final int PLAY_SERVICES_RESOLUTION_REQUEST = 7172;
    private TextView txtCoordinates;
    private TextView txtCoordinates2;
    private Button btnGetCoordinates, btnLocationUpdates;
    private boolean mRequestingLocationUpdates = false;
    private LocationRequest mLocationRequest;
    private GoogleApiClient mGoogleApiClient;
    private Location mLastLocation;

    private static int UPDATE_INTERVAL = 5000;
    private static int FATEST_INTERVAL = 3000;
    private static int DISPLACEMENT = 0;


    EditText edtTen, edtMail;
    Button btnGoi;
    String URL_POST = "http://192.168.2.102:80/device/location";
    String URL_POST2 = "http://192.168.2.102:80/device/notification";


    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        switch (requestCode) {

            case MY_PERMISSION_REQUEST_CODE:
                if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {

                    if (checkPlayServices()) {

                        buildGoogleApiClient();
                    }
                }
                break;
        }
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        //Create Sensor Manager
        SM = (SensorManager) getSystemService(SENSOR_SERVICE);

        //Accelerometer Sensor
        mySensor = SM.getDefaultSensor(Sensor.TYPE_ACCELEROMETER);

        //Register sensor Listener
        SM.registerListener(this, mySensor, SensorManager.SENSOR_DELAY_NORMAL);

        //Assign TextView
        xText = (TextView) findViewById(R.id.xText);
        yText = (TextView) findViewById(R.id.yText);
        zText = (TextView) findViewById(R.id.zText);


        //Location
        txtCoordinates = (TextView) findViewById(R.id.txtCoordinates);
        txtCoordinates2 = (TextView) findViewById(R.id.txtCoordinates2);
        btnGetCoordinates = (Button) findViewById(R.id.btnGetCoordinates);
        btnLocationUpdates = (Button) findViewById(R.id.btnTrackLocation);

        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED
                && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED
                && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this, new String[]{

                    Manifest.permission.ACCESS_FINE_LOCATION,
                    Manifest.permission.ACCESS_COARSE_LOCATION

            }, MY_PERMISSION_REQUEST_CODE);


        } else {

            if (checkPlayServices()) {

                buildGoogleApiClient();
                createLocationRequest();

            }
        }


        btnGetCoordinates.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View view) {

                displayLocation();

            }
        });

        btnLocationUpdates.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View view) {

                togglePeriodicLocationUpdates();
            }

        });


    }

    @Override
    public void onStart(){

        super.onStart();
        if(mGoogleApiClient != null) {

            mGoogleApiClient.connect();
        }
    }

    @Override
    public void onStop() {

        LocationServices.FusedLocationApi.removeLocationUpdates(mGoogleApiClient,this);
        if(mGoogleApiClient != null)
            mGoogleApiClient.disconnect();
        super.onStop();

    }

    private void togglePeriodicLocationUpdates() {

        if(!mRequestingLocationUpdates){

            btnLocationUpdates.setText("Stop location update");
            mRequestingLocationUpdates = true;
            startLocationUpdates();
        }
        else
        {

            btnLocationUpdates.setText("Start location update");
            mRequestingLocationUpdates = false;
            stopLocationUpdates();
        }
    }


    private void displayLocation() {

        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED
                && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED
                && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            return;
        }
        mLastLocation = LocationServices.FusedLocationApi.getLastLocation(mGoogleApiClient);
        if (mLastLocation != null) {

            double latitude = mLastLocation.getLatitude();
            double longitude = mLastLocation.getLongitude();
            txtCoordinates.setText(latitude + "");
            txtCoordinates2.setText(longitude + "");
            POSTLocation();
        } else {
            txtCoordinates.setText("Couldn't get it. Make sure location is enabled - Refresh location after ");
            txtCoordinates2.setText("");


        }
    }

    private void createLocationRequest() {
        mLocationRequest = new LocationRequest();
        mLocationRequest.setInterval(UPDATE_INTERVAL);
        mLocationRequest.setFastestInterval(FATEST_INTERVAL);
        mLocationRequest.setPriority(LocationRequest.PRIORITY_HIGH_ACCURACY);
        mLocationRequest.setSmallestDisplacement(DISPLACEMENT);


    }

    private synchronized void buildGoogleApiClient() {

        mGoogleApiClient = new GoogleApiClient.Builder(this)
                .addConnectionCallbacks(this)
                .addOnConnectionFailedListener(this)
                .addApi(LocationServices.API).build();

        mGoogleApiClient.connect();
    }

    private boolean checkPlayServices() {

        int resultCode = GooglePlayServicesUtil.isGooglePlayServicesAvailable(this);
        if (resultCode != ConnectionResult.SUCCESS) {

            if (GooglePlayServicesUtil.isUserRecoverableError(resultCode)) {

                GooglePlayServicesUtil.getErrorDialog(resultCode, this, PLAY_SERVICES_RESOLUTION_REQUEST).show();
            } else {
                Toast.makeText(getApplicationContext(), "This device is not supported", Toast.LENGTH_LONG).show();
                finish();
            }
            return false;
        }
        return true;
    }


    @Override
    public void onSensorChanged(SensorEvent event) {

        xText.setText("X: " + event.values[0]);
        yText.setText("Y: " + event.values[1]);
        zText.setText("Z: " + event.values[2]);

        float gForce = (float) Math.sqrt( (event.values[0] / 9.8f) * (event.values[0] / 9.8f) + (event.values[1] / 9.8f)
                * (event.values[1] / 9.8f) + (event.values[2] / 9.8f) * (event.values[2] / 9.8f));
        System.out.println("GFORCE VALUE:" + gForce);
        if(gForce > 20 ) POSTNotification("MAJOR ACCIDENT HAS HAPPENED!");

        if (event.values[1] > 25 || event.values[1] < -25) {
            System.out.println("Y PROBLEM" + event.values[0]);
            if(relevantTimer>0) { yType++; count++;}
            else { yType=1; count=1;}
            relevantTimer=30;
        }
         if (event.values[2] > 25 || event.values[2] < -25) {
            System.out.println("Z PROBLEM" + event.values[1]);
            if(relevantTimer>0) {zType++; count++;}
            else { zType=1; count=1;}
            relevantTimer=30;
        }
         if (event.values[0] > 25 || event.values[0] < -25 ) {
            System.out.println("X PROBLEM" + event.values[2]);
            if(relevantTimer>0) {xType++; count++;}
            else {xType=1; count=1;}
            relevantTimer=30;
        }


        if (count > 10 ) {

            if(timer<=0) {

                System.out.println("SIGNAL ACCIDENT");
                count = 0;
                timer = 300;
                checkType = 1;
            }
        }

        if(checkType == 1) {
            checkType=0;
            int max;
            char c;
            System.out.println("CHECKING TYPES" + xType + " " + yType + " " + zType);
            if(xType>yType) { max=xType; c='x'; }
            else {max=yType; c='y';}
            if(zType>max) { max=zType; c='z'; }

            if(gForce > 5) POSTNotification("IMPORTANT!! Severe accident such as a car crash might have taken place!");
            else if(c=='z') POSTNotification("Warning! Possible fall");
                 else if(c=='x') POSTNotification("Warning! The child is running");
                      else if(c=='y') POSTNotification("Accelerometer giving high values - unlikely small accident");
        }

        System.out.println(timer);
        timer--;
        if(timer<-20000) timer=0;
        relevantTimer--;
        if(relevantTimer<0) {
            xType=0;
            yType=0;
            zType=0;
            relevantTimer=0;
            count=0;
        }
    }

    @Override
    public void onAccuracyChanged(Sensor sensor, int accuracy) {

        //Not in use
    }

    private void POSTLocation() {

        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_POST, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {

                Toast.makeText(getApplication(), response, Toast.LENGTH_SHORT).show();
            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(MainActivity.this, error + "", Toast.LENGTH_SHORT).show();
            }
        }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {

                Map<String, String> params = new HashMap<String, String>();
                String LAT = txtCoordinates.getText().toString();
                String LONG = txtCoordinates2.getText().toString();
                String ID = "ybUEPII8H5iYLhwzw7Xz8Dk7hgRnafsDBDF8fHExCsQ=";
                params.put("LAT", LAT);
                params.put("LONG", LONG);
                params.put("ID", ID);

                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

    private void POSTNotification(final String type) {

        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL_POST2, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {

                Toast.makeText(getApplication(), response, Toast.LENGTH_SHORT).show();
            }
        }, new Response.ErrorListener() {

            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(MainActivity.this, error + "", Toast.LENGTH_SHORT).show();
            }
        }
        ) {
            @Override
            protected Map<String, String> getParams() throws AuthFailureError {

                Map<String, String> params = new HashMap<String, String>();
                String NOTIF = type;
                String ID = "ybUEPII8H5iYLhwzw7Xz8Dk7hgRnafsDBDF8fHExCsQ=";
                params.put("NOTIF", NOTIF);
                params.put("ID", ID);

                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

    private void startLocationUpdates() {

        if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            return;
        }
        LocationServices.FusedLocationApi.requestLocationUpdates(mGoogleApiClient, mLocationRequest, this);

    }

    private void stopLocationUpdates() {

            LocationServices.FusedLocationApi.removeLocationUpdates(mGoogleApiClient,this);
    }

    @Override
    public void onConnected(@Nullable Bundle bundle) {
        displayLocation();
        if(mRequestingLocationUpdates)
            startLocationUpdates();

    }


    @Override
    public void onConnectionSuspended(int i) {
        mGoogleApiClient.connect();
    }

    @Override
    public void onConnectionFailed(@NonNull ConnectionResult connectionResult) {
        //not used
    }

    @Override
    public void onLocationChanged(Location location) {

        mLastLocation = location;
        displayLocation();
    }
}
