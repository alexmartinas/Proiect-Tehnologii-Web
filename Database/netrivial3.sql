create or replace FUNCTION functie(varsta integer,notificari integer)
RETURN varchar2 AS
v_id integer;
v_age integer;
v_count integer;     
dist_max integer:=0;
v_name varchar2(50);
BEGIN
   for indx in  (select id_child,distance,count(id_child) from notifications having count(id_child)>=notificari group by id_child,distance) loop
     select age into v_age from children where id_child=indx.id_child;
     if(v_age>varsta and indx.distance>dist_max)
        then
        v_id:=indx.id_child;
        dist_max:=indx.distance;
     end if; 
    end loop;
  select name into v_name from children where id_child=v_id;
return v_name;
END;