create or replace PROCEDURE new_child(id_parinte integer,id_copil integer,nume varchar2,prenume varchar2,varsta integer,gen varchar2,mesaj out varchar2)AS
v_username varchar2(40);
v_password varchar2(40);
v_count integer:=0;
ok integer:=0;
BEGIN
  select count(id_child) into v_count from children where id_child=id_copil;
  if(v_count>0)
    then
      for indx in(select id_user from monitoring where id_child=id_copil) loop
          if(indx.id_user=id_parinte)
            then 
              ok:=1;
          end if;
      end loop;
      if(ok!=0)
       then 
         mesaj:='Deja monitorizati acest copil';
      else
        update children set nr_tutor=nr_tutor+1 where id_child=id_copil;
        insert into monitoring values(id_parinte,id_copil);
        mesaj:='Copil adaugat';
      end if;
    else
        insert into children values(id_copil,nume || ' ' || prenume,varsta,gen,1,0,0);
        insert into monitoring values(id_parinte,id_copil);
        mesaj:='Copil adaugat';
    end if;
END;
