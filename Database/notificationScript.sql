set serveroutput on;
declare
v_data timestamp:='12-01-2017 00:00:00';
v_nr integer:=0;
v_dist integer;
id_kid integer;
begin
  loop
  v_data:=v_data+interval '30' minute;
  v_dist:=dbms_random.value(30,100);
  id_kid:=dbms_random.value(1,10);
  insert into notifications values(id_kid,v_data,0,v_dist);
  v_nr:=v_nr+1;
  exit when v_nr=2000;
  end loop;
end;
/
insert into monitoring values(0,1);
insert into monitoring values(0,2);
insert into monitoring values(0,3);
insert into monitoring values(0,4);
insert into monitoring values(0,5);
insert into monitoring values(0,6);
insert into monitoring values(0,7);
insert into monitoring values(0,8);
insert into monitoring values(0,9);
insert into monitoring values(0,10);
