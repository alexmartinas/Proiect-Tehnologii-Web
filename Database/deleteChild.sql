create or replace PROCEDURE delete_child(id_parinte integer,id_copil integer,mesaj out varchar2)AS
v_count integer:=0;
ok integer:=0;
BEGIN
  select count(id_child) into v_count from children where id_child=id_copil;
  if(v_count<1)
    then
      mesaj:='Copil inexistent';
  else
    select count(id_user) into v_count from monitoring where id_child=id_copil and id_user=id_parinte;
    if(v_count<1)
      then
       mesaj:='Nu monitorizati acest copil';
    else
      delete from  children where id_child=id_copil;
      delete from monitoring where id_child=id_copil and id_user=id_parinte;
      mesaj:='Stergere efectuata cu succes';
    end if;
  end if;
END;
