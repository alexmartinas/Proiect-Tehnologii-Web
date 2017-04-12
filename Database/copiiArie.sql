create or replace FUNCTION distance(lat1 number,lat2 number,lon1 number,lon2 number)
RETURN NUMBER AS
   v_R number:=6378.137;--raza pamantului
   dLat number;
   dLon number;
   v_c number;
   v_d number;
   v_a number;
   pi number;
BEGIN
    pi:=3.14159265358979;
    dLat:=lat2*pi/180-lat1*pi/180;
    dLon:=lon2*pi/180-lon1*pi/180;
    v_a:=sin(dLat/2) * sin(dLat/2) +cos(lat1 * pi / 180) * cos(lat2 * pi / 180) * sin(dLon/2) * sin(dLon/2);
    v_c := 2 * atan2(sqrt(v_a),sqrt(1-v_a));
    v_d:=v_R*v_c;
    v_d:=v_d*1000;
    return v_d;
END;
/

create or replace FUNCTION nr_copii(id_kid integer, distanta number)
RETURN NUMBER AS
v_x number;
v_y number;
v_varsta integer;
v_count integer;
BEGIN
    select location_x,location_y,age into v_x,v_y,v_varsta from children where id_child=id_kid;
    select count(id_child) into v_count from children where age=v_varsta and id_child!=id_kid and distance(location_x,v_x,location_y,v_y)<=distanta;  
    return v_count;
END;